<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleGMaps extends Controller {
	private $codename = 'gmaps';
	private $route = 'd_visual_designer_module/gmaps';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('module/d_visual_designer');
	}
	
	public function index($setting){
		
		$data['entry_title'] = $this->language->get('entry_title');
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['unique_id'] = uniqid();
		
		$data['link'] = html_entity_decode($data['setting']['link'], ENT_QUOTES, 'UTF-8');
		
		$data['height'] = str_replace('px','',$data['setting']['height']);
		
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
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_height'] = $this->language->get('entry_height');
		
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