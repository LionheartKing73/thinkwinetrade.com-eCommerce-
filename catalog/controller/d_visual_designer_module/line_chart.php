<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleLineChart extends Controller {
	private $codename = 'line_chart';
	private $route = 'd_visual_designer_module/line_chart';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('module/d_visual_designer');
	}
	
	public function index($setting){
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
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
			default:
				$data['animate'] = 'easeOutBounce';
			break;
		}
		
		$data['setting_chart'] = array(
			'labels' => explode(';',$data['setting']['x_values']),
			'datasets' => array()
		);
		
		foreach ($data['setting']['values'] as $value) {
			if($data['setting']['mode'] == 'line'){
				$data['setting_chart']['datasets'][] = array(
					'label' => $value['label'],
					'data' => explode(',',$value['value']),
					'borderColor' => $value['color'],
					'backgroundColor' => $this->changeColor($value['color'])
				);
			}
			else{
				$data['setting_chart']['datasets'][] = array(
					'label' => $value['label'],
					'data' => explode(',',$value['value']),
					'backgroundColor' => $value['color']	
				);
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
		
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_label'] = $this->language->get('entry_label');
		$data['entry_value'] = $this->language->get('entry_value');
		$data['entry_values'] = $this->language->get('entry_values');
		$data['entry_modes'] = $this->language->get('entry_modes');
		$data['entry_color'] = $this->language->get('entry_color');
		$data['entry_animate'] = $this->language->get('entry_animate');
		$data['entry_x_values'] = $this->language->get('entry_x_values');
		$data['entry_display_legend'] = $this->language->get('entry_display_legend');

		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_enabled'] = $this->language->get('text_enabled');
		
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_add'] = $this->language->get('button_add');
		
		$data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
		
		$data['modes'] = array(
			'bar' => $this->language->get('text_bar'),
			'line' => $this->language->get('text_line')
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
	
	protected function changeColor($color){
		$res_color = $color;
		if(strrpos($color, 'rgb')){
			list($r, $g, $b) = sscanf($color, "rgb(%d,%d,%d)");
			$res_color = "rgba($r,$g,$b,0.1)";
		}
		elseif (strrpos($color, 'rgba')) {
			list($r, $g, $b, $a) = sscanf($color, "rgba(%d,%d,%d,%d)");
			$a = $a/2;
			$res_color = "rgba($r,$g,$b,$a)";
		}
		else{
			list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
			$res_color = "rgba($r,$g,$b,0.1)";
		}
		return $res_color;
	}
}