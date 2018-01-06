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
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
		
		$this->load->model('extension/module');
		
		$data['entry_module'] = $this->language->get('entry_module');
		
		if(isset($setting['code'])){
			$data['code'] = html_entity_decode($setting['code']);
		}
		else{
			$data['code'] = 'account';
		}
		
		$code = explode('.', $data['code']);
		
		if(VERSION >= '2.3.0.0'){
			$this->load->language('extension/module/' . $code[0]);
		}
		else{
			$this->load->language('module/' . $code[0]);
		}
		
		if(count($code) > 1){
			$module = $this->model_extension_module->getModule($code[1]);
			$data['name'] = strip_tags($this->language->get('heading_title') . ' &gt; ' . $module['name']);
		}
		else{
			$data['name'] =  strip_tags($this->language->get('heading_title'));
		}
		
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){

		$this->load->model('extension/extension');
		$this->load->model('extension/module');
		
		$data['entry_module'] = $this->language->get('entry_module');
		
		$extensions = $this->model_extension_extension->getInstalled('module');
		$data['extensions'] = array();
		foreach ($extensions as $code) {
			
			if(VERSION >= '2.3.0.0'){
				$this->load->language('extension/module/' . $code);
			}
			else{
				$this->load->language('module/' . $code);
			}
			
			$module_data = array();

			$modules = $this->model_extension_module->getModulesByCode($code);

			foreach ($modules as $module) {
				$module_data[] = array(
					'name' => strip_tags($this->language->get('heading_title') . ' &gt; ' . $module['name']),
					'code' => $code . '.' .  $module['module_id']
					);
			}
	
			if ($this->config->has($code . '_status') || $module_data) {
				$data['extensions'][] = array(
					'name'   => strip_tags($this->language->get('heading_title')),
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
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}