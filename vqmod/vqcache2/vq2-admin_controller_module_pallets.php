<?php
class ControllerModulePallets extends Controller {
  private $error = array();

  public function index () {
    $this->load->language('module/pallets');

    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('setting/setting');
    $this->load->model('module/pallets');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('pallets', $this->request->post);
      $this->model_module_pallets->updateShipping($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_successful'] = $this->language->get('text_successful');

    $data['entry_pallet_x'] = $this->language->get('entry_pallet_x');
    $data['entry_shipping'] = $this->language->get('entry_shipping');
    $data['tab_general'] = $this->language->get('tab_general');
    $data['tab_shipping'] = $this->language->get('tab_shipping');

		$data['entry_limit_p'] = $this->language->get('entry_limit_p');
		$data['entry_limit_v'] = $this->language->get('entry_limit_v');
		$data['entry_limit_t'] = $this->language->get('entry_limit_t');
		$data['entry_limit_c'] = $this->language->get('entry_limit_c');

		$data['entry_status'] = $this->language->get('entry_status');

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
			'href'      => $this->url->link('module/pallets', 'token=' . $this->session->data['token'], 'SSL'),
    	'separator' => false
 		);

 		if (isset($this->error['warning'])) {
        $data['error_warning'] = $this->error['warning'];
    } else {
        $data['error_warning'] = '';
    }

    if (isset($this->error['limit_p'])) {
        $data['error_limit_p'] = $this->error['limit_p'];
    } else {
        $data['error_limit_p'] = '';
    }

    if (isset($this->error['limit_v'])) {
        $data['error_limit_v'] = $this->error['limit_v'];
    } else {
        $data['error_limit_v'] = '';
    }

    if (isset($this->error['limit_t'])) {
        $data['error_limit_t'] = $this->error['limit_t'];
    } else {
        $data['error_limit_t'] = '';
    }

    if (isset($this->error['limit_c'])) {
        $data['error_limit_c'] = $this->error['limit_c'];
    } else {
        $data['error_limit_c'] = '';
    }

    if (isset($this->error['shipping'])) {
        $data['error_shipping'] = $this->error['shipping'];
    } else {
        $data['error_shipping'] = '';
    }

    if (isset($this->session->data['success'])) {
        $data['success'] = $this->session->data['success'];
        unset($this->session->data['success']);
    } else {
        $data['success'] = '';
    }

 		if (isset($this->request->post['pallets_status'])) {
			$data['pallets_status'] = $this->request->post['pallets_status'];
		} else {
			$data['pallets_status'] = $this->config->get('pallets_status');
		}

		if (isset($this->request->post['pallets_limit_p'])) {
			$data['pallets_limit_p'] = $this->request->post['pallets_limit_p'];
		} else {
			$data['pallets_limit_p'] = $this->config->get('pallets_limit_p');
		}

		if (isset($this->request->post['pallets_limit_v'])) {
			$data['pallets_limit_v'] = $this->request->post['pallets_limit_v'];
		} else {
			$data['pallets_limit_v'] = $this->config->get('pallets_limit_v');
		}

		if (isset($this->request->post['pallets_limit_t'])) {
			$data['pallets_limit_t'] = $this->request->post['pallets_limit_t'];
		} else {
			$data['pallets_limit_t'] = $this->config->get('pallets_limit_t');
		}

		if (isset($this->request->post['pallets_limit_c'])) {
			$data['pallets_limit_c'] = $this->request->post['pallets_limit_c'];
		} else {
			$data['pallets_limit_c'] = $this->config->get('pallets_limit_c');
		}

    $pallet_sizes = explode(',', $data['pallets_limit_p']);
    for($i = 1; $i <= 11; $i++) {
      foreach ($pallet_sizes as $pallet_size) {
        if (isset($this->request->post['pallets_shipping_x'.$i.'_'.$pallet_size])) {
          $data['pallets_shipping_x'.$i.'_'.$pallet_size] = $this->request->post['pallets_shipping_x'.$i.'_'.$pallet_size];
        } else {
          $data['pallets_shipping_x'.$i.'_'.$pallet_size] = $this->config->get('pallets_shipping_x'.$i.'_'.$pallet_size);
        }
      }
    }

    $this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

    $countries = $this->model_module_pallets->getShipping();
    $this->log->write($countries);

    if(count($countries) > 0) {
      foreach($countries['countries'] as $country_id => $code) {
        $this->log->write($country_id);
        $this->log->write($code);
        $country_tabs['name'] = $code;
        $country_tabs['country_id'] = $country_id;
        $country_tabs['data'] = $countries[$country_id];

        $data['country_tabs'][] = $country_tabs;
      }
    }

    $this->log->write($data['country_tabs']);

		$data['action'] = $this->url->link('module/pallets', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
	    $data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('module/pallets.tpl', $data));
  }

