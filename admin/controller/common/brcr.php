<?php
class ControllerCommonBrcr extends Controller {
	/**
	 * for 'shotcuts'
	 * @return mixed
	 */
	public function index() {
		$this->load->language('common/dashboard');
		$data = [];
		if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 1 && isset($_SESSION['token'])) {
			$data['button_orders'] = [
				'text' => $this->language->get('text_order'),
				'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'], 'SSL'),
			];
			$data['button_modules'] = [
				'text' => $this->language->get('text_module'),
				'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			];

			$this->load->language('module/cr_translate_mate');
			$data['button_translate'] = [
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/cr_translate_mate', 'token=' . $this->session->data['token'], 'SSL'),
			];

			$this->load->language('common/top_menu');
			$data['button_transactions'] = [
				'text' => $this->language->get('text_vendor_transaction'),
				'href' => $this->url->link('report/mvd_vendor_transaction', 'token=' . $this->session->data['token'], 'SSL'),
			];
			$this->load->language('common/dashboard');

			$data['button_products'] = [
				'text' => $this->language->get('text_product'),
				'href' => $this->url->link('catalog/mvd_product', 'token=' . $this->session->data['token'], 'SSL'),
			];

			$this->load->language('sale/contstatctrl');

			$data['button_contract'] = [
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('sale/contstatctrl', 'token=' . $this->session->data['token'], 'SSL'),
			];


			$this->load->language('common/dashboard');
			$data['button_layout'] = [
				'text' => $this->language->get('text_layout'),
				'href' => $this->url->link('design/layout', 'token=' . $this->session->data['token'], 'SSL'),
			];
		}
			if (count($data) > 0) {
				return $this->load->view('common/brcr.tpl', $data);
			}


	}
}