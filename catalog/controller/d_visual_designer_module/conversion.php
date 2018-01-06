<?php
/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModuleConversion extends Controller {
    private $codename = 'conversion';
    private $route = 'd_visual_designer_module/conversion';

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model($this->route);
        $this->load->model('module/d_visual_designer');
    }
    public function index($setting){

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

        $conversion_info = $this->{'model_d_visual_designer_module_'.$this->codename}->getConversions($data['setting']['description_id']);

        $data['view'] = !empty($conversion_info['view'])?$conversion_info['view']:0;
        $data['conversion'] = !empty($conversion_info[$data['setting']['type_conversion']])?$conversion_info[$data['setting']['type_conversion']]:0;

        if($data['view'] > 0){
            $data['conversion_percentage'] = round($data['conversion']/$data['view']*100, 1);
        }
        else{
            $data['conversion_percentage'] = 0;
        }

        $this->user = new Cart\User($this->registry);

        if (!$this->user->isLogged()) {
            $data['permission'] = false;
        }
        else{
            $data['permission'] = true;
        }

        if($data['view'] > 0){
            $data['conversion_percentage'] = round($data['conversion']/$data['view']*100, 1);
        }
        else{
            $data['conversion_percentage'] = 0;
        }

        $data['unique_id'] = uniqid();

        $data['text_viewed'] = $this->language->get('text_viewed');
        $data['text_conversions'] = $this->language->get('text_conversions');
        $data['text_conversion_percentage'] = $this->language->get('text_conversion_percentage');

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
        $data['entry_type'] = $this->language->get('entry_type');

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

        $data['types'] = array(
            'all' => $this->language->get('text_type_all'),
            'cart' => $this->language->get('text_type_cart'),
            'buy' => $this->language->get('text_type_buy'),
            'subscription' => $this->language->get('text_type_subscription'),
            'feedback' => $this->language->get('text_type_feedback')
            );

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

    public function addConversion(){
        $json = array();
        if(!empty($this->request->post['type'])){
            $type = $this->request->post['type'];
        }

        if(!empty($this->request->post['description_id'])){
            $description_id = $this->request->post['description_id'];
        }

        if(!empty($description_id) && !empty($type)){
            $this->{'model_d_visual_designer_module_'.$this->codename}->addConversion($description_id, $type);
            $json['success'] = 'success';
        }
        else{
            $json['error'] = 'error';
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function addConversionBuy(){
        $json = array();

        if(!empty($this->request->post['description_id'])){
            $description_id = $this->request->post['description_id'];
        }

        if(!empty($this->request->post['product_id'])){
            $product_id = $this->request->post['product_id'];
        }

        if(isset($product_id) && isset($description_id)){
            if(!isset($this->session->data['d_visual_designer_landing'])){
                $this->session->data['d_visual_designer_landing'] = array();
            }
            $this->session->data['d_visual_designer_landing'][$product_id] = $description_id;

            $json['success'] = 'success';
        }
        else{
            $json['error'] = 'error';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}