<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleCode extends Controller {
	private $codename = 'code';
	private $route = 'd_visual_designer_module/code';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('module/d_visual_designer');
	}
	
	public function index($setting){
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['setting']['code'] = html_entity_decode(htmlspecialchars_decode($data['setting']['code']), ENT_QUOTES, 'UTF-8');

		if(VERSION>='2.2.0.0') {
			return $this->load->view($this->route, $data);
		}
		else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->route.'.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/'.$this->route.'.tpl', $data);
			} else {
				return $this->load->view('default/template/'.$this->route.'.tpl', $data);
			}
		}
	}
	public function setting($setting){

		$data['entry_code'] = $this->language->get('entry_code');
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['setting']['code'] = html_entity_decode(htmlspecialchars_decode($data['setting']['code']), ENT_QUOTES, 'UTF-8');

		if(VERSION>='2.2.0.0') {
			return $this->load->view($this->route.'_setting', $data);
		}
		else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->route.'_setting.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/'.$this->route.'_setting.tpl', $data);
			} else {
				return $this->load->view('default/template/'.$this->route.'_setting.tpl', $data);
			}
		}
	}
}