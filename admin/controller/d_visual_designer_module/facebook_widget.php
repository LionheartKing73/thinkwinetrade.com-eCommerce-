<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleFacebookWidget extends Controller {
	private $codename = 'facebook_widget';
	private $route = 'd_visual_designer_module/facebook_widget';

	public function __construct($registry) {
		parent::__construct($registry);
		
		$this->load->language($this->route);
		$this->load->model('d_visual_designer/designer');
	}
	
	public function index($setting){
                
		$data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
		
		$data['unique_id'] = uniqid();
		
		return $this->load->view($this->route.".tpl", $data);

	}
	
    public function setting($setting){
		
		$data['entry_href'] = $this->language->get('entry_href');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_tabs'] = $this->language->get('entry_tabs');
		$data['entry_show_facepile'] = $this->language->get('entry_show_facepile');
		$data['entry_small_header'] = $this->language->get('entry_small_header');
		
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
		
		
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

        $data['tabs'] = array(
            'timeline' => $this->language->get('text_tab_timeline'),
            'events' => $this->language->get('text_tab_events'),
            'messages' => $this->language->get('text_tab_messages'),
        );
        
		return $this->load->view($this->route.'_setting.tpl', $data);

    }
}