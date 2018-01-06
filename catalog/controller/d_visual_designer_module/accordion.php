<?php
/*
 *    location: admin/controller
 */

class ControllerDVisualDesignerModuleAccordion extends Controller
{
    private $codename = 'accordion';
    private $route = 'd_visual_designer_module/accordion';

    public function __construct($registry)
    {
        parent::__construct($registry);

        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
    }

    public function index($setting)
    {
        $data['button_add'] = $this->language->get('button_add');

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

        if (VERSION >= '2.2.0.0') {
            return $this->load->view($this->route, $data);
        } else {
            if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/'.$this->route.'.tpl')) {
                return $this->load->view($this->config->get('config_template').'/template/'.$this->route.'.tpl', $data);
            } else {
                return $this->load->view('default/template/'.$this->route.'.tpl', $data);
            }
        }
    }

    public function setting($setting)
    {
        $data['entry_active_section'] = $this->language->get('entry_active_section');
        $data['entry_align'] = $this->language->get('entry_align');
        $data['entry_title'] = $this->language->get('entry_title');

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

        if (VERSION >= '2.2.0.0') {
            return $this->load->view($this->route.'_setting', $data);
        } else {
            if (file_exists(DIR_TEMPLATE.$this->config->get('config_template').'/template/'.$this->route.'_setting.tpl')) {
                return $this->load->view($this->config->get('config_template').'/template/'.$this->route.'_setting.tpl', $data);
            } else {
                return $this->load->view('default/template/'.$this->route.'_setting.tpl', $data);
            }
        }
    }
}
