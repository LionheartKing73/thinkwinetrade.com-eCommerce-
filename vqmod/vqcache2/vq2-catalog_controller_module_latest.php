<?php
class ControllerModuleLatest extends Controller {
	public function index($setting) {
		$this->load->language('module/latest');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');
$data['text_bottle'] = $this->language->get('text_bottle');
      $data['text_percases'] = $this->language->get('text_percases');
	  

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

$this->load->model('pallet/worksheet');
      

		if ($results) {
			foreach ($results as $resultd) {
				if ($resultd['image']) {
					$image = $this->model_tool_image->resize($resultd['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				 $special_by_bottle = false;
      			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($resultd['price'], $resultd['tax_class_id'], $this->config->get('config_tax')));
					//$price_cbr = $this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert($resultd['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
      		   
				   if (count($resultd['special'])){
	                    $price_cbr = '<del>'.$this->currency->getSymbolLeft('HKD').round($this->currency->convert($resultd['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</del><br/><span class="hk-box-span">'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert(isset($resultd['special'])?$resultd['special']/$resultd['pf']:$resultd['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</span>';
                        $price_cbr_all = '<del>'.$this->currency->getSymbolLeft('HKD').round($this->currency->convert($resultd['sp_price']*$resultd['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</del><br/><span class="hk-box-span">'.$this->currency->getSymbolLeft('HKD').' '.round($this->currency->convert(isset($resultd['special'])?$resultd['special']:$resultd['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP).'</span>';
						//$special_by_bottle =  $this->currency->format($this->tax->calculate($resultd['special']/$resultd['pf'], $resultd['tax_class_id'], $this->config->get('config_tax')));
                        $special_by_bottle =  $this->currency->getSymbolLeft('HKD').round($this->currency->convert($resultd['special']/$resultd['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
				   }
				   else{
				   		 $price_cbr = $this->currency->getSymbolLeft('HKD').round($this->currency->convert($resultd['sp_price'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                         $price_cbr_all = $this->currency->getSymbolLeft('HKD').round($this->currency->convert($resultd['sp_price']*$resultd['pf'], 'EUR', 'HKD'),0,PHP_ROUND_HALF_UP);
                   }
                    
				} else {
					$price = false;
					$price_cbr = 0;
				}

				if ((float)$resultd['special']) {
					$special = $this->currency->format($this->tax->calculate($resultd['special'], $resultd['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$resultd['special'] ? $resultd['special'] : $resultd['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $resultd['rating'];
				} else {
					$rating = false;
				}

				if ($resultd['quantity'] <= 0) {
					$stock = $resultd['stock_status'];
				} elseif ($this->config->get('config_stock_display')) {
					$stock = $resultd['quantity'];
				} else {
					$stock = $this->language->get('text_instock');
				}	
				
                $vintage = $this->model_catalog_product->getVintage($resultd['product_id']);
                $appellation = $this->model_catalog_product->getAppellation($resultd['product_id']);
                
                $a['attribute_groups'] = $this->model_catalog_product->getProductAttributes($resultd['product_id']);
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
                $a['awards'] = $this->model_module_ratings->getAwards($resultd['product_id']);   
                

	   $this->load->model('pallet/worksheet');
     $vendor = $this->model_pallet_worksheet->getVendorName($resultd['product_id']);

      $vendor_id = $this->model_pallet_worksheet->getVendor($resultd['product_id']);
        $qry="SELECT * FROM  " . DB_PREFIX . "vendors WHERE " . DB_PREFIX . "vendors.vendor_id  = '" . (int)$this->db->escape($vendor_id) . "'";
        $query = $this->db->query($qry);
          $this->load->model('tool/image');
          if(isset($query->row['vendor_image'])){
			if (is_file(DIR_IMAGE . $query->row['vendor_image'])){
				$image_vendor = $this->model_tool_image->resize($query->row['vendor_image'], 45, 45);
			}else{
               $image_vendor = $this->model_tool_image->resize('no_image.png', 45, 45);
			}
	      }			
      //$data['vendor_in_pallet'] = $this->controller_pallet_worksheet->getVendorInPallet($vendor_id);
      $vendor_in_pallet = $this->load->controller('pallet/worksheet/getVendorInPallet', $vendor_id);
       $vendor_rating = $this->model_pallet_worksheet->getTotalRatingsVendorsByVendorId($vendor_id);
      

$vendor = $this->model_pallet_worksheet->getVendorName($result['product_id']);
      
				$data['products'][] = array(
                                        'bio'         => $a['bio'],
                                        'oak'         => $a['oak'],
                                        'award'       => !empty($a['awards'][0])?$a['awards'][0]:"",

'vendor'      => $vendor,
      

'image_vendor'      => $image_vendor,
'vendor_in_pallet'      => $vendor_in_pallet,
'vendor_id' => $vendor_id,
'vendor_rating'      => $vendor_rating,
      
					'product_id'  => $resultd['product_id'],
					'thumb'       => $image,
                    'vintage'     => ($vintage==null)?'':$vintage,
                    'appellation' => ($appellation==null)?'':$appellation,
					'name'        => $resultd['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($resultd['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
'sp_price'    => $sp_price,
          'pf'          => $pf,
					'price'       => $price,
					'price_cbr'   => $price_cbr,
                    'price_cbr_all'   => $price_cbr_all,					
					'special'     => $special,
					'special_by_bottle'  => $special_by_bottle, //zighia
					'stock'				=> $stock, //zighia
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $resultd['product_id']),
				);
			}

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/latest.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/latest.tpl', $data);
			} else {
				return $this->load->view('default/template/module/latest.tpl', $data);
			}
		}
	}
}