<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleIcon extends Controller {
	private $codename = 'icon';
	private $route = 'd_visual_designer_module/icon';

	public function __construct($registry) {
		parent::__construct($registry);
	    	
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){

		$data['entry_icon'] = $this->language->get('entry_icon');
		$data['entry_color'] = $this->language->get('entry_color');

		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

		$data['setting']['icon'] = preg_replace('/^(fa-)/','fa fa-', $data['setting']['icon']);
		
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){
				
        $data['entry_icon_library'] = $this->language->get('entry_icon_library');
        $data['entry_icon'] = $this->language->get('entry_icon');
		$data['entry_color'] = $this->language->get('entry_color');
		$data['entry_background_style'] = $this->language->get('entry_background_style');
		$data['entry_background_color'] = $this->language->get('entry_background_color');
		$data['entry_size'] = $this->language->get('entry_size');
		$data['entry_align'] = $this->language->get('entry_align');
		$data['entry_link'] = $this->language->get('entry_link');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

	    $data['setting']['icon'] = preg_replace('/^(fa-)/','fa fa-', $data['setting']['icon']);

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

		$data['sizes'] = array(
			'xs'=>'Mini',
			'sm'=>'Small',
			'md'=>'Normal',
			'lg'=>'Large',
			'xl'=>'Extra Large'
		);
		$data['aligns'] = array(
			'flex-start'=>'left',
			'center'=>'center',
			'flex-end'=>'right'
		);
		$data['styles'] = array(
			'rounded'=>'Circle',
			'boxed'=>'Square',
			'rounded-less'=>'Rounded',
			'rounded-outline'=>'Outline Circle',
			'boxed-outline'=>'Outline Square',
			'rounded-less-outline'=>'Outline Rounded'
		);

		$data['base'] = HTTP_SERVER;
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}