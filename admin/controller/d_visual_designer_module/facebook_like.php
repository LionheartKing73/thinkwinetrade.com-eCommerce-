<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleFacebookLike extends Controller {
	private $codename = 'facebook_like';
	private $route = 'd_visual_designer_module/facebook_like';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
        
        $data['entry_type'] = $this->language->get('entry_type');
        
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['type_button'] = $this->language->get('text_'.$data['setting']['type_button']);
		
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){

		$data['base'] = HTTP_SERVER;

        $data['entry_type'] = $this->language->get('entry_type');
		
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['types'] = array(
            'standard' => $this->language->get('text_standard'),
            'box_count' => $this->language->get('text_box_count'),
            'button_count' => $this->language->get('text_button_count'),
        );
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}