<?php
class ControllerModuleLinkedinLogin extends Controller {

	private $moduleData_module;
	private $data  = array();
	private $error = array();
	private $version;
	private $module_path;
	private $extensions_link;
	private $language_variables;
	private $moduleModel;
	private $moduleName;
	private $call_model;

	public function __construct($registry){
		parent::__construct($registry);
		$this->load->config('isenselabs/linkedinlogin');
		$this->moduleName        = $this->config->get('linkedinlogin_name');
		$this->call_model        = $this->config->get('linkedinlogin_model');
		$this->module_path       = $this->config->get('linkedinlogin_path');
		$this->version           = $this->config->get('linkedinlogin_version');
		$this->moduleData_module = $this->config->get('linkedinlogin_moduleData_module');
		
		if (version_compare(VERSION, '2.3.0.0', '>=')) {			
			$this->extensions_link = $this->url->link('extension/extension', 'token=' . $this->session->data['token'].'&type=module', 'SSL');
		} else {
			$this->extensions_link = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');	
		}
			
		$this->load->model($this->module_path);
		$this->moduleModel        = $this->{$this->call_model};
		$this->language_variables = $this->load->language($this->module_path);

    	//Loading framework models
	 	$this->load->model('setting/store');
		$this->load->model('setting/setting');
        $this->load->model('localisation/language');
        if(VERSION >= '2.1.0.1'){
			$this->load->model('customer/customer_group');
		} else {
			$this->load->model('sale/customer_group');
		}

		$this->data['module_path']       = $this->module_path;
		$this->data['moduleName']        = $this->moduleName;
		$this->data['moduleNameSmall']   = $this->moduleName;	
		$this->data['moduleData_module'] = $this->moduleData_module;    
	}


	public function index() { 


		foreach ($this->language_variables as $code => $languageVariable) {
		    $this->data[$code] = $languageVariable;
		}   

		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['moduleTitle'] = $this->language->get('module_title');

		$this->load->model('extension/module');
		$this->load->model('design/layout');

		$catalogURL = $this->getCatalogURL();

		if(!isset($this->request->get['store_id'])) {
           $this->request->get['store_id'] = 0; 
        }

        $store = $this->getCurrentStore($this->request->get['store_id']);

		$this->document->addStyle('view/stylesheet/linkedinlogin/linkedinlogin.css');

		$this->data['error_warning'] = '';
		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
			if (!empty($_POST['OaXRyb1BhY2sgLSBDb21'])) {
				$this->request->post['linkedinlogin_license']['LicensedOn'] = $_POST['OaXRyb1BhY2sgLSBDb21'];
			}
			if (!empty($_POST['cHRpbWl6YXRpb24ef4fe'])) {
				$this->request->post['linkedinlogin_license']['License'] = json_decode(base64_decode($_POST['cHRpbWl6YXRpb24ef4fe']),true);
			}

			if (!isset($this->request->post[$this->moduleName]['module_id']) || empty($this->request->post[$this->moduleName]['module_id'])) { // Creating a new module
				if(!empty($this->request->post[$this->moduleName]['name'])) {
					if($this->moduleModel->duplicatedModuleName($this->request->post[$this->moduleName]['name'])) {
						$this->model_extension_module->addModule('linkedinlogin', $this->request->post[$this->moduleName]);
						$lastModuleID = $this->moduleModel->getLastModuleByCode($this->moduleName);
						$this->request->post[$this->moduleName]['module_id'] = $lastModuleID[0]['module_id'];
						$this->model_extension_module->editModule($lastModuleID[0]['module_id'], $this->request->post[$this->moduleName]);
						$this->session->data['success'] = $this->language->get('text_success_module_creation');
						$this->response->redirect($this->url->link($this->module_path,  'token=' . $this->session->data['token'] . '&module_id=' . $lastModuleID[0]['module_id'], 'SSL'));
					} else {
						$this->session->data['warning'] = $this->language->get('text_error_duplicated_module_name');
						$this->response->redirect($this->url->link($this->module_path,  'token=' . $this->session->data['token'], 'SSL'));
					}
				} 

			} else if(!empty($this->request->post[$this->moduleName]['module_id'])) { // Edit existing module
				if(!empty($this->request->post[$this->moduleName]['name'])) {
					if($this->moduleModel->duplicatedModuleName($this->request->post[$this->moduleName]['name'], $this->request->post[$this->moduleName]['module_id'])) {
						$this->model_extension_module->editModule($this->request->post[$this->moduleName]['module_id'], $this->request->post[$this->moduleName]);
						$this->session->data['success'] = $this->language->get('text_success');
						$this->response->redirect($this->url->link($this->module_path,  'token=' . $this->session->data['token'] . '&module_id=' . $this->request->post[$this->moduleName]['module_id'], 'SSL'));
					} else {
						$this->session->data['warning'] = $this->language->get('text_error_duplicated_module_name');
						$this->response->redirect($this->url->link($this->module_path,  'token=' . $this->session->data['token'] . '&module_id=' . $this->request->post[$this->moduleName]['module_id'], 'SSL'));
					} 
				} else {
					$this->session->data['warning'] = $this->language->get('text_error_module_name');
					$this->response->redirect($this->url->link($this->module_path,  'token=' . $this->session->data['token'] . '&module_id=' . $this->request->post[$this->moduleName]['module_id'], 'SSL'));
				}
			}

			$store = $this->getCurrentStore($this->request->post['store_id']);
			$this->model_setting_setting->editSetting($this->moduleName, $this->request->post, $store['store_id']);	

			$success_message = $this->language->get('text_success');
			
			if (!empty($this->request->get['activate'])) {
				$success_message = $this->language->get('text_success_activation');
			}
			
			$this->session->data['success'] = $success_message;
			$this->response->redirect($this->url->link($this->module_path,  'token=' . $this->session->data['token'], 'SSL'));
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = '';
		}
		
