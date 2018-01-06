<?php
class ControllerAccountSuccess extends Controller {
	public function index() {
		$this->load->language('account/success');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_success'),
			'href' => $this->url->link('account/success')
		);

					
			/* Tmd Quick Login-Register */		
			$successtatus = $this->config->get('quicklogin_successtatus');
			$quickloginstatus = $this->config->get('quicklogin_status');
			
			$heading_titles = $this->config->get('quicklogin_register')['regsuccesstitle'][$this->config->get('config_language_id')];
			if($heading_titles=='' || !$successtatus==1 || !$quickloginstatus==1){
			$data['heading_title'] = $this->language->get('heading_title');
			}else{
			$data['heading_title'] = $heading_titles;
			}		
			/* Tmd Quick Login-Register */
		

		$this->load->model('account/customer_group');

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($this->config->get('config_customer_group_id'));

		if ($customer_group_info && !$customer_group_info['approval']) {
						
			/* Tmd Quick Login-Register */
			$text_messages = $this->config->get('quicklogin_register')['succesdesc'][$this->config->get('config_language_id')];
			
			if($text_messages=='' || !$successtatus==1 || !$quickloginstatus==1){
			$data['text_message'] = sprintf($this->language->get('text_message'), $this->url->link('information/contact'));
			}else{
			$data['text_message'] = html_entity_decode($text_messages, ENT_QUOTES, 'UTF-8');
			}
			/* Tmd Quick Login-Register */
		
		} else {
			$data['text_message'] = sprintf($this->language->get('text_approval'), $this->config->get('config_name'), $this->url->link('information/contact'));
		}

					
			/* Tmd Quick Login-Register */			
			$button_continues = $this->config->get('quicklogin_rsbuttontext');
			if($button_continues=='' || !$successtatus==1 || !$quickloginstatus==1){
			$data['button_continue'] = $this->language->get('button_continue');
			}else{
			$data['button_continue'] = $button_continues;
			}			
			/* Tmd Quick Login-Register */
		

		if ($this->cart->hasProducts()) {
			$data['continue'] = $this->url->link('checkout/cart');
		} else {
			$data['continue'] = $this->url->link('account/account', '', 'SSL');
		}

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

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
		}
	}
}