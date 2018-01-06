<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleCode extends Controller {
	private $codename = 'code';
	private $route = 'd_visual_designer_module/code';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['setting']['code'] = html_entity_decode(htmlspecialchars_decode($data['setting']['code']), ENT_QUOTES, 'UTF-8');
	
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){

        $data['entry_code'] = $this->language->get('entry_code');
		
	    $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['setting']['code'] = html_entity_decode(htmlspecialchars_decode($data['setting']['code']), ENT_QUOTES, 'UTF-8');
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}