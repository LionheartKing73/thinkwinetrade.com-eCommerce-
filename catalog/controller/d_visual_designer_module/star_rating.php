<?php
/*
 *    location: admin/controller
 */

class ControllerDVisualDesignerModuleStarRating extends Controller {
    private $codename = 'star_rating';
    private $route = 'd_visual_designer_module/star_rating';

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
    }

    public function index($setting){

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

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
        $data['entry_rating'] = $this->language->get('entry_rating');
        $data['entry_size'] = $this->language->get('entry_size');


        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

        $data['sizes'] = array(
            '1' => $this->language->get('text_size_1'),
            '2' => $this->language->get('text_size_2'),
            '3' => $this->language->get('text_size_3'),
            '4' => $this->language->get('text_size_4'),
            '5' => $this->language->get('text_size_5')
            );

        $data['ratings'] = array('1','2','3','4','5');

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