<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleSearchProducts extends Controller {
	private $codename = 'search_products';
	private $route = 'd_visual_designer_module/search_products';

	public function __construct($registry) {
		parent::__construct($registry);
		
        $this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
		
		$data['entry_title'] = $this->language->get('entry_title');
		
		$data['text_search'] = $this->language->get('text_search');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['unique_id'] = uniqid();
			
		return $this->load->view($this->route.'.tpl', $data);
	}
	
	public function setting($setting){
		
		$data['entry_title'] = $this->language->get('entry_title');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
		return $this->load->view($this->route.'_setting.tpl', $data);
    }
}