		if (isset($this->session->data['warning'])) {
			$this->data['error_warning'] = $this->session->data['warning'];
			unset($this->session->data['warning']);
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['code'])) {
			$data['error_code'] = $this->error['code'];
		} else {
			$data['error_code'] = '';
		}
		
		$this->load->model('localisation/language');
		

		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		//2.2.0.0 language flag image fix
		foreach ($this->data['languages'] as $key => $value) {
			if(version_compare(VERSION, '2.2.0.0', "<")) {
				$this->data['languages'][$key]['flag_url'] = 'view/image/flags/'.$this->data['languages'][$key]['image'];
			} else {
				$this->data['languages'][$key]['flag_url'] = 'language/'.$this->data['languages'][$key]['code'].'/'.$this->data['languages'][$key]['code'].'.png"';
			}
		}
		
		$firstLanguage = array_shift($this->data['languages']);
		$this->data['firstLanguageCode'] = $firstLanguage['code'];
		
		$this->data['has_customer_group'] = false;
		if (defined('VERSION')) {
			if (strcmp(VERSION, '1.5.3') >= 0) {
				$this->data['has_customer_group'] = true;
			}
		}
		
		
		if(VERSION >= '2.1.0.1') {
			$this->load->model('customer/customer_group');
			$this->data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
		} else {
			$this->load->model('sale/customer_group');
			$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
		}	
		$this->data['more_user_details'] = array(
			array(
				'name' => 'ExtraTelephone',
				'default_checked' => false,
				'text' => $this->language->get('extra_telephone')
			),
			array(
				'name' => 'ExtraFax',
				'default_checked' => false,
				'text' => $this->language->get('extra_fax')
			),
			array(
				'name' => 'ExtraCompany',
				'default_checked' => false,
				'text' => $this->language->get('extra_company')
			),
			array(
				'name' => 'ExtraAddress',
				'default_checked' => false,
				'text' => $this->language->get('extra_address')
			),
			array(
				'name' => 'ExtraCountry',
				'default_checked' => false,
				'text' => $this->language->get('extra_country')
			),
			array(
				'name' => 'ExtraRegion',
				'default_checked' => false,
				'text' => $this->language->get('extra_region')
			),
			array(
				'name' => 'ExtraCity',
				'default_checked' => false,
				'text' => $this->language->get('extra_city')
			),
			array(
				'name' => 'ExtraPostcode',
				'default_checked' => false,
				'text' => $this->language->get('extra_postcode')
			),
			array(
				'name' => 'ExtraNewsletter',
				'default_checked' => false,
				'text' => $this->language->get('extra_newsletter')
			),
			array(
				'name' => 'ExtraPrivacy',
				'default_checked' => false,
				'text' => $this->language->get('extra_privacy')
			)
		);
		
		if (defined('VERSION')) {
			if (strcmp(VERSION, '1.5.3') >= 0) {
				if(VERSION >= '2.1.0.1') {
					$this->load->model('customer/customer_group');
					$this->data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();
				} else {
					$this->load->model('sale/customer_group');
					$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();
				}	
				
				$this->data['more_user_details'][] = array(
					'name' => 'ExtraCompanyId',
					'default_checked' => false,
					'text' => $this->language->get('extra_company_id')
				);
				
				$this->data['more_user_details'][] = array(
					'name' => 'ExtraTaxId',
					'default_checked' => false,
					'text' => $this->language->get('extra_tax_id')
				);
			}
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->extensions_link,
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link($this->module_path, 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$this->data['linkedinlogin'] = $this->model_extension_module->getModule($this->request->get['module_id']);
			$this->data['module_id'] = $this->request->get['module_id'];
		}

   		$this->data['stores'] = array_merge(array(0 => array('store_id' => '0', 'name' => $this->config->get('config_name') . ' (' . $this->data['text_default'].')', 'url' => HTTP_SERVER, 'ssl' => HTTPS_SERVER)), $this->model_setting_store->getStores());
		$this->data['store']                  = $store;

		$this->data['action'] 				  = $this->url->link($this->module_path, 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] 				  = $this->extensions_link;
		$this->data['token']                  = $this->session->data['token'];
		$this->data['data']                   = $this->model_setting_setting->getSetting($this->moduleName);

        $this->data['layouts']                = $this->model_design_layout->getLayouts();
        $this->data['catalog_url']			  = $catalogURL;

		if(isset($this->data['data']['linkedinlogin_license'])){
        	$this->data['moduleData'] = $this->data['data']['linkedinlogin_license'];
		}

		$login_url = $store['url'] . 'index.php?route=account/login';
		$is_https = $this->moduleModel->is_https($login_url);
		
		if ($is_https) {
			$redirect_url = $store['ssl'] . 'index.php?route=account/linkedinlogin';
		} else {
			$redirect_url = $store['url'] . 'index.php?route=account/linkedinlogin';
		}

		$redirect_url = str_replace(
			array('/' . IMODULE_ADMIN_FOLDER, '&amp;', '%2F'),
			array('', '&', '/'),
			$redirect_url
		);

		$this->data['entry_callback'] = $redirect_url;
		$this->data['url_duplicate_module'] = html_entity_decode($this->url->link($this->module_path.'/duplicateModule', 'token=' . $this->session->data['token'], 'SSL'));
		
		$this->data['header']      = $this->load->controller('common/header');
		$this->data['column_left'] = $this->load->controller('common/column_left');
		$this->data['footer']      = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view($this->module_path.'/linkedinlogin.tpl', $this->data));	
	}

	public function duplicateModule() {
		$this->load->model('extension/module');
		if(isset($this->request->get['module_id']) && !empty($this->request->get['module_id'])) {
			$module_id = $this->request->get['module_id'];
			$data['linkedinlogin'] = $this->model_extension_module->getModule($module_id);
			if($this->moduleModel->duplicatedModuleName($this->request->get['name'])) {
				$data['linkedinlogin']['name'] = $this->request->get['name'];
				$this->model_extension_module->addModule('linkedinlogin', $data['linkedinlogin']);
				$lastModuleID = $this->moduleModel->getLastModuleByCode($this->moduleName);
				$this->session->data['success'] = $this->language->get('text_success_module_duplication');
				$json = html_entity_decode($this->url->link($this->module_path,  'token=' . $this->session->data['token'] . '&module_id=' . $lastModuleID[0]['module_id'], 'SSL'));
			} else {
				$json = 'This module name already exists!';
			}
		} else {
			$json = 'Error!';
		}

		$this->response->setOutput(json_encode($json));
	}
	
	public function install() {
		if (!$this->user->hasPermission('modify', $this->module_path)) {
			$this->language->load('module/linkedinlogin');
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->response->redirect($this->url->link($this->module_path, 'token=' . $this->session->data['token'], 'SSL'));
		} else {

			$vqmod_file = IMODULE_ROOT . 'vqmod/xml/linkedin_login_redirect.xml_';
			$vqmod_new_file = IMODULE_ROOT . 'vqmod/xml/linkedin_login_redirect.xml';
			
			if (file_exists($vqmod_file) && is_writeable($vqmod_file)) {
				rename($vqmod_file, $vqmod_new_file);
			}
		}
	}
	
	public function uninstall() {
		if (!$this->user->hasPermission('modify', $this->module_path)) {
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->response->redirect($this->url->link($this->module_path, 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			$this->model_setting_setting->deleteSetting($this->moduleName,0);
			$this->model_setting_setting->deleteSetting($this->moduleData_module,0);
			$stores=$this->model_setting_store->getStores();
			foreach ($stores as $store) {
				$this->model_setting_setting->deleteSetting($this->moduleName, $store['store_id']);
				$this->model_setting_setting->deleteSetting($this->moduleData_module, $store['store_id']);
			}

			$vqmod_file = IMODULE_ROOT . 'vqmod/xml/linkedin_login_redirect.xml';
			$vqmod_new_file = IMODULE_ROOT . 'vqmod/xml/linkedin_login_redirect.xml_';
			if (file_exists($vqmod_file) && is_writeable($vqmod_file)) {
				rename($vqmod_file, $vqmod_new_file);
			}
		}
	}

	private function getCatalogURL() {
        if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
            $storeURL = HTTPS_CATALOG;
        } else {
            $storeURL = HTTP_CATALOG;
        } 
        return $storeURL;
    }

    private function getServerURL() {
        if (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) {
            $storeURL = HTTPS_SERVER;
        } else {
            $storeURL = HTTP_SERVER;
        } 
        return $storeURL;
    }

    private function getCurrentStore($store_id) {    
        if($store_id && $store_id != 0) {
            $store = $this->model_setting_store->getStore($store_id);
        } else {
            $store['store_id'] = 0;
            $store['name'] = $this->config->get('config_name');
            $store['url'] = $this->getCatalogURL(); 
        }
        return $store;
    }
	
	protected function validateForm() {
		if (!$this->user->hasPermission('modify', $this->module_path)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
	
}
?>