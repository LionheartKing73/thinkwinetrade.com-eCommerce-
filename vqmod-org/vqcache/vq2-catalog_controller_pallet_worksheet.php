<?php
class ControllerPalletWorksheet extends Controller {
	public function index() {
   		$this->load->language('pallet/worksheet');

		$this->document->setTitle($this->language->get('heading_title'));

		/**$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('common/home'),
			'text' => $this->language->get('text_home')
		);

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('pallet/worksheet'),
			'text' => $this->language->get('heading_title')
		);**/

		$this->load->model('pallet/worksheet');

		if(!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('pallet/worksheet', '', 'SSL');
			$this->response->redirect($this->url->link('account/login'));
		} else {
			$customer_id = $this->customer->isLogged();
		}

        // Get Worksheet or Add a New One
		$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);


		// Coupon
		$data['error_coupon'] = '';
		//unset($this->session->data['coupon']);
		if (isset($this->request->post['coupon']) && $this->validateCoupon($data['error_coupon'], $worksheet_id)) {
			$this->session->data['coupon'] = $this->request->post['coupon'];

			$this->session->data['success'] = $this->language->get('text_coupon');
			$this->response->redirect($this->url->link('pallet/worksheet'));
		}




		if ($this->model_pallet_worksheet->hasPallets($worksheet_id)) {
			//coupon
			$data['entry_coupon'] = $this->language->get('entry_coupon');
            $data['entry_reward'] = $this->language->get('entry_reward');
			$data['text_use_coupon'] = $this->language->get('text_use_coupon');
			$data['button_coupon'] = $this->language->get('button_coupon');

    		$data['heading_title'] = $this->language->get('heading_title');
			$data['heading_title_long'] = $this->language->get('heading_title_long');
			$data['heading_title_img'] = $this->language->get('heading_title_img');

			$data['text_recurring_item'] = $this->language->get('text_recurring_item');
			$data['text_next'] = $this->language->get('text_next');
			$data['text_next_choice'] = $this->language->get('text_next_choice');
			$data['text_pallet_space'] = $this->language->get('text_pallet_space');
			$data['text_pallet_empty'] = sprintf($this->language->get('text_pallet_empty'), $this->url->link('product/category&path=60'));

			$data['column_image'] = $this->language->get('column_image');
			$data['column_vendor'] = $this->language->get('column_vendor');
			$data['column_vendor_limit'] = $this->language->get('column_vendor_limit');
			$data['column_name'] = $this->language->get('column_name');
			$data['column_model'] = $this->language->get('column_model');
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_bottles'] = $this->language->get('column_bottles');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_price_per_bottle'] = $this->language->get('column_price_per_bottle');
			$data['column_total'] = $this->language->get('column_total');
			$data['column_pallet_total'] = $this->language->get('column_pallet_total');

			$data['button_update'] = $this->language->get('button_update');
			$data['button_remove'] = $this->language->get('button_remove');
			$data['button_shopping'] = $this->language->get('button_shopping');
			$data['button_checkout'] = $this->language->get('button_checkout');

			$data['text_all_pallet_valid'] = $this->language->get('text_all_pallet_valid');
			$data['text_all_pallet_valid_or'] = $this->language->get('text_all_pallet_valid_or');
			$data['button_delete_pallet'] = $this->language->get('button_delete_pallet');
			$data['button_create_pallet'] = $this->language->get('button_create_pallet');
			$data['button_redo_book'] = $this->language->get('button_redo_book');
			$data['button_modify_book'] = $this->language->get('button_modify_book');
			$data['button_validate_book'] = $this->language->get('button_validate_book');
			$data['button_proceed_checkout'] = $this->language->get('button_proceed_checkout');

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
			$data['action_extra'] = $this->url->link('pallet/worksheet');

			$this->load->model('tool/image');
			$this->load->model('tool/upload');

			// Get Pallets that are in the current Worksheet
			$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

			$this->log->write($palletIds);

			$data['products'] = array();
			$products = array();

			$validator = '0';

            if (isset($this->request->post['next'])) {
				$data['next'] = $this->request->post['next'];
			} else {
				$data['next'] = '';
			}

            $data['coupon_status'] = $this->config->get('coupon_status');

			$data['voucher_status'] = false; //$this->config->get('voucher_status');
            $data['reward_status'] = false; //$this->config->get('reward_status');

			if (isset($this->request->post['coupon'])) {
				$data['coupon'] = $this->request->post['coupon'];
			} elseif (isset($this->session->data['coupon'])) {
				$data['coupon'] = $this->session->data['coupon'];
			} else {
				$data['coupon'] = '';
			}

