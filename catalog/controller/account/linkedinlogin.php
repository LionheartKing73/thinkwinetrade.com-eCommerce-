<?php 
class ControllerAccountLinkedinLogin extends Controller {
	private $data = array();
	private $error = array();
	      
  	public function index() {
  		$this->load->model('extension/module');
		unset($this->session->data['linkedin_login_details']);
		if ($this->customer->isLogged()) {
	  		$this->closeAndNavigateTo('account/account');
    	}
		
		if (!empty($this->request->get['redirect'])) {
			$this->session->data['linkedinlogin_redirect'] = base64_decode($this->request->get['redirect']);
		}

		if(isset($this->session->data['module_id']) && !empty($this->session->data['module_id'])) {
			$linkedinLoginConfig = $this->model_extension_module->getModule($this->session->data['module_id']);
			unset($this->session->data['module_id']);
		}
		
		$this->language->load('module/linkedinlogin');

			if (!class_exists('LinkedIn')) {		
				require_once(DIR_SYSTEM . '../vendors/linkedin-api/LinkedIn.php');
			}

			$li = new LinkedIn(
			  array(
				'api_key' => $linkedinLoginConfig['APIKey'], 
				'api_secret' => $linkedinLoginConfig['APISecret'], 
				'callback_url' => $this->config->get('config_url').'index.php?route=account/linkedinlogin'
			  )
			);

		$lnkdin = array();

		if (isset($_REQUEST['code'])) {
			try {
				$token = $li->getAccessToken($_REQUEST['code']);
				$token_expires = $li->getAccessTokenExpiration();
				
				$info = $li->get('/people/~:(first-name,last-name,email-address,id)');
			} catch (Exception $e) {
				echo "Configuration error";
				exit;
			}
			
			$lnkdin['first_name'] = $info['firstName'];
			$lnkdin['last_name'] = $info['lastName'];
			$lnkdin['id'] = $info['id'];
			$lnkdin['email'] = $info['emailAddress'];
			$lnkdin['verified'] = true;
		}

		$_SERVERORIG = $_SERVER;
		$_SERVER = $this->htmlspecialcharsDecode($_SERVER);
		$_SERVER = $_SERVERORIG;
		
		$hasId = (!empty($lnkdin['id'])) ? $lnkdin['id'] : false;
		$hasEmail = (!empty($lnkdin['email'])) ? $lnkdin['email'] : false;
		$verified = (!empty($lnkdin['verified'])) ? $lnkdin['verified'] : true;

		if ($hasId && $hasEmail && $verified) {
			$this->load->model('account/customer');

			$email = $lnkdin['email'];
			$email_query = $this->db->query("SELECT `email`, `status`, `approved` FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(strtolower($email)) . "'");

			if ($email_query->num_rows) {
				if (!(int)$email_query->row['status'] || !(int)$email_query->row['approved']) $this->closeAndNavigateTo();
				if ($this->customer->login($email, '', true)) $this->closeAndNavigateTo();
			} else {
				if (defined('VERSION')) {
					if (strcmp(VERSION, '1.5.3') >= 0) {
						$this->load->model('account/customer_group');
					}
				}
				// Create a new customer
				$setting = $linkedinLoginConfig;
				$noextra = true;
				
				foreach ($setting as $index => $value) {
					if (strpos($index, 'Extra') === 0) { $noextra = false; break; }
				}
				
				$customer_group_id = !empty($setting['UseDefaultCustomerGroups']) ? $this->config->get('config_customer_group_id') : $setting['CustomerGroup'];
				
				if (defined('VERSION') && $noextra) {
					if (strcmp(VERSION, '1.5.3') >= 0) {
						if (!empty($setting['UseDefaultCustomerGroups']) && is_array($this->config->get('config_customer_group_display'))) {
							$customer_groups = $this->model_account_customer_group->getCustomerGroups();
							foreach ($customer_groups  as $customer_group) {
								if ((($customer_group['company_id_display'] && !empty($setting['ExtraCompanyId'])) || ($customer_group['tax_id_display'] && !empty($setting['ExtraTaxId']))) && in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
									$noextra = false;
									break;
								}
							}
						} else {
							$customer_group = $this->model_account_customer_group->getCustomerGroup($customer_group_id);
							if (($customer_group['company_id_display'] && !empty($setting['ExtraCompanyId'])) || ($customer_group['tax_id_display'] && !empty($setting['ExtraTaxId']))) {
								$noextra = false;
							}
						}
					}
				}
				
				if ($noextra) { // we know for certain that the countries are disabled
					$this->load->model('localisation/country');
					$country_info = $this->model_localisation_country->getCountry($this->config->get('config_country_id'));
		
					if (!empty($country_info['postcode_required']) && !empty($setting['ExtraPostcode'])) {
						$noextra = false;
					}
				}
				
				$password = substr(md5(uniqid(rand(), true)), 0, 9);
				
				if ($noextra) {
					$newUserData = $this->getBasicUserData();
					$newUserData['customer_group_id'] = $customer_group_id;
					$newUserData['firstname'] = isset($lnkdin['first_name']) ? $lnkdin['first_name'] : '';
					$newUserData['lastname'] = isset($lnkdin['last_name']) ? $lnkdin['last_name'] : '';
					$newUserData['email'] = $lnkdin['email'];
					$newUserData['password'] = $password;
					
					$old_customer_group = $this->config->get('config_customer_group_id');
					$this->config->set('config_customer_group_id', $customer_group_id);
					$this->model_account_customer->addCustomer($newUserData);
					$this->config->set('config_customer_group_id', $old_customer_group);
					
					if (defined('VERSION')) {
						if (strcmp(VERSION, '1.5.3') >= 0) {
							$customer_group = $this->model_account_customer_group->getCustomerGroup($customer_group_id);
							if (!empty($customer_group['approval'])) $this->closeAndNavigateTo('account/success');
						} else {
							$approval = $this->config->get('config_customer_approval');
							if (!empty($approval)) $this->closeAndNavigateTo('account/success');	
						}
					}
					
					if($this->customer->login($email, $password)){
						unset($this->session->data['guest']);
						unset($this->session->data['linkedin_login_details']);
						$this->closeAndNavigateTo(); //$this->closeAndNavigateTo('account/success');
					}
				} else {
					$this->session->data['linkedin_login_details'] = array_merge($lnkdin, array('password' => $password));
					$this->response->redirect($this->url->link('account/linkedinlogin/userdetails', 'module_id='.$linkedinLoginConfig['module_id'], 'SSL'));
				}
			}
		}

		$this->closeAndNavigateTo(); //$this->closeAndNavigateTo('account/login');
	}
	
	private function getBasicUserData() {
		return array(
			'fax' => '',
			'address_1' => '',
			'address_2' => '',
			'city' => '',
			'postcode' => '',
			'telephone' => '',
			'country_id' => $this->config->get('config_country_id'),
			'tax_id' => '',
			'company_id' => '',
			'company' => '',
			'zone_id' => $this->config->get('config_zone_id'),
			'firstname' => '',
			'lastname' => '',
			'email' => '',
			'password' => '',
			'customer_group_id' => $this->config->get('config_customer_group_id')
		);	
	}
	
	public function submit() {
		$this->load->model('extension/module');

		if(isset($this->request->get['module_id']) && !empty($this->request->get['module_id']))
				$module_id = $this->request->get['module_id'];

		if (empty($this->session->data['linkedin_login_details'])) $this->closeAndNavigateTo(); //$this->closeAndNavigateTo('account/login');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate(true, $module_id)) {
			$data = array_merge($this->getBasicUserData(), $this->request->post, array(
				'firstname' => isset($this->session->data['linkedin_login_details']['first_name']) ? $this->session->data['linkedin_login_details']['first_name'] : '',
				'lastname' => isset($this->session->data['linkedin_login_details']['last_name']) ? $this->session->data['linkedin_login_details']['last_name'] : '',
				'email' => isset($this->session->data['linkedin_login_details']['email']) ? $this->session->data['linkedin_login_details']['email'] : '',
				'password' => isset($this->session->data['linkedin_login_details']['password']) ? $this->session->data['linkedin_login_details']['password'] : ''
			));
			
			$this->load->model('account/customer');
			
			if (defined('VERSION')) {
				if (strcmp(VERSION, '1.5.3') < 0) {
					$setting = $this->config->get('linkedinlogin');
					$setting = $setting[$this->config->get('config_store_id')];
					$data['customer_group_id'] = !empty($setting['UseDefaultCustomerGroups']) ? $this->config->get('config_customer_group_id') : $setting['CustomerGroup'];
				}
			}
			
			$customer_group = $this->config->get('config_customer_group_id');
			$this->config->set('config_customer_group_id', $data['customer_group_id']);
			$this->model_account_customer->addCustomer($data);
			$this->config->set('config_customer_group_id', $customer_group);
			
			if (defined('VERSION')) {
				if (strcmp(VERSION, '1.5.3') >= 0) {
					$this->load->model('account/customer_group');
					$customer_group = $this->model_account_customer_group->getCustomerGroup($data['customer_group_id']);
					if (!empty($customer_group['approval'])) $this->closeAndNavigateTo('account/success');
				} else {
					$approval = $this->config->get('config_customer_approval');
					if (!empty($approval)) $this->closeAndNavigateTo('account/success');	
				}
			}
			
			$this->customer->login($data['email'], $data['password']);
			
			unset($this->session->data['guest']);
			unset($this->session->data['linkedin_login_details']);
			
			// Default Shipping Address
			if ($this->config->get('config_tax_customer') == 'shipping') {
				$this->session->data['shipping_country_id'] = $data['country_id'];
				$this->session->data['shipping_zone_id'] = $data['zone_id'];
				$this->session->data['shipping_postcode'] = $data['postcode'];				
			}
			
			// Default Payment Address
			if ($this->config->get('config_tax_customer') == 'payment') {
				$this->session->data['payment_country_id'] = $data['country_id'];
				$this->session->data['payment_zone_id'] = $data['zone_id'];			
			}
					  	  
	  		$this->closeAndNavigateTo(); //$this->closeAndNavigateTo('account/success');
    	}
	}
	
