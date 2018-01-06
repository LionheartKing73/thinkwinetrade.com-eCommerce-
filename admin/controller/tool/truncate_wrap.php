<?php
class ControllerToolTruncateWrap extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('tool/error_log');

		$this->document->setTitle('Truncate order data');

		$data['heading_title'] = 'Truncate order data';
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['button_clear'] = $this->language->get('button_clear');

	 
		 

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('tool/truncate_wrap', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['clear'] = $this->url->link('tool/error_log/clear', 'token=' . $this->session->data['token'], 'SSL');

	 

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('tool/truncate_wrap.tpl', $data));
	}

	public function clear() {
		$this->load->language('tool/error_log');

		if (!$this->user->hasPermission('modify', 'tool/error_log')) {
			$this->session->data['error'] = $this->language->get('error_permission');
		} else {
			$file = DIR_LOGS . $this->config->get('config_error_filename');

			$handle = fopen($file, 'w+');

			fclose($handle);

			$this->session->data['success'] = $this->language->get('text_success');
		}

		$this->response->redirect($this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL'));
	}
}