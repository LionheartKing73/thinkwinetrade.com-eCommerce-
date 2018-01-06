<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleGooglePlusLike extends Controller {
	private $codename = 'google_plus_like';
	private $route = 'd_visual_designer_module/google_plus_like';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
        
        $data['entry_size'] = $this->language->get('entry_size');
        
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['size'] = $this->language->get('text_'.$data['setting']['size']);
		
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){

        $data['entry_size'] = $this->language->get('entry_size');
		
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['sizes'] = array(
            'small' => $this->language->get('text_small'),
            'medium' => $this->language->get('text_medium'),
            'standard' => $this->language->get('text_standard'),
            'tall' => $this->language->get('text_tall'),
        );
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}