<?php
class ControllerCommonAdminFooter extends Controller {
	public function index() {
		$this->load->model('design/layout');

		
		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'admin';
		}

		$layout_id = $this->model_design_layout->getLayoutByRout($route);
		
		$this->load->model('extension/module');

		$data['modules'] = array();

		$modules = $this->model_design_layout->getLayoutModules($layout_id, 'admin_footer');

		foreach ($modules as $module) {
			$part = explode('.', $module['code']);

			if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
				$data['modules'][] = $this->load->controller('module/' . $part[0].'/admin');
			}

			if (isset($part[1])) {
				$setting_info = $this->model_extension_module->getModule($part[1]);

				if ($setting_info && $setting_info['status']) {
					$data['modules'][] = $this->load->controller('module/' . $part[0].'/admin', $setting_info);
				}
			}
		}


			return $this->load->view('common/admin_footer.tpl', $data);
		}
}