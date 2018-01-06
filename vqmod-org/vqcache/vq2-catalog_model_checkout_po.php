<?php
class ModelCheckoutPo extends Model {
  public function getOrder($order_id) {
    $order_query = $this->db->query("SELECT *, (SELECT os.name FROM `" . DB_PREFIX . "order_status` os WHERE os.order_status_id = o.order_status_id AND os.language_id = o.language_id) AS order_status FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int)$order_id . "'");

    if ($order_query->num_rows) {
      $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['payment_country_id'] . "'");

      if ($country_query->num_rows) {
        $payment_iso_code_2 = $country_query->row['iso_code_2'];
        $payment_iso_code_3 = $country_query->row['iso_code_3'];
      } else {
        $payment_iso_code_2 = '';
        $payment_iso_code_3 = '';
      }

      $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['payment_zone_id'] . "'");

      if ($zone_query->num_rows) {
        $payment_zone_code = $zone_query->row['code'];
      } else {
        $payment_zone_code = '';
      }

      $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['shipping_country_id'] . "'");

      if ($country_query->num_rows) {
        $shipping_iso_code_2 = $country_query->row['iso_code_2'];
        $shipping_iso_code_3 = $country_query->row['iso_code_3'];
      } else {
        $shipping_iso_code_2 = '';
        $shipping_iso_code_3 = '';
      }

