<?php
/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModuleCountdownFlip extends Controller {
    private $codename = 'countdown_flip';
    private $route = 'd_visual_designer_module/countdown_flip';

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
    }
    
    public function index($setting){

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['time'] = 0;

        if(!empty($data['setting']['datetime'])){
            $time = strtotime($data['setting']['datetime']) - time();
            if($time > 0){
                $data['time'] = $time;
            }
        }
        
        $data['unique_id'] = uniqid();
        
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

        $data['entry_datetime'] = $this->language->get('entry_datetime');
        $data['entry_display_title'] = $this->language->get('entry_display_title');
        $data['entry_color_number'] = $this->language->get('entry_color_number');
        $data['entry_color_title'] = $this->language->get('entry_color_title');
        $data['entry_background'] = $this->language->get('entry_background');
        $data['entry_scale'] = $this->language->get('entry_scale');
        $data['entry_position'] = $this->language->get('entry_position');
        
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_enabled'] = $this->language->get('text_enabled');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['positions'] = array(
            'center' => $this->language->get('text_center'),
            'left' => $this->language->get('text_left'),
            'right' => $this->language->get('text_right')
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