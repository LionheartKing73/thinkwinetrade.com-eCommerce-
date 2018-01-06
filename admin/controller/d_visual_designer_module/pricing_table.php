<?php
/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModulePricingTable extends Controller {
    private $codename = 'pricing_table';
    private $route = 'd_visual_designer_module/pricing_table';

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

        $data['entry_color_text'] = $this->language->get('entry_color_text');
        $data['entry_width_between'] = $this->language->get('entry_width_between');
        
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}