			for($p = 0; $p < count($palletIds); $p++) {
				$pallet_id = $palletIds[$p];
				unset($vendorLimitNotMet);
				unset($palletFullNotMet);


				$palletId = $this->model_pallet_worksheet->getPalletData($pallet_id);
				$products = $this->model_pallet_worksheet->getProducts($pallet_id);

		     	$this->load->model('catalog/product');

				if(isset($products)) {
					foreach ($products as $product) {
						$data['thumb'] = array();


						$product_name = $product['name'];
          				$product_info = $this->model_catalog_product->getProduct($product['product_id']);


						if (!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')){
								if ($product['quantity'] > $product_info['quantity'])
								  $product_name .= "<font color='#cc0000'>***</fonts>";
						}

						// Get vendors
						$vendors = array();
						$product['vendor'] = $this->model_pallet_worksheet->getVendor($product['product_id']);
						$product['vendor_name'] = $this->model_pallet_worksheet->getVendorName($product['product_id']);

						if($vendorLimit = $this->model_pallet_worksheet->getBoxesPerVendor($pallet_id, $product['vendor'])) {
							$limit_t = $this->config->get('pallets_limit_t');

							if($vendorLimit['qty'] < $limit_t) {
								$product['vendor_limit'] = $vendorLimit['qty'].' / '.$limit_t;
								$vendorLimitNotMet = 1;
							} else {
								$product['vendor_limit'] = '';
							}
						}

					     $total_quantity_of_this_product  = $this->model_pallet_worksheet->getWorksheetProductQty($worksheet_id, $product['product_id']);
                         $discount = $this->model_catalog_product->getProductDiscount($product['product_id'],$total_quantity_of_this_product);
                         $label = '';
                         if(isset($discount['price']) && $discount['price'] !== null) {
                                          $product_info['price'] = $discount['price'];
                                          $product_info['sp_price'] = $discount['sp_price'];
                                          $label =  $this->language->get('label_discount');
																					$label = '<span class="discount_label">'.$label.'</span>';
                         }

                    //    $this->model_pallet_worksheet->updateProductPrice($worksheet_id,$product_info, $customer_id);

                        $price =  $this->currency->format($product['price']);
						$total =   $this->currency->format($product['total']);

                         //zighia
						$fob_data = $this->model_catalog_product->getFOBProductData($product['product_id']);
						$product['bottles'] = $product['quantity'] * $fob_data['pf'];
                        //zighia

                        if ($product['price'] != $fob_data['price']){
                                if (strlen($label) == 0)
                                          $label =  $this->language->get('label_special');
																					$label = '<span class="promo_label">'.$label.'</span>';
                                $price  =  '<del>'.$this->currency->format($fob_data['price']).'</del><br />
                                <span class="discounted_price">'.$this->currency->format($product['price']).'</span>';
								$total  =  '<del>'.$this->currency->format($fob_data['price']*$product['quantity']).'</del><br /><span class="discounted_price">'.$this->currency->format($product['price']*$product['quantity']).'</span>';
								$price_per_bottle = '<del>'.$this->currency->format($fob_data['price'] / $fob_data['pf']).'</del><br />'.$label.'<span class="discounted_price">'.$this->currency->format($product['price'] / $fob_data['pf']).'</span>';
						} else {
							$price_per_bottle = $this->currency->format($fob_data['price'] / $fob_data['pf']);
						}



						$palletId['products'][] = array(
							'pallet_id' => $product['pallet_id'],
							'id'				=> $product['product_id'],
							'vendor'    => $product['vendor_name'],
							'vendor_limit' => $product['vendor_limit'],
							'name'      => $product_name,
							'model'     => $product['model'],
							'quantity'  => $product['quantity'],
							'price'     => $price,
							'price_per_bottle'     => $price_per_bottle,
							'bottles'	=> $product['bottles'],
							'total'     => $total,
							'href'      => $this->url->link('product/product', 'product_id=' . $product['product_id'])
						);
					}
				} else {
					$palletId['products'][] = array();
				}
               	// Update Totals
				$this->model_pallet_worksheet->updateTotals($pallet_id);

				// Infos
				// Pallet status
				$currentProductsCount = $this->model_pallet_worksheet->hasProducts($pallet_id);
				$palletLocked = $this->model_pallet_worksheet->isPalletLocked($pallet_id);
				$palletSize = $this->model_pallet_worksheet->getPalletSize($pallet_id);
				$palletId['progress']['limit'] = $palletSize;
				$palletId['space']['current'] = $currentProductsCount;
				$palletId['progress']['current'] = 100*$currentProductsCount/$palletSize;
				$infos = array();
				if($currentProductsCount < $palletSize) {
					$spaceLeft = $palletSize - $currentProductsCount;
					$infos['msg'] = sprintf($this->language->get('text_pallet_space'), $spaceLeft, $palletSize);
					$infos['style'] = 'alert-warning';
					$palletId['infos'][] = $infos;
					$palletId['space']['left'] = $spaceLeft;
					$palletId['progress']['left'] = 100*$spaceLeft/$palletSize;
					$palletFullNotMet = 1;
				} else if($currentProductsCount == $palletSize && isset($vendorLimitNotMet)) {
					$infos['msg'] = $this->language->get('error_pallet_invalid_full');
					$infos['style'] = 'alert-warning';
					$palletId['infos'][] = $infos;
					$palletFullNotMet = 1;
				} else if(isset($palletLocked)) {
					$palletId['infos'][]['msg'] = $this->language->get('text_pallet_valid_locked');
				} else {
					$infos['msg'] = $this->language->get('text_pallet_valid');
					$infos['style'] = 'alert-success';
					$palletId['infos'][] = $infos;
				}

				// Validity Check
				if(!isset($vendorLimitNotMet) AND !isset($palletFullNotMet)) {
					$palletId['valid'] = 1;
					$validator++;
				} else {
					$palletId['valid'] = '';
				}

				// Pallet Totals
				$pallet_total_value = $this->model_pallet_worksheet->getTotals($pallet_id);

				$palletId['totals'] = array(
					'title' =>$this->language->get('text_pallet_total'),
					'text'  => $this->currency->format($pallet_total_value)
				);

				$palletId['size'] = $palletSize;
				$palletId['tab'] = $p + 1;
				$data['pallets'][] = $palletId;
			}

			$this->log->write($data['pallets']);

			// Totals
			$total_data = array();
			$taxes = 0;

			if($wtotal = $this->model_pallet_worksheet->getWorksheetTotals($worksheet_id)) {
				$wtotal_data['title'] = $this->language->get('text_worksheet_subtotal');
				$wtotal_data['value'] = $wtotal;
				$total_data[] = $wtotal_data;
			}

			//Coupon
			if ($this->config->get('coupon_status')) {
					$this->load->model('total/coupon');
					$this->model_total_coupon->getWTotal($total_data, $wtotal, $taxes, $worksheet_id);

			}


