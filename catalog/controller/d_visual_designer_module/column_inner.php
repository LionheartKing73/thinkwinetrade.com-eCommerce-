<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleColumnInner extends Controller {
	
	private $codename = 'column_inner';
	private $route = 'd_visual_designer_module/column_inner';

	public function __construct($registry) {
		parent::__construct($registry);
        $this->load->language($this->route);
		$this->load->model('module/d_visual_designer');
	}
    public function index($setting){
		
        $data['button_add'] = $this->language->get('button_add');
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		if(isset($setting['unique_id'])){
			$data['unique_id'] = $setting['unique_id'];
		}
		else{
			$data['unique_id'] = substr(md5(rand()), 0, 7);
		}
		
		if(VERSION>='2.2.0.0') {
			return $this->load->view($this->route, $data);
		}
		else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->route.'.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/'.$this->route.'.tpl', $data);
			} else {
				return $this->load->view('default/template/'.$this->route.'.tpl', $data);
			}
		}
    }
	public function setting($setting){

        $data['entry_size'] = $this->language->get('entry_size');
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['sizes'] = array(
			'1' => '1/12',
			'2' => '2/12',
			'3' => '3/12',
			'4' => '4/12',
			'5' => '5/12',
			'6' => '6/12',
			'7' => '7/12',
			'8' => '8/12',
			'9' => '9/12',
			'10' => '10/12',
			'11' => '11/12',
			'12' => '12/12'
		);
		
		if(VERSION>='2.2.0.0') {
			return $this->load->view($this->route.'_setting', $data);
		}
		else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->route.'_setting.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/'.$this->route.'_setting.tpl', $data);
			} else {
				return $this->load->view('default/template/'.$this->route.'_setting.tpl', $data);
			}
		}
    }
}