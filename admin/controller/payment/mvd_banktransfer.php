<?php
class ControllerPaymentMVDBankTransfer extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/mvd_banktransfer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('mvd_banktransfer', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');

		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_total'] = $this->language->get('help_total');

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
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/mvd_banktransfer', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/mvd_banktransfer', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['mvd_banktransfer_total'])) {
			$data['mvd_banktransfer_total'] = $this->request->post['mvd_banktransfer_total'];
		} else {
			$data['mvd_banktransfer_total'] = $this->config->get('mvd_banktransfer_total');
		}

		if (isset($this->request->post['mvd_banktransfer_order_status_id'])) {
			$data['mvd_banktransfer_order_status_id'] = $this->request->post['mvd_banktransfer_order_status_id'];
		} else {
			$data['mvd_banktransfer_order_status_id'] = $this->config->get('mvd_banktransfer_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['mvd_banktransfer_geo_zone_id'])) {
			$data['mvd_banktransfer_geo_zone_id'] = $this->request->post['mvd_banktransfer_geo_zone_id'];
		} else {
			$data['mvd_banktransfer_geo_zone_id'] = $this->config->get('mvd_banktransfer_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['mvd_banktransfer_status'])) {
			$data['mvd_banktransfer_status'] = $this->request->post['mvd_banktransfer_status'];
		} else {
			$data['mvd_banktransfer_status'] = $this->config->get('mvd_banktransfer_status');
		}

		if (isset($this->request->post['mvd_banktransfer_sort_order'])) {
			$data['mvd_banktransfer_sort_order'] = $this->request->post['mvd_banktransfer_sort_order'];
		} else {
			$data['mvd_banktransfer_sort_order'] = $this->config->get('mvd_banktransfer_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('payment/mvd_banktransfer.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/mvd_banktransfer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}