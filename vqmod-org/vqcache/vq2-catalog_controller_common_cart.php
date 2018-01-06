<?php
class ControllerCommonCart extends Controller {
	public function index() {
		$this->load->language('common/cart');

		// Totals
		$this->load->model('extension/extension');

		$total_data = array();
		$total = 0;
		$taxes = $this->cart->getTaxes();

		$data['palletsqty'] = 0;
		$this->load->model('pallet/worksheet');
		// Display prices
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {

//			$customer_id = $this->customer->isLogged();
//			if ($customer_id) {
//				if($shipping = $this->model_pallet_worksheet->getShipping($this->model_pallet_worksheet->getWorksheet($customer_id))) {
//					$data['palletsqty'] = $shipping;
//				}
//			} else {
//				$data['palletsqty'] = 0;
//			}
//			$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);
//			$wtotal = $this->model_pallet_worksheet->getWorksheetTotals($worksheet_id);
//			if($shipping = $this->model_pallet_worksheet->getShipping($worksheet_id)) {
//				$shipping_data = $this->config->get("pallets_shipping_x" . $shipping);
//			}
//			$grand_total = $wtotal + $shipping_data;


			$wtotal = 0;
			$shipping_data = 0;
			$shipping = 0;

			if(!$this->customer->isLogged()) {

			} else {
				$customer_id = $this->customer->isLogged();
			}
			$this->language->load('pallet/worksheet');

			if (isset($customer_id)) {
				$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);

				$wtotal = $this->model_pallet_worksheet->getWorksheetTotals($worksheet_id);
				if ($wtotal > 0) {
					if($shipping = $this->model_pallet_worksheet->getShipping($worksheet_id) ) {
						$shipping_data = 0;

						foreach ($shipping as $shipping_pallet) {
							$shipping_data += $this->config->get("pallets_shipping_x" . $shipping_pallet['pallet_qty'] . "_" . $shipping_pallet['pallet_size']);
						}
					}
				} else {
					$shipping_data = 0;
				}

				$pallets = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

                 //Coupon
                if ($this->config->get('coupon_status')) {
                            $this->load->model('total/coupon');
                            $this->model_total_coupon->getWTotal($total_data, $wtotal, $taxes, $worksheet_id);

                }

				$grand_total = $wtotal + $shipping_data;
				$data['grandtotal'] = $this->currency->format($grand_total);
				$data['grandtotaltitle'] = $this->language->get('column_total');
				if(count($pallets) > 0) {
					$data['palletsqty'] = count($pallets);
				} else {
					$data['palletsqty'] = 0;
				}
			} else {
				$data['grandtotal'] = 0;
				$data['grandtotaltitle'] = $this->language->get('column_total');
				$data['palletsqty'] = 0;
			}

          	$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

		/*	foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}*/

			$sort_order = array();

			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $total_data);
		}

		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_cart'] = $this->language->get('text_cart');

$data['text_pallet_worksheet'] = $this->language->get('text_pallet_worksheet');
      
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_recurring'] = $this->language->get('text_recurring');
		$data['text_items'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
		$data['text_loading'] = $this->language->get('text_loading');
		$data['button_remove'] = $this->language->get('button_remove');

		$this->load->model('tool/image');
		$this->load->model('tool/upload');

		$data['products'] = array();

		foreach ($this->cart->getProducts() as $product) {
			if ($product['image']) {
				$image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			} else {
				$image = '';
			}

			$option_data = array();

			foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['value'];
				} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

					if ($upload_info) {
						$value = $upload_info['name'];
					} else {
						$value = '';
					}
				}

				$option_data[] = array(
					'name'  => $option['name'],
					'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value),
					'type'  => $option['type']
				);
			}

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
			} else {
				$total = false;
			}

			$data['products'][] = array(
				'key'       => $product['key'],
				'thumb'     => $image,
				'name'      => $product['name'],
				'model'     => $product['model'],
				'option'    => $option_data,
				'recurring' => ($product['recurring'] ? $product['recurring']['name'] : ''),
				'quantity'  => $product['quantity'],
				'price'     => $price,
				'total'     => $total,
				'href'      => $this->url->link('product/product', 'product_id=' . $product['product_id'])
			);
		}

		// Gift Voucher
		$data['vouchers'] = array();

		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $key => $voucher) {
				$data['vouchers'][] = array(
					'key'         => $key,
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'])
				);
			}
		}

		$data['totals'] = array();
	//	$data['grandtotal'] = $grand_total;

		foreach ($total_data as $result) {
			$data['totals'][] = array(
				'title' => $result['title'],
				'text'  => $this->currency->format($result['value']),
			);
		}

		$data['cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

$data['pallet_worksheet'] = $this->url->link('pallet/worksheet', '', 'SSL');
      

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/cart.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/cart.tpl', $data);
		} else {
			return $this->load->view('default/template/common/cart.tpl', $data);
		}
	}

	public function info() {
		$this->response->setOutput($this->index());
	}
}
