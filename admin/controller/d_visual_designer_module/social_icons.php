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
        $this->load->model('d_visual_designer/designer');
    }
    
    public function index($setting){

        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

        return $this->load->view($this->route.".tpl", $data);
    }
    
    public function setting($setting){

        $data['text_facebook'] = $this->language->get('text_facebook');
        $data['text_twitter'] = $this->language->get('text_twitter');
        $data['text_google_plus'] = $this->language->get('text_google_plus');
        $data['text_vk'] = $this->language->get('text_vk');

        $data['entry_link'] = $this->language->get('entry_link');
        $data['entry_color'] = $this->language->get('entry_color');
        $data['entry_background'] = $this->language->get('entry_background');

        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}