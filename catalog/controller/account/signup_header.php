<?php
class ControllerAccountSignupHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		//load folder French language is default Th-add       
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
        //End Load language

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		if ($this->config->get('config_google_analytics_status')) {
			$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		} else {
			$data['google_analytics'] = '';
		}
		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('account/signup');
        $data['welcome_vendor']= $this->language->get('welcome_vendor');

        //$this->load->model('localisation/language');
        //$data['_langs'] = $this->model_localisation_language->getLanguages();
        $data['_langs'] = $this->load->controller('common/language');
        $data['config_language_id'] = $this->config->get('config_language_id');
        $data['switch_language'] = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/signup_header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/account/signup_header.tpl', $data);
		} else {
			return $this->load->view('default/template/account/signup_header.tpl', $data);
		}
		
	}
}