      $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['shipping_zone_id'] . "'");

      if ($zone_query->num_rows) {
        $shipping_zone_code = $zone_query->row['code'];
      } else {
        $shipping_zone_code = '';
      }

      $this->load->model('localisation/language');

      $language_info = $this->model_localisation_language->getLanguage($order_query->row['language_id']);

      if ($language_info) {
        $language_code = $language_info['code'];
        $language_directory = $language_info['directory'];
      } else {
        $language_code = '';
        $language_directory = '';
      }

      return array(
        'order_id'                => $order_query->row['order_id'],
        'invoice_no'              => $order_query->row['invoice_no'],
        'invoice_prefix'          => $order_query->row['invoice_prefix'],
        'store_id'                => $order_query->row['store_id'],
        'store_name'              => $order_query->row['store_name'],
        'store_url'               => $order_query->row['store_url'],
        'customer_id'             => $order_query->row['customer_id'],
        'firstname'               => $order_query->row['firstname'],
        'lastname'                => $order_query->row['lastname'],
        'email'                   => $order_query->row['email'],
        'telephone'               => $order_query->row['telephone'],
        'fax'                     => $order_query->row['fax'],
        'custom_field'            => unserialize($order_query->row['custom_field']),
        'payment_firstname'       => $order_query->row['payment_firstname'],
        'payment_lastname'        => $order_query->row['payment_lastname'],
        'payment_company'         => $order_query->row['payment_company'],
        'payment_address_1'       => $order_query->row['payment_address_1'],
        'payment_address_2'       => $order_query->row['payment_address_2'],
        'payment_postcode'        => $order_query->row['payment_postcode'],
        'payment_city'            => $order_query->row['payment_city'],
        'payment_zone_id'         => $order_query->row['payment_zone_id'],
        'payment_zone'            => $order_query->row['payment_zone'],
        'payment_zone_code'       => $payment_zone_code,
        'payment_country_id'      => $order_query->row['payment_country_id'],
        'payment_country'         => $order_query->row['payment_country'],
        'payment_iso_code_2'      => $payment_iso_code_2,
        'payment_iso_code_3'      => $payment_iso_code_3,
        'payment_address_format'  => $order_query->row['payment_address_format'],
        'payment_custom_field'    => unserialize($order_query->row['payment_custom_field']),
        'payment_method'          => $order_query->row['payment_method'],
        'payment_code'            => $order_query->row['payment_code'],
        'shipping_firstname'      => $order_query->row['shipping_firstname'],
        'shipping_lastname'       => $order_query->row['shipping_lastname'],
        'shipping_company'        => $order_query->row['shipping_company'],
        'shipping_address_1'      => $order_query->row['shipping_address_1'],
        'shipping_address_2'      => $order_query->row['shipping_address_2'],
        'shipping_postcode'       => $order_query->row['shipping_postcode'],
        'shipping_city'           => $order_query->row['shipping_city'],
        'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
        'shipping_zone'           => $order_query->row['shipping_zone'],
        'shipping_zone_code'      => $shipping_zone_code,
        'shipping_country_id'     => $order_query->row['shipping_country_id'],
        'shipping_country'        => $order_query->row['shipping_country'],
        'shipping_iso_code_2'     => $shipping_iso_code_2,
        'shipping_iso_code_3'     => $shipping_iso_code_3,
        'shipping_address_format' => $order_query->row['shipping_address_format'],
        'shipping_custom_field'   => unserialize($order_query->row['shipping_custom_field']),
        'shipping_method'         => $order_query->row['shipping_method'],
        'shipping_code'           => $order_query->row['shipping_code'],
        'comment'                 => $order_query->row['comment'],
        'total'                   => $order_query->row['total'],
        'order_status_id'         => $order_query->row['order_status_id'],
        'order_status'            => $order_query->row['order_status'],
        'affiliate_id'            => $order_query->row['affiliate_id'],
        'commission'              => $order_query->row['commission'],
        'language_id'             => $order_query->row['language_id'],
        'language_code'           => $language_code,
        'language_directory'      => $language_directory,
        'currency_id'             => $order_query->row['currency_id'],
        'currency_code'           => $order_query->row['currency_code'],
        'currency_value'          => $order_query->row['currency_value'],
        'ip'                      => $order_query->row['ip'],
        'forwarded_ip'            => $order_query->row['forwarded_ip'],
        'user_agent'              => $order_query->row['user_agent'],
        'accept_language'         => $order_query->row['accept_language'],
        'date_modified'           => $order_query->row['date_modified'],
        'date_added'              => $order_query->row['date_added']
      );
    } else {
      return false;
    }
  }

  public function isAllPoConfirmed($order_id, $order_status_id) {
    $query = $this->db->query("SELECT COUNT(*) AS confirmed, (SELECT COUNT(*) FROM " . DB_PREFIX . "order_status_vendor_update WHERE order_id = '" . (int)$order_id . "') AS total FROM " . DB_PREFIX . "order_status_vendor_update WHERE order_status_id = '" . (int)$order_status_id . "' AND order_id = '" . (int)$order_id . "'");
		if ($query->row['confirmed'] == $query->row['total']) {
			return $query->row['confirmed'];
		} else {
			return false;
		}
  }

  public function sendRequestToShip($order_id) {
    $order_info = $this->getOrder($order_id);

    if ($order_info) {

      $order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

      foreach ($order_product_query->rows as $order_product) {
        $option_data_vendor = array();
        $order_option_vendor_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product['order_product_id'] . "'");

        $vmail = $this->db->query("SELECT pd.name AS name, p.model AS model, p.sku AS sku, vs.email AS email, vs.vendor_id AS vendor_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "vendor v ON (pd.product_id = v.vproduct_id) LEFT JOIN " . DB_PREFIX . "vendors vs ON (v.vendor = vs.vendor_id) WHERE p.product_id = '" . (int)$order_product['product_id'] . "'");

		//GV:05-SEP-2015 FOB price
        // BUG!!!
		// $fob = $this->getFobPrice( $order_product['product_id'] );
        $fob = $this->getFobPrice2( $order_product['product_id'], $order_id );
		$order_product['price'] = $fob['fob_price'] * $fob['pf'];
		$order_product['total'] = $order_product['quantity'] * $order_product['price'];
		$vintage = $this->getVintage( $order_product['product_id'] );
		$vmail->row['model'] = $vintage;

        $vendor_products[] = array(
          'name'     => $vmail->row['name'],
          'model'    => $vmail->row['model'],
          'sku'      => $vmail->row['sku'],
          'option'   => $option_data_vendor,
          'quantity' => $order_product['quantity'],
          'price'    => $order_product['price'],
          'total'    => $order_product['total'],
          'obs'      =>  $order_product['obs'],
          'product_id' => $order_product['product_id'],
          'tax'    => $order_product['tax'],
          'vendor_id' => $vmail->row['vendor_id'],
          'email'     => $vmail->row['email']
        );

        $vendor_list[] = array ('vendor_id' => $vmail->row['vendor_id']);
      }

      $vendor_unique = array_map("unserialize", array_unique(array_map("serialize", $vendor_list)));

      if ($vendor_products){

        foreach ($vendor_unique as $vendor) {
          if ($vendor['vendor_id']) {
            $data = array();
            $vemail = $this->db->query("SELECT *, CONCAT(firstname,' ',lastname) AS contact_name FROM `" . DB_PREFIX . "vendors` WHERE vendor_id = '" . (int)$vendor['vendor_id'] . "'");
            /* $cust_order_status_query = $this->db->query("SELECT name FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'"); */
            $language = new Language($order_info['language_directory']);
            $language->load('mail/vendor_email_shipping');

            $data['text_order_details'] = $language->get('text_order_details');
			$data['text_vat'] = $language->get('text_vat');

            $data['text_shipping_address'] = "<b>" . $language->get('text_shipping_address') . "</b><br/>";
            $data['date_ordered'] = '<b>' . $language->get('text_date_ordered') . ' </b>' . date('F j\, Y') . '<br/>';
            $data['logo'] = HTTP_SERVER . 'image/' . 'logo_new.png';
            $data['store_name'] = $order_info['store_name'];
            $data['store_url'] = $order_info['store_url'];
            $data['button_order'] = HTTP_SERVER . 'admin/index.php?route=sale/vdi_order/info&order_id=' . $order_id . '&tab=2';

            /*Show header title*/
            $data['title'] = sprintf($language->get('text_new_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);

            /*show vendor name*/
            $data['vendor_name'] = '<b>' . $language->get('text_title') . $vemail->row['contact_name'] . '</b>,' . "\n\n";

            /*show message to vendor*/
            $data['vendor_message'] = $language->get('text_vendor_message') . "\n\n";

            /*show vendor customer order id*/
            if ($this->config->get('mvd_show_order_id')) {
              $data['order_id'] = '<b>' . $language->get('text_vendor_order_id') . '</b>' . $order_id . '<br/>';
            } else {
              $data['order_id'] = '';
            }

            /*show vendor customer order status*/
            /* if ($this->config->get('mvd_show_order_status')) {
              $data['order_status'] = '<b>' . $language->get('text_order_status') . ' </b>' . $cust_order_status_query->row['name'] . '<br/>';
            } else { */
              $data['order_status'] = '';
            /* } */

            /*show payment method*/
            if ($this->config->get('mvd_show_payment_method')) {
              $data['payment_method'] = '<b>' . $language->get('text_payment_method') . ' </b>' . $order_info['payment_method'] . '<br/>';
            } else {
              $data['payment_method'] = '';
            }

            /*show vendor customer email*/
            if ($this->config->get('mvd_show_cust_email')) {
              $data['email_address'] = '<b>' . $language->get('text_email') . ' </b>' . $order_info['email'] . '<br/>';
            } else {
              $data['email_address'] = '';
            }

            /*show vendor customer telephone*/
            if ($this->config->get('mvd_show_cust_telephone')) {
              $data['telephone'] = '<b>' . $language->get('text_telephone') . ' </b>' . $order_info['telephone'] . '<br/>';
            } else {
              $data['telephone'] = '';
            }

            /*show vendor customer shipping address*/
				//Warehouse address
				$wh_info = array();
				$wh_info = $this->getWarehouseAddress();
				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					//'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => '',//$wh_info['shipping_firstname'],
					'lastname'  => '',//$wh_info['shipping_lastname'],
					'company'   => $wh_info['company'],
					'address_1' => $wh_info['address_1'],
					'address_2' => $wh_info['address_2'],
					'city'      => $wh_info['city'],
					'postcode'  => $wh_info['postcode'],
					'zone'      => '',
					//'zone_code' => $wh_info['zone_code'],
					'country'   => $wh_info['country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['cust_shipping_address'] = $shipping_address;

            /*show vendor information*/
            if ($this->config->get('mvd_show_vendor_address')) {
              $data['show_vendor_contact'] = True;
              $format = '<b>{firstname} {lastname}</b>' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city}, {postcode}' . "\n" . '{zone}, {country}';
                $find = array(
                  '{firstname}',
                  '{lastname}',
                  '{company}',
                  '{address_1}',
                  '{address_2}',
                  '{city}',
                  '{postcode}',
                  '{zone}',
                  '{country}'
                );

              $zone_name = $this->db->query("SELECT name FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$vemail->row['zone_id'] . "' AND country_id = '" . (int)$vemail->row['country_id'] . "'");
              $country_name = $this->db->query("SELECT name FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$vemail->row['country_id'] . "'");

                $replace = array(
                  'firstname' => $vemail->row['firstname'],
                  'lastname'  => $vemail->row['lastname'],
                  'company'   => $vemail->row['company'],
                  'address_1' => $vemail->row['address_1'],
                  'address_2' => $vemail->row['address_2'],
                  'city'      => $vemail->row['city'],
                  'postcode'  => $vemail->row['postcode'],
                  'zone'    => isset($zone_name->row['name']) ? $zone_name->row['name'] : 'None',
                  'country'   => $country_name->row['name']
                );

              $vendor_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

              $data['vendor_address'] = $vendor_address . '<br/>';
              $data['text_vendor_contact'] = $language->get('text_vendor_contact');

              /*show vendor email*/
              if ($this->config->get('mvd_show_vendor_email')) {
                $data['vendor_email'] = '<b>' . $language->get('text_email') . ' </b>' . $vemail->row['email'] . '<br/>';
              } else {
                $data['vendor_email'] = '';
              }

              /*show vendor telephone*/
              if ($this->config->get('mvd_show_vendor_telephone')) {
                $data['vendor_telephone'] = '<b>' . $language->get('text_telephone') . ' </b>' . $vemail->row['telephone'] . '<br/>';
              } else {
                $data['vendor_telephone'] = '';
              }

            } else {
              $data['show_vendor_contact'] = False;
            }
            /*end show vendor address*/

            $coupon = $this->db->query("SELECT * FROM " . DB_PREFIX . "vendor_discount WHERE order_id = '" . (int)$order_id . "' AND vendor_id = '" . (int)$vendor['vendor_id'] . "'");
            if (isset($coupon->row['amount']) > 0) {
              $data['coupon_title'] = $coupon->row['title'];
              $data['coupon'] = '-' . $this->currency->format($coupon->row['amount']);
            } else {
              $data['coupon'] = false;
            }

            $subtotal = 0;
            $vsubtotal = $this->db->query("SELECT SUM(total) AS sum_product_total, SUM(quantity*tax) as sum_product_tax FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "vendor v ON ( op.product_id = v.vproduct_id ) WHERE v.vendor =  '" . (int)$vendor['vendor_id'] . "' AND op.order_id =  '" . (int)$order_id . "'");
            $subtotal = $vsubtotal->row['sum_product_total'];

            $vat = $this->db->query("SELECT title FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' AND code = 'tax'");

            /*Get Shipping Cost*/
            $shipcost = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_shipping` WHERE vendor_id = '" . (int)$vendor['vendor_id'] . "' AND order_id = '" . (int)$order_id . "'");

            if ($this->config->get('tax_status') && ($vsubtotal->row['sum_product_tax'] != 0)) {
              $data['text_tax'] = $vat->row['title'];
              $data['tax'] = $this->currency->format($vsubtotal->row['sum_product_tax'] + (isset($shipcost->row['tax']) ? $shipcost->row['tax'] : '0') - (isset($coupon->row['tax']) ? $coupon->row['tax'] : '0'));
            } else {
              $data['tax'] = '0';
            }

            if ($shipcost->rows) {
              if ($shipcost->row['cost']) {
                $total = $vsubtotal->row['sum_product_total'] + $shipcost->row['cost'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] + $shipcost->row['tax'] -((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              } else {
                $total = $vsubtotal->row['sum_product_total'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] - ((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              }

              $data['shipping'] = $shipcost->row['title'] . ' (' . $this->weight->format($shipcost->row['weight'], $this->config->get('config_weight_class_id')) . ')';
              $data['scost'] = $this->currency->format($shipcost->row['cost']);

            } else {
              $total = $vsubtotal->row['sum_product_total'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] - ((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              $data['scost'] = 0;
            }

            /*END Get Shipping Cost*/

			//GV:05-SEP-2015 FOB price
			$fob_total = 0.0;
            foreach ($vendor_products as $vendor_product) {
              if ($vendor['vendor_id'] == $vendor_product['vendor_id']) {
				//GV: Fob price for each vendor
				$fob_total += $vendor_product['total'];
                
                   $fob = $this->getFobPrice2( $vendor_product['product_id'], $order_id );
                
                    
			         if (floatval($fob['fob_price']) == floatval($fob['fob_bottle_full_price'])){
        				$price = $this->currency->format($vendor_product['price'] + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
				        $total = $this->currency->format($vendor_product['price']*$vendor_product['quantity'], $order_info['currency_code'], $order_info['currency_value']);
			         }
			         else{
                        $label =  strlen($vendor_product['obs'])>1?$this->language->get('label_discount'):$this->language->get('label_special');
			            $price = '<del>'.$this->currency->format($fob['fob_bottle_full_price'] * $fob['pf'] +
                        ($this->config->get('config_tax') ? ($vendor_product['tax']) : 0),
                      $order_info['currency_code'], $order_info['currency_value']).'</del><br />'.$label.
                      '<span class="discounted_price">'.
                      $this->currency->format( $fob['fob_price'] * $fob['pf'] + 
                      ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</span>';
                      
					  $total = '<del>'.$this->currency->format($vendor_product['quantity'] * $fob['fob_bottle_full_price'] * $fob['pf'] +
                        ($this->config->get('config_tax') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0),
                      $order_info['currency_code'], $order_info['currency_value']).
                      '</del><br /><span class="discounted_price">'.
                      $this->currency->format($vendor_product['quantity'] * $fob['fob_price'] * $fob['pf'] + 
                      ($this->config->get('config_tax') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']).'</span>';

                     }

                $data['vendor_products'][] = array(
                  'name'     => $vendor_product['name'],
                  'option'   => $vendor_product['option'],
                  'model'    => $vendor_product['model'],
                  'sku'    => $vendor_product['sku'],
              //    'price'    => $this->currency->format($vendor_product['price'] + ($this->config->get('tax_status') ? $vendor_product['tax'] : 0)),
                  'quantity' => $vendor_product['quantity'],
             //     'total'    => $this->currency->format($vendor_product['total'] + ($this->config->get('tax_status') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0)),
                  'total'     => $total,
                  'price'    => $price,
                  'email'    => $vendor_product['email']
                );
              }
            }
			//GV: fob total price
            $subtotal = $fob_total;
			$total = $fob_total;

            $data['product'] = $language->get('column_product');
            $data['model'] = $language->get('text_vintage');
            $data['quantity'] = $language->get('column_quantity');
            $data['unit_price'] = $language->get('column_unit_price');
            $data['total'] = $language->get('column_total');
            $data['subtotal'] = $language->get('column_subtotal');
            $data['vendor_auto_msg'] = $language->get('text_vendor_auto_msg');
            $data['vendor_alert'] = $language->get('text_vendor_email') . $this->config->get('config_name');
            $data['vsubtotal'] = $this->currency->format($subtotal-$subtotal*0.2/1.2);
			$data['vat'] = $this->currency->format($subtotal*0.2/1.2);
            $data['vtotal'] = $this->currency->format($total);

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/vendor_email_shipping.tpl')) {
              $html = $this->load->view($this->config->get('config_template') . '/template/mail/vendor_email_shipping.tpl', $data);
            } else {
              $html = $this->load->view('default/template/mail/vendor_email_shipping.tpl', $data);
            }

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($vemail->row['email']);
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($this->config->get('config_name'));
            $mail->setSubject($language->get('text_vendor_email_subject') . $language->get('text_vendor_order') . $order_id . ' (' . $this->config->get('config_name') . ')');
            $mail->setHtml($html);
            $mail->send();

			$cust_order_status_query = $this->db->query("SELECT name FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'");
			 		$subject = sprintf($language->get('text_update_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);
					$this->load->model('setting/setting');
					$sms_settings = $this->model_setting_setting->getSetting('config');
					$message = $sms_settings['config_sms_update_order_message'];
					$message = str_replace("{vendor_name}", $vemail->row['contact_name'], $message);
					$message = str_replace("{order_id}", $order_id, $message);
					$message = str_replace("{order_date}", date('F j\, Y'), $message);
					$message = str_replace("{order_status}", $cust_order_status_query->row['name'], $message);
					$this->sendSms($vemail->row['telephone'], $message);

					$mail = new Mail();
					$mail->protocol = $this->config->get('config_mail_protocol');
					$mail->parameter = $this->config->get('config_mail_parameter');
					$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
					$mail->smtp_username = $this->config->get('config_mail_smtp_username');
					$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
					$mail->smtp_port = $this->config->get('config_mail_smtp_port');
					$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
					$subject='sms '.$order_status_id. ' PO:'.$send_po;
					$text = $vendor['vendor_id'].' Name:'.$vemail->row['contact_name'].'<br> Order Status '.$cust_order_status_query->row['name'].' <br>Tel: '.$vemail->row['telephone'].' : '.$message;
					$mail->setTo('admin@thinkwinetrade.com');
					//$mail->setTo($order_info['email']);
					$mail->setFrom($this->config->get('config_email'));
					$mail->setSender($this->config->get('config_email'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
					$mail->send();

          }
        }
      }
    }
  }

  public function logger($message) {
			$log = new Log('sms.log');
			$log->write($message);
	}

	public function sendSms($mobile_no, $message) {

			$this->load->model('setting/setting');
			$sms_settings = $this->model_setting_setting->getSetting('config');

			if(!$sms_settings['config_sms_enable'])
					return;

			try {
					$wsdl = "http://api.clickatell.com/soap/document_literal/webservice.php?wsdl";
					$client = new SoapClient($wsdl);
					$params = array('api_id' => $sms_settings['config_sms_api_id'],
									'user' => $sms_settings['config_sms_api_username'],
									'password' => $sms_settings['config_sms_api_password'],
									'to' => array($mobile_no),
									'text' => $message);

					$response = $client->sendmsg($params);
					$this->logger('SEND_SMS :: VENDOR RESPONSE : ' . json_encode($response));
			} catch (Exception $e) {
					$this->logger('SEND_SMS :: VENDOR ERROR : ' . $e->getMessage());
			}
	}

  public function sendRemercimentShipping($order_id) {
    $order_info = $this->getOrder($order_id);

    if ($order_info) {

      $order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

      foreach ($order_product_query->rows as $order_product) {
        $option_data_vendor = array();
        $order_option_vendor_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product['order_product_id'] . "'");

        $vmail = $this->db->query("SELECT pd.name AS name, p.model AS model, p.sku AS sku, vs.email AS email, vs.vendor_id AS vendor_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "vendor v ON (pd.product_id = v.vproduct_id) LEFT JOIN " . DB_PREFIX . "vendors vs ON (v.vendor = vs.vendor_id) WHERE p.product_id = '" . (int)$order_product['product_id'] . "'");

		//GV:05-SEP-2015 FOB price
        // BUG!!!
		// $fob = $this->getFobPrice( $order_product['product_id'] );
    $fob = $this->getFobPrice2( $order_product['product_id'], $order_id );
		$order_product['price'] = $fob['fob_price'] * $fob['pf'];
		$order_product['total'] = $order_product['quantity'] * $order_product['price'];
		$vintage = $this->getVintage( $order_product['product_id'] );
		$vmail->row['model'] = $vintage;

        $vendor_products[] = array(
          'name'     => $vmail->row['name'],
          'model'    => $vmail->row['model'],
          'sku'      => $vmail->row['sku'],
          'option'   => $option_data_vendor,
          'quantity' => $order_product['quantity'],
          'price'    => $order_product['price'],
          'total'    => $order_product['total'],
          'product_id' => $order_product['product_id'],
          'obs'      => $order_product['obs'],
          'tax'    => $order_product['tax'],
          'vendor_id' => $vmail->row['vendor_id'],
          'email'     => $vmail->row['email']
        );

        $vendor_list[] = array ('vendor_id' => $vmail->row['vendor_id']);
      }

      $vendor_unique = array_map("unserialize", array_unique(array_map("serialize", $vendor_list)));

      if ($vendor_products){

        foreach ($vendor_unique as $vendor) {
          if ($vendor['vendor_id']) {
            $data = array();
            $vemail = $this->db->query("SELECT *, CONCAT(firstname,' ',lastname) AS contact_name FROM `" . DB_PREFIX . "vendors` WHERE vendor_id = '" . (int)$vendor['vendor_id'] . "'");
            /* $cust_order_status_query = $this->db->query("SELECT name FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'"); */
            $language = new Language($order_info['language_directory']);
            $language->load('mail/vendor_email_shipping');

            $data['text_order_details'] = $language->get('text_order_details');
			$data['text_vat'] = $language->get('text_vat');
            $data['text_shipping_address'] = "<b>" . $language->get('text_shipping_address') . "</b><br/>";
            $data['date_ordered'] = '<b>' . $language->get('text_date_ordered') . ' </b>' . date('F j\, Y') . '<br/>';
            $data['logo'] = HTTP_SERVER . 'image/' . 'logo_new.png';
            $data['store_name'] = $order_info['store_name'];
            $data['store_url'] = $order_info['store_url'];
            $data['button_order'] = HTTP_SERVER . 'admin/index.php?route=sale/vdi_order/info&order_id=' . $order_id . '&tab=2';

            /*Show header title*/
            $data['title'] = sprintf($language->get('text_new_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);

            /*show vendor name*/
            $data['vendor_name'] = '<b>' . $language->get('text_title') . $vemail->row['contact_name'] . '</b>,' . "\n\n";

            /*show message to vendor*/
            $data['vendor_message'] = $language->get('text_vendor_message') . "\n\n";

            /*show vendor customer order id*/
            if ($this->config->get('mvd_show_order_id')) {
              $data['order_id'] = '<b>' . $language->get('text_vendor_order_id') . '</b>' . $order_id . '<br/>';
            } else {
              $data['order_id'] = '';
            }

              $data['order_status'] = '';

            /*show payment method*/
            if ($this->config->get('mvd_show_payment_method')) {
              $data['payment_method'] = '<b>' . $language->get('text_payment_method') . ' </b>' . $order_info['payment_method'] . '<br/>';
            } else {
              $data['payment_method'] = '';
            }

            /*show vendor customer email*/
            if ($this->config->get('mvd_show_cust_email')) {
              $data['email_address'] = '<b>' . $language->get('text_email') . ' </b>' . $order_info['email'] . '<br/>';
            } else {
              $data['email_address'] = '';
            }

            /*show vendor customer telephone*/
            if ($this->config->get('mvd_show_cust_telephone')) {
              $data['telephone'] = '<b>' . $language->get('text_telephone') . ' </b>' . $order_info['telephone'] . '<br/>';
            } else {
              $data['telephone'] = '';
            }

            /*show vendor customer shipping address*/
				//Warehouse address
				$wh_info = array();
				$wh_info = $this->getWarehouseAddress();
				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					//'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => '',//$wh_info['shipping_firstname'],
					'lastname'  => '',//$wh_info['shipping_lastname'],
					'company'   => $wh_info['company'],
					'address_1' => $wh_info['address_1'],
					'address_2' => $wh_info['address_2'],
					'city'      => $wh_info['city'],
					'postcode'  => $wh_info['postcode'],
					'zone'      => '',
					//'zone_code' => $wh_info['zone_code'],
					'country'   => $wh_info['country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['cust_shipping_address'] = $shipping_address;

            /*show vendor information*/
            if ($this->config->get('mvd_show_vendor_address')) {
              $data['show_vendor_contact'] = True;
              $format = '<b>{firstname} {lastname}</b>' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city}, {postcode}' . "\n" . '{zone}, {country}';
                $find = array(
                  '{firstname}',
                  '{lastname}',
                  '{company}',
                  '{address_1}',
                  '{address_2}',
                  '{city}',
                  '{postcode}',
                  '{zone}',
                  '{country}'
                );

              $zone_name = $this->db->query("SELECT name FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$vemail->row['zone_id'] . "' AND country_id = '" . (int)$vemail->row['country_id'] . "'");
              $country_name = $this->db->query("SELECT name FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$vemail->row['country_id'] . "'");

                $replace = array(
                  'firstname' => $vemail->row['firstname'],
                  'lastname'  => $vemail->row['lastname'],
                  'company'   => $vemail->row['company'],
                  'address_1' => $vemail->row['address_1'],
                  'address_2' => $vemail->row['address_2'],
                  'city'      => $vemail->row['city'],
                  'postcode'  => $vemail->row['postcode'],
                  'zone'    => isset($zone_name->row['name']) ? $zone_name->row['name'] : 'None',
                  'country'   => $country_name->row['name']
                );

              $vendor_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

              $data['vendor_address'] = $vendor_address . '<br/>';
              $data['text_vendor_contact'] = $language->get('text_vendor_contact');

              /*show vendor email*/
              if ($this->config->get('mvd_show_vendor_email')) {
                $data['vendor_email'] = '<b>' . $language->get('text_email') . ' </b>' . $vemail->row['email'] . '<br/>';
              } else {
                $data['vendor_email'] = '';
              }

              /*show vendor telephone*/
              if ($this->config->get('mvd_show_vendor_telephone')) {
                $data['vendor_telephone'] = '<b>' . $language->get('text_telephone') . ' </b>' . $vemail->row['telephone'] . '<br/>';
              } else {
                $data['vendor_telephone'] = '';
              }

            } else {
              $data['show_vendor_contact'] = False;
            }
            /*end show vendor address*/

            $coupon = $this->db->query("SELECT * FROM " . DB_PREFIX . "vendor_discount WHERE order_id = '" . (int)$order_id . "' AND vendor_id = '" . (int)$vendor['vendor_id'] . "'");
            if (isset($coupon->row['amount']) > 0) {
              $data['coupon_title'] = $coupon->row['title'];
              $data['coupon'] = '-' . $this->currency->format($coupon->row['amount']);
            } else {
              $data['coupon'] = false;
            }

            $subtotal = 0;
            $vsubtotal = $this->db->query("SELECT SUM(total) AS sum_product_total, SUM(quantity*tax) as sum_product_tax FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "vendor v ON ( op.product_id = v.vproduct_id ) WHERE v.vendor =  '" . (int)$vendor['vendor_id'] . "' AND op.order_id =  '" . (int)$order_id . "'");
            $subtotal = $vsubtotal->row['sum_product_total'];

            $vat = $this->db->query("SELECT title FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' AND code = 'tax'");

            /*Get Shipping Cost*/
            $shipcost = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_shipping` WHERE vendor_id = '" . (int)$vendor['vendor_id'] . "' AND order_id = '" . (int)$order_id . "'");

            if ($this->config->get('tax_status') && ($vsubtotal->row['sum_product_tax'] != 0)) {
              $data['text_tax'] = $vat->row['title'];
              $data['tax'] = $this->currency->format($vsubtotal->row['sum_product_tax'] + (isset($shipcost->row['tax']) ? $shipcost->row['tax'] : '0') - (isset($coupon->row['tax']) ? $coupon->row['tax'] : '0'));
            } else {
              $data['tax'] = '0';
            }

            if ($shipcost->rows) {
              if ($shipcost->row['cost']) {
                $total = $vsubtotal->row['sum_product_total'] + $shipcost->row['cost'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] + $shipcost->row['tax'] -((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              } else {
                $total = $vsubtotal->row['sum_product_total'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] - ((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              }

              $data['shipping'] = $shipcost->row['title'] . ' (' . $this->weight->format($shipcost->row['weight'], $this->config->get('config_weight_class_id')) . ')';
              $data['scost'] = $this->currency->format($shipcost->row['cost']);

            } else {
              $total = $vsubtotal->row['sum_product_total'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] - ((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              $data['scost'] = 0;
            }

            /*END Get Shipping Cost*/

			//GV:05-SEP-2015 FOB price
			$fob_total = 0.0;
            foreach ($vendor_products as $vendor_product) {
              if ($vendor['vendor_id'] == $vendor_product['vendor_id']) {
				//GV: Fob price for each vendor
                 $fob = $this->getFobPrice2( $vendor_product['product_id'], $order_id );
                
                    
			         if (floatval($fob['fob_price']) == floatval($fob['fob_bottle_full_price'])){
        				$price = $this->currency->format($vendor_product['price'] + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
				        $total = $this->currency->format($vendor_product['price']*$vendor_product['quantity'], $order_info['currency_code'], $order_info['currency_value']);
			         }
			         else{
                         
			        	 $price = '<del>'.$this->currency->format(($fob['fob_bottle_full_price'] * $fob['pf']) + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</del>
                             <br />'.
                             ((strlen($vendor_product['obs'])>1)?$this->language->get('label_discount'):$this->language->get('label_special'))
                             .'<span class="discounted_price">'.$this->currency->format(($fob['fob_price'] * $fob['pf']) + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</span>';

					   $total = '<del>'.$this->currency->format($vendor_product['quantity'] * $fob['fob_bottle_full_price'] * $fob['pf'] +
                        ($this->config->get('config_tax') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0),
                      $order_info['currency_code'], $order_info['currency_value']).
                      '</del><br /><span class="discounted_price">'.
                      $this->currency->format($vendor_product['quantity'] * $fob['fob_price'] * $fob['pf'] + 
                      ($this->config->get('config_tax') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']).'</span>';


				}
				$fob_total += $vendor_product['total'];

                $data['vendor_products'][] = array(
                  'name'     => $vendor_product['name'],
                  'option'   => $vendor_product['option'],
                  'model'    => $vendor_product['model'],
                  'sku'    => $vendor_product['sku'],
                 // 'price'    => $this->currency->format($vendor_product['price'] + ($this->config->get('tax_status') ? $vendor_product['tax'] : 0)),
                  'price'        => $price,
                  'total'      => $total,
                  'quantity' => $vendor_product['quantity'],
                  //'total'    => $this->currency->format($vendor_product['total'] + ($this->config->get('tax_status') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0)),
                  'email'    => $vendor_product['email']
                );
              }
            }
			//GV: fob total price
            $subtotal = $fob_total;
			$total = $fob_total;

            $data['product'] = $language->get('column_product');
            $data['model'] = $language->get('text_vintage');
            $data['quantity'] = $language->get('column_quantity');
            $data['unit_price'] = $language->get('column_unit_price');
            $data['total'] = $language->get('column_total');
            $data['subtotal'] = $language->get('column_subtotal');
            $data['vendor_auto_msg'] = $language->get('text_vendor_auto_msg');
            $data['vendor_alert'] = $language->get('text_vendor_email') . $this->config->get('config_name');
            $data['vsubtotal'] = $this->currency->format($subtotal-$subtotal*0.2/1.2);
			$data['vat'] = $this->currency->format($subtotal*0.2/1.2);
            $data['vtotal'] = $this->currency->format($total);

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/vendor_email_confirmation_shipping.tpl')) {
              $html = $this->load->view($this->config->get('config_template') . '/template/mail/vendor_email_confirmation_shipping.tpl', $data);
            } else {
              $html = $this->load->view('default/template/mail/vendor_email_confirmation_shipping.tpl', $data);
            }

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($vemail->row['email']);
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($this->config->get('config_name'));
            $mail->setSubject("[Commande Terminé] " . $language->get('text_vendor_order') . $order_id . ' (' . $this->config->get('config_name') . ')');
            $mail->setHtml($html);
            $mail->send();
	      }
        }
      }
    }
  }


                        public function sendNotifProduct($order_id, $order_status_id) {

    $order_info = $this->getOrder($order_id);

    if ($order_info) {

      $order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
      
      foreach ($order_product_query->rows as $order_product) {
        $option_data_vendor = array();
        $order_option_vendor_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product['order_product_id'] . "'");

        $vmail = $this->db->query("SELECT pd.name AS name, p.model AS model, p.sku AS sku, vs.email AS email, vs.vendor_id AS vendor_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "vendor v ON (pd.product_id = v.vproduct_id) LEFT JOIN " . DB_PREFIX . "vendors vs ON (v.vendor = vs.vendor_id) WHERE p.product_id = '" . (int)$order_product['product_id'] . "'");

		//GV:05-SEP-2015 FOB price
        // BUG!!!
    // $fob = $this->getFobPrice( $order_product['product_id'] );
		$fob = $this->getFobPrice2( $order_product['product_id'], $order_id );
		$order_product['price'] = $fob['fob_price'] * $fob['pf'];
		$order_product['total'] = $order_product['quantity'] * $order_product['price'];
		$vintage = $this->getVintage( $order_product['product_id'] );
		$vmail->row['model'] = $vintage;

        $vendor_products[] = array(
          'name'     => $vmail->row['name'],
          'model'    => $vmail->row['model'],
          'sku'      => $vmail->row['sku'],
          'option'   => $option_data_vendor,
          'quantity' => $order_product['quantity'],
          'price'    => $order_product['price'],
          'total'    => $order_product['total'],
          'product_id' => $order_product['product_id'],
          'obs'      =>$order_product['obs'],
          'tax'    => $order_product['tax'],
          'vendor_id' => $vmail->row['vendor_id'],
          'email'     => $vmail->row['email']
        );

        $vendor_list[] = array ('vendor_id' => $vmail->row['vendor_id']);
      }
      
      $vendor_unique = array_map("unserialize", array_unique(array_map("serialize", $vendor_list)));
      if ($vendor_products){

        foreach ($vendor_unique as $vendor) {
          if ($vendor['vendor_id']) {
            $data = array();
            $vemail = $this->db->query("SELECT *, CONCAT(firstname,' ',lastname) AS contact_name FROM `" . DB_PREFIX . "vendors` WHERE vendor_id = '" . (int)$vendor['vendor_id'] . "'");
            $cust_order_status_query = $this->db->query("SELECT name FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'");
            $language = new Language($order_info['language_directory']);
            //$language->load($order_info['language_filename']);
            $language->load('mail/vendor_email');

            $data['text_order_details'] = $language->get('text_order_details');
			$data['text_vat'] = $language->get('text_vat');
            $data['text_shipping_address'] = "<b>" . $language->get('text_shipping_address') . "</b><br/>";
            $data['date_ordered'] = '<b>' . $language->get('text_date_ordered') . ' </b>' . date('F j\, Y') . '<br/>';
            $data['logo'] = HTTP_SERVER . 'image/' . 'logo_new.png';
            $data['store_name'] = $order_info['store_name'];
            $data['store_url'] = $order_info['store_url'];
            $data['button_order'] = HTTP_SERVER . 'admin/index.php?route=sale/vdi_order/info&order_id=' . $order_id . '&tab=2';

            /*Show header title*/
            $data['title'] = sprintf($language->get('text_new_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);

            /*show vendor name*/
            $data['vendor_name'] = '<b>' . $language->get('text_title') . $vemail->row['contact_name'] . '</b>,' . "\n\n";

            /*show message to vendor*/
            $data['vendor_message'] = $this->config->get('mvd_new_order_message' . $this->config->get('config_language_id')) . "\n\n";

            /*show vendor customer order id*/
            if ($this->config->get('mvd_show_order_id')) {
              $data['order_id'] = '<b>' . $language->get('text_vendor_order_id') . '</b>' . $order_id . '<br/>';
            } else {
              $data['order_id'] = '';
            }

            /*show vendor customer order status*/
            if ($this->config->get('mvd_show_order_status')) {
              $data['order_status'] = '<b>' . $language->get('text_order_status') . ' </b>' . $cust_order_status_query->row['name'] . '<br/>';
            } else {
              $data['order_status'] = '';
            }

            /*show payment method*/
            if ($this->config->get('mvd_show_payment_method')) {
              $data['payment_method'] = '<b>' . $language->get('text_payment_method') . ' </b>' . $order_info['payment_method'] . '<br/>';
            } else {
              $data['payment_method'] = '';
            }

            /*show vendor customer email*/
            if ($this->config->get('mvd_show_cust_email')) {
              $data['email_address'] = '<b>' . $language->get('text_email') . ' </b>' . $order_info['email'] . '<br/>';
            } else {
              $data['email_address'] = '';
            }

            /*show vendor customer telephone*/
            if ($this->config->get('mvd_show_cust_telephone')) {
              $data['telephone'] = '<b>' . $language->get('text_telephone') . ' </b>' . $order_info['telephone'] . '<br/>';
            } else {
              $data['telephone'] = '';
            }

            /*show vendor customer shipping address*/
				//Warehouse address
				$wh_info = array();
				$wh_info = $this->getWarehouseAddress();
				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					//'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => '',//$wh_info['shipping_firstname'],
					'lastname'  => '',//$wh_info['shipping_lastname'],
					'company'   => $wh_info['company'],
					'address_1' => $wh_info['address_1'],
					'address_2' => $wh_info['address_2'],
					'city'      => $wh_info['city'],
					'postcode'  => $wh_info['postcode'],
					'zone'      => '',
					//'zone_code' => $wh_info['zone_code'],
					'country'   => $wh_info['country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['cust_shipping_address'] = $shipping_address;

            /*show vendor information*/
            if ($this->config->get('mvd_show_vendor_address')) {
              $data['show_vendor_contact'] = True;
              $format = '<b>{firstname} {lastname}</b>' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city}, {postcode}' . "\n" . '{zone}, {country}';
                $find = array(
                  '{firstname}',
                  '{lastname}',
                  '{company}',
                  '{address_1}',
                  '{address_2}',
                  '{city}',
                  '{postcode}',
                  '{zone}',
                  '{country}'
                );

              $zone_name = $this->db->query("SELECT name FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$vemail->row['zone_id'] . "' AND country_id = '" . (int)$vemail->row['country_id'] . "'");
              $country_name = $this->db->query("SELECT name FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$vemail->row['country_id'] . "'");

                $replace = array(
                  'firstname' => $vemail->row['firstname'],
                  'lastname'  => $vemail->row['lastname'],
                  'company'   => $vemail->row['company'],
                  'address_1' => $vemail->row['address_1'],
                  'address_2' => $vemail->row['address_2'],
                  'city'      => $vemail->row['city'],
                  'postcode'  => $vemail->row['postcode'],
                  'zone'    => isset($zone_name->row['name']) ? $zone_name->row['name'] : 'None',
                  'country'   => $country_name->row['name']
                );

              $vendor_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
              
              $data['vendor_address'] = $vendor_address . '<br/>';
              $data['text_vendor_contact'] = $language->get('text_vendor_contact');

              /*show vendor email*/
              if ($this->config->get('mvd_show_vendor_email')) {
                $data['vendor_email'] = '<b>' . $language->get('text_email') . ' </b>' . $vemail->row['email'] . '<br/>';
              } else {
                $data['vendor_email'] = '';
              }

              /*show vendor telephone*/
              if ($this->config->get('mvd_show_vendor_telephone')) {
                $data['vendor_telephone'] = '<b>' . $language->get('text_telephone') . ' </b>' . $vemail->row['telephone'] . '<br/>';
              } else {
                $data['vendor_telephone'] = '';
              }

            } else {
              $data['show_vendor_contact'] = False;
            }
            /*end show vendor address*/

            $coupon = $this->db->query("SELECT * FROM " . DB_PREFIX . "vendor_discount WHERE order_id = '" . (int)$order_id . "' AND vendor_id = '" . (int)$vendor['vendor_id'] . "'");
            if (isset($coupon->row['amount']) > 0) {
              $data['coupon_title'] = $coupon->row['title'];
              $data['coupon'] = '-' . $this->currency->format($coupon->row['amount']);
            } else {
              $data['coupon'] = false;
            }

            $subtotal = 0;
            $vsubtotal = $this->db->query("SELECT SUM(total) AS sum_product_total, SUM(quantity*tax) as sum_product_tax FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "vendor v ON ( op.product_id = v.vproduct_id ) WHERE v.vendor =  '" . (int)$vendor['vendor_id'] . "' AND op.order_id =  '" . (int)$order_id . "'");
            $subtotal = $vsubtotal->row['sum_product_total'];

            $vat = $this->db->query("SELECT title FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' AND code = 'tax'");

            /*Get Shipping Cost*/
            $shipcost = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_shipping` WHERE vendor_id = '" . (int)$vendor['vendor_id'] . "' AND order_id = '" . (int)$order_id . "'");

            if ($this->config->get('tax_status') && ($vsubtotal->row['sum_product_tax'] != 0)) {
              $data['text_tax'] = $vat->row['title'];
              $data['tax'] = $this->currency->format($vsubtotal->row['sum_product_tax'] + (isset($shipcost->row['tax']) ? $shipcost->row['tax'] : '0') - (isset($coupon->row['tax']) ? $coupon->row['tax'] : '0'));
            } else {
              $data['tax'] = '0';
            }

            if ($shipcost->rows) {
              if ($shipcost->row['cost']) {
                $total = $vsubtotal->row['sum_product_total'] + $shipcost->row['cost'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] + $shipcost->row['tax'] -((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              } else {
                $total = $vsubtotal->row['sum_product_total'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] - ((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              }

              $data['shipping'] = $shipcost->row['title'] . ' (' . $this->weight->format($shipcost->row['weight'], $this->config->get('config_weight_class_id')) . ')';
              $data['scost'] = $this->currency->format($shipcost->row['cost']);

            } else {
              $total = $vsubtotal->row['sum_product_total'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] - ((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              $data['scost'] = 0;
            }

            /*END Get Shipping Cost*/

			//GV:05-SEP-2015 FOB price
			$fob_total = 0.0;
            foreach ($vendor_products as $vendor_product) {
              if ($vendor['vendor_id'] == $vendor_product['vendor_id']) {
				//GV: Fob price for each vendor
                   $fob = $this->getFobPrice2( $vendor_product['product_id'], $order_id );
                
                    
			         if (floatval($fob['fob_price']) == floatval($fob['fob_bottle_full_price'])){
        				$price = $this->currency->format($vendor_product['price'] + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
				        $total = $this->currency->format($vendor_product['price']*$vendor_product['quantity'], $order_info['currency_code'], $order_info['currency_value']);
			         }
			         else{
                         
			        	 $price = '<del>'.$this->currency->format(($fob['fob_bottle_full_price'] * $fob['pf']) + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</del>
                             <br />'.
                             ((strlen($vendor_product['obs'])>1)?"<font color='#cc0000' size='-1'>Discount: </font> ":"<font color='#cc0000' size='-1'>Promo: </font> ")
                             .'<font color="#cc0000">'.$this->currency->format(($fob['fob_price'] * $fob['pf']) + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</font>';

					   $total = '<del>'.$this->currency->format($vendor_product['quantity'] * $fob['fob_bottle_full_price'] * $fob['pf'] +
                        ($this->config->get('config_tax') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0),
                      $order_info['currency_code'], $order_info['currency_value']).
                      '</del><br /><font color="#cc0000">'.
                      $this->currency->format($vendor_product['quantity'] * $fob['fob_price'] * $fob['pf'] + 
                      ($this->config->get('config_tax') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']).'</font>';


				}
                
				$fob_total += $vendor_product['total'];

                $data['vendor_products'][] = array(
                  'name'     => $vendor_product['name'],
                  'option'   => $vendor_product['option'],
                  'model'    => $vendor_product['model'],
                  'sku'    => $vendor_product['sku'],
                  //'price'    => $this->currency->format($vendor_product['price'] + ($this->config->get('tax_status') ? $vendor_product['tax'] : 0)),
                  'price' => $price,
                  'quantity' => $vendor_product['quantity'],
                  //'total'    => $this->currency->format($vendor_product['total'] + ($this->config->get('tax_status') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0)),
                  'total' => $total,
                  'email'    => $vendor_product['email']
                );
              }
            }
			//GV: fob total price
            $subtotal = $fob_total;
			$total = $fob_total;

            $data['vendor_name'] = '<b>' . $vemail->row['contact_name'] . '</b>,' . "\n\n";
            $data['product'] = $language->get('column_product');
            $data['model'] = $language->get('text_vintage');
            $data['quantity'] = $language->get('column_quantity');
            $data['unit_price'] = $language->get('column_unit_price');
            $data['total'] = $language->get('column_total');
            $data['subtotal'] = $language->get('column_subtotal');
            $data['vendor_auto_msg'] = $language->get('text_vendor_auto_msg_confirmation_reception');
            $data['vendor_alert'] = $this->config->get('config_name')." Confirmation de réception produits et documents " . $this->config->get('config_name');
            $data['vsubtotal'] = $this->currency->format($subtotal-$subtotal*0.2/1.2);
			$data['vat'] = $this->currency->format($subtotal*0.2/1.2);
            $data['vtotal'] = $this->currency->format($total);
            $data['idOrder']=$order_id;
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/vendor_email.tpl')) {
              $html = $this->load->view($this->config->get('config_template') . '/template/mail/vendor_email_confirmation_reception.tpl', $data);
            } else {
              $html = $this->load->view('default/template/mail/vendor_email_confirmation_reception.tpl', $data);
            }
            
            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($vemail->row['email']);
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($this->config->get('config_name'));
            //$mail->setSubject($language->get('text_vendor_email_subject') . $language->get('text_vendor_order') . $order_id . ' (' . $this->config->get('config_name') . ')');
            $mail->setSubject("[CONFIRMATION RECEPTION] - ID Commmande " . $order_id . ' (' . $this->config->get('config_name') . ')');
            $mail->setHtml($html);
            $mail->send();
          }
        }
      }
    }
  }

	
  public function sendPo($order_id, $order_status_id) {

    $order_info = $this->getOrder($order_id);

    if ($order_info) {

      $order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

      foreach ($order_product_query->rows as $order_product) {
        $option_data_vendor = array();
        $order_option_vendor_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product['order_product_id'] . "'");

        $vmail = $this->db->query("SELECT pd.name AS name, p.model AS model, p.sku AS sku, vs.email AS email, vs.vendor_id AS vendor_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "vendor v ON (pd.product_id = v.vproduct_id) LEFT JOIN " . DB_PREFIX . "vendors vs ON (v.vendor = vs.vendor_id) WHERE p.product_id = '" . (int)$order_product['product_id'] . "'");

		//GV:05-SEP-2015 FOB price
        // BUG!!!
    // $fob = $this->getFobPrice( $order_product['product_id'] );
		$fob = $this->getFobPrice2( $order_product['product_id'], $order_id );
		$order_product['price'] = $fob['fob_price'] * $fob['pf'];
		$order_product['total'] = $order_product['quantity'] * $order_product['price'];
		$vintage = $this->getVintage( $order_product['product_id'] );
		$vmail->row['model'] = $vintage;

        $vendor_products[] = array(
          'name'     => $vmail->row['name'],
          'model'    => $vmail->row['model'],
          'sku'      => $vmail->row['sku'],
          'option'   => $option_data_vendor,
          'quantity' => $order_product['quantity'],
          'price'    => $order_product['price'],
          'total'    => $order_product['total'],
          'product_id' => $order_product['product_id'],
          'obs'      => $order_product['obs'],
          'tax'    => $order_product['tax'],
          'vendor_id' => $vmail->row['vendor_id'],
          'email'     => $vmail->row['email']
        );

        $vendor_list[] = array ('vendor_id' => $vmail->row['vendor_id']);
      }

      $vendor_unique = array_map("unserialize", array_unique(array_map("serialize", $vendor_list)));

      if ($vendor_products){

        foreach ($vendor_unique as $vendor) {
          if ($vendor['vendor_id']) {
            $data = array();
            $vemail = $this->db->query("SELECT *, CONCAT(firstname,' ',lastname) AS contact_name FROM `" . DB_PREFIX . "vendors` WHERE vendor_id = '" . (int)$vendor['vendor_id'] . "'");
            $cust_order_status_query = $this->db->query("SELECT name FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'");
            $language = new Language($order_info['language_directory']);
            //$language->load($order_info['language_filename']);
            $language->load('mail/vendor_email');

            $data['text_order_details'] = $language->get('text_order_details');
			$data['text_vat'] = $language->get('text_vat');
            $data['text_shipping_address'] = "<b>" . $language->get('text_shipping_address') . "</b><br/>";
            $data['date_ordered'] = '<b>' . $language->get('text_date_ordered') . ' </b>' . date('F j\, Y') . '<br/>';
            $data['logo'] = HTTP_SERVER . 'image/' . 'logo_new.png';
            $data['store_name'] = $order_info['store_name'];
            $data['store_url'] = $order_info['store_url'];
            $data['button_order'] = HTTP_SERVER . 'admin/index.php?route=sale/vdi_order/info&order_id=' . $order_id . '&tab=2';

            /*Show header title*/
            $data['title'] = sprintf($language->get('text_new_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);

            /*show vendor name*/
            $data['vendor_name'] = '<b>' . $language->get('text_title') . $vemail->row['contact_name'] . '</b>,' . "\n\n";

            /*show message to vendor*/
            $data['vendor_message'] = $this->config->get('mvd_new_order_message' . $this->config->get('config_language_id')) . "\n\n";

            /*show vendor customer order id*/
            if ($this->config->get('mvd_show_order_id')) {
              $data['order_id'] = '<b>' . $language->get('text_vendor_order_id') . '</b>' . $order_id . '<br/>';
            } else {
              $data['order_id'] = '';
            }

            /*show vendor customer order status*/
            if ($this->config->get('mvd_show_order_status')) {
              $data['order_status'] = '<b>' . $language->get('text_order_status') . ' </b>' . $cust_order_status_query->row['name'] . '<br/>';
            } else {
              $data['order_status'] = '';
            }

            /*show payment method*/
            if ($this->config->get('mvd_show_payment_method')) {
              $data['payment_method'] = '<b>' . $language->get('text_payment_method') . ' </b>' . $order_info['payment_method'] . '<br/>';
            } else {
              $data['payment_method'] = '';
            }

            /*show vendor customer email*/
            if ($this->config->get('mvd_show_cust_email')) {
              $data['email_address'] = '<b>' . $language->get('text_email') . ' </b>' . $order_info['email'] . '<br/>';
            } else {
              $data['email_address'] = '';
            }

            /*show vendor customer telephone*/
            if ($this->config->get('mvd_show_cust_telephone')) {
              $data['telephone'] = '<b>' . $language->get('text_telephone') . ' </b>' . $order_info['telephone'] . '<br/>';
            } else {
              $data['telephone'] = '';
            }

            /*show vendor customer shipping address*/
				//Warehouse address
				$wh_info = array();
				$wh_info = $this->getWarehouseAddress();
				$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					//'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => '',//$wh_info['shipping_firstname'],
					'lastname'  => '',//$wh_info['shipping_lastname'],
					'company'   => $wh_info['company'],
					'address_1' => $wh_info['address_1'],
					'address_2' => $wh_info['address_2'],
					'city'      => $wh_info['city'],
					'postcode'  => $wh_info['postcode'],
					'zone'      => '',
					//'zone_code' => $wh_info['zone_code'],
					'country'   => $wh_info['country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['cust_shipping_address'] = $shipping_address;

            /*show vendor information*/
            if ($this->config->get('mvd_show_vendor_address')) {
              $data['show_vendor_contact'] = True;
              $format = '<b>{firstname} {lastname}</b>' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city}, {postcode}' . "\n" . '{zone}, {country}';
                $find = array(
                  '{firstname}',
                  '{lastname}',
                  '{company}',
                  '{address_1}',
                  '{address_2}',
                  '{city}',
                  '{postcode}',
                  '{zone}',
                  '{country}'
                );

              $zone_name = $this->db->query("SELECT name FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$vemail->row['zone_id'] . "' AND country_id = '" . (int)$vemail->row['country_id'] . "'");
              $country_name = $this->db->query("SELECT name FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$vemail->row['country_id'] . "'");

                $replace = array(
                  'firstname' => $vemail->row['firstname'],
                  'lastname'  => $vemail->row['lastname'],
                  'company'   => $vemail->row['company'],
                  'address_1' => $vemail->row['address_1'],
                  'address_2' => $vemail->row['address_2'],
                  'city'      => $vemail->row['city'],
                  'postcode'  => $vemail->row['postcode'],
                  'zone'    => isset($zone_name->row['name']) ? $zone_name->row['name'] : 'None',
                  'country'   => $country_name->row['name']
                );

              $vendor_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

              $data['vendor_address'] = $vendor_address . '<br/>';
              $data['text_vendor_contact'] = $language->get('text_vendor_contact');

              /*show vendor email*/
              if ($this->config->get('mvd_show_vendor_email')) {
                $data['vendor_email'] = '<b>' . $language->get('text_email') . ' </b>' . $vemail->row['email'] . '<br/>';
              } else {
                $data['vendor_email'] = '';
              }

              /*show vendor telephone*/
              if ($this->config->get('mvd_show_vendor_telephone')) {
                $data['vendor_telephone'] = '<b>' . $language->get('text_telephone') . ' </b>' . $vemail->row['telephone'] . '<br/>';
              } else {
                $data['vendor_telephone'] = '';
              }

            } else {
              $data['show_vendor_contact'] = False;
            }
            /*end show vendor address*/

            $coupon = $this->db->query("SELECT * FROM " . DB_PREFIX . "vendor_discount WHERE order_id = '" . (int)$order_id . "' AND vendor_id = '" . (int)$vendor['vendor_id'] . "'");
            if (isset($coupon->row['amount']) > 0) {
              $data['coupon_title'] = $coupon->row['title'];
              $data['coupon'] = '-' . $this->currency->format($coupon->row['amount']);
            } else {
              $data['coupon'] = false;
            }

            $subtotal = 0;
            $vsubtotal = $this->db->query("SELECT SUM(total) AS sum_product_total, SUM(quantity*tax) as sum_product_tax FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "vendor v ON ( op.product_id = v.vproduct_id ) WHERE v.vendor =  '" . (int)$vendor['vendor_id'] . "' AND op.order_id =  '" . (int)$order_id . "'");
            $subtotal = $vsubtotal->row['sum_product_total'];

            $vat = $this->db->query("SELECT title FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' AND code = 'tax'");

            /*Get Shipping Cost*/
            $shipcost = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_shipping` WHERE vendor_id = '" . (int)$vendor['vendor_id'] . "' AND order_id = '" . (int)$order_id . "'");

            if ($this->config->get('tax_status') && ($vsubtotal->row['sum_product_tax'] != 0)) {
              $data['text_tax'] = $vat->row['title'];
              $data['tax'] = $this->currency->format($vsubtotal->row['sum_product_tax'] + (isset($shipcost->row['tax']) ? $shipcost->row['tax'] : '0') - (isset($coupon->row['tax']) ? $coupon->row['tax'] : '0'));
            } else {
              $data['tax'] = '0';
            }

            if ($shipcost->rows) {
              if ($shipcost->row['cost']) {
                $total = $vsubtotal->row['sum_product_total'] + $shipcost->row['cost'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] + $shipcost->row['tax'] -((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              } else {
                $total = $vsubtotal->row['sum_product_total'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] - ((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              }

              $data['shipping'] = $shipcost->row['title'] . ' (' . $this->weight->format($shipcost->row['weight'], $this->config->get('config_weight_class_id')) . ')';
              $data['scost'] = $this->currency->format($shipcost->row['cost']);

            } else {
              $total = $vsubtotal->row['sum_product_total'] - ((isset($coupon->row['amount'])) ? $coupon->row['amount'] : 0) + ($this->config->get('tax_status') ? ($vsubtotal->row['sum_product_tax'] - ((isset($coupon->row['tax'])) ? $coupon->row['tax'] : 0)): 0);
              $data['scost'] = 0;
            }

            /*END Get Shipping Cost*/

			//GV:05-SEP-2015 FOB price
			$fob_total = 0.0;
           // $the_price = $this->currency->format($vendor_product['price'] + ($this->config->get('tax_status') ? $vendor_product['tax'] : 0));
         
            foreach ($vendor_products as $vendor_product) {
              if ($vendor['vendor_id'] == $vendor_product['vendor_id']) {
				//GV: Fob price for each vendor
                    $fob = $this->getFobPrice2( $vendor_product['product_id'], $order_id );
                
                    
			         if (floatval($fob['fob_price']) == floatval($fob['fob_bottle_full_price'])){
        				$price = $this->currency->format($vendor_product['price'] + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
				        $total = $this->currency->format($vendor_product['price']*$vendor_product['quantity'], $order_info['currency_code'], $order_info['currency_value']);
			         }
			         else{
                         
			        /*	 $price = '<del>'.$this->currency->format(($fob['fob_bottle_full_price'] * $fob['pf']) + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</del>
                             <br />'.
                             ((strlen($vendor_product['obs'])>1)? $this->language->get('label_discount'): $this->language->get('label_special'))
                             .'<span class="discounted_price">'.$this->currency->format(($fob['fob_price'] * $fob['pf']) + ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</span>';*/
                         $label =  strlen($vendor_product['obs'])>1?$this->language->get('label_discount'):$this->language->get('label_special');
			            $price = '<del>'.$this->currency->format($fob['fob_bottle_full_price'] * $fob['pf'] +
                        ($this->config->get('config_tax') ? ($vendor_product['tax']) : 0),
                      $order_info['currency_code'], $order_info['currency_value']).'</del><br />'.$label.
                      '<span class="discounted_price">'.
                      $this->currency->format( $fob['fob_price'] * $fob['pf'] + 
                      ($this->config->get('config_tax') ? $vendor_product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</span>';
                  

					   $total = '<del>'.$this->currency->format($vendor_product['quantity'] * $fob['fob_bottle_full_price'] * $fob['pf'] +
                        ($this->config->get('config_tax') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0),
                      $order_info['currency_code'], $order_info['currency_value']).
                      '</del><br /><span class="discounted_price">'.
                      $this->currency->format($vendor_product['quantity'] * $fob['fob_price'] * $fob['pf'] + 
                      ($this->config->get('config_tax') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']).'</span>';


				}
				$fob_total += $vendor_product['total'];

                $data['vendor_products'][] = array(
                  'name'     => $vendor_product['name'],
                  'option'   => $vendor_product['option'],
                  'model'    => $vendor_product['model'],
                  'sku'    => $vendor_product['sku'],
                  'price'    => $price,
                  'quantity' => $vendor_product['quantity'],
                 // 'total'    => $this->currency->format($vendor_product['total'] + ($this->config->get('tax_status') ? ($vendor_product['tax'] * $vendor_product['quantity']) : 0)),
                   'total'  => $total,
                  'email'    => $vendor_product['email']
                );
              }
            }
			//GV: fob total price
            $subtotal = $fob_total;
			$total = $fob_total;

            $data['product'] = $language->get('column_product');
            $data['model'] = $language->get('text_vintage');
            $data['quantity'] = $language->get('column_quantity');
            $data['unit_price'] = $language->get('column_unit_price');
            $data['total'] = $language->get('column_total');
            $data['subtotal'] = $language->get('column_subtotal');
            $data['vendor_auto_msg'] = $language->get('text_vendor_auto_msg');
            $data['vendor_alert'] = $language->get('text_vendor_email') . $this->config->get('config_name');
            $data['vsubtotal'] = $this->currency->format($subtotal-$subtotal*0.2/1.2);
			$data['vat'] = $this->currency->format($subtotal*0.2/1.2);
            $data['vtotal'] = $this->currency->format($total);


            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/vendor_email.tpl')) {
            	  $html = $this->load->view($this->config->get('config_template') . '/template/mail/vendor_email.tpl', $data);
		      } else {
			      $html = $this->load->view('default/template/mail/vendor_email.tpl', $data);
            }

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($vemail->row['email']);
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender($this->config->get('config_name'));
            $mail->setSubject($language->get('text_vendor_email_subject') . $language->get('text_vendor_order') . $order_id . ' (' . $this->config->get('config_name') . ')');
            $mail->setHtml($html);
            $mail->send();
          }
        }
      }
    }
  }
	//GV
  	public function getWarehouseAddress() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "warehouse` LIMIT 1");

		if ($query->row) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$query->row['country_id'] . "'");

			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';
				$address_format = '';
			}

			return array(
				'company'		 => $query->row['company'],
				'email'			 => $query->row['email'],
				'firstname'      => $query->row['firstname'],
				'lastname'       => $query->row['lastname'],
				'address_1'      => $query->row['address_1'],
				'address_2'      => $query->row['address_2'],
				'postcode'       => $query->row['postcode'],
				'city'           => $query->row['city'],
				//'zone_id'        => 1146,//$query->row['zone_id'],
				'telephone'		 => $query->row['telephone'],
				'email'		 	 => $query->row['email'],
				'fax'		 	 => $query->row['fax'],
				//'zone'           => $zone,
				//'zone_code'      => $zone_code,
				'country_id'     => $query->row['country_id'],
				'country'        => $country,
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format
			);
		}
	}
	public function getFobPrice($product_id) {
		$query = $this->db->query("SELECT pf, fob_price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$product_id . "' " );

		return $query->row;
	}
  public function getFobPrice2($product_id, $order_id) {
    $query = $this->db->query("SELECT fob_case as pf, fob_bottle as fob_price, fob_bottle_full_price FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "' AND product_id = '" . (int)$product_id . "' " );

    return $query->row;
  }
	public function getVintage( $product_id ) {
			$query = $this->db->query("SELECT  `text` FROM " . DB_PREFIX . "product_attribute pa  WHERE  pa.product_id= '" . (int)$product_id . "' AND pa.attribute_id = 13 AND language_id = 1" );
			$query_color = $this->db->query("SELECT  `text` FROM " . DB_PREFIX . "product_attribute pa  WHERE  pa.product_id= '" . (int)$product_id . "' AND pa.attribute_id = 14 AND language_id = 1" );
			$temp_str = '';
			if ( $query_color->num_rows ) {
				$temp_str = $query_color->row['text'];
			}

			if( $query->num_rows ) {
				$temp_str .=  ($temp_str == '' ) ? $query->row['text'] : "<br/>".$query->row['text'];
			}
			return $temp_str;
	}

	//End GV
}
