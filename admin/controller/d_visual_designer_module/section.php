<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleSection extends Controller {
	private $codename = 'section';
	private $route = 'd_visual_designer_module/section';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
    public function index($setting){

        $data['button_add'] = $this->language->get('button_add');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
        return $this->load->view($this->route.'.tpl', $data);
    }
    public function setting($setting){
		$data = array();
		
		$data['entry_section_id'] = $this->language->get('entry_section_id');
		$data['entry_title'] = $this->language->get('entry_title');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
        return $this->load->view($this->route.'_setting.tpl', $data);
    }

}