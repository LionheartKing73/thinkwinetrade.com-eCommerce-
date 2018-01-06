<?php
class ControllerCommonLogin extends Controller {
    private $error = array();

    public function index() {
        //load folder language
        //$config_language_id = isset($this->session->data['admin_language_id'])? $this->session->data['admin_language_id']:$this->config->get('config_language_id');
        //$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE language_id = '" . (int)$config_language_id . "'");
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE code = 'fr'");
        $language = $query->row;
        $lang = new Language($language['directory']);
        if (version_compare(VERSION, '2.0.2', '>=')) {
            $lang->load($language['directory']);
        } else if (version_compare(VERSION, '2.0.1', '<')) {
            $lang->load($language['filename']);
        } else {
            $lang->load('default');
        }
        $this->registry->set('language', $lang);
        //echo "<pre>language: "; print_r($language); echo "</pre>";
        //End Load language

        //imformation vendor
        $this->load->model('catalog/information');
        $information_id = 23;
        $information_info = $this->model_catalog_information->getNewInformation($information_id);
        if (!empty($information_info)) {
            $data['information_heading_title'] = $information_info['title'];
            $data['information_description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');
        }
        //End information
        $this->load->language('common/login');

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->user->isLogged() && isset($this->request->get['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
            
			if (!$this->user->getVP()) {
				$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				//$this->response->redirect($this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL'));
				$this->load->model('catalog/vendor');
				$profiles = $this->model_catalog_vendor->getVendorProfile($this->user->getId());
				$total_products = $this->model_catalog_vendor->getTotalProductVendors($profiles['vendor_id']);

				$dashboard = true;
				if($profiles['vendor_image'] == ''){
					$dashboard = false;
					$this->response->redirect($this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL'));
				}

				if($total_products == 0){
					$dashboard = false;
					$this->response->redirect($this->url->link('catalog/vdi_product/add', 'token=' . $this->session->data['token'], 'SSL'));
				}

				if($profiles['paypal_email'] == '' || $profiles['payment'] == ''){
					$dashboard = false;
					$this->response->redirect($this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL'));
				}
				if($profiles['notification'] == 1 ){

					$dashboard = false;

					$this->response->redirect($this->url->link('catalog/vdi_product/', 'token=' . $this->session->data['token'], 'SSL'));

				}
				if($dashboard){
					$this->response->redirect($this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL'));
				}
			}
			
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		      $this->session->data['token'] = md5(mt_rand());

            if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], HTTP_SERVER) === 0 || strpos($this->request->post['redirect'], HTTPS_SERVER) === 0 )) {
                $this->response->redirect($this->request->post['redirect'] . '&token=' . $this->session->data['token']);
            } else {
                
			if (!$this->user->getVP()) {
				$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				//$this->response->redirect($this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL'));
				$this->load->model('catalog/vendor');
				$profiles = $this->model_catalog_vendor->getVendorProfile($this->user->getId());
				$total_products = $this->model_catalog_vendor->getTotalProductVendors($profiles['vendor_id']);

				$dashboard = true;
				if($profiles['vendor_image'] == ''){
					$dashboard = false;
					$this->response->redirect($this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL'));
				}

				if($total_products == 0){
					$dashboard = false;
					$this->response->redirect($this->url->link('catalog/vdi_product/add', 'token=' . $this->session->data['token'], 'SSL'));
				}

				if($profiles['paypal_email'] == '' || $profiles['payment'] == ''){
					$dashboard = false;
					$this->response->redirect($this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL'));
				}
				if($profiles['notification'] == 1 ){

					$dashboard = false;

					$this->response->redirect($this->url->link('catalog/vdi_product/', 'token=' . $this->session->data['token'], 'SSL'));

				}
				if($dashboard){
					$this->response->redirect($this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL'));
				}
			}
			
            }
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_login_heading'] = $this->language->get('text_login_heading');

        $data['text_login'] = $this->language->get('text_login');
        $data['text_forgotten'] = $this->language->get('text_forgotten');

        $data['entry_username'] = $this->language->get('entry_username');
        $data['entry_password'] = $this->language->get('entry_password');

        $data['button_login'] = $this->language->get('button_login');
        $data['create_account'] = $this->language->get('create_account');
        $data['donot_has_account'] = $this->language->get('donot_has_account');


        if ((isset($this->session->data['token']) && !isset($this->request->get['token'])) || ((isset($this->request->get['token']) && (isset($this->session->data['token']) && ($this->request->get['token'] != $this->session->data['token']))))) {
            $this->error['warning'] = $this->language->get('error_token');
        }

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

        $data['action'] = $this->url->link('common/login', '', 'SSL');
        $vendor_signup_link = $this->url->link('account/signup', '', 'SSL');
        $data['vendor_signup_link'] =  str_replace("/admin/", "/", $vendor_signup_link);
        //echo "vendor_signup_link: ".$data['vendor_signup_link'];

        if (isset($this->request->post['username'])) {
            $data['username'] = $this->request->post['username'];
        } else {
            $data['username'] = '';
        }

        if (isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        } else {
            $data['password'] = '';
        }

        if (isset($this->request->get['route'])) {
            $route = $this->request->get['route'];

            unset($this->request->get['route']);
            unset($this->request->get['token']);

            $url = '';

            if ($this->request->get) {
                $url .= http_build_query($this->request->get);
            }

            $data['redirect'] = $this->url->link($route, $url, 'SSL');
        } else {
            $data['redirect'] = '';
        }

        if ($this->config->get('config_password')) {
            $data['forgotten'] = $this->url->link('common/forgotten', '', 'SSL');
        } else {
            $data['forgotten'] = '';
        }

        $data['header'] = $this->load->controller('common/header_login');
        $data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
//imformation vendor
        $this->load->model('catalog/information');
        $information_id = 23;
        $information_info = $this->model_catalog_information->getNewInformation($information_id);


        if ($information_info) {
            $data['information_heading_title'] = $information_info['title'];
            $data['information_description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');
        }
        //End information
        $this->response->setOutput($this->load->view('common/login.tpl', $data));
    }



    protected function validate() {
		if (!isset($this->request->post['username']) ||
			 !isset($this->request->post['password']) || !$this->user->login($this->request->post['username'], $this->request->post['password'])) {
            $this->error['warning'] = $this->language->get('error_login');
        }

        return !$this->error;
    }

    public function check() {

        $this->load->model('user/user');
		$user_info = $this->model_user_user->getUser($this->user->getId());
		
			if ($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['cual_admin_language_id'])) {
				$this->db->query("UPDATE `" . DB_PREFIX . "user` SET `language_id` = '" . $this->request->post['cual_admin_language_id'] . "' WHERE user_id = '" . $this->user->getId() . "'");
				$this->session->data['admin_language_id'] = $this->request->post['cual_admin_language_id'];
				unset($this->request->post['cual_admin_language_id']);
				$this->response->redirect('http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'], 303);
				return;
			}
            


        $route = '';

        if (isset($this->request->get['route'])) {
            $part = explode('/', $this->request->get['route']);

            if (isset($part[0])) {
                $route .= $part[0];
            }

            if (isset($part[1])) {
                $route .= '/' . $part[1];
            }
        }

        $ignore = array(
            'common/login',
            'common/forgotten',
            'common/reset'
        );

        if (!$this->user->isLogged() && !in_array($route, $ignore)) {
            return new Action('common/login');
        }

        if (isset($this->request->get['route'])) {
            $ignore = array(
                'common/login',
                'common/logout',
                'common/forgotten',
                'common/reset',
                'error/not_found',
                'error/permission'
            );

            if (!in_array($route, $ignore) && (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token']))) {
                return new Action('common/login');
            }
        } else {
	        if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
                return new Action('common/login');
            }
        }
    }
}
