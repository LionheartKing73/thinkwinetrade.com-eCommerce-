<?php
class ControllerCommonHeader extends Controller {

				public function gethtml($id,$displaytype,$image,$desc,$message,$bc,$fc,$server = "") {
					
					if($displaytype == 1) {
						$html  = '<div class="messagestrip" id="devpm'.$id.'" style="background:'.$bc.';color:'.$fc.';">'.$message.'<button type="button" class="close" data-dismiss="alert">×</button></div>';
					}
				//	$this->log->write($html);
					return $html;
				}

				public function devpmcookie() {
					$id = $this->request->post['a'];
					setcookie($id,1, time()+(3600*5));
				}
				
	public function index() {
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		if ($this->config->get('config_google_analytics_status')) {
			$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['google_analytics'] = '';
		}
		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}
		$this->load->language('account/rating');
		$data['text_warning'] = $this->language->get('text_warning');
		$data['text_warning_link'] = $this->language->get('text_warning_link');

		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');
		$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		if ($this->customer !== null){
			$data['customer_id_text'] = $this->language->get('text_customer_id').' TWT-'.$this->customer->getId();
		}

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');

		
				$this->load->model('tool/couponpromo');
				$couponpromo = $this->model_tool_couponpromo->getcouponpromos();
				//$this->log->write(print_r($couponpromo,true));
				$htmlpromo = "";
				$this->session->data['promoavailable'] = array();
				foreach ($couponpromo as $key => $value) {

					if($value['displaytype'] != 1) {continue;}
					//$this->log->write(print_r($value,true));
					
					$dateavailable = 1;
					if($value['expiry'] == 2) {
						$dateavailable = $this->model_tool_couponpromo->isDateAvailable($value['id'],$value['date_start'],$value['date_end']);
						//$this->log->write($value['id'].'---'.$dateavailable);
						
					}

					if($dateavailable) {
						//$this->log->write($value['id']."--".$dateavailable);
						$desc = isset($value['descriptiontext']) ? html_entity_decode($value['descriptiontext']) : "";
						$image = isset($value['image']) ? $value['image'] : "";
						$message = isset($value['discountapplied']) ? $value['discountapplied'] : "";
					} else {
						continue;
					}

					if($value['condition'] == 1 && $dateavailable) {
						if($value['type'] != "I") {$this->session->data['promoavailable'][$value['id']] = $value['id'];}
						if(!isset($_COOKIE["devpm".$value['id']])) {
							$htmlpromo .= $this->gethtml( $value['id'],$value['displaytype'],$image,$desc,$message,$value['backgroundcolor'],$value['fontcolor']);
							//$this->log->write($htmlpromo);
						}
					}

					if($value['condition'] == 2 && $dateavailable && $this->customer->isLogged()) {
						if($value['type'] != "I") {$this->session->data['promoavailable'][$value['id']] = $value['id'];}
						if(!isset($_COOKIE["devpm".$value['id']])) {
							$htmlpromo .= $this->gethtml( $value['id'],$value['displaytype'],$image,$desc,$message,$value['backgroundcolor'],$value['fontcolor']); 
							//$this->log->write($htmlpromo);
						}
					}

					if($value['condition'] == 3 && $dateavailable) {
						$data['customergrouppromo'] = $this->model_tool_couponpromo->getCustomerGroups($value['id']);
						if(in_array($this->customer->getGroupId(),$data['customergrouppromo'])) {
							if($value['type'] != "I") {$this->session->data['promoavailable'][$value['id']] = $value['id'];}
							if(!isset($_COOKIE["devpm".$value['id']])) {
									$htmlpromo .= $this->gethtml( $value['id'],$value['displaytype'],$image,$desc,$message,$value['backgroundcolor'],$value['fontcolor'],$server);
							}
							//$this->log->write($htmlpromo);
						}
					}

					if($value['condition'] == 4 && $dateavailable) {
						$data['customerspromo'] = $this->model_tool_couponpromo->getCustomers($value['id']);
						if(in_array($this->customer->getId(),$data['customerspromo'])) {
							if($value['type'] != "I") {$this->session->data['promoavailable'][$value['id']] = $value['id'];}
							if(!isset($_COOKIE["devpm".$value['id']])) {
									$htmlpromo .= $this->gethtml( $value['id'],$value['displaytype'],$image,$desc,$message,$value['backgroundcolor'],$value['fontcolor'],$server);
							}
							//$this->log->write($htmlpromo);
						}
					}
					
				}
				//$this->log->write(print_r($this->session->data['promoavailable'],true));
				$data['htmlpromo'] = $htmlpromo;
				
				
		$data['telephone'] = $this->config->get('config_telephone');

