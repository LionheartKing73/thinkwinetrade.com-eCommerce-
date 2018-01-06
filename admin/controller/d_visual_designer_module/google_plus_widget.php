<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleGooglePlusWidget extends Controller {
	private $codename = 'google_plus_widget';
	private $route = 'd_visual_designer_module/google_plus_widget';

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
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_showcoverphoto'] = $this->language->get('entry_showcoverphoto');
		$data['entry_showtagline'] = $this->language->get('entry_showtagline');
		$data['entry_theme'] = $this->language->get('entry_theme');
		$data['entry_type'] = $this->language->get('entry_type');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		    
		$data['themes'] = array(
            'light' => $this->language->get('text_theme_light'),
            'dark' => $this->language->get('text_theme_dark')
        );
		
		$data['layouts'] = array(
            'landscape' => $this->language->get('text_layout_landscape'),
            'portrait' => $this->language->get('text_layout_portrait')
        );
		
		$data['types'] = array(
            'profile' => $this->language->get('text_type_profile'),
            'page' => $this->language->get('text_type_page'),
            'community' => $this->language->get('text_type_community')
        );
		
		return $this->load->view($this->route.'_setting.tpl', $data);
    }
}