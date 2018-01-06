<?php

/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleButton extends Controller
{
    private $codename = 'button';
    private $route = 'd_visual_designer_module/button';
    
    public function __construct($registry)
    {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
        
    }
    
    public function index($setting)
    {
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['unique_id'] = uniqid();
        
        switch ($data['setting']['action']) {
            case 'link' :
                $data['action'] = "location.href='" . $data['setting']['link'] . "'";
                break;
            case 'buy' :
                $data['action'] = "cart.add('" . $setting['product_id'] . "', '" . $setting['quantity'] . "')";
                break;
            default:
                $data['action'] = 'return false;';
        }
        if(!empty($data['setting']['font_family'])){
            $data['font_href'] = 'https://fonts.googleapis.com/css?family='.$data['setting']['font_family'].':';
            
            if(!empty($data['setting']['bold'])){
                $data['font_href'] .= '700';
            }
            if(!empty($data['setting']['italic'])){
                $data['font_href'] .= 'i';
            }
            $data['font_href'] .= '&subset=cyrillic,cyrillic-ext,greek,greek-ext,hebrew,latin-ext,vietnamese';
        }
        
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
        
        $data['entry_icon_library'] = $this->language->get('entry_icon_library');
        $data['entry_text'] = $this->language->get('entry_text');
        $data['entry_action'] = $this->language->get('entry_action');
        $data['entry_link'] = $this->language->get('entry_link');
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_quantity'] = $this->language->get('entry_quantity');
        $data['entry_link'] = $this->language->get('entry_link');
        $data['entry_new_window'] = $this->language->get('entry_new_window');
        $data['entry_color'] = $this->language->get('entry_color');
        $data['entry_color_text'] = $this->language->get('entry_color_text');
        $data['entry_color_hover'] = $this->language->get('entry_color_hover');
        $data['entry_size'] = $this->language->get('entry_size');
        $data['entry_alignment'] = $this->language->get('entry_alignment');
        $data['entry_full_width'] = $this->language->get('entry_full_width');
        $data['entry_display_icon'] = $this->language->get('entry_display_icon');
        $data['entry_icon'] = $this->language->get('entry_icon');
        $data['entry_animate'] = $this->language->get('entry_animate');
        $data['entry_border_color'] = $this->language->get('entry_border_color');
        $data['entry_border_width'] = $this->language->get('entry_border_width');
        $data['entry_border_radius'] = $this->language->get('entry_border_radius');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_height'] = $this->language->get('entry_height');
        $data['entry_font_size'] = $this->language->get('entry_font_size');
        $data['entry_size'] = $this->language->get('entry_size');
        $data['entry_letter_spacing'] = $this->language->get('entry_letter_spacing');
        $data['entry_font_family'] = $this->language->get('entry_font_family');
        $data['entry_color_text_hover'] = $this->language->get('entry_color_text_hover');
        $data['entry_border_color_hover'] = $this->language->get('entry_border_color_hover');
        $data['entry_icon_color'] = $this->language->get('entry_icon_color');
        $data['entry_icon_align'] = $this->language->get('entry_icon_align');
        $data['entry_icon_only_hover'] = $this->language->get('entry_icon_only_hover');
        
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_enabled'] = $this->language->get('text_enabled');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        if (!empty($data['setting']['product_id'])) {
            $this->load->model('catalog/product');
            $product_info = $this->model_catalog_product->getProduct($data['setting']['product_id']);
            $data['product_name'] = $product_info['name'];
        } else {
            $data['product_name'] = '';
        }
        
        $data['libraries'] = array(
            'fontawesome' => 'Font Awesome',
            'glyphicon'   => 'Glyphicons',
            'ionicons'    => 'Open Ionic',
            'mapicons'    => 'Map Icons',
            'material'    => 'Material Design Iconic Font',
            'typeicon'    => 'Typeicons',
            'elusive'     => 'Elusive Icons',
            'octicon'     => 'Octicons',
            'weather'     => 'Weather Icons'
        );
        
        $data['actions'] = array(
            ''     => $this->language->get('text_no'),
            'link' => $this->language->get('text_link'),
            'buy'  => $this->language->get('text_buy')
        );
        
        $data['aligns'] = array(
            'left'   => $this->language->get('text_left'),
            'center' => $this->language->get('text_center'),
            'right'  => $this->language->get('text_right')
        );
    
        $data['icon_aligns'] = array(
            'left'   => $this->language->get('text_left'),
            'right'  => $this->language->get('text_right')
        );
        
        $data['animates'] = array(
            ''            => $this->language->get('text_no'),
            'fadeInDown'  => $this->language->get('text_top_to_bottom'),
            'fadeInUp'    => $this->language->get('text_bottom_to_top'),
            'fadeInLeft'  => $this->language->get('text_left_to_right'),
            'fadeInRight' => $this->language->get('text_right_to_left'),
            'fadeIn'      => $this->language->get('text_apear')
        );
        
        $data['base'] = HTTP_SERVER;
        
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
    
    public function autocompleteProduct()
    {
        $json = array();
        
        if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
            $this->load->model('catalog/product');
            
            if (isset($this->request->get['filter_name'])) {
                $filter_name = $this->request->get['filter_name'];
            } else {
                $filter_name = '';
            }
            
            if (isset($this->request->get['filter_model'])) {
                $filter_model = $this->request->get['filter_model'];
            } else {
                $filter_model = '';
            }
            
            if (isset($this->request->get['limit'])) {
                $limit = $this->request->get['limit'];
            } else {
                $limit = 5;
            }
            
            $filter_data = array(
                'filter_name'  => $filter_name,
                'filter_model' => $filter_model,
                'start'        => 0,
                'limit'        => $limit
            );
            
            $results = $this->model_catalog_product->getProducts($filter_data);
            
            foreach ($results as $result) {
                
                $json[] = array(
                    'product_id' => $result['product_id'],
                    'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                    'model'      => $result['model'],
                    'price'      => $result['price']
                );
            }
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}