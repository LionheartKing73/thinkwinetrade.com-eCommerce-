<?php

/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModulePricingTableSection extends Controller
{
    private $codename = 'pricing_table_section';
    private $route = 'd_visual_designer_module/pricing_table_section';
    
    public function __construct($registry)
    {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
    }
    
    public function index($setting)
    {
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['setting']['feautures'] = explode(',', $data['setting']['feautures']);
        
        $data['unique_id'] = uniqid();
        
        
        if (VERSION >= '2.2.0.0') {
            return $this->load->view($this->route, $data);
        } else {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/' . $this->route . '.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/' . $this->route . '.tpl',
                    $data);
            } else {
                return $this->load->view('default/template/' . $this->route . '.tpl', $data);
            }
        }
    }
    
    public function setting($setting)
    {
        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_subtitle'] = $this->language->get('entry_subtitle');
        $data['entry_display_icon'] = $this->language->get('entry_display_icon');
        $data['entry_icon_library'] = $this->language->get('entry_icon_library');
        $data['entry_icon'] = $this->language->get('entry_icon');
        $data['entry_currency'] = $this->language->get('entry_currency');
        $data['entry_price'] = $this->language->get('entry_price');
        $data['entry_per'] = $this->language->get('entry_per');
        $data['entry_feautures'] = $this->language->get('entry_feautures');
        $data['entry_display_button'] = $this->language->get('entry_display_button');
        $data['entry_button_text'] = $this->language->get('entry_button_text');
        $data['entry_button_link'] = $this->language->get('entry_button_link');
        $data['entry_button_color_text'] = $this->language->get('entry_button_color_text');
        $data['entry_button_background'] = $this->language->get('entry_button_background');
        $data['entry_button_border_width'] = $this->language->get('entry_button_border_width');
        $data['entry_button_border_color'] = $this->language->get('entry_button_border_color');
        $data['entry_background'] = $this->language->get('entry_background');
        $data['entry_button_style'] = $this->language->get('entry_button_style');
        $data['entry_shadow'] = $this->language->get('entry_shadow');
        $data['entry_style'] = $this->language->get('entry_style');
        $data['entry_color_text'] = $this->language->get('entry_color_text');
        $data['entry_align_feauture'] = $this->language->get('entry_align_feauture');
        $data['entry_button_padding_bottom'] = $this->language->get('entry_button_padding_bottom');
        $data['entry_button_padding_top'] = $this->language->get('entry_button_padding_top');
        
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_enabled'] = $this->language->get('text_enabled');
        
        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_icon'] = $this->language->get('tab_icon');
        $data['tab_button'] = $this->language->get('tab_button');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['libraries'] = array(
            'fontawesome' => 'Font Awesome',
            'glyphicon' => 'Glyphicons',
            'ionicons' => 'Open Ionic',
            'mapicons' => 'Map Icons',
            'material' => 'Material Design Iconic Font',
            'typeicon' => 'Typeicons',
            'elusive' => 'Elusive Icons',
            'octicon' => 'Octicons',
            'weather' => 'Weather Icons'
        );
        
        $data['styles'] = array(
            'style_1' => $this->language->get('text_style_1'),
            'style_2' => $this->language->get('text_style_2')
        );
        
        $data['button_styles'] = array(
            'square' => $this->language->get('text_button_style_square'),
            'rounded' => $this->language->get('text_button_style_rounded')
        );
    
        $data['aligns'] = array(
            'left' => $this->language->get('text_left'),
            'center' => $this->language->get('text_center'),
            'right' => $this->language->get('text_right')
        );
        
        if (VERSION >= '2.2.0.0') {
            return $this->load->view($this->route . '_setting', $data);
        } else {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/' . $this->route . '_setting.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/' . $this->route . '_setting.tpl',
                    $data);
            } else {
                return $this->load->view('default/template/' . $this->route . '_setting.tpl', $data);
            }
        }
    }
}
