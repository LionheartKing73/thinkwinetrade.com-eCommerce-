<?php
/*
 *  location: admin/controller
 */

class ControllerModuleDVisualDesignerModule extends Controller {
    private $codename = 'd_visual_designer_module';
    private $route = 'module/d_visual_designer_module';
    private $extension = '';
    private $config_file = '';
    private $store_id = 0;
    private $error = array(); 
    
    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->model($this->route);
        $this->load->language($this->route);
        
        $this->d_shopunity = (file_exists(DIR_SYSTEM.'mbooth/extension/d_shopunity.json'));
        $this->extension = json_decode(file_get_contents(DIR_SYSTEM.'mbooth/extension/'.$this->codename.'.json'), true);
        $this->store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;
    }
    
    public function required(){
        $this->load->language($this->route);
        $this->document->setTitle($this->language->get('heading_title_main'));
        $data['heading_title'] = $this->language->get('heading_title_main');
        $data['text_not_found'] = $this->language->get('text_not_found');
        $data['breadcrumbs'] = array();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
        
        $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
    }

    public function index() {

        if(!$this->d_shopunity){
            $this->required();
            return false;
        }

        $this->load->model('d_shopunity/mbooth');

        $this->model_d_shopunity_mbooth->validateDependencies($this->codename);

        $this->document->addStyle('view\stylesheet\shopunity\bootstrap.css');

        $this->document->addScript('view\javascript\summernote\summernote.min.js');
        $this->document->addStyle('view\javascript\summernote\summernote.css');

        $this->document->addScript('view/javascript/shopunity/bootstrap-switch/bootstrap-switch.min.js');
        $this->document->addStyle('view/stylesheet/shopunity/bootstrap-switch/bootstrap-switch.min.css');

        $this->load->model('extension/module');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            if (!isset($this->request->get['module_id'])) {
                $this->model_extension_module->addModule($this->codename, $this->request->post);
                $this->request->get['module_id'] = $this->db->getLastId();
            } 

            $this->request->post['module_id'] = $this->request->get['module_id'];

            $this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
            
            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], true));    
        }

        $data['version'] = $this->extension['version'];

        $this->document->setTitle($this->language->get('heading_title_main'));
        $data['heading_title'] = $this->language->get('heading_title_main');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_important'] = $this->language->get('text_important');
        $data['text_warning'] = sprintf($this->language->get('text_warning'), $this->url->link('module/d_visual_designer', 'token='.$this->session->data['token'], 'SSL'));
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_description'] = $this->language->get('entry_description');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save_and_stay'] = $this->language->get('button_save_and_stay');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

        if (isset($this->error['description'])) {
            $data['error_description'] = $this->error['description'];
        } else {
            $data['error_description'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], true)
            );

        if (!isset($this->request->get['module_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link($this->route, 'token=' . $this->session->data['token'], true)
                );
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link($this->route, 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true)
                );
        }

        if (!isset($this->request->get['module_id'])) {
            $data['action'] = $this->url->link($this->route, 'token=' . $this->session->data['token'], true);
        } else {
            $data['action'] = $this->url->link($this->route, 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true);
        }

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], true);

        $data['module_link'] = $this->url->link($this->route, 'token='.$this->session->data['token'], true);

        if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
            $data['module_id'] = $this->request->get['module_id'];
        }

        if (isset($this->request->post['name'])) {
            $data['name'] = $this->request->post['name'];
        } elseif (!empty($module_info)) {
            $data['name'] = $module_info['name'];
        } else {
            $data['name'] = '';
        }

        if (isset($this->request->post['description'])) {
            $data['description'] = $this->request->post['description'];
        } elseif (!empty($module_info)) {
            $data['description'] = $module_info['description'];
        } else {
            $data['description'] = '';
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($module_info)) {
            $data['status'] = $module_info['status'];
        } else {
            $data['status'] = '';
        }

        //languages
        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();
        foreach ($data['languages'] as $key =>  $language){
            if(VERSION >= '2.2.0.0'){
                $data['languages'][$key]['flag'] = 'language/'.$language['code'].'/'.$language['code'].'.png';
            }else{
                $data['languages'][$key]['flag'] = 'view/image/flags/'.$language['image'];
            }
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				

        $this->response->setOutput($this->load->view('module/'.$this->codename . '.tpl', $data));
    }

    public function install(){

        if($this->d_shopunity){
            $this->load->model('d_shopunity/mbooth');
            $this->model_d_shopunity_mbooth->installDependencies($this->codename);  
        }     
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', $this->route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if(!empty($this->error)){
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }
}