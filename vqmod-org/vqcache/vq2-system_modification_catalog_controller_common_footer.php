<?php
class ControllerCommonFooter extends Controller {

				public function gethtml($id,$displaytype,$image,$desc,$message,$bc,$fc,$server = "") {
					
					if($displaytype == 2) {
						if($desc == "<p><br></p>") {
							return "";
						}
						$html = '<div class="remodal"id="devpm'.$id.'" data-remodal-id="modal" data-remodal-options="hashTracking: false" style="background:'.$bc.';color:'.$fc.';">'.$desc.'</div>';
					}
					if($displaytype == 3) {
						$html = '<div class="remodal" id="devpm'.$id.'"  data-remodal-id="modal" data-remodal-options="hashTracking: false"><img style="width:100%;" src="'.$server."image/".$image.'"></div>';
					}
					
					return $html;
				}
				public function devpmcookie() {
					$id = $this->request->post['a'];
					setcookie($id,1, time()+(3600*5));
				}
				
	public function index() {
		$this->load->language('common/footer');

		
				$this->load->model('tool/couponpromo');
				$couponpromo = $this->model_tool_couponpromo->getcouponpromos();
				//$this->log->write(print_r($couponpromo,true));
				$htmlpromo = "";
				$this->session->data['promoavailable'] = array();
				foreach ($couponpromo as $key => $value) {
				    if($value['displaytype'] == 1) {continue;}
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
				
				

		$data['text_information'] = $this->language->get('text_information');
		$data['text_service'] = $this->language->get('text_service');
		$data['text_extra'] = $this->language->get('text_extra');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_sitemap'] = $this->language->get('text_sitemap');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_special'] = $this->language->get('text_special');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_newsletter'] = $this->language->get('text_newsletter');

                    $data['text_cookie_close'] = $this->language->get('text_cookie_close');
		                $data['text_cookie'] = $this->language->get('text_cookie');
           

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}

		

			/* START */
			$layout_positions = $this->load->controller('common/layout_footer/layoutPositions');

			foreach($layout_positions as $position){
				$data[$position] = $this->load->controller('common/layout_footer/index', $position);
			}
			/* END */
			
			
			
		$data['contact'] = $this->url->link('information/contact');
		$data['return'] = $this->url->link('account/return/add', '', 'SSL');
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
		$data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));
		
	
		$data['footerright'] = $this->load->controller('common/footerright');
        
        
        if ($this->config->get('config_google_analytics_status')) {
			$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['google_analytics'] = '';
		}
		

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
		}
		
		
		$data['footerright'] = $this->load->controller('common/footerright');



		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/footer.tpl', $data);
		} else {
			return $this->load->view('default/template/common/footer.tpl', $data);
		}
	}
}