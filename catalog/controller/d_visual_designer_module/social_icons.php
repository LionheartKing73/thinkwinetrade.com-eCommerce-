<?php
/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModuleSocialIcons extends Controller {
    private $codename = 'social_icons';
    private $route = 'd_visual_designer_module/social_icons';

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
    }
    
    public function index($setting){

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

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

        $data['text_facebook'] = $this->language->get('text_facebook');
        $data['text_twitter'] = $this->language->get('text_twitter');
        $data['text_google_plus'] = $this->language->get('text_google_plus');
        $data['text_vk'] = $this->language->get('text_vk');

        $data['entry_link'] = $this->language->get('entry_link');
        $data['entry_color'] = $this->language->get('entry_color');
        $data['entry_background'] = $this->language->get('entry_background');

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

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