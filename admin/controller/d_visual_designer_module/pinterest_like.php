<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModulePinterestLike extends Controller {
	private $codename = 'pinterest_like';
	private $route = 'd_visual_designer_module/pinterest_like';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
        
        $data['entry_type_button'] = $this->language->get('entry_type_button');
        
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['type_button'] =  $this->language->get("text_".$data['setting']['type_button']);
		
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){
		
        $data['entry_type_button'] = $this->language->get('entry_type_button');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['types'] = array(
            'horizontal' => $this->language->get('text_horizontal'),
            'vertical' => $this->language->get('text_vertical'),
            'none' => $this->language->get('text_none')
        );
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}