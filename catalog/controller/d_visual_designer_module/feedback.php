<?php
/*
*location: admin/controller
*/

class ControllerDVisualDesignerModuleFeedback extends Controller {
    private $codename = 'feedback';
    private $route = 'd_visual_designer_module/feedback';
    
    private $error = array();
    
    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
    }
    public function index($setting){

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_phone'] = $this->language->get('entry_phone');
        $data['entry_comment'] = $this->language->get('entry_comment');
        
        $data['button_send'] = $this->language->get('button_send');
        
        $data['text_success_send'] = $this->language->get('text_success_send');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['fields'] = array();
        
        if(!empty($data['setting']['fields'])){
            foreach($data['setting']['fields'] as $key => $value){
                $data['fields'][] = array(
                    'name' => !empty($value['name'][$this->config->get('config_language_id')])?$value['name'][$this->config->get('config_language_id')]:'',
                    'value' => $value['value']
                    );
            }
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
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $this->load->model('localisation/language');
        
        $data['languages'] = $this->model_localisation_language->getLanguages();
        
        foreach ($data['languages'] as $code => $value){
            $data['languages'][$code]['flag'] = 'catalog/language/'.$code.'/'.$code.'.png';
        }
        
        $data['fields'] = $data['setting']['fields'];
        
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
    
    public function send(){

        $json = array();

        if(!empty($this->request->post['email'])&&(!filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL) === false)){
            $email = $this->request->post['email'];
        }
        else{
            $this->error['email'] = $this->language->get('error_email');
        }

        if(!empty($this->request->post['comment'])&&(strlen($this->request->post['comment'])>10&strlen($this->request->post['comment'])<3000)){
            $comment = $this->request->post['comment'];
        }
        else{
            $this->error['comment'] = $this->language->get('error_comment');
        }

        if(!empty($this->request->post['name'])&&(strlen($this->request->post['name'])>3&strlen($this->request->post['name'])<32)){
            $name = $this->request->post['name'];
        }
        else{
            $this->error['name'] = $this->language->get('error_name');
        }

        if(isset($this->request->post['fields'])){
            $fields = $this->request->post['fields'];
        }
        else{
            $fields = array();
        }

        if(isset($this->request->post['phone'])){
            $phone = $this->request->post['phone'];
        }

        if(!$this->error){

            $message = '';

            $message .= "<p>".$this->language->get('entry_name')." - ".$name."</p>";

            if(!empty($fields)){
                foreach ($fields as $field){
                    $message .= "<p>".$field['name']." - ".$field['value']."</p>";
                }
            }

            $message .= "<p>".$this->language->get('entry_comment')." - ".$comment."</p>";

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->request->post['email']);
            $mail->setSender(html_entity_decode($name, ENT_QUOTES, 'UTF-8'));
            $mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $name), ENT_QUOTES, 'UTF-8'));
            $mail->setHTML($message);
            $mail->send();
            $json['success'] = 'success';
        }
        else{
            $json['errors'] = $this->error;
            $json['error'] = 'error';
        }
        
        $this->response->setOutput(json_encode($json));
    }
    
}