<?php
class ControllerModuleLatest extends Controller {
	public function index($setting) {
		$this->load->language('module/latest');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
        $data['text_stock_display'] = $this->language->get('text_stock_display');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		$filter_data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProducts($filter_data);

		if ($results) {
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				 $special_by_bottle = false;
      			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					//$price_cbr = $this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert($result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
      		   
				   if (count($result['special'])){
	                    $price_cbr = '<del>'.$this->currency->getSymbolLeft('HKD').round($this->currency->convert($result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</del><br/><span class="hk-box-span">'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert(isset($result['special'])?$result['special']/$result['pf']:$result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</span>';
                        $price_cbr_all = '<del>'.$this->currency->getSymbolLeft('HKD').round($this->currency->convert($result['sp_price']*$result['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</del><br/><span class="hk-box-span">'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert(isset($result['special'])?$result['special']:$result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</span>';
						//$special_by_bottle =  $this->currency->format($this->tax->calculate($result['special']/$result['pf'], $result['tax_class_id'], $this->config->get('config_tax')));
                        $special_by_bottle =  $this->currency->getSymbolLeft('HKD').round($this->currency->convert($result['special']/$result['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
				   }
				   else{
				   		 $price_cbr = $this->currency->getSymbolLeft('HKD').round($this->currency->convert($result['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                         $price_cbr_all = $this->currency->getSymbolLeft('HKD').round($this->currency->convert($result['sp_price']*$result['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                   }
                    
				} else {
					$price = false;
					$price_cbr = 0;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
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
				
                $vintage = $this->model_catalog_product->getVintage($result['product_id']);
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
                $h = !special;
            	
            	//if(!$special && $result['fakeprice'] > 0) $special = $price;
            	//if($result['fakeprice'] > 0) $price = $this->currency->format((float)$price * (float)$result['fakeprice'] / (100 - (float)$result['fakeprice']) + (//float)$price);
				if(!$special && $result['fakeprice'] > 0){
					$special = $price;
					$price = $this->currency->format((float)$price * (float)$result['fakeprice'] / (100 - (float)$result['fakeprice']) + (float)$price);
					$special_by_bottle =  $this->currency->format($this->tax->calculate($special/$result['pf'], $result['tax_class_id'], $this->config->get('config_tax')));
				
				} 
				$sp_price =  $this->currency->format($this->tax->calculate($price/$result['pf'], $result['tax_class_id'], $this->config->get('config_tax')));
				$data['products'][] = array(
                                        'bio'         => $a['bio'],
                                        'oak'         => $a['oak'],
                                        'award'       => !empty($a['awards'][0])?$a['awards'][0]:"",
					'product_id'  => $result['product_id'],
                	'pf'  => $result['pf'],
					'thumb'       => $image,
					'fakeprice'      => $result['fakeprice'],	
                    'vintage'     => ($vintage==null)?'':$vintage,
                    'appellation' => ($appellation==null)?'':$appellation,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
					'price'       => $price,
					'price_cbr'   => $price_cbr,
                    'price_cbr_all'   => $price_cbr_all,					
					'special'     => $special,
					'special_by_bottle'  => $special_by_bottle, //zighia
					'stock'				=> $stock, //zighia
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id']),
				);
			}
			foreach($data['products'] as $productrec)
            {
            	$mr['product'] = $productrec;
            	$mr['additionalcurrencies'] = $data['additionalcurrencies'];
            	$mr['currency'] = $this->currency;
            	$mr['selected_additional_currency'] = $data['selected_additional_currency'];
				$data['productshtml'][] = $this->load->view($this->config->get('config_template') . '/template/common/productpart.tpl', $mr);
            }
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/latest.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/latest.tpl', $data);
			} else {
				return $this->load->view('default/template/module/latest.tpl', $data);
			}
		}
	}
}