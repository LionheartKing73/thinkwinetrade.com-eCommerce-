<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleMessageBox extends Controller {
	private $codename = 'message_box';
	private $route = 'd_visual_designer_module/message_box';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
	
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){
		
		$data['entry_icon_library'] = $this->language->get('entry_icon_library');
        $data['entry_presets'] = $this->language->get('entry_presets');
		$data['entry_style'] = $this->language->get('entry_style');
		$data['entry_share'] = $this->language->get('entry_share');
		$data['entry_color'] = $this->language->get('entry_color');
		$data['entry_border_color'] = $this->language->get('entry_border_color');
		$data['entry_icon'] = $this->language->get('entry_icon');
		$data['entry_text'] = $this->language->get('entry_text');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['libraries'] = array(
			'fontawesome' => 'Font Awesome',
			'glyphicon' => 'Glyphicons',
			'ionicons' => 'Open Ionic',
			'mapicons' => 'Map Icons',
			'material' => 'Material Design Iconic Font',
			'typeicon' => 'Typeicons',
			'elusive' => 'Elusive Icons',
			'octicon' => 'Octicons',
			'weather' => 'Weather Icons'
		);
		
		$data['styles'] = array(
			'' => $this->language->get('text_standard'),
			'solid' => $this->language->get('text_solid'),
			'solid_icon' => $this->language->get('text_solid_icon'),
			'outline' => $this->language->get('text_outline'),
			'3d' => $this->language->get('text_3d'),
		);
		
		$data['shares'] = array(
			'square' => $this->language->get('text_square'),
			'rounded' => $this->language->get('text_rounded'),
			'round' => $this->language->get('text_round')
		);
		
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}