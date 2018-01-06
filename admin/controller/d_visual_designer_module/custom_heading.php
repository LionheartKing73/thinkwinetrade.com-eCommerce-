<?php
/*
*	location: admin/controller
*/

class ControllerDVisualDesignerModuleCustomHeading extends Controller {
    private $codename = 'custom_heading';
    private $route = 'd_visual_designer_module/custom_heading';
    
    public function __construct($registry) {
        parent::__construct($registry);
        $this->load->language($this->route);
        $this->load->model('d_visual_designer/designer');
    }
    
    public function index($setting){

        $data['entry_text'] = $this->language->get('entry_text');
        $data['entry_font_family'] = $this->language->get('entry_font_family');

        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['setting']['text'] = html_entity_decode(htmlspecialchars_decode($data['setting']['text']), ENT_QUOTES, 'UTF-8');
        
        $data['unique_id'] = substr( md5(rand()), 0, 7);
        
        return $this->load->view($this->route.'.tpl', $data);
    }
    public function setting($setting){

        $data['entry_text'] = $this->language->get('entry_text');
        $data['entry_align'] = $this->language->get('entry_align');
        $data['entry_tag'] = $this->language->get('entry_tag');
        $data['entry_font_size'] = $this->language->get('entry_font_size');
        $data['entry_line_height'] = $this->language->get('entry_line_height');
        $data['entry_color'] = $this->language->get('entry_color');
        $data['entry_link'] = $this->language->get('entry_link');
        $data['entry_font_family'] = $this->language->get('entry_font_family');
        
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['tags'] = array('h1','h2','h3','h4','h5','h6','p','div');
        
        $data['aligns'] = array(
            'left' => $this->language->get('text_left'),
            'center' => $this->language->get('text_center'),
            'right' => $this->language->get('text_right')
            );
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}