			$data['signup'] = $this->url->link('account/signup', '', 'SSL');
			$data['mvd_login'] = HTTP_SERVER . 'admin';
			$data['txt_signup'] = $this->language->get('txt_signup');
			$data['text_seller'] = $this->language->get('text_seller');
			$data['mvd_signup'] = $this->config->get('mvd_sign_up');
			
		$data['mytemplate'] = $this->config->get('config_template');

$data['text_triangle'] = $this->language->get('text_triangle');
$data['text_popup_title'] = $this->language->get('text_popup_title');
$data['text_popup_qty'] = $this->language->get('text_popup_qty');
$data['button_addtopallet'] = $this->language->get('button_addtopallet');
$data['text_popup_details'] = $this->language->get('text_popup_details');
$data['text_popup_column_sellers'] = $this->language->get('text_popup_column_sellers');
$data['text_popup_column_name'] = $this->language->get('text_popup_column_name');
$data['text_popup_column_qty'] = $this->language->get('text_popup_column_qty');
$data['text_popup_column_price_per_bottle'] = $this->language->get('text_popup_column_price_per_bottle');
$data['text_popup_column_price'] = $this->language->get('text_popup_column_price');
$data['text_popup_column_total'] = $this->language->get('text_popup_column_total');
$data['text_pallet_worksheet'] = $this->language->get('text_pallet_worksheet');
      

		$this->load->model('account/order');
$data['countdown'] = $this->model_account_order->getCountdownDate();
		$data['do_review'] = $this->model_account_order->getDoReview($this->customer->getId());

		if(!isset($this->session->data['do_review'])){
			if($data['do_review'] == 1){
				$this->session->data['do_review']= true;
				$data['review_link'] = $this->url->link('account/order', '', 'SSL');
			}
		} else {
			if($data['do_review'] != 1){
				unset($this->session->data['do_review']);
				$data['review_link'] = '';
			}
			if($data['do_review'] == 1){
				$this->session->data['do_review']= true;
				$data['review_link'] = $this->url->link('account/order', '', 'SSL');
			}
		}
		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);
        foreach ($categories as $category){
              $data['categories'][] = array(
					'name'     => $category['name'],
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
        }//to be deleted when reactivating children display
/*		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
										
				'filter_sub_category' => true,
				'mfp_disabled' => true
			
					);
					// Level 2
					$children_level2 = $this->model_catalog_category->getCategories($child['category_id']);
					$children_data_level2 = array();
					foreach ($children_level2 as $child_level2) {
							$data_level2 = array(
									'filter_category_id'  => $child_level2['category_id'],
													
				'filter_sub_category' => true,
				'mfp_disabled' => true
			
							);
							$product_total_level2 = '';
							if ($this->config->get('config_product_count')) {
									$product_total_level2 = ' (' . $this->model_catalog_product->getTotalProducts($data_level2) . ')';
							}

							$children_data_level2[] = array(
									'name'  =>  $child_level2['name'].$product_total_level2 ,
									'href'  => $this->url->link('product/category', 'path=' . $child['category_id'] . '_' . $child_level2['category_id']),
									'id' => $category['category_id']. '_' . $child['category_id']. '_' . $child_level2['category_id']
							);
					}
                    
                    $data_level1 = array(
									'filter_category_id'  => $child['category_id'],
													
				'filter_sub_category' => true,
				'mfp_disabled' => true
			
							);
                    $product_total_level1 = ' (' . $this->model_catalog_product->getTotalProducts($data_level1) . ')';
                    
					$children_data[] = array(
							'name'  => $child['name'].$product_total_level1 ,
							'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id']),
							'id' => $category['category_id']. '_' . $child['category_id'],
							'children_level2' => $children_data_level2,
					);

				}

				// Level 1
              /* $data_level0 = array(
									'filter_category_id'  => $category['category_id'],
													
				'filter_sub_category' => true,
				'mfp_disabled' => true
			
							);
                $product_total_level0 = ' (' . $this->model_catalog_product->getTotalProducts($data_level0) . ')';
              */    
/*				$data['categories'][] = array(
					'name'     => $category['name'],
				//	'children' => $children_data,  
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}
*/
		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		
		
			/* START */
			$layout_positions = $this->load->controller('common/layout_header/layoutPositions');

			foreach($layout_positions as $position){
				$data[$position] = $this->load->controller('common/layout_header/index', $position);
			}
			/* END */
			
			
			
		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}


		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');

        $data['banner_top'] = $this->load->controller('common/banner_top');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data); }

	}

}
