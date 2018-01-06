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
        $this->load->model('d_visual_designer/designer');
    }

    public function index($setting){

        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

        return $this->load->view($this->route.".tpl", $data);
    }

    public function setting($setting){

        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_rating'] = $this->language->get('entry_rating');
        $data['entry_size'] = $this->language->get('entry_size');


        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

        $data['sizes'] = array(
            '1' => $this->language->get('text_size_1'),
            '2' => $this->language->get('text_size_2'),
            '3' => $this->language->get('text_size_3'),
            '4' => $this->language->get('text_size_4'),
            '5' => $this->language->get('text_size_5')
            );

        $data['ratings'] = array('1','2','3','4','5');

        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}