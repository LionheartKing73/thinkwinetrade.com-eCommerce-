<?php
class ControllerModuleInvoicePro extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/invoicepro');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('inv_pro', $this->request->post);			
					
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_edit'] = $this->language->get('text_edit');
		
		$data['entry_bcode_type'] = $this->language->get('entry_bcode_type');
		$data['entry_inv_model'] = $this->language->get('entry_inv_model');
		$data['entry_inv_sku'] = $this->language->get('entry_inv_sku');
		$data['entry_inv_number'] = $this->language->get('entry_inv_number');
		
		$data['help_inv_model'] = $this->language->get('help_inv_model');
		$data['help_inv_number'] = $this->language->get('help_inv_number');
		$data['help_inv_sku'] = $this->language->get('help_inv_sku');
		$data['help_bcode_type'] = $this->language->get('help_bcode_type');

 	    $data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/invoicepro', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		$data['action'] = $this->url->link('module/invoicepro', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['inv_sku'])) {
			$data['inv_pro_inv_sku'] = $this->request->post['inv_pro_inv_sku'];
		} else {
			$data['inv_pro_inv_sku'] = $this->config->get('inv_pro_inv_sku');
		}	

		if (isset($this->request->post['inv_pro_barcode_type_invsku'])) {
			$data['inv_pro_barcode_type_invsku'] = $this->request->post['inv_pro_barcode_type_invsku'];
		} else {
			$data['inv_pro_barcode_type_invsku'] = $this->config->get('inv_pro_barcode_type_invsku');
		}
		
		if (isset($this->request->post['inv_pro_inv_model'])) {
			$data['inv_pro_inv_model'] = $this->request->post['inv_pro_inv_model'];
		} else {
			$data['inv_pro_inv_model'] = $this->config->get('inv_pro_inv_model');
		}
		
		
		
		
		if (isset($this->request->post['inv_pro_barcode_type_invmodel'])) {
			$data['inv_pro_barcode_type_invmodel'] = $this->request->post['inv_pro_barcode_type_invmodel'];
		} else {
			$data['inv_pro_barcode_type_invmodel'] = $this->config->get('inv_pro_barcode_type_invmodel');
		}
		
		if (isset($this->request->post['inv_pro_inv_number'])) {
			$data['inv_number'] = $this->request->post['inv_pro_inv_number'];
		} else {
			$data['inv_pro_inv_number'] = $this->config->get('inv_pro_inv_number');
		}
	
		if (isset($this->request->post['inv_pro_barcode_type_inv_number'])) {
			$data['inv_pro_barcode_type_inv_number'] = $this->request->post['inv_pro_barcode_type_inv_number'];
		} else {
			$data['inv_pro_barcode_type_inv_number'] = $this->config->get('inv_pro_barcode_type_inv_number');
		}
		
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('module/invoicepro.tpl', $data));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/invoicepro')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}