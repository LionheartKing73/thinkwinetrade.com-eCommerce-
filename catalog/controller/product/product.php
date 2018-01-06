<?php
class ControllerProductProduct extends Controller {
	private $error = array();

	public function index() {

		if(!$this->customer->isLogged()) {
			$this->session->data['not_logged_redirect'] = "1";
			$this->response->redirect($this->url->link('common/home'));
		}

		$this->load->language('product/product');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$this->load->model('catalog/category');

		if (isset($this->request->get['path'])) {
			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path)
					);
				}
			}

			// Set the last category breadcrumb
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['breadcrumbs'][] = array(
					'text' => $category_info['name'],
					'href' => $this->url->link('product/category', 'path=' . $this->request->get['path'] . $url)
				);
			}
		}

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->get['manufacturer_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_brand'),
				'href' => $this->url->link('product/manufacturer')
			);

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {
				$data['breadcrumbs'][] = array(
					'text' => $manufacturer_info['name'],
					'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)
				);
			}
		}

		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_search'),
				'href' => $this->url->link('product/search', $url)
			);
		}

		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $product_info['name'],
				'href' => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id'])
			);

			$this->document->setTitle($product_info['meta_title']);
			$this->document->setDescription($product_info['meta_description']);
			$this->document->setKeywords($product_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');
			$this->document->addScript('catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/magnific/magnific-popup.css');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
			$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

			$data['heading_title'] = $product_info['name'];

			$data['text_select'] = $this->language->get('text_select');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_model'] = $this->language->get('text_model');
			$data['text_reward'] = $this->language->get('text_reward');
			$data['text_points'] = $this->language->get('text_points');
			$data['text_stock'] = $this->language->get('text_stock');
			$data['text_discount'] = $this->language->get('text_discount');
			$data['text_tax'] = $this->language->get('text_tax');
			$data['text_option'] = $this->language->get('text_option');
			$data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$data['text_write'] = $this->language->get('text_write');
			$data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
			$data['text_note'] = $this->language->get('text_note');
			$data['text_tags'] = $this->language->get('text_tags');
			$data['text_related'] = $this->language->get('text_related');
			$data['text_loading'] = $this->language->get('text_loading');

			$data['entry_qty'] = $this->language->get('entry_qty');
			$data['entry_name'] = $this->language->get('entry_name');
			$data['entry_review'] = $this->language->get('entry_review');
			$data['entry_rating'] = $this->language->get('entry_rating');
			$data['entry_good'] = $this->language->get('entry_good');
			$data['entry_bad'] = $this->language->get('entry_bad');

			$data['button_cart'] = $this->language->get('button_cart');
			$data['button_wishlist'] = $this->language->get('button_wishlist');
			$data['button_compare'] = $this->language->get('button_compare');
			$data['button_upload'] = $this->language->get('button_upload');
			$data['button_continue'] = $this->language->get('button_continue');

            $data['text_discount_head1'] = $this->language->get('text_discount_head1');
            $data['text_discount_head2'] = $this->language->get('text_discount_head2');
            $data['text_discount_head3'] = $this->language->get('text_discount_head3');
            $data['text_discount_tab'] = $this->language->get('text_discount_tab');

			$this->load->model('catalog/review');

			$data['tab_description'] = $this->language->get('tab_description');
			$data['tab_vendor'] = $this->language->get('tab_vendor');
			$data['tab_attribute'] = $this->language->get('tab_attribute');
			$data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);

			$data['product_id'] = (int)$this->request->get['product_id'];
			$data['manufacturer'] = $product_info['manufacturer'];
			$data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			$data['model'] = $product_info['model'];
			$data['reward'] = $product_info['reward'];
			$data['points'] = $product_info['points'];

			if ($product_info['quantity'] <= 0) {
				$data['stock'] = $product_info['stock_status'];
			} elseif ($this->config->get('config_stock_display')) {
				$data['stock'] = $product_info['quantity'];
			} else {
				$data['stock'] = $this->language->get('text_instock');
			}

			$this->load->model('tool/image');

			if ($product_info['image']) {
				$data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			} else {
				$data['popup'] = '';
			}

			if ($product_info['image']) {
				$data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			} else {
				$data['thumb'] = '';
			}

			$data['images'] = array();

			
	

			$data['sbrSL'] = $this->currency->getSymbolLeft('HKD');
			$data['cbr_value'] = round($this->currency->getValue('HKD'),2,PHP_ROUND_HALF_UP);
			$data['special_by_bottle'] = false;
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$data['price'] = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				$data['price_cbr'] = $data['sbrSL'].' '.round($this->currency->convert($product_info['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);


			} else {
				$data['price'] = false;
				$data['price_cbr'] = 0;
			}

            $data['price_cbr_special'] = false;
			if ((float)$product_info['special']) {
				$data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                $data['price_cbr_special'] = $data['sbrSL'].' '.round($this->currency->convert($product_info['special']/$product_info['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                $data['special_by_bottle'] =  $this->currency->format($this->tax->calculate($product_info['special']/$product_info['pf'], $product_info['tax_class_id'], $this->config->get('config_tax')));
				$special_range = $this->model_catalog_product->getSpecialRange($product_info['product_id']);
				if ($special_range !== false){

					 if($special_range['date_start'] != '0000-00-00' &&  $special_range['date_end'] != '0000-00-00'){
                         $percent = 100-($product_info['special']*100)/$product_info['price'];
                         $date_start = DateTime::createFromFormat('Y-m-j', $special_range['date_start']);
                          $date_end = DateTime::createFromFormat('Y-m-j', $special_range['date_end']);
		    			 $data['special_range'] = $this->language->get('text_special_range') .
                                 $date_start->format('d/m/Y').'-'.$date_end->format('d/m/Y').' ~ '.round($percent,0).'%';
                     }

				}

			} else {
				$data['special'] = false;
			}
	 
					 $data['fakeprice'] = 0;
				if(!$data['special'] && $product_info['fakeprice'] > 0) { 
				
					$data['special'] = $data['price'];
					$data['price'] = $this->currency->format((float)$data['price'] * (float)$product_info['fakeprice'] /
										(100 - (float)$product_info['fakeprice']) + (float)$data['price']);
			
					/*$data['sp_price'] = $this->currency->format((float)$data['price'] * (float)$product_info['fakeprice'] /
										(100 - (float)$product_info['fakeprice']) + (float)$data['price']);*/
										
						$data['sp_price'] = 	$this->currency->format($this->tax->calculate($data['price'] /$product_info['pf'],$this->config->get('config_tax')));
			
			$product_info['special'] =$data['special'] ;
			$product_info['sp_price'] =$data['sp_price'] ;

		 
					$data['special_by_bottle'] =  $this->currency->format($this->tax->calculate($data['special']/$product_info['pf'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					
					
					$data['price_cbr_special'] = $data['sbrSL'].' '.round($this->currency->convert( $data['special'] /$product_info['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
					$data['price_cbr_special'] = $data['sbrSL'].' '.round($this->currency->convert($data['price'] /$product_info['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
					$data['price_cbr'] = $data['sbrSL'].' '.round($this->currency->convert($data['price'] /$product_info['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
					
					 
					//price_cbr_special new price per bottle
					//price_cbr regular ppb
					$data['fakeprice'] = $product_info['fakeprice'];
					
					
				}
            
				 
			
			
			$results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

			foreach ($results as $result) {
				$data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
				);
			}		
			
			if ($this->config->get('config_tax')) {
				$data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
			} else {
				$data['tax'] = false;
			}
			
			if ($product_info['custom_css']) {
				$data['custom_css'] = $product_info['custom_css'];
			} else {
				$data['custom_css'] = '';
			}
			 

            $data['discounts'] = array();
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);

			foreach ($discounts as $discount) {

                $output_array = array();
                preg_match("/(\d+).* (\d+)/", $discount['step-text'], $output_array);
                $step_text_bottles = "";

				$data['discounts'][] = array(
					'quantity' => $discount['quantity'],
                    'step-text' => $discount['step-text'],
                    'step_text_bottles' => !isset($output_array[2])?"error":
                                          ($product_info['pf']*$discount['quantity'])."+ ".
                                          ($product_info['pf']*$output_array[2]),
                    'sp_price' => $this->currency->format($this->tax->calculate($discount['sp_price'], $product_info['tax_class_id'], $this->config->get('config_tax'))),
                    'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax'))),
                    'hk_price' => $this->currency->format($discount['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'HKD' ),
                    'hk_price_bottle' => $this->currency->format($discount['sp_price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'HKD' )

				);
			}
        }
			$data['options'] = array();

			foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) {
				$product_option_value_data = array();

				foreach ($option['product_option_value'] as $option_value) {
					if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
						if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
							$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false));
						} else {
							$price = false;
						}

						$product_option_value_data[] = array(
							'product_option_value_id' => $option_value['product_option_value_id'],
							'option_value_id'         => $option_value['option_value_id'],
							'name'                    => $option_value['name'],
							'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
							'price'                   => $price,
							'price_prefix'            => $option_value['price_prefix']
						);
					}
				}

				$data['options'][] = array(
					'product_option_id'    => $option['product_option_id'],
					'product_option_value' => $product_option_value_data,
					'option_id'            => $option['option_id'],
					'name'                 => $option['name'],
					'type'                 => $option['type'],
					'value'                => $option['value'],
					'required'             => $option['required']
				);
			}

			if ($product_info['minimum']) {
				$data['minimum'] = $product_info['minimum'];
			} else {
				$data['minimum'] = 1;
			}

			$data['review_status'] = $this->config->get('config_review_status');

			if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
				$data['review_guest'] = true;
			} else {
				$data['review_guest'] = false;
			}

			if ($this->customer->isLogged()) {
				$data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
			} else {
				$data['customer_name'] = '';
			}

			$data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			$data['rating'] = (int)$product_info['rating'];
			$data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
			$data['vendor_description'] = $this->model_module_d_visual_designer->parseDescriptionHelper($this->model_catalog_product->getVendorDescription($vendor_id));

			$data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
			$data['bio'] = false;
			$data['oak'] = false;
			foreach($data['attribute_groups'] as $attribute){
				if ($attribute['attribute_group_id'] == 8){
					   foreach($attribute['attribute'] as $value){
                                                if ($value['attribute_id'] == 28){
                                                    if (trim(strtolower($value['text'])) == 'yes')
                                                        $data['bio'] =  true;

                                                }
                                                if ($value['attribute_id'] == 27){
                                                    if (trim(strtolower($value['text'])) == 'yes')
                                                        $data['oak'] =  true;

                                                }
					   }
				}
				break;
			}

                        $this->load->model('module/ratings');

			$data['awards'] = $this->model_module_ratings->getAwards($this->request->get['product_id']);

			$data['products'] = array();

			$results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
            $data['text_stock_display'] = $this->language->get('text_stock_display');

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
				}

				$price = false;
				$special_by_bottle = false;
				$price_cbr =  0;
				$price_cbr_all =  0;
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));


				}
				
				if ((float)$result['special']) {
	                     //  $price_cbr = '<del>'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert($result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</del><br /><span class="hk-box-span">'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert(isset($result['special'])?$result['special']/$result['pf']:$result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</span>';
						$special_by_bottle =  $this->currency->format($this->tax->calculate($result['special']/$result['pf'], $result['tax_class_id'], $this->config->get('config_tax')));
                        $price_cbr = '<del >'.$this->currency->getSymbolLeft('HKD').round($this->currency->convert($result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</del><br/><span class="hk-box-span">'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert(isset($result['special'])?$result['special']/$result['pf']:$result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</span>';
                        $price_cbr_all = '<del >'.$this->currency->getSymbolLeft('HKD').round($this->currency->convert($result['sp_price']*$result['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</del><br/><span class="hk-box-span">'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert(isset($result['special'])?$result['special']:$result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</span>';
					}
					else{
				   		 //$price_cbr = $this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert($result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                          $price_cbr = $this->currency->getSymbolLeft('HKD').round($this->currency->convert($result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                          $price_cbr_all = $this->currency->getSymbolLeft('HKD').round($this->currency->convert($result['sp_price']*$result['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                    }

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}
                 if ((float)$result['special']) {
						$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}
					
				
					

				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}
                if ($result['quantity'] <= 0) {
					$stock = $result['stock_status'];
				} elseif ($this->config->get('config_stock_display')) {
					$stock = $result['quantity'];
				} else {
					$stock = $this->language->get('text_instock');
				}
                $appellation = $this->model_catalog_product->getAppellation($result['product_id']);
		$a['attribute_groups'] = $this->model_catalog_product->getProductAttributes($result['product_id']);
                $a['bio'] = false;
                $a['oak'] = false;
                foreach($a['attribute_groups'] as $attribute){
                        if ($attribute['attribute_group_id'] == 8){
                                   foreach($attribute['attribute'] as $value){
                                        if ($value['attribute_id'] == 28){
                                            if (trim(strtolower($value['text'])) == 'yes')
                                                $a['bio'] =  true;

                                        }
                                        if ($value['attribute_id'] == 27){
                                            if (trim(strtolower($value['text'])) == 'yes')
                                                $a['oak'] =  true;

                                        }
                                   }
                        }
                        break;
                }
                $this->load->model('module/ratings');
                $a['awards'] = $this->model_module_ratings->getAwards($result['product_id']);

				 $vendor_idx = $this->model_pallet_worksheet->getVendor($result['product_id']);
        $qryx="SELECT * FROM  " . DB_PREFIX . "vendors WHERE " . DB_PREFIX . "vendors.vendor_id  = '" . (int)$this->db->escape($vendor_idx) . "'";
        $queryx = $this->db->query($qryx);
          $this->load->model('tool/image');
          if(isset($queryx->row['vendor_image'])){
			if (is_file(DIR_IMAGE . $queryx->row['vendor_image'])){
				$image_vendorx = $this->model_tool_image->resize($query->row['vendor_image'], 45, 45);
			}else{
               $image_vendorx = $this->model_tool_image->resize('no_image.png', 45, 45);
			}
	      }
      //$data['vendor_in_pallet'] = $this->controller_pallet_worksheet->getVendorInPallet($vendor_idx);
      $vendor_in_palletx = $this->load->controller('pallet/worksheet/getVendorInPallet', $vendor_idx);
       $vendor_ratingx = $this->model_pallet_worksheet->getTotalRatingsVendorsByVendorId($vendor_idx);

				$data['products'][] = array(
                                        'bio'         => $a['bio'],
                                        'oak'         => $a['oak'],
                                        'award'       => !empty($a['awards'][0])?$a['awards'][0]:"",
                	'pf'  => $result['pf'],
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,

					'image_vendor'      => $image_vendorx,
'vendor_in_pallet'      => $vendor_in_palletx,
'vendor_rating'      => $vendor_ratingx,

					'price_cbr'   => $price_cbr,
                    'price_cbr_all'=> $price_cbr_all,
					'special'     => $special,
					'special_by_bottle'  => $special_by_bottle, //zighia
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id']),
                    'vintage'     => $this->model_catalog_product->getVintage($result['product_id']),
                    'appellation' => ($appellation==null)?'':$appellation,
                    'stock'       => $stock
				);
			}
			$data['productshtml'] = array();
        	$mr = array();
       		$mr['currency'] = $this->currency;
        	foreach($data['products'] as $productrec)
            {
            	$productrec['vendor_id'] = $data['vendor_id'];
            	$mr['product'] = $productrec;
            	$mr['additionalcurrencies'] = $data['additionalcurrencies'];
            	$mr['selected_additional_currency'] = $data['selected_additional_currency'];
				$data['productshtml'][] = $this->load->view($this->config->get('config_template') . '/template/common/productpart.tpl', $mr);
            }
			$data['tags'] = array();

			if ($product_info['tag']) {
				$tags = explode(',', $product_info['tag']);

				foreach ($tags as $tag) {
					$data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}

			$data['text_payment_recurring'] = $this->language->get('text_payment_recurring');
			$data['recurrings'] = $this->model_catalog_product->getProfiles($this->request->get['product_id']);

			$this->model_catalog_product->updateViewed($this->request->get['product_id']);

			if ($this->config->get('config_google_captcha_status')) {
				$this->document->addScript('https://www.google.com/recaptcha/api.js');

				$data['site_key'] = $this->config->get('config_google_captcha_public');
			} else {
				$data['site_key'] = '';
			}

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');
$data['price_bottom'] = $this->load->controller('common/price_bottom');
            $data['text_google'] = $this->language->get('text_google');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/product.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/product/product.tpl', $data));
			}
		} else {
			$url = '';

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}

			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}

			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}

			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/product', $url . '&product_id=' . $product_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

                        $data['price_bottom'] = $this->load->controller('common/price_bottom');




			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function review() {
		$this->load->language('product/product');

		$this->load->model('catalog/review');

		$data['text_no_reviews'] = $this->language->get('text_no_reviews');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['reviews'] = array();

		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);

		$this->load->model('account/customer');

		foreach ($results as $result) {
			$customer_info = $this->model_account_customer->getCustomer($result['customer_id']);
			$addresses = $this->model_account_customer->getAddresses($result['customer_id']);

			$com = $addresses[$result['customer_id']]['company'];
			if($com == ''){$company = '';} else {$company ='( '.$com.')';}

			$data['reviews'][] = array(
				'author'     => $result['author'],
				'company'	=>  $company,
				'text'       => nl2br($result['text']),
				'rating'     => (int)$result['rating'],
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($review_total) ? (($page - 1) * 5) + 1 : 0, ((($page - 1) * 5) > ($review_total - 5)) ? $review_total : ((($page - 1) * 5) + 5), $review_total, ceil($review_total / 5));

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/review.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/review.tpl', $data));
		}
	}

	public function vendordescription()
    {
    	if (isset($this->request->get['product_id'])) {
			$productId = (int)$this->request->get['product_id'];
		} else {
			$productId = 0;
		}
    
   		$this->load->model('catalog/product');
    	$query = $this->db->query("SELECT vnd.vendor_description from " . DB_PREFIX . "vendors vnd INNER JOIN ".DB_PREFIX."vendor v ON v.vendor = vnd.vendor_id
                                   WHERE v.vproduct_id = $productId");
    	//var_dump($this->db); die;
    	$this->load->model('module/d_visual_designer');
    	$parseDescr=$this->model_module_d_visual_designer->parseDescriptionHelper($query->row['vendor_description']);
    	
    	$json = array(
        	'html' =>  html_entity_decode($parseDescr, ENT_QUOTES, 'UTF-8')
        );
    	$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
    }
	public function write() {
		$this->load->language('product/product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error'] = $this->language->get('error_name');
			}

			if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error'] = $this->language->get('error_text');
			}

			if (empty($this->request->post['rating']) || $this->request->post['rating'] < 0 || $this->request->post['rating'] > 5) {
				$json['error'] = $this->language->get('error_rating');
			}

			if ($this->config->get('config_google_captcha_status')) {
				$recaptcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->config->get('config_google_captcha_secret')) . '&response=' . $this->request->post['g-recaptcha-response'] . '&remoteip=' . $this->request->server['REMOTE_ADDR']);

				$recaptcha = json_decode($recaptcha, true);

				if (!$recaptcha['success']) {
					$json['error'] = $this->language->get('error_captcha');
				}
			}

			if (!isset($json['error'])) {
				$this->load->model('catalog/review');

				$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getRecurringDescription() {
		$this->language->load('product/product');
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_id'])) {
			$product_id = $this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		if (isset($this->request->post['recurring_id'])) {
			$recurring_id = $this->request->post['recurring_id'];
		} else {
			$recurring_id = 0;
		}

		if (isset($this->request->post['quantity'])) {
			$quantity = $this->request->post['quantity'];
		} else {
			$quantity = 1;
		}

		$product_info = $this->model_catalog_product->getProduct($product_id);
		$recurring_info = $this->model_catalog_product->getProfile($product_id, $recurring_id);

		$json = array();

		if ($product_info && $recurring_info) {
			if (!$json) {
				$frequencies = array(
					'day'        => $this->language->get('text_day'),
					'week'       => $this->language->get('text_week'),
					'semi_month' => $this->language->get('text_semi_month'),
					'month'      => $this->language->get('text_month'),
					'year'       => $this->language->get('text_year'),
				);

				if ($recurring_info['trial_status'] == 1) {
					$price = $this->currency->format($this->tax->calculate($recurring_info['trial_price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')));
					$trial_text = sprintf($this->language->get('text_trial_description'), $price, $recurring_info['trial_cycle'], $frequencies[$recurring_info['trial_frequency']], $recurring_info['trial_duration']) . ' ';
				} else {
					$trial_text = '';
				}

				$price = $this->currency->format($this->tax->calculate($recurring_info['price'] * $quantity, $product_info['tax_class_id'], $this->config->get('config_tax')));

				if ($recurring_info['duration']) {
					$text = $trial_text . sprintf($this->language->get('text_payment_description'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				} else {
					$text = $trial_text . sprintf($this->language->get('text_payment_cancel'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
				}

				$json['success'] = $text;
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function write_review_rating() {
		$this->load->language('product/product');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {

			foreach($this->request->post['review_product'] as  $_key => $review){


				if (empty($review['rating']) || $review['rating'] < 0 || $review['rating'] > 5) {
					$json['error'] = $this->language->get('error_rating');
				}

				if ((utf8_strlen($review['text']) < 25) || (utf8_strlen($review['text']) > 1000)) {
					$json['error'] = $this->language->get('error_text');
				}
				$order_id = $review['order_id'];
			}

			foreach($this->request->post['rating_vendor'] as  $_key => $rating){
				//var_dump($rating['rating_vendor']);
				if (empty($rating['rating_vendor']) || $rating['rating_vendor'] =='') {
					$json['error'] = $this->language->get('error_rating_vendor');
				}
				//$json['error'] = $rating['rating_vendor'];
			}
			//var_dump($this->request->post['rating_vendor']);

			if (!isset($json['error'])) {
				foreach($this->request->post['review_product'] as  $_key => $review){
					$this->load->model('catalog/review');
					$this->model_catalog_review->addReview($review['product_id'], $review);
				}
				foreach($this->request->post['rating_vendor'] as  $_key => $rating){
					$this->load->model('catalog/rating');
					$this->model_catalog_rating->addRating($rating['vendor_id'], $rating);
				}

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


 /*   //code moved from google map location ocmod file
    public function getLatLang($address, $region){

    $address .=$region;
    $address = str_replace(" ", "+", $address);

    //$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=".$region);
    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");

    $json = json_decode($json, true);
    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

    return $lat.','.$long;
    }*/

}
