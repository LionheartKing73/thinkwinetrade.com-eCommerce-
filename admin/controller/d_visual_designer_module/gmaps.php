<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleGMaps extends Controller {
	private $codename = 'gmaps';
	private $route = 'd_visual_designer_module/gmaps';

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
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_height'] = $this->language->get('entry_height');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}