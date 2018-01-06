<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleSeparater extends Controller {
	private $codename = 'separater';
	private $route = 'd_visual_designer_module/separater';

	public function __construct($registry) {
		parent::__construct($registry);
		
        $this->load->language($this->route);
		$this->load->model('module/d_visual_designer');
	}
	public function index($setting){
        		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

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
        $data['entry_color'] = $this->language->get('entry_color');
        $data['entry_border_width'] = $this->language->get('entry_border_width');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_align'] = $this->language->get('entry_align');
        $data['entry_style'] = $this->language->get('entry_style');
		
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['aligns'] = array('left','center','right');
        $data['styles'] = array('dotted','dashed','solid','double','groove','ridge','inset','outset');
        
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