	public function userdetails() {
		$this->load->model('extension/module');
		if (empty($this->session->data['linkedin_login_details'])) $this->closeAndNavigateTo(); //$this->closeAndNavigateTo('account/login');
		
		if (defined('VERSION')) {
			if (strcmp(VERSION, '1.5.3') >= 0) {
				$this->load->model('account/customer_group');
			}
		}

		if(isset($this->request->get['module_id']) && !empty($this->request->get['module_id']))
			$setting = $this->model_extension_module->getModule($this->request->get['module_id']);
		
		$this->language->load('checkout/checkout');
		$this->language->load('module/linkedinlogin');
		
		$this->data['lang'] = $this->language->get('code');
		$this->data['text_your_details'] = $this->language->get('text_your_details');
		$this->data['text_customer_group'] = $this->language->get('text_customer_group');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_company_id'] = $this->language->get('entry_company_id');
		$this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
		$this->data['entry_address_1'] = $this->language->get('entry_address_1');
		$this->data['entry_address_2'] = $this->language->get('entry_address_2');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_newsletter'] = sprintf($this->language->get('entry_newsletter'), $this->config->get('config_name'));
		$this->data['button_submit'] = $this->language->get('button_submit');
		$this->data['entry_fax'] = $this->language->get('entry_fax');
		$this->data['enabled'] = $this->getEnabled($setting);
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		$this->data['base'] = $server;
		
		$this->data['has_customer_group'] = false;
		if (defined('VERSION')) {
			if (strcmp(VERSION, '1.5.3') >= 0) {
				$this->data['has_customer_group'] = true;
				$this->data['customer_group_id'] = !empty($setting['UseDefaultCustomerGroups']) ? $this->config->get('config_customer_group_id') : $setting['CustomerGroup'];
				$this->data['customer_groups'] = array();
		
				if (!empty($setting['UseDefaultCustomerGroups']) && is_array($this->config->get('config_customer_group_display'))) {
					
					$customer_groups = $this->model_account_customer_group->getCustomerGroups();
					
					foreach ($customer_groups  as $customer_group) {
						if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
							$this->data['customer_groups'][] = $customer_group;
						}
					}
				} else {
					$this->data['customer_groups'][] = 	$this->model_account_customer_group->getCustomerGroup($this->data['customer_group_id']);
				}
			}
		}
		