			// Shipping
			if($shipping = $this->model_pallet_worksheet->getShipping($worksheet_id)) {
				$data['shipping']['price'] = '';
				$shipping_data['value'] = 0;
				$shipping_text = '';

				foreach ($shipping as $shipping_pallet) {
					$shipping_data['value'] += $this->config->get("pallets_shipping_x" . $shipping_pallet['pallet_qty'] . "_" . $shipping_pallet['pallet_size']);
					$shipping_text .= $shipping_pallet['pallet_qty'] . "x" . $shipping_pallet['pallet_size'] . " ";
				}

				$data['shipping']['price'] = $this->currency->format($shipping_data['value']);
				$data['shipping']['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping_text);
				$shipping_data['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping_text);
				$total_data[] = $shipping_data;
			}


			//$data['palletsqty'] = $shipping;

			// Total of All Totals
			$worksheet_total = 0;
			for($t = 0; $t < count($total_data); $t++) {
				$worksheet_total += $total_data[$t]['value'];
			}
			$worksheet_total_data['title'] = $this->language->get('text_worksheet_total');
			$worksheet_total_data['value'] = $worksheet_total;
			$total_data[] = $worksheet_total_data;

			$this->log->write($total_data);

			$data['totals'] = array();

			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'])
				);
			}

			$data['totals'][] = array(
					'title'=>'Total HK$',
					//'text'=>$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert($worksheet_total, $this->session->data['currency'], 'HKD'),0,PHP_ROUND_HALF_UP)
                    'text' => $this->currency->format($this->currency->convert($worksheet_total, $this->session->data['currency'], 'HKD'),"HKD",1),
                    );

