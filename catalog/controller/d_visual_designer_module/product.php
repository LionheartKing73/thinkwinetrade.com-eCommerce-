<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleProduct extends Controller
{
    private $codename = 'product';
    private $route = 'd_visual_designer_module/product';

    public function __construct($registry)
    {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
    }
    
    public function index($setting)
    {

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		
		$data['text_tax'] = $this->language->get('text_tax');

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);
        
        if (!empty($data['setting']['product_id'])) {
            if (VERSION >= '2.2.0.0') {
                $width = $this->config->get($this->config->get('config_theme') . '_image_thumb_width');
                $height = $this->config->get($this->config->get('config_theme') . '_image_thumb_height');
            } else {
                $width = $this->config->get('config_image_thumb_width');
                $height = $this->config->get('config_image_thumb_height');
            }

            $this->load->model('catalog/product');
            $this->load->model('tool/image');
            $product_info = $this->model_catalog_product->getProduct($data['setting']['product_id']);

            if ($product_info['image']) {
                $image = $this->model_tool_image->resize($product_info['image'], $width, $height);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', $width, $height);
            }
            
            if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
            } else {
                $price = false;
            }
            
            if ((float)$product_info['special']) {
                $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
            } else {
                $special = false;
            }
            
            if ($this->config->get('config_tax')) {
                $tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
            } else {
                $tax = false;
            }
            
            if ($this->config->get('config_review_status')) {
                $rating = $product_info['rating'];
            } else {
                $rating = false;
            }

			$product_info['description'] = $this->model_module_d_visual_designer->getText($product_info['description']);

            $data['product'] = array(
                'product_id'  => $product_info['product_id'],
                'thumb'       => $image,
                'name'        => $product_info['name'],
                'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
                'price'       => $price,
                'special'     => $special,
                'tax'         => $tax,
                'rating'      => $rating,
                'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
            );
        }

        if (VERSION>='2.2.0.0') {
            return $this->load->view($this->route, $data);
        } else {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->route.'.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/'.$this->route.'.tpl', $data);
            } else {
                return $this->load->view('default/template/'.$this->route.'.tpl', $data);
            }
        }
    }
    
    public function setting($setting)
    {
        $data['entry_product'] = $this->language->get('entry_product');
        $data['entry_style'] = $this->language->get('entry_style');

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

        if (!empty($data['setting']['product_id'])) {
            $this->load->model('catalog/product');
            $product_info = $this->model_catalog_product->getProduct($data['setting']['product_id']);
            $data['product_name'] = $product_info['name'];
        } else {
            $data['product_name'] = '';
        }

        $data['styles'] = array(
            'default' => $this->language->get('text_style_default')
        );
        
        if (VERSION>='2.2.0.0') {
            return $this->load->view($this->route.'_setting', $data);
        } else {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->route.'_setting.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/'.$this->route.'_setting.tpl', $data);
            } else {
                return $this->load->view('default/template/'.$this->route.'_setting.tpl', $data);
            }
        }
    }

    public function autocomplete()
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
