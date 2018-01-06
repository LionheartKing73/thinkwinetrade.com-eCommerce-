<?php
class ControllerModuleFeatured extends Controller {
    public static $counter=0;
	public function index($setting) {
		$this->load->language('module/featured');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');
$data['text_bottle'] = $this->language->get('text_bottle');
      $data['text_percases'] = $this->language->get('text_percases');
	  
$data['text_bottle'] = $this->language->get('text_bottle');
      $data['text_percases'] = $this->language->get('text_percases');

		$data['button_cart'] = $this->language->get('button_cart');
        $data['text_stock_display'] = $this->language->get('text_stock_display');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
        $data['counter'] = self::$counter++;

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['product'])) {
			$products = array_slice($setting['product'], 0, (int)$setting['limit']);

			foreach ($products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info) {
					if ($product_info['image']) {
						$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					}
	              
                   $special_by_bottle = false;
				   if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					//$price_cbr = $this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert($product_info['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
				   if ($product_info['special']){
              	        $price_cbr = '<del>'.$this->currency->getSymbolLeft('HKD').round($this->currency->convert($product_info['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</del><br/><span class="hk-box-span">'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert(isset($product_info['special'])?$product_info['special']/$product_info['pf']:$product_info['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</span>';
                        $price_cbr_all = '<del>'.$this->currency->getSymbolLeft('HKD').round($this->currency->convert($product_info['sp_price']*$product_info['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</del><br/><span class="hk-box-span">'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert(isset($product_info['special'])?$product_info['special']:$product_info['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</span>';
						//$special_by_bottle =  $this->currency->format($this->tax->calculate($product_info['special']/$product_info['pf'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                        $special_by_bottle =  $this->currency->getSymbolLeft('HKD').round($this->currency->convert($product_info['special']/$product_info['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);		   }
				   else{
				   	     $price_cbr = $this->currency->getSymbolLeft('HKD').round($this->currency->convert($product_info['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                         $price_cbr_all = $this->currency->getSymbolLeft('HKD').round($this->currency->convert($product_info['sp_price']*$product_info['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                      }
                    
				} else {
					$price = false;
					$price_cbr = 0;
				}
          
					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}
                    
$pf = $product_info['pf'];
        $sp_price = $this->currency->format($this->tax->calculate($product_info['sp_price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                    if ((float)$product_info['special']) {
						$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}

					if ($this->config->get('config_tax')) {
						$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
					} else {
						$tax = false;
					}

					if ($this->config->get('config_review_status')) {
						$rating = $product_info['rating'];
					} else {
						$rating = false;
					}
                   if ($product_info['quantity'] <= 0) {
					    $stock = $product_info['stock_status'];
				    } elseif ($this->config->get('config_stock_display')) {
					    $stock = $product_info['quantity'];
    				} else {
	        				$stock = $this->language->get('text_instock');
			    	}
                    
                    $vintage = $this->model_catalog_product->getVintage($product_info['product_id']);
                    $appellation = $this->model_catalog_product->getAppellation($product_info['product_id']);
                    
                    $a['attribute_groups'] = $this->model_catalog_product->getProductAttributes($product_info['product_id']);
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
                    $a['awards'] = $this->model_module_ratings->getAwards($product_info['product_id']); 


$this->load->model('pallet/worksheet');
$vendor = $this->model_pallet_worksheet->getVendorName($product_id);
      
					$data['products'][] = array(
                                                'bio'         => $a['bio'],
                                                'oak'         => $a['oak'],
                                                'award'       => !empty($a['awards'][0])?$a['awards'][0]:"",

'vendor'      => $vendor,
      
						'product_id'  => $product_info['product_id'],
						'thumb'       => $image,
                        'vintage'     => ($vintage==null)?'':$vintage,
                        'appellation' => ($appellation==null)?'':$appellation,
						'name'        => $product_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
'sp_price'    => $sp_price,
          'pf'          => $pf,
'sp_price'    => $sp_price,
          'pf'          => $pf,
						'price'       => $price,
						'special'     => $special,
                       	'price_cbr'   => $price_cbr,
                        'price_cbr_all'   => $price_cbr_all,					
					    'special_by_bottle'  => $special_by_bottle, //zighia
					    'stock'		=> $stock, //zighia
						'tax'         => $tax,
						'rating'      => $rating,
						'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
					);
				}
			}
		}

		if ($data['products']) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/featured.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/featured.tpl', $data);
			} else {
				return $this->load->view('default/template/module/featured.tpl', $data);
			}
		}
	}
}