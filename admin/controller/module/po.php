<?php
class ControllerModulePo extends Controller {
  private $error = array();  

  public function index () {
    $this->load->language('module/po');
	
    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('po', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('module/po', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_successful'] = $this->language->get('text_successful');
		
		$data['entry_status'] = $this->language->get('entry_status');

    $data['tab_statuses'] = $this->language->get('tab_statuses');
    $data['entry_status_pending'] = $this->language->get('entry_status_pending');
    $data['entry_status_payment_confirmed'] = $this->language->get('entry_status_payment_confirmed');
    $data['entry_status_waiting_po_confirmation'] = $this->language->get('entry_status_waiting_po_confirmation');
    $data['entry_status_po_confirmed'] = $this->language->get('entry_status_po_confirmed');
    $data['entry_status_shipping_confirmed'] = $this->language->get('entry_status_shipping_confirmed');

    $data['tab_transporters'] = $this->language->get('tab_transporters');
    $data['entry_transporters'] = $this->language->get('entry_transporters');
    $data['help_transporter'] = $this->language->get('help_transporter');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['breadcrumbs'] = array();

 		$data['breadcrumbs'][] = array(
     	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
    	'separator' => false
 		);

 		$data['breadcrumbs'][] = array(
     	'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
    	'separator' => false
 		);
	
 		$data['breadcrumbs'][] = array(
     	'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/po', 'token=' . $this->session->data['token'], 'SSL'),
    	'separator' => false
 		);

 		if (isset($this->error['warning'])) {
        $data['error_warning'] = $this->error['warning'];
    } else {
        $data['error_warning'] = '';
    }

    if (isset($this->session->data['success'])) {
        $data['success'] = $this->session->data['success'];
        unset($this->session->data['success']);
    } else {
        $data['success'] = '';
    }

 		if (isset($this->request->post['po_status_pending_id'])) {
			$data['po_status_pending_id'] = $this->request->post['po_status_pending_id'];
		} else {
			$data['po_status_pending_id'] = $this->config->get('po_status_pending_id');
		}

    if (isset($this->request->post['po_status_payment_confirmed_id'])) {
      $data['po_status_payment_confirmed_id'] = $this->request->post['po_status_payment_confirmed_id'];
    } else {
      $data['po_status_payment_confirmed_id'] = $this->config->get('po_status_payment_confirmed_id');
    }

    if (isset($this->request->post['po_status_waiting_po_confirmation_id'])) {
      $data['po_status_waiting_po_confirmation_id'] = $this->request->post['po_status_waiting_po_confirmation_id'];
    } else {
      $data['po_status_waiting_po_confirmation_id'] = $this->config->get('po_status_waiting_po_confirmation_id');
    }

    if (isset($this->request->post['po_status_po_confirmed_id'])) {
      $data['po_status_po_confirmed_id'] = $this->request->post['po_status_po_confirmed_id'];
    } else {
      $data['po_status_po_confirmed_id'] = $this->config->get('po_status_po_confirmed_id');
    }

    if (isset($this->request->post['po_status_shipping_confirmed_id'])) {
      $data['po_status_shipping_confirmed_id'] = $this->request->post['po_status_shipping_confirmed_id'];
    } else {
      $data['po_status_shipping_confirmed_id'] = $this->config->get('po_status_shipping_confirmed_id');
    }

    $data['po_transporters'] = $this->config->get('po_transporters');

    $this->load->model('localisation/order_status');

    $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		$data['action'] = $this->url->link('module/po', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
        $data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('module/po.tpl', $data));
  }
	
	private function validate () {
    if (! $this->user->hasPermission('modify', 'module/po')) {
      $this->error['warning'] = $this->language->get('error_permission');
    }

    return !$this->error;
  }

  public function install() {
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "pallet_product` ADD COLUMN `product_received` int(11) NOT NULL DEFAULT 0;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "pallet_product` ADD COLUMN `documents_received` int(11) NOT NULL DEFAULT 0;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "pallet_product` ADD COLUMN `product_received_date` date NOT NULL;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "pallet_product` ADD COLUMN `documents_received_date` date NOT NULL;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "pallet_product` ADD COLUMN `vendor_confirmed` int(11) NOT NULL DEFAULT 0;");
    //product_no varchar(64)
    $this->db->query("CREATE TABLE `" . DB_PREFIX . "order_vendor_new` ( `vendor_id` int(11) NOT NULL, `order_id` int(11) NOT NULL, `date_seen` datetime NOT NULL );");
  }

  public function uninstall() {
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `product_received`;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `documents_received`;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `vendor_confirmed`;");
  }
}