		$this->load->model('localisation/country');
		$this->data['countries'] = $this->model_localisation_country->getCountries();
		$this->data['country_id'] = $this->config->get('config_country_id');
		
		$this->data['zone_id'] = $this->config->get('config_zone_id');
		$this->data['submit_url'] = $this->url->link('account/linkedinlogin/submit', 'module_id='.$setting['module_id'], 'SSL');
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');
			
			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));
			
			if ($information_info) {
				$this->data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/info', 'information_id=' . $this->config->get('config_account_id'), 'SSL'), $information_info['title'], $information_info['title']);
			} else {
				$this->data['text_agree'] = '';
			}
		} else {
			$this->data['text_agree'] = '';
		}

		if(version_compare(VERSION, '2.2.0.0', "<")) {
		    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/linkedinlogin/userdetails.tpl')) {
				return $this->load->view($this->config->get('config_template').'/template/module/linkedinlogin/userdetails.tpl', $this->data);
			} else {
				return $this->load->view('default/template/module/linkedinlogin/userdetails.tpl', $this->data);
			}
		} else {
		       return $this->load->view('module/linkedinlogin/userdetails', $this->data);
		}
		
	}
	
	public function validate($inline = false, $module_id=0) {
		$this->load->model('extension/module');
		$this->language->load('checkout/checkout');
		$error = array();

		if(isset($module_id) && !empty($module_id))
				$configuration= $this->model_extension_module->getModule($this->request->get['module_id']);
		else if(isset($this->request->get['module_id']) && !empty($this->request->get['module_id']))
				$configuration= $this->model_extension_module->getModule($this->request->get['module_id']);
		else
				$configuration = array();
		
		$enabled = $this->getEnabled($configuration);
		
		foreach($this->request->post as $index => $value) {
			$this->request->post[$index] = trim($value);
		}
		
		if ($enabled['telephone'])
			if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
				$error['telephone'] = $this->language->get('error_telephone');
			}
		
		if (defined('VERSION')) {
			if (strcmp(VERSION, '1.5.3') >= 0) {
				// Customer Group
				$this->load->model('account/customer_group');
				
				if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$customer_group_id = $this->request->post['customer_group_id'];
				} else {
					$customer_group_id = $this->config->get('config_customer_group_id');
				}
		
				$customer_group = $this->model_account_customer_group->getCustomerGroup($customer_group_id);
				
			}
		}
		
		if ($enabled['address'])
			if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128)) {
				$error['address_1'] = $this->language->get('error_address_1');
			}
		
		if ($enabled['city'])
			if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
				$error['city'] = $this->language->get('error_city');
			}

		$this->request->post['country_id'] = empty($this->request->post['country_id']) ? $this->config->get('config_country_id') : $this->request->post['country_id'];

		$this->load->model('localisation/country');
		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

		if ($enabled['country'] || $enabled['postcode'] || $this->config->get('config_vat') || $country_info['postcode_required']) {
			
			if ($country_info) {
				if ($enabled['postcode'] && $country_info['postcode_required'] && ((utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10))) {
					$error['postcode'] = $this->language->get('error_postcode');
				}
				
				if (defined('VERSION')) {
					if (strcmp(VERSION, '1.5.3') >= 0) {
						// VAT Validation
						$this->load->helper('vat');
						
						if ($enabled['tax_id'] && $this->config->get('config_vat') && $this->request->post['tax_id'] && (vat_validation($country_info['iso_code_2'], $this->request->post['tax_id']) == 'invalid')) {
							$error['tax_id'] = $this->language->get('error_vat');
						}
					}
				}
			} else {
				$error['country'] = $this->language->get('error_country');	
			}
		}

		if ($enabled['country'])
			if ($this->request->post['country_id'] == '') {
				$error['country_id'] = $this->language->get('error_country');
			}
		
		if ($enabled['region'])
			if ($this->request->post['zone_id'] == '') {
				$error['zone_id'] = $this->language->get('error_zone');
			}

		if ($this->config->get('config_account_id') && $enabled['privacy']) {
			$this->load->model('catalog/information');
			
			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));
			
			if ($information_info && !isset($this->request->post['agree'])) {
      			$error['agree'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}
		
		if ($inline) {
			if (empty($error)) {
				return true;
			} else {
				return false;
			}
		} else {
			$json = empty($error) ? array() : array('error' => $error);
			$this->response->setOutput(json_encode($json));	
		}
  	}
	
	function getEnabled($setting = array()) {
		
		return array(
			'telephone' => !empty($setting['ExtraTelephone']),
			'company' => !empty($setting['ExtraCompany']),
			'fax' => !empty($setting['ExtraFax']),
			'address' => !empty($setting['ExtraAddress']),
			'city' => !empty($setting['ExtraCity']),
			'postcode' => !empty($setting['ExtraPostcode']),
			'country' => !empty($setting['ExtraCountry']),
			'region' => !empty($setting['ExtraRegion']),
			'privacy' => !empty($setting['ExtraPrivacy']),
			'newsletter' => !empty($setting['ExtraNewsletter']),
			'company_id' => !empty($setting['ExtraCompanyId']),
			'tax_id' => !empty($setting['ExtraTaxId'])
		);
	}
	
	function closeAndNavigateTo($route = false) {
		if (!empty($this->session->data['linkedinlogin_redirect'])) {
			$route = '"'.str_replace('account/logout', 'account/account', $this->session->data['linkedinlogin_redirect']).'"';
			unset($this->session->data['linkedinlogin_redirect']);
		} else {
			$route = $route === false ? 'window.opener.location.href.replace("account/logout", "account/account")' : '"'. $this->url->link(str_replace('account/logout', 'account/account', $route), '', 'SSL') .'"';
		}
		
		echo '<script> if(window.opener) { window.opener.location.href = '.$route.'; window.close(); } </script>'; exit;
	}
	
	function htmlspecialcharsDecode($data) {
    	if (is_array($data)) {
	  		foreach ($data as $key => $value) {
				unset($data[$key]);
				$data[$this->htmlspecialcharsDecode($key)] = $this->htmlspecialcharsDecode($value);
	  		}
		} else { 
	  		$data = htmlspecialchars_decode($data, ENT_COMPAT);
		}

		return $data;
	}
	
	public function country() {
		$json = array();
		
		$this->load->model('localisation/country');

    	$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);
		
		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']		
			);
		}
		
		$this->response->setOutput(json_encode($json));
	}		  

}
?>