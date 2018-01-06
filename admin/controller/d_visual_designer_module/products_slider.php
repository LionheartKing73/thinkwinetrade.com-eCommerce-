<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleProductsSlider extends Controller {
	private $codename = 'products_slider';
	private $route = 'd_visual_designer_module/products_slider';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
		
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_mode'] = $this->language->get('entry_mode');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['mode'] = $this->language->get('text_'.$data['setting']['mode']);
		
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){

        $data['entry_title'] = $this->language->get('entry_title');
		$data['entry_count'] = $this->language->get('entry_count');
		$data['entry_interval'] = $this->language->get('entry_interval');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_mode'] = $this->language->get('entry_mode');
		$data['entry_count_product'] = $this->language->get('entry_count_product');
		
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['modes'] = array(
			'latest' => $this->language->get('text_latest'),
			'bestseller' => $this->language->get('text_bestseller'),
			'popular' => $this->language->get('text_popular'),
			'special' => $this->language->get('special')
		);
		
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}