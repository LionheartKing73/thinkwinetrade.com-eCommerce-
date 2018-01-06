<?php
/*
*location: admin/controller
*/

class ControllerDVisualDesignerModuleFeedback extends Controller
{
    private $codename = 'feedback';
    private $route = 'd_visual_designer_module/feedback';
    
    private $error = array();
    
    public function __construct($registry)
    {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('d_visual_designer/designer');
    }
    public function index($setting)
    {
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_phone'] = $this->language->get('entry_phone');
        $data['entry_comment'] = $this->language->get('entry_comment');
        
        $data['button_send'] = $this->language->get('button_send');
        
        $data['text_success_send'] = $this->language->get('text_success_send');
        
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $data['fields'] = array();
        
        if (!empty($data['setting']['fields'])) {
            foreach ($data['setting']['fields'] as $key => $value) {
                $data['fields'][] = array(
                    'name' => !empty($value['name'][$this->config->get('config_language_id')])?$value['name'][$this->config->get('config_language_id')]:'',
                    'value' => $value['value']
                    );
            }
        }
        
        $data['unique_id'] = uniqid();
        
        return $this->load->view($this->route.'.tpl', $data);
    }
    public function setting($setting)
    {
        $data['entry_display_name'] = $this->language->get('entry_display_name');
        $data['entry_display_phone'] = $this->language->get('entry_display_phone');
        $data['entry_custom_field'] = $this->language->get('entry_custom_field');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_value'] = $this->language->get('entry_value');
        $data['entry_regex'] = $this->language->get('entry_regex');
        
        $data['button_add'] = $this->language->get('button_add');
        $data['button_remove'] = $this->language->get('button_remove');
        
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);
        
        $this->load->model('localisation/language');
        
        $data['languages'] = $this->model_localisation_language->getLanguages();
        
        foreach ($data['languages'] as $code => $value) {
            $data['languages'][$code]['flag'] = 'language/'.$code.'/'.$code.'.png';
        }
        
        $data['fields'] = $data['setting']['fields'];
        
       return $this->load->view($this->route.'_setting.tpl', $data);
    }
}
