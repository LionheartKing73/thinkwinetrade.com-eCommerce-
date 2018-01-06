<?php
/*
 *  location: admin/controller
 */

class ControllerDVisualDesignerModuleProductsGrid extends Controller {
    private $codename = 'products_grid';
    private $route = 'd_visual_designer_module/products_grid';

    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
        $this->load->model($this->route);
    }
    
    public function index($setting){
            
        $data['button_cart'] = $this->language->get('button_cart');
        $data['button_wishlist'] = $this->language->get('button_wishlist');
        $data['button_compare'] = $this->language->get('button_compare');
        
        
        $data['text_tax'] = $this->language->get('text_tax');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
                
        switch ($data['setting']['mode']) {
            case 'latest':
            $products = $this->model_d_visual_designer_module_products_grid->getLatestProducts($data['setting']['count_product']);
            break;
            
            case 'special':
            $products = $this->model_d_visual_designer_module_products_grid->getProductSpecials($data['setting']['count_product']);
            break;
            
            case 'popular':
            $products = $this->model_d_visual_designer_module_products_grid->getPopularProducts($data['setting']['count_product']);
            break;
            case 'bestseller':
            $products = $this->model_d_visual_designer_module_products_grid->getBestSellerProducts($data['setting']['count_product']);
            break;
            
            default:
            $products = array();
            break;
        }
        if(VERSION >= '2.2.0.0'){
            $width = $this->config->get($this->config->get('config_theme') . '_image_thumb_width');
            $height = $this->config->get($this->config->get('config_theme') . '_image_thumb_height');
        }
        else{
            $width = $this->config->get('config_image_thumb_width');
            $height = $this->config->get('config_image_thumb_height');
        }
                
        $this->load->model('tool/image');
        $data['products'] = array();
        if ($products) {
            foreach ($products as $result) {
                if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $width, $height);
                } else {
                    $image = $this->model_tool_image->resize('placeholder.png', $width, $height);
                }
                
                if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                } else {
                    $price = false;
                }
                
                if ((float)$result['special']) {
                    $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                } else {
                    $special = false;
                }
                
                if ($this->config->get('config_tax')) {
                    $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
                } else {
                    $tax = false;
                }
                
                if ($this->config->get('config_review_status')) {
                    $rating = $result['rating'];
                } else {
                    $rating = false;
                }
                
                $result['description'] = $this->model_module_d_visual_designer->getText($result['description']);
                
                if(VERSION>='2.2.0.0')
                {
                    $description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..';
                }
                else
                {
                    $description = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..';
                }

                $data['products'][] = array(
                    'product_id'  => $result['product_id'],
                    'thumb'       => $image,
                    'name'        => $result['name'],
                    'description' => $description,
                    'price'       => $price,
                    'special'     => $special,
                    'tax'         => $tax,
                    'rating'      => $rating,
                    'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
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

        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_width'] = $this->language->get('entry_width');
        $data['entry_mode'] = $this->language->get('entry_mode');
        $data['entry_count_product'] = $this->language->get('entry_count_product');
        
        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        $data['modes'] = array(
            'latest' => $this->language->get('text_latest'),
            'bestseller' => $this->language->get('text_bestseller'),
            'popular' => $this->language->get('text_popular'),
            'special' => $this->language->get('special')
        );
        
        $data['sizes'] = array(
            '1' => '1/12',
            '2' => '2/12',
            '3' => '3/12',
            '4' => '4/12',
            '5' => '5/12',
            '6' => '6/12',
            '7' => '7/12',
            '8' => '8/12',
            '9' => '9/12',
            '10' => '10/12',
            '11' => '11/12',
            '12' => '12/12',
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
}