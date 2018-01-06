<?php
/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModuleTextSeparater extends Controller {
    private $codename = 'text_separater';
    private $route = 'd_visual_designer_module/text_separater';

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('d_visual_designer/designer');
    }
    public function index($setting){

        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_font_family'] = $this->language->get('entry_font_family');

        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        return $this->load->view($this->route.'.tpl', $data);
    }
    public function setting($setting){
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_title_align'] = $this->language->get('entry_title_align');
        $data['entry_color_title'] = $this->language->get('entry_color_title');
        $data['entry_font_family'] = $this->language->get('entry_font_family');
        $data['entry_font_size'] = $this->language->get('entry_font_size');

        $data['entry_border_width'] = $this->language->get('entry_border_width');
        $data['entry_border_style'] = $this->language->get('entry_border_style');
        $data['entry_border_color'] = $this->language->get('entry_border_color');

        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_align'] = $this->language->get('entry_align');

        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['aligns'] = array(
            'left' => $this->language->get('text_align_left'),
            'center' => $this->language->get('text_align_center'),
            'right' => $this->language->get('text_align_right')
        );
        $data['styles'] = array('dotted','dashed','solid','double','groove','ridge','inset','outset');
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}