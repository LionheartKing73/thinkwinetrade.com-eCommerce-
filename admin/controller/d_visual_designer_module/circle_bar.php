<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleCircleBar extends Controller {
	private $codename = 'circle_bar';
	private $route = 'd_visual_designer_module/circle_bar';

	public function __construct($registry) {
		parent::__construct($registry);
		
        $this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
		
		$data['entry_color'] = $this->language->get('entry_color');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['unique_id'] = uniqid();
			
		return $this->load->view($this->route.'.tpl', $data);
	}
	
	public function setting($setting){

        $data['entry_title'] = $this->language->get('entry_title');
		$data['entry_value'] = $this->language->get('entry_value');
		$data['entry_units'] = $this->language->get('entry_units');
		$data['entry_label_value'] = $this->language->get('entry_label_value');
		$data['entry_color'] = $this->language->get('entry_color');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
		return $this->load->view($this->route.'_setting.tpl', $data);
    }
}