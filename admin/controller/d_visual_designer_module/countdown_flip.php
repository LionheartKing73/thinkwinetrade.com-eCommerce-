<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleCountdownFlip extends Controller {
	private $codename = 'countdown_flip';
	private $route = 'd_visual_designer_module/countdown_flip';

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
		$data['entry_display_title'] = $this->language->get('entry_display_title');
		$data['entry_color_number'] = $this->language->get('entry_color_number');
		$data['entry_color_title'] = $this->language->get('entry_color_title');
		$data['entry_background'] = $this->language->get('entry_background');
		$data['entry_scale'] = $this->language->get('entry_scale');
		$data['entry_position'] = $this->language->get('entry_position');
		
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_enabled'] = $this->language->get('text_enabled');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['positions'] = array(
			'center' => $this->language->get('text_center'),
			'left' => $this->language->get('text_left'),
			'right' => $this->language->get('text_right')
		);  

		return $this->load->view($this->route.'_setting.tpl', $data);
	}
}