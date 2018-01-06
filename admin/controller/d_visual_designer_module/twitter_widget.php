<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleTwitterWidget extends Controller {
	private $codename = 'twitter_widget';
	private $route = 'd_visual_designer_module/twitter_widget';

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

		$data['entry_href'] = $this->language->get('entry_href');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_color_link'] = $this->language->get('entry_color_link');
		$data['entry_theme'] = $this->language->get('entry_theme');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['themes'] = array(
			'light' => $this->language->get('text_theme_light'),
			'dark' => $this->language->get('text_theme_dark')
		);
		
		return $this->load->view($this->route.'_setting.tpl', $data);
    }
}