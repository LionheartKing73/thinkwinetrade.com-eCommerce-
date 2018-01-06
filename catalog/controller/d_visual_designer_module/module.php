<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleModule extends Controller {
	private $codename = 'module';
	private $route = 'd_visual_designer_module/module';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('module/d_visual_designer');
	}
	
	public function index($setting){
		
		$this->load->model('extension/module');
		
		$part = explode('.', $setting['code']);
		
		if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
			if(VERSION >= '2.3.0.0'){
				$data['text'] = $this->load->controller('extension/module/' . $part[0]);
			}
			else{
				$data['text'] = $this->load->controller('module/' . $part[0]);
			}
		}
		
		if (isset($part[1])) {
			$setting_info = $this->model_extension_module->getModule($part[1]);
			if ($setting_info && $setting_info['status']) {
				if(VERSION >= '2.3.0.0'){
					$data['text'] = $this->load->controller('extension/module/' . $part[0], $setting_info);
				}
				else{
					$data['text'] = $this->load->controller('module/' . $part[0], $setting_info);
				}
			}
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

		$this->load->model($this->route);
		
		$data['entry_module'] = $this->language->get('entry_module');
		
		$extensions = $this->model_d_visual_designer_module_module->getInstalled('module');
		$data['extensions'] = array();
		foreach ($extensions as $code) {
			
			if(VERSION >= '2.3.0.0'){
				$this->load->language('extension/module/' . $code);
			}
			else{
				$this->load->language('module/' . $code);
			}
			
			$module_data = array();

			$modules = $this->model_d_visual_designer_module_module->getModulesByCode($code);

			foreach ($modules as $module) {
				$module_data[] = array(
					'name' => strip_tags($code . ' &gt; ' . $module['name']),
					'code' => $code . '.' .  $module['module_id']
					);
			}
	
			if ($this->config->has($code . '_status') || $module_data) {
				$data['extensions'][] = array(
					'name'   => strip_tags($code),
					'code'   => $code,
					'module' => $module_data
					);
			}
		}
		if(isset($setting['code'])){
			$data['code'] = $setting['code'];
		}
		else{
			$data['code'] = '';
		}
        
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