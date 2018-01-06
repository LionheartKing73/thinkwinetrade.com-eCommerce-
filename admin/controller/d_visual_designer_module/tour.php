<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleTour extends Controller {
	private $codename = 'tour';
	private $route = 'd_visual_designer_module/tour';

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
		
		$data['entry_active_section'] = $this->language->get('entry_active_section');
    	$data['entry_align'] = $this->language->get('entry_align');
    	$data['entry_title'] = $this->language->get('entry_title');

		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

		$data['aligns'] = array(
			'left' => $this->language->get('text_left'),
			'center' => $this->language->get('text_center'),
			'right' => $this->language->get('text_right'),
		);
		
        return $this->load->view($this->route.'_setting.tpl', $data);
    }

}