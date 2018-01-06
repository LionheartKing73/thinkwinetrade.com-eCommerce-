<?php
class ControllerModuleFob extends Controller {
  private $error = array();  

  public function index () {
    $this->load->language('module/fob');
	
    $this->document->setTitle($this->language->get('heading_title'));

    $this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('fob', $this->request->post);

            $this->update($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('module/fob', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_successful'] = $this->language->get('text_successful');
		
		$data['entry_status'] = $this->language->get('entry_status');
    $data['entry_fixed_margin'] = $this->language->get('entry_fixed_margin');
    $data['entry_var_margin'] = $this->language->get('entry_var_margin');

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
			'href'      => $this->url->link('module/fob', 'token=' . $this->session->data['token'], 'SSL'),
    	'separator' => false
 		);

 		if (isset($this->error['warning'])) {
        $data['error_warning'] = $this->error['warning'];
    } else {
        $data['error_warning'] = '';
    }

    if (isset($this->error['fixed_margin'])) {
        $data['error_fixed_margin'] = $this->error['fixed_margin'];
    } else {
        $data['error_fixed_margin'] = '';
    }

    if (isset($this->error['var_margin'])) {
        $data['error_var_margin'] = $this->error['var_margin'];
    } else {
        $data['error_var_margin'] = '';
    }

    if (isset($this->error['var_sign'])) {
        $data['error_var_sign'] = $this->error['var_sign'];
    } else {
        $data['error_var_sign'] = '';
    }

    if (isset($this->session->data['success'])) {
        $data['success'] = $this->session->data['success'];
        unset($this->session->data['success']);
    } else {
        $data['success'] = '';
    }

 		if (isset($this->request->post['fob_fixed_margin'])) {
			$data['fob_fixed_margin'] = $this->request->post['fob_fixed_margin'];
		} else {
			$data['fob_fixed_margin'] = $this->config->get('fob_fixed_margin');
		}

    if (isset($this->request->post['fob_var_margin'])) {
      $data['fob_var_margin'] = $this->request->post['fob_var_margin'];
    } else {
      $data['fob_var_margin'] = $this->config->get('fob_var_margin');
    }

    if (isset($this->request->post['fob_var_sign'])) {
      $data['fob_var_sign'] = $this->request->post['fob_var_sign'];
    } else {
      $data['fob_var_sign'] = $this->config->get('fob_var_sign');
    }

    $data['fob_margins'] = $this->config->get('fob_margins');

    /*$data['fob_var_margins'] = array (
      '0' => array(
        'title' => 'fixed margin',
        'sign' => '+',
        'value' => '3.5'),
      '1' => array(
        'title' => 'pre shipping',
        'sign' => '*',
        'value' => '1.05')
      );*/

    $data['math_signs'] = array('+', '-', '/', '*');
    $data['math_signs_array'] = "'+', '-', '/', '*'";

    /*for($i = 1; $i <= 11; $i++) {
      if (isset($this->request->post['fob_shipping_x'.$i])) {
        $data['fob_shipping_x'.$i] = $this->request->post['fob_shipping_x'.$i];
      } else {
        $data['fob_shipping_x'.$i] = $this->config->get('fob_shipping_x'.$i);
      }
    }*/
		
		$data['action'] = $this->url->link('module/fob', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
        $data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('module/fob.tpl', $data));
  }

  public function update ($data) {
    $this->load->model('catalog/product');

    $this->model_catalog_product->updatePrice($data);
  }
	
	private function validate () {
    if (! $this->user->hasPermission('modify', 'module/fob')) {
      $this->error['warning'] = $this->language->get('error_permission');
    }

    return !$this->error;
  }

  public function install() {
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD COLUMN `fob_price` decimal(15,4) NOT NULL DEFAULT 0.0000 AFTER `shipping`;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD COLUMN `sp_price` decimal(15,4) NOT NULL DEFAULT 0.0000 AFTER `shipping`;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD COLUMN `pf` int(2) NOT NULL DEFAULT 6 AFTER `shipping`;");
  }

  public function uninstall() {
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `pf`;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `sp_price`;");
    $this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP COLUMN `fob_price`;");
  }
}