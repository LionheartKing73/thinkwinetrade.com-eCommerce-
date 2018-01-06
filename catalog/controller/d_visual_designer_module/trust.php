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
        $this->load->model('module/d_visual_designer');
    }
    
    public function index($setting){

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $this->load->model('tool/image');

        $data['images'] = array();
        
        foreach ($data['setting']['images'] as $value) {
            if (isset($value) && is_file(DIR_IMAGE . $value['image'])) {
                $image = $value['image'];
            }
            else{
                $image = 'no_image.png';
            }
            
            list($width, $height) = getimagesize(DIR_IMAGE . $image);
            
            $thumb = $this->model_tool_image->resize($image, $width, $height);
            
            $data['images'][] = array(
                'thumb' => $thumb,
                'link' => $value['link']
                );
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

        $data['entry_title'] = $this->language->get('entry_title');

        $data['column_image'] = $this->language->get('column_image');
        $data['column_link'] = $this->language->get('column_link');

        $data['button_image_add'] = $this->language->get('button_image_add');
        $data['button_remove'] = $this->language->get('button_remove');

        $data['text_none'] = $this->language->get('text_none');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

        $data['images'] = $this->{'model_d_visual_designer_module_'.$this->codename}->getImages();

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