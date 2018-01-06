<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleNumber extends Controller {
	private $codename = 'number';
	private $route = 'd_visual_designer_module/number';

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

        $data['entry_number'] = $this->language->get('entry_number');
        $data['entry_thousand_separator'] = $this->language->get('entry_thousand_separator');
        $data['entry_duration'] = $this->language->get('entry_duration');
        $data['entry_font_size'] = $this->language->get('entry_font_size');
        $data['entry_font_bold'] = $this->language->get('entry_font_bold');
        $data['entry_color'] = $this->language->get('entry_color');
		
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