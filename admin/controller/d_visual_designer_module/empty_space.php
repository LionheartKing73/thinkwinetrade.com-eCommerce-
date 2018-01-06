<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleEmptySpace extends Controller {
	private $codename = 'empty_space';
	private $route = 'd_visual_designer_module/empty_space';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
        
        $data['entry_height'] = $this->language->get('entry_height');
        
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){
		
        $data['entry_height'] = $this->language->get('entry_height');
		
	    $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['types'] = array(
            'standard' => $this->language->get('text_standard'),
            'box_count' => $this->language->get('text_box_count'),
            'button_count' => $this->language->get('text_button_count'),
        );
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}