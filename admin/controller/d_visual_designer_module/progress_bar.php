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
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
		
		$data['entry_title'] = $this->language->get('entry_title');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		return $this->load->view($this->route.'.tpl', $data);
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
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}