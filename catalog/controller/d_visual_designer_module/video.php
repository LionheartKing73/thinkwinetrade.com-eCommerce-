<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleVideo extends Controller {
	private $codename = 'video';
	private $route = 'd_visual_designer_module/video';

	public function __construct($registry) {
		parent::__construct($registry);
		
        $this->load->language($this->route);
		$this->load->model('module/d_visual_designer');
	}
	public function index($setting){
        
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['setting']['link'] = str_replace("watch?v=","embed/",$data['setting']['link']);
		
		$data['setting']['link'] = str_replace("vimeo.com","player.vimeo.com/video",$data['setting']['link']);
		
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
        $data['entry_link'] = $this->language->get('entry_link');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_ratio'] = $this->language->get('entry_ratio');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['ratios'] = array(
			'169' => '16:9',
			'43' => '4:3',
			'235' => '2.35:1'
		);
		
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