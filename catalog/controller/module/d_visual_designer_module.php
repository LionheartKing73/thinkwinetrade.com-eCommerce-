<?php
class ControllerModuleDVisualDesignerModule extends Controller {

    private $codename = 'd_visual_designer_module';
    
    private $route = 'module/d_visual_designer_module';
    
    public function index($setting) {
        
        if(isset($setting['description'][$this->config->get('config_language_id')]['description'])){
            $content = $setting['description'][$this->config->get('config_language_id')]['description'];

            $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');

            $data['module_id'] = $setting['module_id'];

            $data['description'] = $content;

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
    }

    public function AjaxSave(){
        $json = array();

        if(isset($this->request->post['description'])){
            $description = $this->request->post['description'];
        }

        if(!empty($this->request->get['id'])){
            $module_id = $this->request->get['id'];
        }

        if(isset($description)&&isset($module_id)){

            $this->load->model($this->route);

            $setting = $this->{'model_module_'.$this->codename}->getModule($module_id);

            $setting['description'][$this->config->get('config_language_id')]['description'] = $description;

            $this->{'model_module_'.$this->codename}->editModule($module_id, $setting);

            $json['success'] = 'success';
        }
        else{
            $json['error'] = 'error';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    } 
}