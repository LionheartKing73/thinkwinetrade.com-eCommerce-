<?php
/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModuleFeatures extends Controller {
    private $codename = 'features';
    private $route = 'd_visual_designer_module/features';

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('d_visual_designer/designer');
    }
    
    public function index($setting){

        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        return $this->load->view($this->route.'.tpl', $data);
    }
    
    public function setting($setting){

        $data['entry_text'] = $this->language->get('entry_text');
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_alt'] = $this->language->get('entry_alt');
        $data['entry_size'] = $this->language->get('entry_size');
        $data['entry_image_position'] = $this->language->get('entry_image_position');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_height'] = $this->language->get('entry_height');
        
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['setting']['text'] = html_entity_decode(htmlspecialchars_decode($data['setting']['text']), ENT_QUOTES, 'UTF-8');

        $this->load->model('tool/image');
        
        if (isset($data['setting']['image']) && is_file(DIR_IMAGE . $data['setting']['image'])) {
            $image = $data['setting']['image'];
        }
        else{
            $image = 'no_image.png';
        }

        $data['thumb'] = $this->model_tool_image->resize($image, 100, 100);
        
        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
        
        $data['sizes'] = array(
            'original' => $this->language->get('text_original'),
            'responsive' => $this->language->get('text_responsive'),
            'small' => $this->language->get('text_small'),
            'medium' => $this->language->get('text_medium'),
            'large' => $this->language->get('text_large'),
            'custom' => $this->language->get('text_custom')
            );  
        
        $data['image_positions'] = array(
            'top' => $this->language->get('text_position_image_top'),
            'left_top' => $this->language->get('text_position_style_image_left_top'),
            'left' => $this->language->get('text_position_style_image_left')
            );

        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}