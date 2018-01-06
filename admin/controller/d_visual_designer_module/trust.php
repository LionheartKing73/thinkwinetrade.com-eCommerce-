<?php
/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModuleTrust extends Controller {
    private $codename = 'trust';
    private $route = 'd_visual_designer_module/trust';

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model($this->route);
        $this->load->model('d_visual_designer/designer');
    }
    
    public function index($setting){

        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

        return $this->load->view($this->route.".tpl", $data);
    }
    
    public function setting($setting){

        $data['entry_title'] = $this->language->get('entry_title');

        $data['column_image'] = $this->language->get('column_image');
        $data['column_link'] = $this->language->get('column_link');

        $data['button_image_add'] = $this->language->get('button_image_add');
        $data['button_remove'] = $this->language->get('button_remove');

        $data['text_none'] = $this->language->get('text_none');
        
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

        $data['images'] = $this->{'model_d_visual_designer_module_'.$this->codename}->getImages();

        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}