<?php
class ControllerCommonLayoutHeader extends Controller {
	public function index($position) {

	$this->load->model('design/layout');

		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'common/home';
		}

		$layout_id = 0;

		if ($route == 'product/category' && isset($this->request->get['path'])) {
			$this->load->model('catalog/category');

			$path = explode('_', (string)$this->request->get['path']);

			$layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));
		}

		if ($route == 'product/product' && isset($this->request->get['product_id'])) {
			$this->load->model('catalog/product');

			$layout_id = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);
		}

		if ($route == 'information/information' && isset($this->request->get['information_id'])) {
			$this->load->model('catalog/information');

			$layout_id = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);
		}

		if (!$layout_id) {
			$layout_id = $this->model_design_layout->getLayout($route);
		}

		if (!$layout_id) {
			$layout_id = $this->config->get('config_layout_id');
		}

		$this->load->model('extension/module');

		$data['modules'] = array();
		
		$modules = $this->model_design_layout->getLayoutModules($layout_id, $position);

		foreach ($modules as $module) {
			$part = explode('.', $module['code']);

			if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
				$module_data = $this->load->controller('module/' . $part[0]);

				if ($module_data) {
					$data['modules'][] = $module_data;
				}
			}

			if (isset($part[1])) {
				$setting_info = $this->model_extension_module->getModule($part[1]);

				if ($setting_info && $setting_info['status']) {
					$module_data = $this->load->controller('module/' . $part[0], $setting_info);

					if ($module_data) {
						$data['modules'][] = $module_data;
					}
				}
			}
		}


		if(VERSION >= '2.2.0.0' ){ 
			$template = 'common/layouts/' . $position . '';
		}else{		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/layouts/' . $position . '.tpl')) {
				$template = $this->config->get('config_template') . '/template/common/layouts/' . $position . '.tpl';
			} else {
				$template = 'default/template/common/layouts/' . $position . '.tpl';
			}
		}	
		
		return $this->load->view($template, $data);
	}
	
	
	
	public function layoutPositions(){
		$layout_positions = array(
		
				'above_header',
				'above_hd_lt',					
				'above_hd_rt',					
				'above_hd_pm_lt',					
				'above_hd_pm_md',					
				'above_hd_pm_rt',	
				'above_hd_btm',	
				
				'below_header',
				'below_hd_lt',					
				'below_hd_rt',					
				'below_hd_pm_lt',					
				'below_hd_pm_md',					
				'below_hd_pm_rt',	
				'below_hd_btm',	
			);
		return $layout_positions;
	}
}
