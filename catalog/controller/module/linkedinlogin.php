<?php  
class ControllerModuleLinkedinLogin extends Controller {
	
	
	private $data  = array();
	private $error = array();
	private $module_path;	
	private $language_variables;

	public function __construct($registry){
		parent::__construct($registry);
		$this->load->config('isenselabs/linkedinlogin');
		$this->module_path       = $this->config->get('linkedinlogin_path');
		$this->language_variables = $this->load->language($this->module_path);
    	//Loading framework models
	 	$this->load->model('setting/store');
		$this->load->model('setting/setting');
        $this->load->model('localisation/language');

		$this->data['module_path']       = $this->module_path;  
	}
	public function index($config) {

		foreach ($this->language_variables as $code => $languageVariable) {
		    $this->data[$code] = $languageVariable;
		} 

      	$this->data['heading_title'] = $this->language->get('heading_title');
		
      	$login_ssl = isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'));

		if(!$this->customer->isLogged()){
			if ($login_ssl) {
				$configuration = str_replace('http', 'https', $this->config->get('linkedinlogin'));
			} else {
				$configuration = $this->config->get('linkedinlogin');
			}
			
			$this->data['data']['LinkedinLogin'] = $config;
			
			if (!empty($this->data['data']['LinkedinLogin']['status']) && $this->data['data']['LinkedinLogin']['status'] == '1') {

				$this->data['url_login'] = html_entity_decode($this->url->link($this->module_path.'/display', 'module_id='.$this->data['data']['LinkedinLogin']['module_id'], $login_ssl ? 'SSL' : 'NONSSL'));
				
				if (file_exists('catalog/view/theme/' . $this->getConfigTemplate() . '/stylesheet/linkedinlogin.css')) {
					$this->document->addStyle('catalog/view/theme/' .  $this->getConfigTemplate() . '/stylesheet/linkedinlogin.css');
				} else {
					$this->document->addStyle('catalog/view/theme/default/stylesheet/linkedinlogin.css');
				}
				
				if(!isset($this->data['data']['LinkedinLogin']['ButtonName_'.$this->config->get('config_language')])){
					$this->data['data']['LinkedinLogin']['ButtonLabel'] = 'Login with Linkedin';
				} else {
					$this->data['data']['LinkedinLogin']['ButtonLabel'] = $this->data['data']['LinkedinLogin']['ButtonName_'.$this->config->get('config_language')];
				}
				
				if(!isset($this->data['data']['LinkedinLogin']['WrapperTitle_'.$this->config->get('config_language')])){
					$this->data['data']['LinkedinLogin']['WrapperTitle'] = 'Login';
				} else {
					$this->data['data']['LinkedinLogin']['WrapperTitle'] = $this->data['data']['LinkedinLogin']['WrapperTitle_'.$this->config->get('config_language')];
				}
	
			

				if(version_compare(VERSION, '2.2.0.0', "<")) {
				    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->module_path.'/linkedinlogin.tpl')) {
						return $this->load->view($this->config->get('config_template').'/template/'.$this->module_path.'/linkedinlogin.tpl', $this->data);
					} else {
						return $this->load->view('default/template/'.$this->module_path.'/linkedinlogin.tpl', $this->data);
					}
				} else {
				       return $this->load->view($this->module_path.'/linkedinlogin.tpl', $this->data);
				}

			}
		}
	}
	
	public function display() {		
		$this->load->model('extension/module');
      	$login_ssl = isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'));

		if ($login_ssl) {
			$configuration = str_replace('http', 'https', $this->config->get('linkedinlogin'));
		} else {
			$configuration = $this->config->get('linkedinlogin');
		}
		
		if(isset($this->request->get['module_id']) && !empty($this->request->get['module_id']))
			$this->data['data']['LinkedinLogin'] = $this->model_extension_module->getModule($this->request->get['module_id']);

		$this->session->data['module_id'] = $this->data['data']['LinkedinLogin']['module_id'];

		if (isset($this->data['data']['LinkedinLogin']['APIKey']) && isset($this->data['data']['LinkedinLogin']['APISecret'])
			 && !empty($this->data['data']['LinkedinLogin']['APIKey']) && !empty($this->data['data']['LinkedinLogin']['APISecret']) ) {
			
			if (!class_exists('LinkedIn')) {	
				require_once(DIR_SYSTEM . '../vendors/linkedin-api/LinkedIn.php');
				
				$li = new LinkedIn(
				  array(
					'api_key' => $this->data['data']['LinkedinLogin']['APIKey'], 
					'api_secret' => $this->data['data']['LinkedinLogin']['APISecret'], 
					'callback_url' => $this->config->get('config_url').'index.php?route=account/linkedinlogin'
				  )
				);
			
				echo $li->getLoginUrl(
				  array(
					LinkedIn::SCOPE_BASIC_PROFILE, 
					LinkedIn::SCOPE_EMAIL_ADDRESS
				  )
				);
		
			}
		} else {
			echo "index.php?route='.$this->module_path.'/configerror";
			exit;
		}
		
		unset($this->session->data['linkedinlogin_redirect']);
		exit;
	}
	
	public function configerror() {
		echo "Configuraion error:<br /><br />You have not set up the module correctly. Please set API key and API Secret Key.";
		exit;
	}

	private function getConfigTemplate(){
		if(version_compare(VERSION, '2.2.0.0', '<')) {
			return $this->config->get('config_template');
		} else {
			return  $this->config->get($this->config->get('config_theme') . '_directory');
		}
	}

}
?>