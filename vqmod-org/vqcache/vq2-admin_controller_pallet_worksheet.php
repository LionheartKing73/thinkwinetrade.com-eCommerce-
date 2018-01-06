<?php
class ControllerPalletWorksheet extends Controller {
	public function products() {
		foreach ($this->request->post as $key => $val) {
			${$key} = (int)$val;
		}

		$this->load->model('pallet/worksheet');
		$products = $this->model_pallet_worksheet->getOrderProductsByPalletId($pallet_id);

		$json['products'] = array();

		if(isset($products)) {
			foreach ($products as $product) {

				$json['products'][] = array(
					'pallet_id'  => $product['pallet_id'],
					'product_id' => $product['product_id'],
					'name'       => $product['name'],
					'model'      => $product['model'],
					'option'     => array(),
					'quantity'   => $product['quantity'],
					'price'      => $this->currency->format($product['price'], $product['currency_code']),
					'total'      => $this->currency->format($product['total'], $product['currency_code']),
					'sp_price'   => '',
					'fob_price'  => '',
					'reward'     => '',
					'onclick'		 => $product['product_id'].", ".$product['pallet_id'].", ".$order_id
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function addproduct() {
		$json = array();

		foreach ($this->request->post as $key => $val) {
			${$key} = (int)$val;
		}

		if(isset($product_id) && isset($pallet_id) && isset($quantity) && isset($order_id)) {

			$this->load->model('pallet/worksheet');
			$vendor_id = $this->model_pallet_worksheet->getVendor($product_id);

			$this->load->model('catalog/product');
			$product_info = $this->model_catalog_product->getProduct($product_id);
            $special= $this->model_catalog_product->getProductSpecials($product_id);

            if(count($special)){
                $product_info['price'] = $special[0]['price'];
            }


			if ($product_info) {

				$product_info['total'] = $product_info['price'] * $quantity;
				$product_info['vendor_id'] = $vendor_id;

				$option = array();
				$recurring_id = 0;

				//$this->cart->add($product['product_id'], $quantity, $option, $recurring_id);

				$this->model_pallet_worksheet->addToPallet($pallet_id, $order_id, $product_info, $quantity);
			}
		} else {
			$this->log->write("Missing Params");
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function removeproduct() {

		$json = array();

		foreach ($this->request->post as $key => $val) {
			${$key} = (int)$val;
		}

		if(isset($product_id) && isset($pallet_id)) {
			$this->load->model('pallet/worksheet');
			$this->model_pallet_worksheet->removeFromPallet($pallet_id, $product_id);
		} else {
			$this->log->write("Missing Params");
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function addpallet() {
		foreach ($this->request->post as $key => $val) {
			${$key} = (int)$val;
		}

		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		if(isset($worksheet_id) && isset($order_id) && isset($customer_id) && isset($pallet_size)) {
			$json['pallet_id'] = $this->model_pallet_worksheet->addPallet($worksheet_id, $customer_id, $order_id, $pallet_size);
			$pallets = $this->model_pallet_worksheet->getPallets($worksheet_id);
			$json['newtab'] = count($pallets);
			$json['pallet_size'] = $pallet_size;
			$this->session->data['success'] = $this->language->get('text_remove');
		} else {
			$this->session->data['error'] = "Failed.";
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function destroypallet() {
		foreach ($this->request->post as $key => $val) {
			${$key} = (int)$val;
		}

		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		if(isset($pallet_id) && isset($order_id)) {
			$this->model_pallet_worksheet->destroyPallet($pallet_id, $order_id);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function checkPermission() {
		if (!$this->user->hasPermission('modify', 'sale/order')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function validate() {
		$json = array();

		if ($this->checkPermission()) {
			// Store
			if (isset($this->request->get['store_id'])) {
				$store_id = $this->request->get['store_id'];
			} else {
				$store_id = 0;
			}

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($store_id);

			if ($store_info) {
				$url = $store_info['ssl'];
			} else {
				$url = HTTPS_CATALOG;
			}

			if (isset($this->session->data['cookie']) && isset($this->request->get['api'])) {
				// Include any URL perameters
				$url_data = array();

				foreach($this->request->get as $key => $value) {
					if ($key != 'route' && $key != 'token' && $key != 'store_id') {
						$url_data[$key] = $value;
					}
				}

				$this->load->model('pallet/worksheet');

				$order_id = $this->request->post['order_id'];

				$customer_id = $this->model_pallet_worksheet->getCustomerId($order_id);

				$palletIds = $this->model_pallet_worksheet->getPallets($this->request->post['worksheet_id']);

				$products_all = array();

				for($p = 0; $p < count($palletIds); $p++) {
					$pallet_id = $palletIds[$p];

					$pallet_size = $this->model_pallet_worksheet->getPalletSize($pallet_id);
					$pallet_no = $this->model_pallet_worksheet->generatePalletNo($order_id, $p, $customer_id, $pallet_size);

					$this->model_pallet_worksheet->archivePallet($pallet_id, $order_id, $pallet_no);

					$products = $this->model_pallet_worksheet->getProducts($pallet_id);

					if(isset($products)) {
						$products_all = array_merge($products_all, $products);
					}
				}

				$post['product'] = $products_all;

				$curl = curl_init();

				// Set SSL if required
				if (substr($url, 0, 5) == 'https') {
					curl_setopt($curl, CURLOPT_PORT, 443);
				}

				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLINFO_HEADER_OUT, true);
				curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
			//	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			//	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_URL, $url . 'index.php?route=' . $this->request->get['api'] . ($url_data ? '&' . http_build_query($url_data) : ''));

				if ($this->request->post) {
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
				}

				curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

				$json = curl_exec($curl);

				curl_close($curl);

			}

			/*$this->load->model('pallet/worksheet');

			$worksheet_id = $this->request->post['worksheet_id'];

			$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id);

			for($p = 0; $p < count($palletIds); $p++) {
				$pallet_id = $palletIds[$p];

				$products = $this->model_pallet_worksheet->getProducts($pallet_id);

				if(isset($products)) {
					$this->load->model('catalog/product');

					foreach ($products as $product) {

						$product_info = $this->model_catalog_product->getProduct($product['product_id']);

						if(isset($product_info)) {

							if (isset($product['quantity'])) {
								$quantity = (int)$product['quantity'];
							} else {
								$quantity = $product_info['minimum'] ? $product_info['minimum'] : 1;
							}

							$option = array();
							$recurring_id = 0;

							$this->cart->add($product['product_id'], $quantity, $option, $recurring_id);
						}
					}
				}
			}*/

		} else {
			$response = array();
			$response['error'] = $this->error;
			unset($this->error);

			$json = json_encode($response);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput($json);
	}

	public function pdfo() {
		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}
	}

	public function pdf() {
		$this->load->language('pallet/worksheet');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');

		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_ship_to'] = $this->language->get('text_ship_to');
		$data['text_payment_method'] = $this->language->get('text_payment_method');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_pallet_no'] = $this->language->get('column_pallet_no');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_comment'] = $this->language->get('column_comment');

		$data['title'] = $this->language->get('text_order');

		$data['text_order_info'] = $this->language->get('text_order_info');
		$data['text_order_total'] = $this->language->get('text_order_total');
		$data['column_vendor'] = $this->language->get('column_vendor');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_pallet_total'] = $this->language->get('column_pallet_total');

		$this->load->model('sale/order');

		$this->load->model('pallet/worksheet');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		foreach ($orders as $order_id) {

			$order_info = $this->model_sale_order->getOrder($order_id);

			$worksheet_id = $this->model_pallet_worksheet->getWorksheetByOrderId($order_id);

			$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id);

			$order['order_id'] = $order_id;

			for($p = 0; $p < count($palletIds); $p++) {
				$pallet_id = $palletIds[$p];

				$palletId = $this->model_pallet_worksheet->getPalletData($pallet_id);
				//$products = $this->model_pallet_worksheet->getProducts($pallet_id);
				$products = $this->model_pallet_worksheet->getOrderProductsByPalletId($pallet_id);

				if(isset($products)) {
					foreach ($products as $product) {

						$vendors = array();
						$product['vendor'] = $this->model_pallet_worksheet->getVendor($product['product_id']);

						$palletId['products'][] = array(
							'pallet_id' => $product['pallet_id'],
							//'pallet_no'	=> $product['pallet_no'],
							'id'				=> $product['product_id'],
							'vendor'    => $this->language->get('text_vendor').$product['vendor'],
							'name'      => $product['name'],
							'model'     => $product['sku'],
							'quantity'  => $product['quantity'],
							'price'     => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
							'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
						);
					}
				}

				$pallet_total_value = $this->model_pallet_worksheet->getTotals($pallet_id);

				$palletId['totals'] = array(
					'title' => $this->language->get('text_pallet_total'),
					'text' => $this->currency->format($pallet_total_value + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
				);

				//$data['pallets'][] = $palletId;
				$order['pallets'][] = $palletId;
			}
			$data['orders'][] = $order;
		}

		// Totals
		$total_data = array();

		if($wtotal = $this->model_pallet_worksheet->getWorksheetTotals($worksheet_id)) {
			$wtotal_data['title'] = $this->language->get('text_worksheet_subtotal');
			$wtotal_data['value'] = $wtotal;
			$total_data[] = $wtotal_data;
		}

		// Shipping
		if($shipping = $this->model_pallet_worksheet->getShipping($worksheet_id)) {
			$data['shipping']['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping);
			$data['shipping']['price'] = $this->currency->format($shipping * $this->config->get("pallets_shipping_x".$shipping));
			$shipping_data['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping);
			$shipping_data['value'] = $this->config->get("pallets_shipping_x".$shipping);
			$total_data[] = $shipping_data;
		}

		// Total of All Totals
		$worksheet_total = 0;
		for($t = 0; $t < count($total_data); $t++) {
			$worksheet_total += $total_data[$t]['value'];
		}
		$worksheet_total_data['title'] = $this->language->get('text_preorder_total');
		$worksheet_total_data['value'] = $worksheet_total;
		$total_data[] = $worksheet_total_data;

		$data['totals'] = array();

		foreach ($total_data as $total) {
			$data['totals'][] = array(
				'title' => $total['title'],
				'text' => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value'])
			);
		}

		//$this->response->setOutput(pdf($this->load->view('pallet/worksheet.tpl', $data)));
		$this->response->setOutput($this->load->view('pallet/worksheet.tpl', $data));
	}

	public function archive($order_id) {
		$this->load->model('pallet/worksheet');
		$this->load->model('sale/order');

		$order_info = $this->model_sale_order->getOrder($order_id);
		$worksheet_id = $this->model_pallet_worksheet->getWorksheetByOrderId($order_id);

		$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

		for($p = 0; $p < count($palletIds); $p++) {
			$pallet_id = $palletIds[$p];
			$pallet_size = $this->model_pallet_worksheet->getPalletSize($pallet_id);
			$pallet_no = $this->model_pallet_worksheet->generatePalletNo($order_id, $p, $customer_id, $pallet_size);
			$this->model_pallet_worksheet->archivePallet($pallet_id, $order_id, $pallet_no);
		}
	}










	public function index() {
		$this->load->language('pallet/worksheet');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('common/home'),
			'text' => $this->language->get('text_home')
		);

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('pallet/worksheet'),
			'text' => $this->language->get('heading_title')
		);

		$this->load->model('pallet/worksheet');

		if(!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/login'));
		} else {
			$customer_id = $this->customer->isLogged();
		}

		// Get Worksheet or Add a New One
		$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);

		if ($this->model_pallet_worksheet->hasPallets($worksheet_id)) {
			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_recurring_item'] = $this->language->get('text_recurring_item');
			$data['text_next'] = $this->language->get('text_next');
			$data['text_next_choice'] = $this->language->get('text_next_choice');
			$data['text_pallet_space'] = $this->language->get('text_pallet_space');
			$data['text_pallet_empty'] = $this->language->get('text_pallet_empty');

			$data['column_image'] = $this->language->get('column_image');
			$data['column_vendor'] = $this->language->get('column_vendor');
			$data['column_vendor_limit'] = $this->language->get('column_vendor_limit');
			$data['column_name'] = $this->language->get('column_name');
			$data['column_model'] = $this->language->get('column_model');
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_bottles'] = $this->language->get('column_bottles');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_total'] = $this->language->get('column_total');
			$data['column_pallet_total'] = $this->language->get('column_pallet_total');

			$data['button_update'] = $this->language->get('button_update');
			$data['button_remove'] = $this->language->get('button_remove');
			$data['button_shopping'] = $this->language->get('button_shopping');
			$data['button_checkout'] = $this->language->get('button_checkout');

			$data['error_vendor_triangle'] = sprintf($this->language->get('error_vendor_triangle'), $this->config->get('pallets_limit_t'));

			if (!$this->cart->hasStock() && (!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning'))) {
				$data['error_warning'] = $this->language->get('error_stock');
			} elseif (isset($this->session->data['error'])) {
				$data['error_warning'] = $this->session->data['error'];

				unset($this->session->data['error']);
			} else {
				$data['error_warning'] = '';
			}

			if ($this->config->get('config_customer_price') && !$this->customer->isLogged()) {
				$data['attention'] = sprintf($this->language->get('text_login'), $this->url->link('account/login'), $this->url->link('account/register'));
			} else {
				$data['attention'] = '';
			}

			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];
				unset($this->session->data['success']);
			} else {
				$data['success'] = '';
			}

			$data['action'] = $this->url->link('pallet/worksheet/edit');

			$this->load->model('tool/image');
			$this->load->model('tool/upload');

			// Get Pallets that are in the current Worksheet
			$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

			$data['products'] = array();
			$products = array();

			for($p = 0; $p < count($palletIds); $p++) {
				$pallet_id = $palletIds[$p];

				// Update Totals
				$this->model_pallet_worksheet->updateTotals($pallet_id);

				$palletId = $this->model_pallet_worksheet->getPalletData($pallet_id);
				$products = $this->model_pallet_worksheet->getProducts($pallet_id);

				if(isset($products)) {
					foreach ($products as $product) {
						$data['thumb'] = array();

						// Get vendors
						$vendors = array();
						$product['vendor'] = $this->model_pallet_worksheet->getVendor($product['product_id']);

						if($vendorLimit = $this->model_pallet_worksheet->getBoxesPerVendor($pallet_id, $product['vendor'])) {
							$limit_t = $this->config->get('pallets_limit_t');

							if($vendorLimit['qty'] < $limit_t) {
								$product['vendor_limit'] = $vendorLimit['qty'].' / '.$limit_t;
								$vendorLimitNotMet = 1;
							} else {
								$product['vendor_limit'] = '';
							}
						}

						$product['bottles'] = $product['quantity'] * 6;

						$palletId['products'][] = array(
							'pallet_id' => $product['pallet_id'],
							'id'				=> $product['product_id'],
							'vendor'    => $this->language->get('text_vendor').$product['vendor'],
							'vendor_limit' => $product['vendor_limit'],
							'name'      => $product['name'],
							'model'     => $product['model'],
							'quantity'  => $product['quantity'],
							'price'     => $this->currency->format($product['price'],'','',false),
							'bottles'		=> $product['bottles'],
							'total'     => $this->currency->format($product['total'],'','',false),
							'href'      => $this->url->link('product/product', 'product_id=' . $product['product_id'])
						);
					}
				} else {
					$palletId['products'][] = array();
				}

				// Infos
				// Pallet status
				$currentProductsCount = $this->model_pallet_worksheet->hasProducts($pallet_id);
				$palletLocked = $this->model_pallet_worksheet->isPalletLocked($pallet_id);
				$palletId['progress']['limit'] = $this->config->get('pallets_limit_p');
				$palletId['progress']['current'] = $currentProductsCount;
				if($currentProductsCount < $this->config->get('pallets_limit_p')) {
					$spaceLeft = $this->config->get('pallets_limit_p') - $currentProductsCount;
					$palletId['infos'][]['msg'] = sprintf($this->language->get('text_pallet_space'), $spaceLeft);
					$palletId['progress']['left'] = $spaceLeft;
					$palletFullNotMet = 1;
				} else if($currentProductsCount == $this->config->get('pallets_limit_p') && isset($vendorLimitNotMet)) {
					$palletId['infos'][]['msg'] = $this->language->get('error_pallet_invalid_full');
					$palletFullNotMet = 1;
				} else if(isset($palletLocked)) {
					$palletId['infos'][]['msg'] = $this->language->get('text_pallet_valid_locked');
				} else {
					$palletId['infos'][]['msg'] = $this->language->get('text_pallet_valid');
				}

				// Validity Check
				if(!isset($vendorLimitNotMet) AND !isset($palletFullNotMet)) {
					$palletId['valid'] = 1;
				} else {
					$palletId['valid'] = '';
				}

				// Pallet Totals
				$pallet_total_value = $this->model_pallet_worksheet->getTotals($pallet_id);

				$palletId['totals'] = array(
					'title' => $this->language->get('text_pallet_total'),
					'text'  => $this->currency->format($pallet_total_value)
				);

				$palletId['tab'] = $p + 1;
				//$tab['id'] = $pallets[$p];
				$data['pallets'][] = $palletId;

			}

			// Totals
			$total_data = array();

			if($wtotal = $this->model_pallet_worksheet->getWorksheetTotals($worksheet_id)) {
				$wtotal_data['title'] = $this->language->get('text_worksheet_subtotal');
				$wtotal_data['value'] = $wtotal;
				$total_data[] = $wtotal_data;
			}

			// Shipping
			if($shipping = $this->model_pallet_worksheet->getShipping($worksheet_id)) {
				$data['shipping']['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping);
				$data['shipping']['price'] = $this->currency->format($shipping * $this->config->get("pallets_shipping_x".$shipping));
				$shipping_data['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping);
				$shipping_data['value'] = $this->config->get("pallets_shipping_x".$shipping);
				$total_data[] = $shipping_data;
			}

			// Total of All Totals
			$worksheet_total = 0;
			for($t = 0; $t < count($total_data); $t++) {
				$worksheet_total += $total_data[$t]['value'];
			}
			$worksheet_total_data['title'] = $this->language->get('text_worksheet_total');
			$worksheet_total_data['value'] = $worksheet_total;
			$total_data[] = $worksheet_total_data;

			$data['totals'] = array();

			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'])
				);
			}

			// Add New Pallet
			$unlockedPallet = $this->model_pallet_worksheet->getPallet($worksheet_id, $customer_id);
			if(!isset($unlockedPallet)) {
				$data['all_pallets_locked'] = 1;
			} else {
				$data['all_pallets_locked'] = '';
			}

			$data['continue'] = $this->url->link('common/home');

			$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
			$data['proceed'] = $this->url->link('pallet/worksheet/proceed', '', 'SSL');

			$this->load->model('extension/extension');

			$data['checkout_buttons'] = array();

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/pallet/worksheet.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/pallet/worksheet.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/pallet/worksheet.tpl', $data));
			}
		} else {
			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_error'] = $this->language->get('text_empty');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			unset($this->session->data['success']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function add() {
		$this->load->language('pallet/worksheet');

		$json = array();

		if (isset($this->request->post['product_id'])) {
			$product_id = (int)$this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('pallet/worksheet');

		if($this->customer->isLogged()) {

			$customer_id = $this->customer->isLogged();
			$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);
			$pallet_id = $this->model_pallet_worksheet->getPallet($worksheet_id, $customer_id);

			if(isset($pallet_id)) {

				$vendor_id = $this->model_pallet_worksheet->getVendor($product_id);
				$currentVendors = $this->model_pallet_worksheet->getVendorsPerPallet($pallet_id);
				$vendorsLimit = $this->config->get("pallets_limit_v");
				$vendorInPallet = $this->model_pallet_worksheet->isVendorInPallet($pallet_id, $vendor_id);

				if(($currentVendors <= $vendorsLimit && $vendorInPallet) || ($currentVendors < $vendorsLimit && !$vendorInPallet)) {

					$this->load->model('catalog/product');

					$product_info = $this->model_catalog_product->getProduct($product_id);

					if ($product_info) {
						if (isset($this->request->post['quantity'])) {
							$quantity = (int)$this->request->post['quantity'];
						} else {
							$quantity = $product_info['minimum'] ? $product_info['minimum'] : 1;
						}

						if (isset($this->request->post['option'])) {
							$option = array_filter($this->request->post['option']);
						} else {
							$option = array();
						}

						$product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);

						foreach ($product_options as $product_option) {
							if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
								$json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
							}
						}

						if (isset($this->request->post['recurring_id'])) {
							$recurring_id = $this->request->post['recurring_id'];
						} else {
							$recurring_id = 0;
						}

						/*$recurrings = $this->model_catalog_product->getProfiles($product_info['product_id']);

						if ($recurrings) {
							$recurring_ids = array();

							foreach ($recurrings as $recurring) {
								$recurring_ids[] = $recurring['recurring_id'];
							}

							if (!in_array($recurring_id, $recurring_ids)) {
								$json['error']['recurring'] = $this->language->get('error_recurring_required');
							}
						}*/

						$product_info['total'] = $product_info['price'] * $quantity;

						$product_info['vendor_id'] = $vendor_id;

						//$this->model_pallet_worksheet->addToPallet($pallet_id, $product_info, $quantity);

						if (!$json) {
							//$this->cart->add($this->request->post['product_id'], $quantity, $option, $recurring_id);

							$currentProductsCount = $this->model_pallet_worksheet->hasProducts($pallet_id);
							if($currentProductQty = $this->model_pallet_worksheet->getProductQty($pallet_id, $product_info['product_id'])) {
								$woCount = $currentProductsCount - $currentProductQty;
								$quantity += $currentProductQty;
								if ($woCount + $quantity <= $this->config->get('pallets_limit_p')) {
									$this->model_pallet_worksheet->updatePallet($pallet_id, $product_info['product_id'], $quantity);
									$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']), $product_info['name'], $this->url->link('pallet/worksheet'));
								} else {
									$json['error']['popup'] = sprintf($this->language->get('error_pallet_limit'), $this->config->get('pallets_limit_p'));
								}
							} else {
								if ($currentProductsCount + $quantity <= $this->config->get('pallets_limit_p')) {
									$this->model_pallet_worksheet->addToPallet($pallet_id, $product_info, $quantity);
									$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']), $product_info['name'], $this->url->link('pallet/worksheet'));
								} else {
									$json['error']['popup'] = sprintf($this->language->get('error_pallet_limit'), $this->config->get('pallets_limit_p'));
								}
							}

							//$json['total'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
						} else {
							$json['redirect'] = str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']));
						}
					}
				} else {
					$json['error']['popup'] = sprintf($this->language->get('error_vendors_limit'), $this->config->get('pallets_limit_v'));
				}
			} else {
				$json['error']['popup'] = sprintf($this->language->get('error_pallets_locked'), $this->url->link('pallet/worksheet'));
			}

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));

		} else {
			$json['error']['popup'] = sprintf($this->language->get('error_login_required'), $this->url->link('account/login'));

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
	}

	public function update() {
		$this->load->language('pallet/worksheet');

		$json = array();

		// Update
		if (isset($this->request->post['pallet_id']) && isset($this->request->post['product_id'])) {
			$this->load->model('pallet/worksheet');

			if($this->model_pallet_worksheet->isPalletLocked($this->request->post['pallet_id'])) {
				$this->session->data['error'] = $this->language->get('error_pallet_locked');
			} else {
				$currentProductsCount = $this->model_pallet_worksheet->hasProducts($this->request->post['pallet_id']);
				$currentProductQty = $this->model_pallet_worksheet->getProductQty($this->request->post['pallet_id'], $this->request->post['product_id']);
				$woCount = $currentProductsCount - $currentProductQty;
				if ($woCount + $this->request->post['quantity'] <= $this->config->get('pallets_limit_p')) {
					$this->model_pallet_worksheet->updatePallet($this->request->post['pallet_id'], $this->request->post['product_id'], $this->request->post['quantity']);
					$this->session->data['success'] = $this->language->get('text_remove');
				} else {
					$this->session->data['error'] = sprintf($this->language->get('error_pallet_limit'), $this->config->get('pallets_limit_p'));
				}
			}
			//$this->response->redirect($this->url->link('pallet/worksheet'));
		}

		//$this->response->redirect($this->url->link('pallet/worksheet'));

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function remove() {
		$this->load->language('pallet/worksheet');

		$json = array();

		// Remove
		if (isset($this->request->post['pallet_id']) && isset($this->request->post['product_id'])) {
			$this->load->model('pallet/worksheet');

			if($this->model_pallet_worksheet->isPalletLocked($this->request->post['pallet_id'])) {
				$this->session->data['error'] = $this->language->get('error_pallet_locked');
			} else {
				$this->model_pallet_worksheet->removeFromPallet($this->request->post['pallet_id'], $this->request->post['product_id']);
				$this->session->data['success'] = $this->language->get('text_remove');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}



	public function lockpallet() {
		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		$customer_id = $this->customer->isLogged();

		if(isset($this->request->post['pallet_id']) && isset($customer_id)) {
			$this->model_pallet_worksheet->lockPallet($this->request->post['pallet_id'], $customer_id);
			$this->session->data['success'] = $this->language->get('text_remove');
		} else {
			$this->session->data['error'] = $this->language->get('error_action_failed');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function unlockpallet() {
		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		$customer_id = $this->customer->isLogged();

		if(isset($this->request->post['pallet_id']) && isset($customer_id)) {
			$this->model_pallet_worksheet->unlockPallet($this->request->post['pallet_id'], $customer_id);
			$this->session->data['success'] = $this->language->get('text_remove');
		} else {
			$this->session->data['error'] = $this->language->get('error_action_failed');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function palletstatus() {
		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		$customer_id = $this->customer->isLogged();

		if(isset($customer_id)) {

			$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);
			$pallet_id = $this->model_pallet_worksheet->getPallet($worksheet_id, $customer_id);

			if(isset($pallet_id)) {
				if($this->model_pallet_worksheet->hasProducts($pallet_id)) {
					// Update Totals
					$this->model_pallet_worksheet->updateTotals($pallet_id);

					$status = $this->model_pallet_worksheet->getPalletStatusData($pallet_id, $customer_id);

					if(isset($status)) {
						$json['sellers'] = $status['vendors']."/".$this->config->get('pallets_limit_v');
						$json['cases'] = $status['qty']."/".$this->config->get('pallets_limit_p');
						$json['bottles'] = $status['qty'] * 6;
						$json['total'] = $this->currency->format($status['total'],'','',true);
						$json['success'] = 1;
						//$this->session->data['success'] = $this->language->get('text_remove');
					}
				} else {
					$json['success'] = 1;
				}
			} else {
				$json['error']['popup'] = sprintf($this->language->get('error_pallets_locked'), $this->url->link('pallet/worksheet'));
			}
		} else {
			$json['error']['popup'] = sprintf($this->language->get('error_login_required'), $this->url->link('account/login'));
		}

		//$json = array('sellers' => '1/3', 'cases' => '30/100', 'bottles' => '333', 'price' => '333.00');

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}



	public function destroyworksheet() {
		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		$customer_id = $this->customer->isLogged();

		if(isset($customer_id)) {
			$this->model_pallet_worksheet->destroyWorksheet($customer_id);
			$this->session->data['success'] = $this->language->get('text_remove');
		} else {
			$this->session->data['error'] = $this->language->get('error_action_failed');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function proceed() {
		$this->load->language('pallet/worksheet');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('common/home'),
			'text' => $this->language->get('text_home')
		);

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('pallet/worksheet'),
			'text' => $this->language->get('heading_title')
		);

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('pallet/worksheet/proceed'),
			'text' => $this->language->get('text_preorder')
		);

		$this->load->model('pallet/worksheet');

		if(!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/login'));
		} else {
			$customer_id = $this->customer->isLogged();
		}

		$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);

		$data['heading_title'] = $this->language->get('text_preorder');

		$data['text_preorder_info'] = $this->language->get('text_preorder_info');
		$data['text_preorder_total'] = $this->language->get('text_preorder_total');
		$data['text_modify'] = $this->language->get('text_modify');
		$data['text_validate'] = $this->language->get('text_validate');

		$data['column_vendor'] = $this->language->get('column_vendor');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_bottles'] = $this->language->get('column_bottles');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_pallet_total'] = $this->language->get('column_pallet_total');

		$data['button_update'] = $this->language->get('button_update');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_shopping'] = $this->language->get('button_shopping');
		$data['button_checkout'] = $this->language->get('button_checkout');


		// Get Pallets that are in the current Worksheet
		$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

		$data['products'] = array();
		$products = array();

		for($p = 0; $p < count($palletIds); $p++) {
			$pallet_id = $palletIds[$p];

			// Update Totals
			$this->model_pallet_worksheet->updateTotals($pallet_id);

			$palletId = $this->model_pallet_worksheet->getPalletData($pallet_id);
			$products = $this->model_pallet_worksheet->getProducts($pallet_id);

			if(isset($products)) {
				foreach ($products as $product) {
					$data['thumb'] = array();

					// Get vendors
					$vendors = array();
					$product['vendor'] = $this->model_pallet_worksheet->getVendor($product['product_id']);

					if($vendorLimit = $this->model_pallet_worksheet->getBoxesPerVendor($pallet_id, $product['vendor'])) {
						$limit_t = $this->config->get('pallets_limit_t');

						if($vendorLimit['qty'] < $limit_t) {
							$product['vendor_limit'] = $vendorLimit['qty'].' / '.$limit_t;
							$vendorLimitNotMet = 1;
						} else {
							$product['vendor_limit'] = '';
						}
					}

					$palletId['products'][] = array(
						'pallet_id' => $product['pallet_id'],
						'id'				=> $product['product_id'],
						'vendor'    => $this->language->get('text_vendor').$product['vendor'],
						'name'      => $product['name'],
						'model'     => $product['sku'],
						'quantity'  => $product['quantity'],
						'price'     => $this->currency->format($product['price'],'','',false),
						'total'     => $this->currency->format($product['total'],'','',false)
					);
				}
			} else {
				$palletId['products'][] = array();
			}

			// Pallet Totals
			$pallet_total_value = $this->model_pallet_worksheet->getTotals($pallet_id);

			$palletId['totals'] = array(
				'title' => $this->language->get('text_pallet_total'),
				'text'  => $this->currency->format($pallet_total_value)
			);

			$palletId['tab'] = $p + 1;
			//$tab['id'] = $pallets[$p];
			$data['pallets'][] = $palletId;

		}

		// Totals
		$total_data = array();

		if($wtotal = $this->model_pallet_worksheet->getWorksheetTotals($worksheet_id)) {
			$wtotal_data['title'] = $this->language->get('text_worksheet_subtotal');
			$wtotal_data['value'] = $wtotal;
			$total_data[] = $wtotal_data;
		}

		// Shipping
		if($shipping = $this->model_pallet_worksheet->getShipping($worksheet_id)) {
			$data['shipping']['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping);
			$data['shipping']['price'] = $this->currency->format($shipping * $this->config->get("pallets_shipping_x".$shipping));
			$shipping_data['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping);
			$shipping_data['value'] = $this->config->get("pallets_shipping_x".$shipping);
			$total_data[] = $shipping_data;
		}

		// Total of All Totals
		$worksheet_total = 0;
		for($t = 0; $t < count($total_data); $t++) {
			$worksheet_total += $total_data[$t]['value'];
		}
		$worksheet_total_data['title'] = $this->language->get('text_preorder_total');
		$worksheet_total_data['value'] = $worksheet_total;
		$total_data[] = $worksheet_total_data;

		$data['totals'] = array();

		foreach ($total_data as $total) {
			$data['totals'][] = array(
				'title' => $total['title'],
				'text'  => $this->currency->format($total['value'])
			);
		}

		$data['worksheet'] = $this->url->link('pallet/worksheet', '', 'SSL');
		$data['validate'] = $this->url->link('pallet/worksheet/validate', '', 'SSL');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/pallet/proceed.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/pallet/proceed.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/pallet/proceed.tpl', $data));
		}
	}


    public function updatePrices($data){
		$this->load->model('pallet/worksheet');
        $this->model_pallet_worksheet->updatePrices($data);

    }


}
