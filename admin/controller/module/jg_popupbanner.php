<?php
	class ControllerModuleJGPopupBanner extends Controller { //--- Controller => MVC ---
		//--- All form error ---
		private $error = array();
		//--- end All form error ---

		public function index() //--- controller first run ----
		{
			//--- Default Load ---
			$data = $this->load->language('module/jg_popupbanner'); //--- Quick set language text ---
			$this->document->setTitle($this->language->get('heading_title')); //--- Set Module Title Name ----
			
			$this->load->model('design/jg_popupbanner'); //--- Load common model (MVC) ----
			$this->load->model('tool/image'); //--- Load image model ---
			$this->load->model('extension/module'); //--- Load default model ---
			//--- End Default Load ---

			//--- Submit form and checking part ---
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate() == true) {
				//--- Save all data ---
				$all_data = array();
				$all_data["all_post"] = $this->request->post;
				$this->model_design_jg_popupbanner->update_common_setting($all_data); //--- Update common setting ---
				
				$all_data = array();
				$all_data["all_post"] = $this->request->post;
				$this->model_design_jg_popupbanner->update_setting($all_data); //--- Update default setting ---
				
				
				//--- Add this module record in opencart [Can Design Layout] ---
				//--- mange post data ---
				$this_request_post = array();
				foreach($this->request->post as $this_key => $this_value){
					if($this_key == "title"){
						$this_request_post[$this_key] = $this_value;
						$this_request_post["name"] = $this_value;
					}else{
						$this_request_post[$this_key] = $this_value;
					}
				}
				
				if($this_request_post["is_popup"] == ""){
					$this_request_post["is_popup"] = "N";	
				}
				//--- eng mange post data ---
				
				if (empty($this->request->get['module_id'])) {
					$this->model_extension_module->addModule('jg_popupbanner', $this_request_post);
				} else {
					$this->model_extension_module->editModule($this->request->get['module_id'], $this_request_post);
				}
				//--- End Add this module record in opencart [Can Design Layout] ---
			
				//--- End Save all data ---
				
				$this->session->data['success'] = $this->language->get('text_success'); //--- Session Success messgae ---
				
				//--- Redirect extension page ---
				$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}else{

				//--- Get all data ---
				$all_data = array();
				$all_return_data = array();
				$all_return_data = $this->model_design_jg_popupbanner->get_common_setting($all_data);
				$all_common_setting_return_data = $all_return_data["common_setting"];
				
				$this_image = "";
				foreach($all_common_setting_return_data as $index => $this_return_data){
					foreach($this_return_data  as $this_key => $this_value){
						$data[$this_key] = $this_value;
						
						if($this_key == "bannerfile"){
							$this_image = $this_value;
						}
					}
				}
				//--- End Get all data ---
				
				//--- Manage image section ---
				if (!empty($all_common_setting_return_data) && is_file(DIR_IMAGE . $this_image)) {
					$data['thumb'] = $this->model_tool_image->resize($this_image, 100, 100);
				} else {
					$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
				}
		
				$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
				//--- End Manage image section ---

				$all_setting_return_data = $all_return_data["setting"];
				$data['status'] = $all_setting_return_data[0]["value"];
				
				
				
			}
			//--- End Submit form and Checking part ---



			//--- Assign the language data for parsing it to view ----
			$data['heading_title'] = $this->language->get('heading_title');

			//--- assign form submit action path ---
			$data['action'] = $this->url->link('module/jg_popupbanner', 'token=' . $this->session->data['token']."&module_id=".(!empty($this->request->get['module_id']) ? $this->request->get['module_id'] : ""), 'SSL');
			
			//--- assign form canel action path ---
			$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

			//--- assign breadcrumbs part into view ---
			$data['breadcrumbs'] = array();
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'), // come from /language/english/english.php
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
			);
	
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_jg_module'), // come from /language/english/english.php
				'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
			);
	
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/jg_popupbanner', 'token=' . $this->session->data['token'], 'SSL')
			);
			//--- End assign breadcrumbs part into view ---
			
			
			//--- assign form text part ---
			$data['button_save'] = $this->language->get('button_save');
			$data['button_cancel'] = $this->language->get('button_cancel');
			//--- end assign form text part ---
			
			//--- End Assign the language data for parsing it to view ----
			
			//--- assign error part ---
			if (isset($this->error['error_title'])) {
				$data['error_title'] = $this->error['error_title'];
			} else {
				$data['error_title'] = '';
			}
			//--- end assign error part ---
			
			
			
			//--- Assign admin common header, left menu, footer to view ---
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			$this->response->setOutput($this->load->view('module/jg_popupbanner.tpl', $data));
			//--- end Assign admin common header, left menu, footer to view ---			
		}
		
		//--- Check form validate ---
		protected function validate() {
			//---- Check backend user permission ---
			if (!$this->user->hasPermission('modify', 'module/jg_popupbanner')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			//---- end Check backend user permission ---
			
			//--- Check form ---
			if ($this->request->post['title'] == "") {
				$this->error['error_title'] = $this->language->get('error_require');
			}
			//--- end Check form ---

			return (empty($this->error) ? true : false);
		}
		//--- end Check form validate ---
		
		//--- Backend system install function ---
		public function install(){
			$this->load->model('design/jg_popupbanner'); //--- Load model ---
			$this->model_design_jg_popupbanner->install();
		}
		//--- End Backend system install function ---
		
		//--- Backend system Uninstall function ---
		public function uninstall(){        
			$this->load->model('design/jg_popupbanner'); //--- Load model ---
			$this->model_design_jg_popupbanner->uninstall();
		}
		//--- End Backend system Uninstall function ---
	}
?>