			if(count($palletIds) == $validator) {
				$data['all_pallets_valid'] = 1;
			} else {
				$data['all_pallets_valid'] = '';
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
		

			/* START */
			$layout_positions = $this->load->controller('common/layout_footer/layoutPositions');

			foreach($layout_positions as $position){
				$data[$position] = $this->load->controller('common/layout_footer/index', $position);
			}
			/* END */
			
			
			
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/pallet/worksheet.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/pallet/worksheet.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/pallet/worksheet.tpl', $data));
			}
		} else {
			$data['heading_title'] = $this->language->get('heading_title');
			$data['heading_title_long'] = $this->language->get('heading_title_long');
			$data['heading_title_img'] = $this->language->get('heading_title_img');

			$data['text_error'] = $this->language->get('text_empty');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			unset($this->session->data['success']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
		

			/* START */
			$layout_positions = $this->load->controller('common/layout_footer/layoutPositions');

			foreach($layout_positions as $position){
				$data[$position] = $this->load->controller('common/layout_footer/index', $position);
			}
			/* END */
			
			
			
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');


			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/pallet/empty.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/pallet/empty.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/pallet/empty.tpl', $data));
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
            $pallets = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);
            $pallet_id = $this->model_pallet_worksheet->getPallet($worksheet_id, $customer_id);


			if(isset($pallet_id)) {
				$this->log->write("Got pallet: ".$pallet_id);


				$vendor_id = $this->model_pallet_worksheet->getVendor($product_id);
				$currentVendors = $this->model_pallet_worksheet->getVendorsPerPallet($pallet_id);
				$vendorsLimit = $this->config->get("pallets_limit_v");
				$vendorInPallet = $this->model_pallet_worksheet->isVendorInPallet($pallet_id, $vendor_id);

				$this->log->write("c: ".$currentVendors." l: ".$vendorsLimit." i:".$vendorInPallet);

				if(($currentVendors <= $vendorsLimit && $vendorInPallet) || ($currentVendors < $vendorsLimit && !$vendorInPallet)) {

					$this->load->model('catalog/product');

					$product_info = $this->model_catalog_product->getProduct($product_id);

					$stock_ok = true;
                    $pallets_quantity = 0;
                    foreach($pallets as $pallet){
                             $pallets_quantity += (int)$this->model_pallet_worksheet->getProductQty($pallet, $product_id );
                    }


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

                     if (isset($product_info['special']))
                            $product_info['price'] = $product_info['special'];

                     	$product_info['total'] = $product_info['price'] * $quantity;

						$product_info['vendor_id'] = $vendor_id;

						$this->log->write($product_info);

						//$this->model_pallet_worksheet->addToPallet($pallet_id, $product_info, $quantity);

					  if (!$json) {
							//$this->cart->add($this->request->post['product_id'], $quantity, $option, $recurring_id);

							$currentProductsCount = $this->model_pallet_worksheet->hasProducts($pallet_id);
							$palletSize = $this->model_pallet_worksheet->getPalletSize($pallet_id);
							if($currentProductQty = $this->model_pallet_worksheet->getProductQty($pallet_id, $product_info['product_id'])) {
								$woCount = $currentProductsCount - $currentProductQty;

								if ($pallets_quantity+$quantity >$product_info['quantity']){

			 							$quantity = $product_info['quantity']-$pallets_quantity+$currentProductQty;
                                        $json['error']['popup'] = sprintf($this->language->get('error_pallet_stock'), $product_info['name'],$product_info['quantity']);
                                        if ($quantity <= 0 ){
                                          $stock_ok = false;
                                        }

								}
                                else
                                    $quantity += $currentProductQty;

								if (($woCount + $quantity <= $palletSize) && $stock_ok) {
									$this->model_pallet_worksheet->updatePallet($pallet_id, $product_info['product_id'], $quantity);
                                    if (!isset($json['error']['popup']))
									  $json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']),(int)$this->request->post['quantity'].' x '.$product_info['name'], $this->url->link('pallet/worksheet'));
								} else {
                                    if($stock_ok)
									$json['error']['popup'] = sprintf($this->language->get('error_pallet_limit'), $palletSize);
								}
							} else {
								if ($pallets_quantity+$quantity >= $product_info['quantity']){

			 							$quantity = $product_info['quantity']-$pallets_quantity+$currentProductQty;

                                        if ($quantity <= 0 ){
                                          $stock_ok = false;
                                          $json['error']['popup'] = sprintf($this->language->get('error_pallet_stock'), $product_info['name'],$product_info['quantity']);
                                        }

								}

								if (($currentProductsCount + $quantity <= $palletSize) && $stock_ok) {
									$this->model_pallet_worksheet->addToPallet($pallet_id, $product_info, $quantity);
                                    if (!isset($json['error']['popup']))
									  $json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']), $product_info['name'], $this->url->link('pallet/worksheet'));
								} else {
                                    if($stock_ok)
									$json['error']['popup'] = sprintf($this->language->get('error_pallet_limit'), $palletSize);
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
				//$json['error']['popup'] = sprintf($this->language->get('error_pallets_locked'), $this->url->link('pallet/worksheet'));
				$json['error']['popup'] = "add NEED TO ADD PALLET FIRST!";
			}

		 if (!$json['error']['popup']){
              $total_quantity_of_this_product  = $this->model_pallet_worksheet->getWorksheetProductQty($worksheet_id, $product_id);
              $discount = $this->model_catalog_product->getProductDiscount($product_id,$total_quantity_of_this_product);
              if($discount['price'] !== null) {
                              $product_info['price'] = $discount['price'];
                              $product_info['sp_price'] = $discount['sp_price'];
                }
               $this->model_pallet_worksheet->updateProductPrice($worksheet_id,$product_info, $customer_id);

            }

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));

		} else {
			$this->log->write("Customer not logged in");
			$json['error']['popup'] = sprintf($this->language->get('error_login_required'), $this->url->link('account/login'));

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
	}

	public function update() {
		$this->load->language('pallet/worksheet');

		$json = array();

		$this->log->write($this->request->post);


		// Update
		if (isset($this->request->post['pallet_id']) && isset($this->request->post['product_id'])) {
			$this->load->model('pallet/worksheet');

             $customer_id = $this->customer->isLogged();
		     $worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);

			if($this->model_pallet_worksheet->isPalletLocked($this->request->post['pallet_id'])) {
				$this->session->data['error'] = $this->language->get('error_pallet_locked');
			} else {
                 $pallets_quantity = 0;
                 $pallets = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

                 foreach($pallets as $pallet){
                       $pallets_quantity += (int)$this->model_pallet_worksheet->getProductQty($pallet, $this->request->post['product_id'] );
                  }
              $quantity =  $this->request->post['quantity'];
              $product_id= $this->request->post['product_id'];

              	$currentProductsCount = $this->model_pallet_worksheet->hasProducts($this->request->post['pallet_id']);
								$palletSize = $this->model_pallet_worksheet->getPalletSize($this->request->post['pallet_id']);
				$currentProductQty = $this->model_pallet_worksheet->getProductQty($this->request->post['pallet_id'], $this->request->post['product_id']);
				$woCount = $currentProductsCount - $currentProductQty;

				$this->load->model('catalog/product');
				$product_info = $this->model_catalog_product->getProduct($this->request->post['product_id']);


                $stock_ok = true;

				if ($pallets_quantity+$quantity >= $product_info['quantity']){
			 		  $quantity_ = $product_info['quantity']-$this->request->post['quantity'];

                      if ($quantity_ < 0 ){
                          $stock_ok = false;
                          $quantity = $product_info['quantity'];
                          $this->session->data['error'] = sprintf($this->language->get('error_pallet_stock'), $product_info['name'],$product_info['quantity']);

                      }

				}

				if (($woCount + $quantity  <= $palletSize) && $stock_ok) {
					$this->model_pallet_worksheet->updatePallet($this->request->post['pallet_id'], $this->request->post['product_id'], $quantity );
					$this->session->data['success'] = $this->language->get('text_remove');
				} else {
                    if ($stock_ok)
					  $this->session->data['error'] = sprintf($this->language->get('error_pallet_limit'), $palletSize);
				}
			}
			//$this->response->redirect($this->url->link('pallet/worksheet'));
		}

		//$this->response->redirect($this->url->link('pallet/worksheet'));

        if (!$this->session->data['error']){
              $total_quantity_of_this_product  = $this->model_pallet_worksheet->getWorksheetProductQty($worksheet_id, $product_id);
              $discount = $this->model_catalog_product->getProductDiscount($product_id,$total_quantity_of_this_product);
              if($discount['price'] !== null) {
                              $product_info['price'] = $discount['price'];
                              $product_info['sp_price'] = $discount['sp_price'];
                }

                $this->model_pallet_worksheet->updateProductPrice($worksheet_id,$product_info, $customer_id);

        }
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function edit() {
		$this->load->language('pallet/worksheet');

		$json = array();

		$this->log->write($this->request->post);

		// Update
		if (isset($this->request->post['pallet_id']) && isset($this->request->post['product_id'])) {
			$this->load->model('pallet/worksheet');

			if($this->model_pallet_worksheet->isPalletLocked($this->request->post['pallet_id'])) {
				$this->session->data['error'] = $this->language->get('error_pallet_locked');
			} else {
				$currentProductsCount = $this->model_pallet_worksheet->hasProducts($this->request->post['pallet_id']);
				$palletSize = $this->model_pallet_worksheet->getPalletSize($pallet_id);
				$currentProductQty = $this->model_pallet_worksheet->getProductQty($this->request->post['pallet_id'], $this->request->post['product_id']);
				$woCount = $currentProductsCount - $currentProductQty;
				if ($woCount + $this->request->post['quantity'] <= $palletSize) {
					$this->model_pallet_worksheet->updatePallet($this->request->post['pallet_id'], $this->request->post['product_id'], $this->request->post['quantity']);
					$this->session->data['success'] = $this->language->get('text_remove');
				} else {
					$this->session->data['error'] = sprintf($this->language->get('error_pallet_limit'), $palletSize);
				}
			}
			//$this->response->redirect($this->url->link('pallet/worksheet'));
		}

		$this->response->redirect($this->url->link('pallet/worksheet'));
	}

	public function remove() {
		$this->load->language('pallet/worksheet');

		$json = array();

		$this->log->write($this->request->post);

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

	public function addpallet() {
		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		$customer_id = $this->customer->isLogged();
		$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);
		$pallets = $this->model_pallet_worksheet->hasPallets($worksheet_id);
		if($pallets < $this->config->get('pallets_limit_c')) {
			/////////////////////Need to post pallet_size (modal is the new pallet_size) here----------------------------------
			$this->model_pallet_worksheet->addPallet($worksheet_id, $customer_id, $this->request->post['modal']);
			if($this->request->post['modal'] > 0) {
				$json['success'] = sprintf($this->language->get('text_add_pallet'), $this->request->post['modal']);
			}
		} else {
			if($this->request->post['modal'] > 0) {
				$json['error']['popup'] = sprintf($this->language->get('error_container_limit'), $this->config->get('pallets_limit_c'));
			} else {
				$this->session->data['error'] = sprintf($this->language->get('error_container_limit'), $this->config->get('pallets_limit_c'));
			}
		}
		$json['palletnumber'] = 0;
		$pallets = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);
		if(isset($pallets)) {
			$json['palletnumber'] = count($pallets);
		} else {
			$json['palletnumber'] = 0;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function newpallet() {
		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		$customer_id = $this->customer->isLogged();
		$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);
		$pallets = $this->model_pallet_worksheet->hasPallets($worksheet_id);
		if($pallets < $this->config->get('pallets_limit_c')) {
			$this->model_pallet_worksheet->lockAllPallets($worksheet_id, $customer_id);
			if($this->request->post['modal'] > 0) {
				$json['success'] = $this->language->get('text_new_pallet');
			} else {
				$this->session->data['success'] = $this->language->get('text_new_pallet');
			}
		} else {
			if($this->request->post['modal'] > 0) {
				$json['error']['popup'] = sprintf($this->language->get('error_container_limit'), $this->config->get('pallets_limit_c'));
			} else {
				$this->session->data['error'] = sprintf($this->language->get('error_container_limit'), $this->config->get('pallets_limit_c'));
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

	public function getVendorInPallet($vendor_id) {
		$customer_id = $this->customer->isLogged();

		if(isset($customer_id)) {
			$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);
			$pallet_id = $this->model_pallet_worksheet->getPallet($worksheet_id, $customer_id);

			if(isset($pallet_id)) {
				$result = array();

				$result = $this->model_pallet_worksheet->getBoxesPerVendor($pallet_id, $vendor_id);
				$limit_t = $this->config->get('pallets_limit_t');

				if(isset($result['qty'])) {
					$this->load->language('pallet/worksheet');

					if($result['qty'] < $limit_t) {
						$result['vendorLimitNotMet'] = 1;
					} else {
						$result['vendorLimitNotMet'] = "";
					}

					$result['qty'] = sprintf($this->language->get('text_vendor_in_pallet'), $result['qty']);
					return $result;
				}
			}
		}
	}

	public function palletstatus() {
		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		$customer_id = $this->customer->isLogged();

		if(isset($customer_id)) {

			$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);
			$pallet_id = $this->model_pallet_worksheet->getPallet($worksheet_id, $customer_id);
			$this->language->load('pallet/worksheet');


			if(isset($pallet_id) && !$this->model_pallet_worksheet->isPalletLocked($pallet_id)) {
				$pallet_size = $this->model_pallet_worksheet->getPalletSize($pallet_id);

				if($this->model_pallet_worksheet->hasProducts($pallet_id)) {
					// Update Totals
					$this->model_pallet_worksheet->updateTotals($pallet_id);

					$products = $this->model_pallet_worksheet->getProducts($pallet_id);
					$this->load->model('catalog/product');


					if(isset($products)) {
						foreach ($products as $product) {
                             $total_quantity_of_this_product  = $this->model_pallet_worksheet->getWorksheetProductQty($worksheet_id, $product['product_id']);
                             $discount = $this->model_catalog_product->getProductDiscount($product['product_id'],$total_quantity_of_this_product);
                             $label = '';
                             if($discount['price'] !== null) {
                                              $product_info['price'] = $discount['price'];
                                              $product_info['sp_price'] = $discount['sp_price'];
                                              $label =  $this->language->get('label_discount');
																							$label = '<span class="discount_label">'.$label.'</span>';
                             }

						    //zighia
							$fob_data = $this->model_catalog_product->getFOBProductData($product['product_id']);
							$product['bottles'] = $product['quantity'] * $fob_data['pf'];
                        	//zighia

              $price =  $this->currency->format($product['price']);
							$total =   $this->currency->format($product['total']);
							$price_per_bottle = $this->currency->format($fob_data['price'] / $fob_data['pf']);


                        if ($product['price'] != $fob_data['price']){
                                if (strlen($label) == 0)
                                          $label =  $this->language->get('label_special');
																					$label = '<span class="promo_label">'.$label.'</span>';
                                $price  =  '<del>'.$this->currency->format($fob_data['price']).'</del><br />
                                <span class="discounted_price">'.$this->currency->format($product['price']).'</span>';
								$total  =  '<del>'.$this->currency->format($fob_data['price']*$product['quantity']).'</del><br />
                                           <span class="discounted_price">'.$this->currency->format($product['price']*$product['quantity']).'</span>';
								$price_per_bottle = '<del>'.$this->currency->format($fob_data['price'] / $fob_data['pf']).'</del><br />'.$label.'<span class="discounted_price">'.$this->currency->format($product['price'] / $fob_data['pf']).'</span>';

						}



					 		// Get vendors
							$vendors = array();
							$product['vendor'] = $this->model_pallet_worksheet->getVendor($product['product_id']);
							$product['vendor_name'] = $this->model_pallet_worksheet->getVendorName($product['product_id']);

							if($vendorLimit = $this->model_pallet_worksheet->getBoxesPerVendor($pallet_id, $product['vendor'])) {
								$limit_t = $this->config->get('pallets_limit_t');

								if($vendorLimit['qty'] < $limit_t) {
									$product['vendor_limit'] = sprintf($this->language->get('error_vendor_triangle'), $limit_t);
									$vendorLimitNotMet = 1;
								} else {
									$product['vendor_limit'] = '';
								}
							}



							$palletId['products'][] = array(
								'id'				=> $product['product_id'],
								'vendor'    => $product['vendor_name'],
								'vendor_limit' => $product['vendor_limit'],
								'name'      => $product['name'],
								'model'     => $product['model'],
								'quantity'  => $product['quantity'],
								'price_per_bottle'     => $price_per_bottle,
								'price'     => $price,
								'total'     => $total,
								'href'      => $this->url->link('product/product', 'product_id=' . $product['product_id'])
							);
						}

						/*$currentProductsCount = $this->model_pallet_worksheet->hasProducts($pallet_id);
						$palletId['progress']['limit'] = $this->config->get('pallets_limit_p');
						$palletId['space']['current'] = $currentProductsCount;
						$palletId['progress']['current'] = 100*$currentProductsCount/$this->config->get('pallets_limit_p');
						if($currentProductsCount < $this->config->get('pallets_limit_p')) {
							$palletId['progress']['left'] = $this->config->get('pallets_limit_p') - $currentProductsCount;
						}*/

						$currentProductsCount = $this->model_pallet_worksheet->hasProducts($pallet_id);
						$palletSize = $this->model_pallet_worksheet->getPalletSize($pallet_id);
						$palletId['progress']['limit'] = $palletSize;
						$palletId['space']['current'] = $currentProductsCount;
						$palletId['progress']['current'] = 100*$currentProductsCount/$palletSize;
						if($currentProductsCount < $palletSize) {
							$palletId['space']['left'] = $palletSize - $currentProductsCount;
							$palletId['progress']['left'] = 100*$palletId['space']['left']/$palletSize;
							$palletId['text_space_left'] = $this->language->get('text_space_left');
							$palletFullNotMet = 1;
						} else if($currentProductsCount == $palletSize && isset($vendorLimitNotMet)) {
							$palletFullNotMet = 1;
						}

						// Validity Check
						if(!isset($vendorLimitNotMet) AND !isset($palletFullNotMet)) {
							$palletId['valid'] = 1;
						} else {
							$palletId['valid'] = '';
						}

						$pallet_total_value = $this->model_pallet_worksheet->getTotals($pallet_id);

						$palletId['totals'] = array(
							'title' => $this->language->get('text_pallet_total'),
							'text'  => $this->currency->format($pallet_total_value)
						);


						$json = $palletId;

						$this->log->write($json);

						$json['success'] = 1;
					}
					$pallets = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);
					if(isset($pallets)) {
						$json['palletnumber'] = count($pallets);
					} else {
						$json['palletnumber'] = 0;
					}
					$wtotal = $this->model_pallet_worksheet->getWorksheetTotals($worksheet_id);

					if($shipping = $this->model_pallet_worksheet->getShipping($worksheet_id)) {
						$shipping_data = 0;

						foreach ($shipping as $shipping_pallet) {
							$shipping_data += $this->config->get("pallets_shipping_x" . $shipping_pallet['pallet_qty'] . "_" . $shipping_pallet['pallet_size']);
						}

						/*$shipping_data = $this->config->get("pallets_shipping_x" . $shipping);*/
					}

					if($wtotal > 0) {
						$grand_total = $wtotal + $shipping_data;
					} else {
						$grand_total = 0;
					}

					$json['grandtotal'] = $this->currency->format($grand_total);
					$json['grandtotaltitle'] = $this->language->get('column_total');
					/*$status = $this->model_pallet_worksheet->getPalletStatusData($pallet_id, $customer_id);

					if(isset($status)) {
						$json['sellers'] = $status['vendors']."/".$this->config->get('pallets_limit_v');
						$json['cases'] = $status['qty']."/".$this->config->get('pallets_limit_p');
						$json['bottles'] = $status['qty'] * 6;
						$json['total'] = $this->currency->format($status['total'],'','',true);
						$json['success'] = 1;
						//$this->session->data['success'] = $this->language->get('text_remove');
					}*/
				} else {

					$pallets = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);
					if(isset($pallets)) {
						$json['palletnumber'] = count($pallets);
					} else {
						$json['palletnumber'] = 0;
					}
					$json['success'] = 1;
				}

				$json['pallet_size'] = $pallet_size;
				$json['text_pallet_size'] = $this->language->get('text_pallet_size_modal');
			} else {
				//$json['error']['popup'] = sprintf($this->language->get('error_pallets_locked'), $this->url->link('pallet/worksheet'));
				$json['pallet_sizes'] = explode(",", $this->config->get('pallets_limit_p'));
				$json['text_pallet_size'] = $this->language->get('text_pallet_sizes_modal');
				$json['success'] = 1;
			}
		} else {
			$json['grandtotal'] = 0;
			$json['grandtotaltitle'] = $this->language->get('column_total');

			$json['error']['popup'] = sprintf($this->language->get('error_login_required'), $this->url->link('account/login'));
		}

		//$json = array('sellers' => '1/3', 'cases' => '30/100', 'bottles' => '333', 'price' => '333.00');

		$this->log->write($json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function checkvalid() {
		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		$customer_id = $this->customer->isLogged();

		if(isset($customer_id)) {
			$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);

			if ($this->model_pallet_worksheet->hasPallets($worksheet_id)) {

				// Get Pallets that are in the current Worksheet
				$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

				$validator = '0';

				for($p = 0; $p < count($palletIds); $p++) {
					$pallet_id = $palletIds[$p];
					unset($vendorLimitNotMet);
					unset($palletFullNotMet);

					$palletId = $this->model_pallet_worksheet->getPalletData($pallet_id);
					$products = $this->model_pallet_worksheet->getProducts($pallet_id);

					if(isset($products)) {
						foreach ($products as $product) {

							// Get vendors
							$vendors = array();
							$product['vendor'] = $this->model_pallet_worksheet->getVendor($product['product_id']);

							if($vendorLimit = $this->model_pallet_worksheet->getBoxesPerVendor($pallet_id, $product['vendor'])) {
								$limit_t = $this->config->get('pallets_limit_t');

								if($vendorLimit['qty'] < $limit_t) {
									$vendorLimitNotMet = 1;
								}
							}
						}
					}

					$currentProductsCount = $this->model_pallet_worksheet->hasProducts($pallet_id);
					$palletSize = $this->model_pallet_worksheet->getPalletSize($pallet_id);
					if($currentProductsCount < $palletSize) {
						$palletFullNotMet = 1;
					} else if($currentProductsCount == $palletSize && isset($vendorLimitNotMet)) {
						$palletFullNotMet = 1;
					}

					if(!isset($vendorLimitNotMet) AND !isset($palletFullNotMet)) {
						$validator++;
					}
				}
			}

			if(count($palletIds) == $validator) {
				$json['count'] = count($palletIds);
				$json['validator'] = $validator;
				$data['all_pallets_valid'] = 1;
				$json['valid'] = 1;
				$json['success'] = $this->language->get('text_all_pallet_valid_modal');
				$json['create_pallet'] = $this->language->get('button_create_pallet_modal');
				$json['proceed_checkout'] = $this->language->get('button_proceed_checkout_modal');
			} else {
				$data['all_pallets_valid'] = '';
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function palletstatusdd() {
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

	public function destroypallet() {
		$json = array();

		$this->load->language('pallet/worksheet');

		$this->load->model('pallet/worksheet');

		$customer_id = $this->customer->isLogged();

		if(isset($this->request->post['pallet_id']) && isset($customer_id)) {
			$this->model_pallet_worksheet->destroyPallet($this->request->post['pallet_id'], $customer_id);
			$this->session->data['success'] = $this->language->get('text_remove');
		} else {
			$this->session->data['error'] = $this->language->get('error_action_failed');
		}

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

		$data['text_preorder_info'] = sprintf($this->language->get('text_preorder_info'), $this->model_pallet_worksheet->getCustomerName($customer_id));
		$data['text_preorder_total'] = $this->language->get('text_preorder_total');
		$data['text_modify'] = $this->language->get('text_modify');
		$data['text_validate'] = $this->language->get('text_validate');

		$data['column_vendor'] = $this->language->get('column_vendor');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_bottles'] = $this->language->get('column_bottles');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_price_per_bottle'] = $this->language->get('column_price_per_bottle');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_pallet_total'] = $this->language->get('column_pallet_total');

		$data['button_update'] = $this->language->get('button_update');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_shopping'] = $this->language->get('button_shopping');
		$data['button_checkout'] = $this->language->get('button_checkout');


		// Get Pallets that are in the current Worksheet
		$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

		$this->log->write($palletIds);

		$data['products'] = array();
		$products = array();

		$this->load->model('catalog/product');
		for($p = 0; $p < count($palletIds); $p++) {
			$pallet_id = $palletIds[$p];

			// Update Totals
			$this->model_pallet_worksheet->updateTotals($pallet_id);

			$palletId = $this->model_pallet_worksheet->getPalletData($pallet_id);
			$products = $this->model_pallet_worksheet->getProducts($pallet_id);

			$nr = $p + 1;
			$palletId['nr'] = 'Pallet #'.$nr;

			if(isset($products)) {
				foreach ($products as $product) {
					$data['thumb'] = array();

					// Get vendors
					$vendors = array();
					$product['vendor'] = $this->model_pallet_worksheet->getVendor($product['product_id']);
					$product['vendor_name'] = $this->model_pallet_worksheet->getVendorName($product['product_id']);

					if($vendorLimit = $this->model_pallet_worksheet->getBoxesPerVendor($pallet_id, $product['vendor'])) {
						$limit_t = $this->config->get('pallets_limit_t');

						if($vendorLimit['qty'] < $limit_t) {
							$product['vendor_limit'] = $vendorLimit['qty'].' / '.$limit_t;
							$vendorLimitNotMet = 1;
						} else {
							$product['vendor_limit'] = '';
						}
					}


                     $total_quantity_of_this_product  = $this->model_pallet_worksheet->getWorksheetProductQty($worksheet_id, $product['product_id']);
                         $discount = $this->model_catalog_product->getProductDiscount($product['product_id'],$total_quantity_of_this_product);
                         $label = '';
                         if($discount['price'] !== null) {
                                          $product_info['price'] = $discount['price'];
                                          $product_info['sp_price'] = $discount['sp_price'];
                                          $label = $this->language->get('label_discount');
																					$label = '<span class="discount_label">'.$label.'</span>';
                         }

                        $this->model_pallet_worksheet->updateProductPrice($worksheet_id,$product_info, $customer_id);

                        $price =  $this->currency->format($product['price']);
						$total =   $this->currency->format($product['total']);

                         //zighia
						$fob_data = $this->model_catalog_product->getFOBProductData($product['product_id']);
						$product['bottles'] = $product['quantity'] * $fob_data['pf'];
                        //zighia

                        if ($product['price'] != $fob_data['price']){
                                if (strlen($label) == 0)
                                          $label = $this->language->get('label_special');
																					$label = '<span class="promo_label">'.$label.'</span>';
                                $price  =  '<del>'.$this->currency->format($fob_data['price']).'</del><br />
                                <span class="discounted_price">'.$this->currency->format($product['price']).'</span>';
								$total  =  '<del>'.$this->currency->format($fob_data['price']*$product['quantity']).'</del><br /><span class="discounted_price">'.$this->currency->format($product['price']*$product['quantity']).'</span>';
								$price_per_bottle = '<del>'.$this->currency->format($fob_data['price'] / $fob_data['pf']).'</del><br />'.$label.'<span class="discounted_price">'.$this->currency->format($product['price'] / $fob_data['pf']).'</span>';
						} else {
							$price_per_bottle = $this->currency->format($fob_data['price'] / $fob_data['pf']);
						}


					$palletId['products'][] = array(
						'pallet_id' => $product['pallet_id'],
						'id'				=> $product['product_id'],
						'vendor'    => $product['vendor_name'],
						'name'      => $product['name'],
						'model'     => $product['sku'],
						'quantity'  => $product['quantity'],
						'price_per_bottle'     => $price_per_bottle,
						'price'     => $price,
						'total'     => $total
					);
				}
			} else {
				$palletId['products'][] = array();
			}

			// Pallet Totals
			$pallet_total_value = $this->model_pallet_worksheet->getTotals($pallet_id);

			$this->log->write("pallet-total");
			$this->log->write($pallet_total_value);

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


        //Coupon
		if ($this->config->get('coupon_status')) {
					$this->load->model('total/coupon');
					$this->model_total_coupon->getWTotal($total_data, $wtotal, $taxes, $worksheet_id);

		}

		// Shipping
		if($shipping = $this->model_pallet_worksheet->getShipping($worksheet_id)) {
			$data['shipping']['price'] = '';
			$shipping_data['value'] = 0;
			$shipping_text = '';

			foreach ($shipping as $shipping_pallet) {
				$shipping_data['value'] += $this->config->get("pallets_shipping_x" . $shipping_pallet['pallet_qty'] . "_" . $shipping_pallet['pallet_size']);
				$shipping_text .= $shipping_pallet['pallet_qty'] . "x" . $shipping_pallet['pallet_size'] . " ";
			}

			$data['shipping']['price'] = $this->currency->format($shipping_data['value']);
			$data['shipping']['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping_text);
			$shipping_data['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping_text);
			$total_data[] = $shipping_data;

			/*$data['shipping']['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping);
			$data['shipping']['price'] = $this->currency->format($shipping * $this->config->get("pallets_shipping_x".$shipping));
			$shipping_data['title'] = sprintf($this->language->get('text_worksheet_shipping'), $shipping);
			$shipping_data['value'] = $this->config->get("pallets_shipping_x".$shipping);
			$total_data[] = $shipping_data;*/
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

		$data['totals'][] = array(
					'title'=>'Total HK$',
                    'text' => $this->currency->format($this->currency->convert($worksheet_total, $this->session->data['currency'], 'HKD'),"HKD",1),
					//'text'=>$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert($worksheet_total, $this->session->data['currency'], 'HKD'),0,PHP_ROUND_HALF_UP)
                    );

		$data['worksheet'] = $this->url->link('pallet/worksheet', '', 'SSL');
		$data['validate'] = $this->url->link('pallet/worksheet/validate', '', 'SSL');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		

			/* START */
			$layout_positions = $this->load->controller('common/layout_footer/layoutPositions');

			foreach($layout_positions as $position){
				$data[$position] = $this->load->controller('common/layout_footer/index', $position);
			}
			/* END */
			
			
			
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->load->model('account/order');
		$data['do_review'] = $this->model_account_order->getDoReview($customer_id);
		$data['url_order'] = $this->url->link('account/order', '', 'SSL');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/pallet/proceed.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/pallet/proceed.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/pallet/proceed.tpl', $data));
		}
	}

	public function archive($order_id) {
		$this->load->model('pallet/worksheet');

		if(!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/login'));
		} else {
			$customer_id = $this->customer->isLogged();
		}

		$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);
		$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

		for($p = 0; $p < count($palletIds); $p++) {
			$pallet_id = $palletIds[$p];

			//Th-add, sua loi ko co order trong pallet_product sau khi cancel tu paypal
			/* $this->load->model('checkout/order');
			$order = $this->model_checkout_order->getOrder($order_id);
			$products = $this->model_pallet_worksheet->getOrderProducts($order_id);
			$this->model_pallet_worksheet->addToPalletProducts($pallet_id, $order_id ,$products); */
			//EndTh-add

			//$pallet_no = $this->model_pallet_worksheet->generatePalletNo($order_id, $p, $customer_id);
			$pallet_size = $this->model_pallet_worksheet->getPalletSize($pallet_id);
			$archive_nos = $this->model_pallet_worksheet->generateArchiveNos($order_id, $p, $customer_id, $pallet_size);
			//$this->model_pallet_worksheet->archivePallet($pallet_id, $order_id, $pallet_no);
			$this->model_pallet_worksheet->archivePallet($pallet_id, $order_id, $archive_nos);
		}

		$this->model_pallet_worksheet->archiveWorksheet($order_id, $worksheet_id, $customer_id);
	}

	public function validate() {
		$this->load->model('pallet/worksheet');

		if(!$this->customer->isLogged()) {
			$this->response->redirect($this->url->link('account/login'));
		} else {
			$customer_id = $this->customer->isLogged();
		}

		$this->cart->clear();

		$worksheet_id = $this->model_pallet_worksheet->getWorksheet($customer_id);

		$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id, $customer_id);

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
/*

					$palletId['products'][] = array(
						'pallet_id' => $product['pallet_id'],
						'id'				=> $product['product_id'],
						'vendor'    => $this->language->get('text_vendor').$product['vendor'],
						'name'      => $product['name'],
						'model'     => $product['sku'],
						'quantity'  => $product['quantity'],
						'price'     => $this->currency->format($product['price'],'','',false),
						'total'     => $this->currency->format($product['total'],'','',false)
					);*/
				}
			}
		}
		$this->response->redirect($this->url->link('checkout/checkout'));
	}

	public function getproductname() {
		$json = array();

		$this->load->model('pallet/worksheet');
		$json = $this->model_pallet_worksheet->getProductNameById($this->request->post['product_id']);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

    protected function validateCoupon(&$data, $worksheet_id) {
		$this->load->model('checkout/coupon');

		$coupon_info = $this->model_checkout_coupon->getWCoupon($this->request->post['coupon'], $worksheet_id);

		if ($coupon_info === null){
		   $data = $this->language->get('error_coupon');
		   return false;
		}

		return true;

	}

}
