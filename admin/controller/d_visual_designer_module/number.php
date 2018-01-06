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
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
	
		return $this->load->view($this->route.'.tpl', $data);
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
		
		
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

		return $this->load->view($this->route.'_setting.tpl', $data);
	}
}