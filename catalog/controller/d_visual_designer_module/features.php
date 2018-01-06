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
        $this->load->model('module/d_visual_designer');
    }
    
    public function index($setting){

        $this->load->model('tool/image');

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['setting']['text'] = html_entity_decode(htmlspecialchars_decode($data['setting']['text']), ENT_QUOTES, 'UTF-8');

        $this->load->model('tool/image');
        
        if (isset($data['setting']['image']) && is_file(DIR_IMAGE . $data['setting']['image'])) {
            $image = $data['setting']['image'];
        }
        else{
            $image = 'no_image.png';
        }
        
        if($data['setting']['size'] == 'original' || $data['setting']['size'] == 'responsive'){
            list($width, $height) = getimagesize(DIR_IMAGE . $image);
        }
        elseif ($data['setting']['size'] == 'small'){
            $width = $this->config->get($this->config->get('config_theme') . '_image_category_width');
            $height = $this->config->get($this->config->get('config_theme') . '_image_category_height');
        }
        elseif ($data['setting']['size'] == 'medium'){
            $width = 300;
            $height = 94;
        }
        elseif ($data['setting']['size'] == 'large'){
            $width = 600;
            $height = 188;
        }
        elseif ($data['setting']['size'] == 'custom'){
            $width = $data['setting']['width'];
            $height = $data['setting']['height'];
        }
        
        $data['width'] = $width;
        
        $data['height'] = $height;
        
        $data['thumb'] = $this->model_tool_image->resize($image, $width, $height);
        
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

        $data['entry_text'] = $this->language->get('entry_text');
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_alt'] = $this->language->get('entry_alt');
        $data['entry_size'] = $this->language->get('entry_size');
        $data['entry_image_position'] = $this->language->get('entry_image_position');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_height'] = $this->language->get('entry_height');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
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