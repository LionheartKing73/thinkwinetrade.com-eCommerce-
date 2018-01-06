<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleRoundChart extends Controller {
	private $codename = 'round_chart';
	private $route = 'd_visual_designer_module/round_chart';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('module/d_visual_designer');
	}
	
	public function index($setting){
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['labels'] = array();
		$data['values'] = array();
		$data['colors'] = array();
		
		foreach ($data['setting']['values'] as $value) {
			$data['labels'][] = $value['label'];
			$data['values'][] = $value['value'];
			$data['colors'][] = $value['color'];
		}
		
		
		$data['unique_id'] = uniqid();
		
		switch ($data['setting']['animate']) {
			case 'easeoutbounce':
				$data['animate'] = 'easeOutBounce';
			break;
			case 'easeoutelastic':
				$data['animate'] = 'easeOutElastic';
			break;
			case 'easeoutback':
				$data['animate'] = 'easeOutBack';
			break;
			case 'easeinoutcubic':
				$data['animate'] = 'easeInOutCubic';
			break;
			case 'easeinoutquint':
				$data['animate'] = 'easeInOutQuint';
			break;
			case 'easeinoutquart':
				$data['animate'] = 'easeInOutQuart';
			break;
			case 'easeinquad':
				$data['animate'] = 'easeInQuad';
			break;
			case 'easeoutsine':
				$data['animate'] = 'easeOutSine';
			break;
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
		
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_label'] = $this->language->get('entry_label');
		$data['entry_color'] = $this->language->get('entry_color');
		$data['entry_value'] = $this->language->get('entry_value');
		$data['entry_values'] = $this->language->get('entry_values');
		$data['entry_modes'] = $this->language->get('entry_modes');
		$data['entry_gap'] = $this->language->get('entry_gap');
		$data['entry_animate'] = $this->language->get('entry_animate');
		$data['entry_display_legend'] = $this->language->get('entry_display_legend');

		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_enabled'] = $this->language->get('text_enabled');
		
		
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add'] = $this->language->get('button_add');
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['modes'] = array(
			'pie' => $this->language->get('text_pie'),
			'doughnut' => $this->language->get('text_doughnut')
		);
		
		$data['animates'] = array(
			'easeoutbounce' => $this->language->get('text_easeOutBounce'),
			'easeoutelastic' => $this->language->get('text_easeOutElastic'),
			'easeoutback' => $this->language->get('text_easeOutBack'),
			'easeinoutcubic' => $this->language->get('text_easeInOutCubic'),
			'easeinoutquint' => $this->language->get('text_easeinOutQuint'),
			'easeinoutquart' => $this->language->get('text_easeInOutQuart'),
			'easeinquad' => $this->language->get('text_easeinQuad'),
			'easeoutsine' => $this->language->get('text_easeOutSine'),
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