	private function validate () {
    if (! $this->user->hasPermission('modify', 'module/pallets')) {
      $this->error['warning'] = $this->language->get('error_permission');
    }

    if (!$this->request->post['pallets_limit_p']) {
			$this->error['limit_p'] = $this->language->get('error_limit_p');
		}

		if (!$this->request->post['pallets_limit_v']) {
			$this->error['limit_v'] = $this->language->get('error_limit_v');
		}

		if (!$this->request->post['pallets_limit_t']) {
			$this->error['limit_t'] = $this->language->get('error_limit_t');
		}

		if (!$this->request->post['pallets_limit_c']) {
			$this->error['limit_c'] = $this->language->get('error_limit_c');
		}

    /*for($i = 1; $i <= 11; $i++) {
      if (!$this->request->post['pallets_shipping_x'.$i]) {
        $this->error['shipping'] = $this->language->get('error_shipping');
      }
    }*/

    return !$this->error;
  }

  public function install() {
  	$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "worksheet` (
	  		`worksheet_id` int(11) NOT NULL AUTO_INCREMENT,
			  `customer_id` int(11) NOT NULL,
        `order_id` int(11) NULL,
        `archived` int(1) NOT NULL DEFAULT '0',
			  `date_added` datetime NOT NULL,
			  `date_modified` datetime NOT NULL,
			  PRIMARY KEY (`worksheet_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
  	");

  	$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pallet` (
			  `pallet_id` int(11) NOT NULL AUTO_INCREMENT,
			  `worksheet_id` int(11) NOT NULL,
			  `order_id` int(11) NULL,
			  `customer_id` int(11) NOT NULL DEFAULT '0',
        `pallet_size` int(3) NOT NULL,
        `locked` int(1) NOT NULL DEFAULT '0',
			  `date_added` datetime NOT NULL,
			  `date_modified` datetime NOT NULL,
        `pallet_no` varchar(64) NULL,
			  PRIMARY KEY (`pallet_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
  	");

  	$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "pallet_product` (
			  `pallet_product_id` int(11) NOT NULL AUTO_INCREMENT,
			  `pallet_id` int(11) NOT NULL,
        `order_id` int(11) NULL,
			  `product_id` int(11) NOT NULL,
			  `name` varchar(255) NOT NULL,
        `model` varchar(64) NOT NULL,
			  `sku` varchar(64) NOT NULL,
			  `quantity` int(4) NOT NULL,
			  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
			  `total` decimal(15,4) NOT NULL DEFAULT '0.0000',
			  `vendor_id` int(11) NOT NULL,
			  PRIMARY KEY (`pallet_product_id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
		");

		$this->load->model('setting/setting');

		$default_settings = array(
			"pallets_limit_p" => 42,
			"pallets_limit_v" => 5,
			"pallets_limit_t" => 20,
			"pallets_limit_c" => 11
		);

		$this->model_setting_setting->editSetting('pallets', $default_settings);

    $this->load->model('extension/event');
    $this->model_extension_event->addEvent('pallet', 'post.order.save', 'pallet/worksheet/archive');
    //zighia
    $this->model_extension_event->addEvent('update_prices', 'post.fob.save', 'pallet/worksheet/updatePrices');
  }

  public function uninstall() {
  	$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "worksheet`");
  	$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "pallet`");
  	$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "pallet_product`");

    $this->load->model('extension/event');
    $this->model_extension_event->deleteEvent('pallet');
    $this->model_extension_event->deleteEvent('update_prices');
  }
}
