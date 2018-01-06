<?php
class ControllerModuleVdiMyCarriers extends Controller {
  public function index () {
    $this->load->controller('common/vdi_dashboard/checklist_venue');
	
	$this->load->language('module/vdi_my_carriers');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('module/vdi_my_carriers');

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
			'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/vdi_my_carriers', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('module/vdi_my_carriers/add', 'token=' . $this->session->data['token'] . $url, 'SSL');

    $data['carriers'] = array();

    $filter_data = array(
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

    $carrier_total = $this->model_module_vdi_my_carriers->getTotalCarriers($filter_data);

    $results = $this->model_module_vdi_my_carriers->getCarriers($filter_data);

		foreach ($results as $result) {
      $data['carriers'][] = array(
				'carrier_id'  => $result['carrier_id'],
        'name'        => $result['name'],
        'address'     => $result['address'],
        'city'        => $result['city'],
        'postal_code' => $result['postal_code'],
        'phone'       => $result['phone'],
        'email'       => $result['email'],
				'edit'        => $this->url->link('module/vdi_my_carriers/edit', 'token=' . $this->session->data['token'] . '&carrier_id=' . $result['carrier_id'] . $url, 'SSL'),
        'delete'        => $this->url->link('module/vdi_my_carriers/delete', 'token=' . $this->session->data['token'] . '&carrier_id=' . $result['carrier_id'] . $url, 'SSL')
			);
    }

    $data['heading_title'] = $this->language->get('heading_title');
    $data['text_list'] = $this->language->get('text_list');
    $data['button_add'] = $this->language->get('button_add');
    $data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
    $data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
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
    $data['button_add'] = $this->language->get('button_add');

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
		$pagination->url = $this->url->link('module/vdi_my_carriers', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($carrier_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($carrier_total - $this->config->get('config_limit_admin'))) ? $carrier_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $carrier_total, ceil($carrier_total / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('common/vdi_header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
      $data['top_menu'] = $this->load->controller('common/vdi_top_menu');
       $data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('module/vdi_my_carriers.tpl', $data));
  }

  public function edit () {
    $this->load->language('module/vdi_my_carriers');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('module/vdi_my_carriers');

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
			'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/vdi_my_carriers', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['update'] = $this->url->link('module/vdi_my_carriers/update', 'token=' . $this->session->data['token'] . $url, 'SSL');
    $data['carrier'] = $this->model_module_vdi_my_carriers->getCarrier($this->request->get['carrier_id']);

    $data['heading_title'] = $this->language->get('heading_title');
    $data['text_edit'] = $this->language->get('text_edit');
    $data['entry_name'] = $this->language->get('entry_name');
    $data['entry_address'] = $this->language->get('entry_address');
    $data['entry_city'] = $this->language->get('entry_city');
    $data['entry_postal_code'] = $this->language->get('entry_postal_code');
    $data['entry_phone'] = $this->language->get('entry_phone');
    $data['entry_email'] = $this->language->get('entry_email');
    $data['button_update'] = $this->language->get('button_update');

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

		$data['header'] = $this->load->controller('common/vdi_header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
      $data['top_menu'] = $this->load->controller('common/vdi_top_menu');

		$this->response->setOutput($this->load->view('module/vdi_my_carriers_edit.tpl', $data));
  }

  public function add() {
    $json = array();

    if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

      $this->load->model('module/vdi_my_carriers');
      $this->model_module_vdi_my_carriers->addCarrier($this->request->post);
      $json['success'] = "OK";
		}

    $this->response->addHeader('Content-Type: application/json');
    $this->response->setOutput(json_encode($json));
  }

  public function delete() {
    if(isset($this->request->get['carrier_id']) && $this->user->getVP()) {
      $this->load->model('module/vdi_my_carriers');
      $this->model_module_vdi_my_carriers->deleteCarrier($this->request->get);
    }

    $this->response->redirect($this->url->link('module/vdi_my_carriers', 'token=' . $this->session->data['token'], 'SSL'));
  }

  public function update() {
    if(isset($this->request->post) && $this->user->getVP()) {
      $this->load->model('module/vdi_my_carriers');
      $this->model_module_vdi_my_carriers->updateCarrier($this->request->post);
    }

    $this->response->redirect($this->url->link('module/vdi_my_carriers', 'token=' . $this->session->data['token'], 'SSL'));
  }

	private function validate () {
    if (! $this->user->hasPermission('modify', 'module/vdi_my_carriers')) {
      $this->error['warning'] = $this->language->get('error_permission');
    }

    return !$this->error;
  }

  public function install() {
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD COLUMN `carrier` varchar(255) NULL;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD COLUMN `tracking_no` varchar(255) NULL;");
    $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "carrier` (
			  `carrier_id` int(11) NOT NULL AUTO_INCREMENT,
        `vendor_id` int(11) NOT NULL,
			  `name` varchar(255) NOT NULL,
			  `address` varchar(255) NOT NULL,
			  `city` varchar(255) NOT NULL,
        `postal_code` varchar(255) NOT NULL,
			  `phone` varchar(255) NOT NULL,
			  `email` varchar(255) NOT NULL,
			  PRIMARY KEY (`carrier_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
  	");
  }

  public function uninstall() {
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` DROP COLUMN `carrier`;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "order` DROP COLUMN `tracking_no`;");
    $this->db->query("DROP TABLE `" . DB_PREFIX . "carrier`;");
  }
}
