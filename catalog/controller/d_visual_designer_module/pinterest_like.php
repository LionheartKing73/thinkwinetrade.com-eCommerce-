<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModulePinterestLike extends Controller {
	private $codename = 'pinterest_like';
	private $route = 'd_visual_designer_module/pinterest_like';

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
		
        $data['entry_type_button'] = $this->language->get('entry_type_button');
		
    	$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['types'] = array(
            'horizontal' => $this->language->get('text_horizontal'),
            'vertical' => $this->language->get('text_vertical'),
            'none' => $this->language->get('text_none')
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