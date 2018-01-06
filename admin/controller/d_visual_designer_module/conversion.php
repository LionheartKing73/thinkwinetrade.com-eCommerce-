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
        $this->load->model('d_visual_designer/designer');
    }
    
    public function index($setting){

        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

        $conversion_info = $this->{'model_d_visual_designer_module_'.$this->codename}->getConversions($data['setting']['description_id']);

        $data['view'] = !empty($conversion_info['view'])?$conversion_info['view']:0;
        $data['conversion'] = !empty($conversion_info[$data['setting']['type_conversion']])?$conversion_info[$data['setting']['type_conversion']]:0;
        if($data['view'] > 0){
            $data['conversion_percentage'] = round($data['conversion']/$data['view']*100, 1);
        }
        else{
            $data['conversion_percentage'] = 0;
        }

        $data['unique_id'] = uniqid();

        $data['token'] = $this->session->data['token'];

        $data['text_viewed'] = $this->language->get('text_viewed');
        $data['text_conversions'] = $this->language->get('text_conversions');
        $data['text_conversion_percentage'] = $this->language->get('text_conversion_percentage');

        return $this->load->view($this->route.".tpl", $data);
    }
    
    public function setting($setting){

        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_type'] = $this->language->get('entry_type');
        
        $data['setting'] = $this->model_d_visual_designer_designer->getSetting($setting, $this->codename);

        $data['types'] = array(
            'all' => $this->language->get('text_type_all'),
            'cart' => $this->language->get('text_type_cart'),
            'buy' => $this->language->get('text_type_buy'),
            'subscription' => $this->language->get('text_type_subscription'),
            'feedback' => $this->language->get('text_type_feedback')
            );
        
        return $this->load->view($this->route.'_setting.tpl', $data);
    }
}