<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleSeparater extends Controller {
	private $codename = 'separater';
	private $route = 'd_visual_designer_module/separater';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
        
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
        $data['aligns'] = array('left','center','right');
        $data['styles'] = array('dotted','dashed','solid','double','groove','ridge','inset','outset');
		
		return $this->load->view($this->route.'.tpl', $data);
	}
	
    public function setting($setting){
		
        $data['entry_color'] = $this->language->get('entry_color');
        $data['entry_border_width'] = $this->language->get('entry_border_width');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_align'] = $this->language->get('entry_align');
        $data['entry_style'] = $this->language->get('entry_style');
		
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['aligns'] = array('left','center','right');
        $data['styles'] = array('dotted','dashed','solid','double','groove','ridge','inset','outset');
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}