<?php
class ControllerCheckoutSuccess extends Controller {
	public function index() {
		$this->load->language('checkout/success');

		if (isset($this->session->data['order_id'])) {
            $data['order_completed'] = 1;
            $this->load->model('account/order');
            $products = $this->model_account_order->getOrderProducts($this->session->data['order_id']);
            $totals = $this->model_account_order->getOrderTotals($this->session->data['order_id']);
            $sub_total = 0;
            $tax_total = 0;
            $shipping_total = 0;
            foreach($totals as $total){
                 switch ($total['code']){
                     case "sub_total": $sub_total = $total['value']; break;
                     case "shipping": $shipping_total = $total['value']; break;
                     case "tax" : $tax_total = $total['tax']; break;
                 }
            }
             $this->load->model('catalog/category'); 
             $data['google_analytics_order'] =   "ga('ecommerce:addTransaction', {
                                                      'id': '".$this->session->data['order_id']."',
                                                      'affiliation': 'ThinkWineTrade', 
                                                      'revenue': '".$sub_total."', 
                                                      'shipping': '".$shipping_total."', 
                                                      'tax': '".$tax_total."'
                                                });"."\n";
             foreach ($products as $product){
                  $category_id = $this->model_catalog_category->getProductCategoryID($product['product_id']);
                  $category = $this->model_catalog_category->getCategory($category_id);
                  $sku = $this->model_account_order->getProductSKU($product['product_id']);
                  $data['google_analytics_order'] .=  "ga('ecommerce:addItem', {
                                                          'id': '".$this->session->data['order_id']."',                     
                                                          'name': '".$product['name']."',    
                                                          'sku': '".$sku."',                 
                                                          'category': '".$category["name"]."',         
                                                          'price': '".$product['price']."',                 
                                                          'quantity': '".$product['quantity']."'                   
                                                         });"."\n";
             }
            /*
            $data['google_analytics_order'] =  "<script>"."\n";
            $data['google_analytics_order'].= " window.dataLayer = window.dataLayer || []
                                                           dataLayer.push({
                                                           'transactionId': '".$this->session->data['order_id']."',
                                                           'transactionAffiliation': '',
                                                           'transactionTotal': ".$sub_total.",
                                                           'transactionTax': ".$tax_total.",
                                                           'transactionShipping': ".$shipping_total.",
                                                           'transactionProducts': [";
           foreach ($products as $product){
                  $category_id = $this->model_catalog_category->getProductCategoryID($product['product_id']);
                  $category = $this->model_catalog_category->getCategory($category_id);
                  $sku = $this->model_account_order->getProductSKU($product['product_id']);
                  $data['google_analytics_order'] .=  "{'sku': '".$sku."',
                                                        'name': '".$product['name']."',
                                                        'category': '".$category["name"]."',
                                                        'price': ".$product['price'].",
                                                        'quantity': ".$product['quantity']."
                                                        },";
          }
          $data['google_analytics_order'] = rtrim ($data['google_analytics_order'], ",");
          $data['google_analytics_order'] .="]
                                        });"."\n";
          $data['google_analytics_order'].="</script>";
           */ 
			$this->cart->clear();

			// Add to activity log
			$this->load->model('account/activity');

			if ($this->customer->isLogged()) {
				$activity_data = array(
					'customer_id' => $this->customer->getId(),
					'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
					'order_id'    => $this->session->data['order_id']
				);

				$this->model_account_activity->addActivity('order_account', $activity_data);
			} else {
				$activity_data = array(
					'name'     => $this->session->data['guest']['firstname'] . ' ' . $this->session->data['guest']['lastname'],
					'order_id' => $this->session->data['order_id']
				);

				$this->model_account_activity->addActivity('order_guest', $activity_data);
			}
      
            $this->event->trigger('post.order.save', $this->session->data['order_id']);
           
         
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
			unset($this->session->data['totals']);
		}

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_basket'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_checkout'),
			'href' => $this->url->link('checkout/checkout', '', 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_success'),
			'href' => $this->url->link('checkout/success')
		);

		$data['heading_title'] = $this->language->get('heading_title');

		if ($this->customer->isLogged()) {
			$data['text_message'] = sprintf($this->language->get('text_customer'), $this->url->link('account/account', '', 'SSL'), $this->url->link('account/order', '', 'SSL'), $this->url->link('account/download', '', 'SSL'), $this->url->link('information/contact'));
		} else {
			$data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
		}

		$data['button_continue'] = $this->language->get('button_continue');

		
$data['continue'] = $this->url->link('account/order');
      

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		

			/* START */
			$layout_positions = $this->load->controller('common/layout_footer/layoutPositions');

			foreach($layout_positions as $position){
				$data[$position] = $this->load->controller('common/layout_footer/index', $position);
			}
			/* END */
			
			
			
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        
        

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/success.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/success.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/success.tpl', $data));
		}
	}
}