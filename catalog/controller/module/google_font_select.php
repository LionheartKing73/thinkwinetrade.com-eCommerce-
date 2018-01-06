<?php
class ControllerModuleGoogleFontSelect extends Controller {
    public function index() {
        $this->load->language('module/google_font_select'); // loads the language file of helloworld
         
        $data['heading_title'] = $this->language->get('heading_title'); // set the heading_title of the module
         
        //Add Google font css url
        $data['google_font_name'] = html_entity_decode($this->config->get('google_font_select_font_name')); // to set google font URL     
        $data['google_font_css_name'] = str_replace('+',' ', $this->config->get('google_font_select_font_css')); // to set font-family name in css        
        $font_weights = ":100,200,300,400,500,600,700,italic"; // include all availabe font varients of selected font name
        $this->document->addStyle('//fonts.googleapis.com/css?family=' . $data['google_font_name'] . $font_weights);
         
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/google_font_select.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/module/google_font_select.tpl', $data);
        } else {
            return $this->load->view('default/template/module/google_font_select.tpl', $data);
        }
    }
}