<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleRowInner extends Controller {
	private $codename = 'row_inner';
	private $route = 'd_visual_designer_module/row_inner';

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
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}