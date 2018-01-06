<?php
class ControllerCommonHeader extends Controller {
	public function index() {

            if(!empty($this->request->get['token'])){
                $data['d_shopunity'] = $this->url->link('d_shopunity/extension', 'token='.$this->request->get['token'], 'SSL');
            }
            
		$data['title'] = $this->document->getTitle();

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$this->load->language('common/header');

		$data['heading_title'] = $this->language->get('heading_title');

		//sync menu, william, 20151125
		$data['sync_menu'] = $this->language->get('sync_menu');

		$data['text_order'] = $this->language->get('text_order');
		$data['text_order_status'] = $this->language->get('text_order_status');
		$data['text_complete_status'] = $this->language->get('text_complete_status');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['text_online'] = $this->language->get('text_online');
		$data['text_approval'] = $this->language->get('text_approval');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_stock'] = $this->language->get('text_stock');
		$data['text_review'] = $this->language->get('text_review');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_front'] = $this->language->get('text_front');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_homepage'] = $this->language->get('text_homepage');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
		$data['text_logout'] = $this->language->get('text_logout');

			$data['text_multi_vendor_status'] = $this->language->get('text_multi_vendor_status');
			$data['text_total_pending_products'] = $this->language->get('text_total_pending_products');
			$data['text_total_pending_accounts'] = $this->language->get('text_total_pending_accounts');
			
$data['text_login_heading'] = $this->language->get('text_login_heading');

		if (!isset($this->request->get['token']) || !isset($this->session->data['token']) || ($this->request->get['token'] != $this->session->data['token'])) {
			$data['logged'] = '';

			$data['home'] = $this->url->link('common/dashboard', '', 'SSL');
		} else {
			$data['logged'] = true;

			$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
			$data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');


			$this->load->model('localisation/language');
			$data['_langs'] = $this->model_localisation_language->getLanguages();
			$data['text_switch_language'] = $this->language->get('text_switch_language');
			$data['config_language_id'] = $this->config->get('config_language_id');
			$data['switch_language'] = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

			// Orders
			$this->load->model('sale/order');

			// Processing Orders
			$data['order_status_total'] = $this->model_sale_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_processing_status'))));
			$data['order_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&filter_order_status=' . implode(',', $this->config->get('config_processing_status')), 'SSL');

			// Complete Orders
			$data['complete_status_total'] = $this->model_sale_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_complete_status'))));
			$data['complete_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&filter_order_status=' . implode(',', $this->config->get('config_complete_status')), 'SSL');

			$this->load->model('catalog/mvd_product');
			$total_pending_products = $this->model_catalog_mvd_product->getTotalWaitingApprovalProduct();
			$data['total_pending_products'] = $total_pending_products;
			$data['pending_products'] = $this->url->link('catalog/mvd_product', 'token=' . $this->session->data['token'] . '&filter_status=5', 'SSL');

			$this->load->model('catalog/vendor');
			$total_pending_accounts = $this->model_catalog_vendor->getUserAwaitingApproval();
			$data['total_pending_accounts'] = $total_pending_accounts;
			$data['pending_accounts'] = $this->url->link('catalog/vendor', 'token=' . $this->session->data['token'] . '&filter_status=5', 'SSL');
			

			// Returns
			$this->load->model('sale/return');

			$return_total = $this->model_sale_return->getTotalReturns(array('filter_return_status_id' => $this->config->get('config_return_status_id')));

			$data['return_total'] = $return_total;

			$data['return'] = $this->url->link('sale/return', 'token=' . $this->session->data['token'], 'SSL');

			// Customers
			$this->load->model('report/customer');

			$data['online_total'] = $this->model_report_customer->getTotalCustomersOnline();

			$data['online'] = $this->url->link('report/customer_online', 'token=' . $this->session->data['token'], 'SSL');

			$this->load->model('sale/customer');

			$customer_total = $this->model_sale_customer->getTotalCustomers(array('filter_approved' => false));

			$data['customer_total'] = $customer_total;
			$data['customer_approval'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&filter_approved=0', 'SSL');

			// Products
			$this->load->model('catalog/product');

			$product_total = $this->model_catalog_product->getTotalProducts(array('filter_quantity' => 0));

			$data['product_total'] = $product_total;

			$data['product'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&filter_quantity=0', 'SSL');

			// Reviews
			$this->load->model('catalog/review');

			$review_total = $this->model_catalog_review->getTotalReviews(array('filter_status' => false));

			$data['review_total'] = $review_total;

			$data['review'] = $this->url->link('catalog/review', 'token=' . $this->session->data['token'] . '&filter_status=0', 'SSL');

			// Ratings
			$this->load->model('catalog/rating');

			$rating_total = $this->model_catalog_rating->getTotalRatings(array('filter_status' => 0));

			$data['rating_total'] = $rating_total;


			$data['rating'] = $this->url->link('catalog/rating', 'token=' . $this->session->data['token'] . '&filter_status=0', 'SSL');

			// Affliate
			$this->load->model('marketing/affiliate');

			$affiliate_total = $this->model_marketing_affiliate->getTotalAffiliates(array('filter_approved' => false));

			$data['affiliate_total'] = $affiliate_total;
			$data['affiliate_approval'] = $this->url->link('marketing/affiliate', 'token=' . $this->session->data['token'] . '&filter_approved=1', 'SSL');

			//$data['alerts'] = $customer_total + $product_total + $review_total + $rating_total + $return_total + $affiliate_total;
              
			$data['alerts'] = $customer_total + $product_total + $review_total + $rating_total+ $return_total + $affiliate_total + $total_pending_products + $total_pending_accounts;

			

			// Online Stores
			$data['stores'] = array();

			$data['stores'][] = array(
				'name' => $this->config->get('config_name'),
				'href' => HTTP_CATALOG
			);

			$this->load->model('setting/store');

			$results = $this->model_setting_store->getStores();

			foreach ($results as $result) {
				$data['stores'][] = array(
					'name' => $result['name'],
					'href' => $result['url']
				);
			}
		}


				if($data['logged']){
					$data['notificationurl'] = $this->url->link('common/notification', 'token=' . $this->session->data['token'], 'SSL');
				}
			
		return $this->load->view('common/header.tpl', $data);
	}
}
