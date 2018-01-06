<?php
class ControllerModuleMvdCarriers extends Controller {
  public function index () {
    $this->load->language('module/mvd_carriers');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('module/mvd_carriers');

    if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

    $url = '';

    if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

    $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/mvd_dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/mvd_carriers', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

    $data['carriers'] = array();

    $filter_data = array(
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

    $carrier_total = $this->model_module_mvd_carriers->getTotalCarriers($filter_data);

    $results = $this->model_module_mvd_carriers->getCarriers($filter_data);

		foreach ($results as $result) {
      $data['carriers'][] = array(
				'carrier_id'  => $result['carrier_id'],
        'vendor_name' => $result['vendor_name'],
        'name'        => $result['name'],
        'address'     => $result['address'],
        'city'        => $result['city'],
        'postal_code' => $result['postal_code'],
        'phone'       => $result['phone'],
        'email'       => $result['email']
			);
    }

    $data['heading_title'] = $this->language->get('heading_title');
    $data['text_list'] = $this->language->get('text_list');
    $data['button_add'] = $this->language->get('button_add');
    $data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
    $data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
    $data['column_vendor_name'] = $this->language->get('column_vendor_name');
    $data['column_address'] = $this->language->get('column_address');
		$data['column_city'] = $this->language->get('column_city');
    $data['column_postal_code'] = $this->language->get('column_postal_code');
		$data['column_phone'] = $this->language->get('column_phone');
		$data['column_email'] = $this->language->get('column_email');
		$data['column_action'] = $this->language->get('column_action');
    $data['text_no_results'] = $this->language->get('text_no_results');
    $data['entry_name'] = $this->language->get('entry_name');
    $data['entry_address'] = $this->language->get('entry_address');
    $data['entry_city'] = $this->language->get('entry_city');
    $data['entry_postal_code'] = $this->language->get('entry_postal_code');
    $data['entry_phone'] = $this->language->get('entry_phone');
    $data['entry_email'] = $this->language->get('entry_email');
    $data['text_new_carrier_title'] = $this->language->get('text_new_carrier_title');

    $data['token'] = $this->session->data['token'];

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

    $url = '';

    $pagination = new Pagination();
		$pagination->total = $carrier_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('module/mvd_carriers', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($carrier_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($carrier_total - $this->config->get('config_limit_admin'))) ? $carrier_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $carrier_total, ceil($carrier_total / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
	  	$data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('module/mvd_carriers.tpl', $data));
  }
}
