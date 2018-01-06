<?php
class ControllerApiVDIOrder extends Controller {
	public function history() {
		$this->load->language('api/vdi_order');

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			// Add keys for missing post vars
			$keys = array(
				'order_status_id',
				'vendor_id',
				'notify',
				'append',
				'comment',
				'ref_number',
				'transporter'
			);

			foreach ($keys as $key) {
				if (!isset($this->request->post[$key])) {
					$this->request->post[$key] = '';
				}
			}

			$this->load->model('checkout/order');

			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$order_info = $this->model_checkout_order->getOrder($order_id);

			if ($order_info) {
        if($this->request->post['order_status_id'] == $this->config->get('po_status_waiting_po_confirmation_id')) {
					$this->request->post['order_status_id'] = $this->config->get('po_status_po_confirmed_id');
				} elseif ($this->request->post['order_status_id'] == $this->config->get('po_status_po_confirmed_id')) {
					$this->request->post['order_status_id'] = $this->config->get('po_status_shipping_confirmed_id');
					if($this->request->post['transporter'] == "shipping_by_myself") {
						$this->request->post['transporter'] = $this->language->get('shipping_by_myself');
					}
					$comment = "";
					if(isset($this->request->post['transporter'])) { $comment .= '<span class="alert alert-success alert-tracking">'.$this->request->post['transporter'].'</span>'; }
					if(isset($this->request->post['ref_number']) && strlen($this->request->post['ref_number']) > 0) { $comment .= '<span class="alert alert-success alert-tracking margin-left-10">'.$this->request->post['ref_number'].'</span>'; }
					$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$this->request->post['order_status_id'] . "', notify = '" . $this->request->post['notify'] . "', comment = '" . $comment . "', vendor_id = '" . (int)$this->request->post['vendor_id'] . "', date_added = NOW()");

					$this->db->query("UPDATE " . DB_PREFIX . "order SET carrier = '" . $this->db->escape($this->request->post['transporter']) ."', tracking_no = '" . $this->db->escape($this->request->post['ref_number']) . "' WHERE order_id='" . (int)$order_id . "'");
                                        $this->load->model('checkout/po');
                                        $this->model_checkout_po->sendRemercimentShipping($order_id);

					if (isset($this->request->post['vendor_id'])) {
						$order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "' AND vendor_id = '" . (int)$this->request->post['vendor_id'] . "'");

						foreach ($order_product_query->rows as $order_product) {
							$this->db->query("UPDATE " . DB_PREFIX . "product SET quantity = (quantity - " . (int)$order_product['quantity'] . ") WHERE product_id = '" . (int)$order_product['product_id'] . "' AND subtract = '1'");

							$order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product['order_product_id'] . "'");

							foreach ($order_option_query->rows as $option) {
								$this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET quantity = (quantity - " . (int)$order_product['quantity'] . ") WHERE product_option_value_id = '" . (int)$option['product_option_value_id'] . "' AND subtract = '1'");
							}
						}
					}
				}

				if (isset($this->request->post['vendor_id'])) {
					$this->db->query("UPDATE `" . DB_PREFIX . "order_status_vendor_update` SET order_status_id = '" . (int)$this->request->post['order_status_id'] . "', date_add = NOW() WHERE order_id = '" . (int)$order_id . "' AND vendor_id = '" . (int)$this->request->post['vendor_id'] . "'");
					$this->db->query("UPDATE `" . DB_PREFIX . "order_product` SET order_status_id = '" . (int)$this->request->post['order_status_id'] . "' WHERE order_id = '" . (int)$order_id . "' AND vendor_id = '" . (int)$this->request->post['vendor_id'] . "'");
				}

				$global_order_status_query = $this->db->query("SELECT order_status_id FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "' GROUP BY order_status_id");

				if($global_order_status_query->rows) {
					if (count($global_order_status_query->rows) == 1) {
						$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$this->request->post['order_status_id'] . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");
					}
				}

				$this->load->model('checkout/po');
				if($this->model_checkout_po->isAllPoConfirmed($order_id, $this->config->get('po_status_po_confirmed_id'))) {
					$this->model_checkout_po->sendRequestToShip($order_id);
				}

				//$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$this->request->post['order_status_id'] . "', notify = '" . $this->request->post['notify'] . "', comment = '" . $this->request->post['comment'] . "', vendor_id = '" . (int)$this->request->post['vendor_id'] . "', date_added = NOW()");

				if ($order_info['order_status_id'] && $this->request->post['order_status_id']) {
					$language = new Language($order_info['language_directory']);
					$language->load('mail/vdi_order');

					$subject = sprintf($language->get('text_update_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);

					$message  = $language->get('text_update_order') . ' ' . $order_id . "\n";
					$message .= $language->get('text_update_date_added') . ' ' . date($this->language->get('date_format_short'), strtotime($order_info['date_added'])) . "\n\n";

					$order_status_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$this->request->post['order_status_id'] . "' AND language_id = '" . (int)$order_info['language_id'] . "'");

					if ($order_status_query->num_rows) {
						$message .= $language->get('text_update_order_status') . "\n\n";
						$message .= $order_status_query->row['name'] . "\n\n";
					}

					if ($order_info['customer_id']) {
						$message .= $language->get('text_update_link') . "\n";
						$message .= $order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id . "\n\n";
					}

					if ($this->request->post['notify'] && $this->request->post['comment']) {
						$message .= $language->get('text_update_comment') . "\n\n";
						if ($this->getCurrentMultiVendorOrderStatus($order_id) == $this->getRequiredMultiVendorsOrderStatus($order_id)) {
							$getComments = $this->getVendorComment($order_id);
							foreach ($getComments AS $Comment) {
								if ($Comment['comment']) {
									$message .= strip_tags(html_entity_decode($Comment['comment'], ENT_QUOTES, 'UTF-8')) . "\n\n";
								}
							}
						} else {
							$message .= $this->request->post['comment'] . "\n\n";
						}
					}

					$message .= $language->get('text_update_footer');

					if ($this->config->get('mvd_sales_order_allow_notification')) {
						$mail = new Mail();
						$mail->protocol = $this->config->get('config_mail_protocol');
						$mail->parameter = $this->config->get('config_mail_parameter');
						$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
						$mail->smtp_username = $this->config->get('config_mail_smtp_username');
						$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
						$mail->smtp_port = $this->config->get('config_mail_smtp_port');
						$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

						$mail->setTo($order_info['email']);
						$mail->setFrom($this->config->get('config_email'));
						$mail->setSender($order_info['store_name']);
						$mail->setSubject($subject);
						$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
						$mail->send();
					} elseif ($this->getCurrentMultiVendorOrderStatus($order_id) == $this->getRequiredMultiVendorsOrderStatus($order_id)) {
						$mail = new Mail();
						$mail->protocol = $this->config->get('config_mail_protocol');
						$mail->parameter = $this->config->get('config_mail_parameter');
						$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
						$mail->smtp_username = $this->config->get('config_mail_smtp_username');
						$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
						$mail->smtp_port = $this->config->get('config_mail_smtp_port');
						$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

						$mail->setTo($order_info['email']);
						$mail->setFrom($this->config->get('config_email'));
						$mail->setSender($order_info['store_name']);
						$mail->setSubject($subject);
						$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
						$mail->send();
					}
				}

				$json['success'] = $this->language->get('text_success');
			} else {
				$json['error'] = $this->language->get('error_not_found');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getCurrentMultiVendorOrderStatus($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_status_vendor_update WHERE order_id = '" . (int)$order_id . "' AND order_status_id = '" . (int)$this->config->get('mvd_order_status') . "'");
		return $query->row['total'];
	}

	public function getRequiredMultiVendorsOrderStatus($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_status_vendor_update WHERE order_id = '" . (int)$order_id . "'");
		return $query->row['total'];
	}

	public function getVendorComment($order_id) {
		$query = $this->db->query("SELECT comment FROM " . DB_PREFIX . "order_history WHERE order_id = '" . (int)$order_id . "' ORDER BY order_history_id DESC");
		return $query->rows;
	}
}
