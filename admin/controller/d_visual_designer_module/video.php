<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleVideo extends Controller {
	private $codename = 'video';
	private $route = 'd_visual_designer_module/video';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	public function index($setting){
		
		$data['text_link'] = $this->language->get('text_link');
		
    	$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
        return $this->load->view($this->route.'.tpl', $data);
    }
	
    public function setting($setting){
        $data['entry_link'] = $this->language->get('entry_link');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_ratio'] = $this->language->get('entry_ratio');
        
        $this->load->model('tool/image');

		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['ratios'] = array(
			'169' => '16:9',
			'43' => '4:3',
			'235' => '2.35:1'
		);

        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}