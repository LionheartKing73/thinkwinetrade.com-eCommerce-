<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleCountdown extends Controller {
	private $codename = 'countdown';
	private $route = 'd_visual_designer_module/countdown';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){

		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['unique_id'] = uniqid();
		
		return $this->load->view($this->route.".tpl", $data);
	}
	
	public function setting($setting){

		$data['entry_datetime'] = $this->language->get('entry_datetime');
		$data['entry_display_week'] = $this->language->get('entry_display_week');
		$data['entry_display_title'] = $this->language->get('entry_display_title');
		$data['entry_style'] = $this->language->get('entry_style');
		$data['entry_color_number'] = $this->language->get('entry_color_number');
		$data['entry_color_title'] = $this->language->get('entry_color_title');
		$data['entry_background'] = $this->language->get('entry_background');
		$data['entry_border_color'] = $this->language->get('entry_border_color');
		
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_enabled'] = $this->language->get('text_enabled');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		return $this->load->view($this->route.'_setting.tpl', $data);
	}
}