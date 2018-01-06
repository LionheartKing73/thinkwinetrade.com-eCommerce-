<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleProgressBar extends Controller {
	private $codename = 'progress_bar';
	private $route = 'd_visual_designer_module/progress_bar';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('module/d_visual_designer');
	}
	
	public function index($setting){
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['unique_id'] = uniqid();
		
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
		
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_units'] = $this->language->get('entry_units');
		$data['entry_color'] = $this->language->get('entry_color');
		$data['entry_label'] = $this->language->get('entry_label');
		$data['entry_value'] = $this->language->get('entry_value');
		$data['entry_color'] = $this->language->get('entry_color');
		$data['entry_values'] = $this->language->get('entry_values');
		$data['entry_modes'] = $this->language->get('entry_modes');
		$data['entry_animate'] = $this->language->get('entry_animate');
		$data['entry_stripes'] = $this->language->get('entry_stripes');
		
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add'] = $this->language->get('button_add');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

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