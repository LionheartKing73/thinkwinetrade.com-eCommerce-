<?php
/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModuleTestimonial extends Controller {
    private $codename = 'testimonial';
    private $route = 'd_visual_designer_module/testimonial';

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
    }
    
    public function index($setting){

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['setting']['comment'] = html_entity_decode(htmlspecialchars_decode($data['setting']['comment']), ENT_QUOTES, 'UTF-8');

        $this->load->model('tool/image');

        if (isset($data['setting']['image']) && is_file(DIR_IMAGE . $data['setting']['image'])) {
            $data['thumb'] = $this->model_tool_image->resize($data['setting']['image'], 96, 96);
        }
        else{
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 96, 96);
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

        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_comment'] = $this->language->get('entry_comment');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['setting']['comment'] = html_entity_decode(htmlspecialchars_decode($data['setting']['comment']), ENT_QUOTES, 'UTF-8');
        
        $this->load->model('tool/image');
        
        if (isset($data['setting']['image']) && is_file(DIR_IMAGE . $data['setting']['image'])) {
            $image = $data['setting']['image'];
        }
        else{
            $image = 'no_image.png';
        }
        
        
        $data['thumb'] = $this->model_tool_image->resize($image, 100, 100);
        
        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

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