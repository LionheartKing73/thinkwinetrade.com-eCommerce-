<?php
class ControllerCommonVDIHeader extends Controller {
    public function index() {
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
        $data['commande_expediter'] = "Commandes à expédier";

        $this->load->language('common/vdi_header');

        $data['heading_title'] = $this->language->get('heading_title');

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
        $data['text_add_product'] = $this->language->get('text_add_product');

        if (!isset($this->request->get['token']) || !isset($this->session->data['token']) && ($this->request->get['token'] != $this->session->data['token'])) {
            $data['logged'] = '';
            $data['home'] = $this->url->link('common/vdi_dashboard', '', 'SSL');
        } else {
            $data['logged'] = true;
            $data['home'] = $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL');

            $data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');

            $data['add_product'] = $this->url->link('catalog/vdi_product/add', 'token=' . $this->session->data['token'], 'SSL');


            $this->load->model('localisation/language');
            $data['_langs'] = $this->model_localisation_language->getLanguages();
            $data['text_switch_language'] = $this->language->get('text_switch_language');
            $data['config_language_id'] = $this->config->get('config_language_id');
            $data['switch_language'] = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

            // Orders
            $this->load->model('sale/vdi_order');

            // Processing Orders
            $data['order_status_total'] = $this->model_sale_vdi_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_processing_status'))));
            $data['order_status'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&filter_order_status=' . implode(',', $this->config->get('config_processing_status')), 'SSL');

            // Complete Orders
            $data['complete_status_total'] = $this->model_sale_vdi_order->getTotalOrders(array('filter_order_status' => implode(',', $this->config->get('config_complete_status'))));
            $data['complete_status'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&filter_order_status=' . implode(',', $this->config->get('config_complete_status')), 'SSL');

            // Orders, Products (Unconfirmed)

            $data['po_confirm_total'] = $this->model_sale_vdi_order->getTotalVendorOrdersNew();
            $data['po_confirm'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&filter_order_status=19', 'SSL');

            $data['po_shiping_total'] = $this->model_sale_vdi_order->getTotalShipingVendorOrdersNumber();
            $data['po_shipping'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&filter_order_status=3', 'SSL');

            ////data['complete_status_total'] = $this->model_sale_vdi_order->getTotalOrders(array('filter_order_status' => "3"));
            //$this->model_sale_vdi_order->getTotalVendorOrdersNew();
            $data['products_confirm_total'] = $this->model_sale_vdi_order->getTotalVendorProductsNew();
            $data['products_confirm'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&filter_order_status=19', 'SSL');

            $data['text_po_confirm'] = $this->language->get('text_po_confirm');
            $data['text_products_confirm'] = $this->language->get('text_products_confirm');
            $data['commande_expediter'] = $this->language->get('commande_expediter');

            // Products
            $this->load->model('catalog/vdi_product');

            $product_total = $this->model_catalog_vdi_product->getTotalProducts(array('filter_quantity' => 0));

            $data['product_total'] = $product_total;

            $data['product'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . '&filter_quantity=0', 'SSL');

            // Products Pending Approval
            $this->load->model('catalog/vdi_product');

            $product_pending_approval_total = $this->model_catalog_vdi_product->getTotalProducts(array('filter_status' => 5));

            $data['product_pending_approval_total'] = $product_pending_approval_total;

            $data['product_pending_approval'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . '&filter_status=5', 'SSL');

            $data['alerts'] = $product_total + $product_pending_approval_total + $data['po_confirm_total'] + $data['products_confirm_total']+$data['po_shiping_total'];

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
            /* Get userinfo for menu */
            $this->load->language('common/menu');

            $this->load->model('user/user');

            $this->load->model('tool/image');

            $user_info = $this->model_user_user->getUser($this->user->getId());

            $this->load->model('catalog/vdi_vendor_profile');
            $vendors_info = $this->model_catalog_vdi_vendor_profile->getVendorProfile($this->user->getId());
            if ($user_info) {
                //echo "<pre>"; print_r($vendors_info); echo "</pre>";
              /*  $data['firstname'] = $user_info['firstname'];
                $data['lastname'] = $user_info['lastname'];
                $data['username'] = $user_info['username'];
                $data['user_group'] = $user_info['user_group'] ;
                $data['company'] = $vendors_info['company'];*/

                $data['firstname'] = $vendors_info['firstname'];
                $data['lastname'] = $vendors_info['lastname'];
                $data['username'] = $vendors_info['username'];
                $data['user_group'] = $vendors_info['user_group'] ;
                $data['company'] = $vendors_info['company'];

                if (is_file(DIR_IMAGE . $vendors_info['vendor_image'])) {
                    $data['image'] = $this->model_tool_image->resize($vendors_info['vendor_image'], 45, 45);
                } else {
                    $data['image'] = $this->model_tool_image->resize('no_image.png', 45, 45);
                }
            } else {
                $data['image'] = '';
            }
            /* Get userinfo for menu */

			$this->load->language('catalog/rating_vendor');
			$this->load->model('catalog/vendor');
			$profiles = $this->model_catalog_vendor->getVendorProfile($this->user->getId());
			$total_products = $this->model_catalog_vendor->getTotalProductVendors($profiles['vendor_id']);

			$dashboard = true;
			$step1=0;
			$step3=0;
			$text_checklist = '';
			if($profiles['vendor_image'] == '' && $dashboard){
				$dashboard = false;
				$text_checklist = $this->language->get('warning_add_profile_image');
				$step1=1;

			}

			if($total_products == 0 && $dashboard){
				$dashboard = false;
				$text_checklist = $this->language->get('warning_add_product');
			}

			/*if(($profiles['paypal_email'] == '' || $profiles['payment'] == '') && $dashboard){
				$dashboard = false;
				$text_checklist = $this->language->get('warning_add_finance');
				$step3=1;
			}*/

			if($profiles['notification'] == 1 ){
				$dashboard = false;

				$text_checklist = $this->language->get('warning_update_notification');
			}
			$data['step1'] = $step1;
			$data['step3'] = $step3;
			$data['checklist'] = $text_checklist;
        }


        $data['vendor_status'] = -1;

        if ($this->user && !isset($_SESSION[ $this->session->data['token'].'show'])){

             $data['vendor_status']= $this->user->getStatus();
             $data['text_need_approval'] = $this->language->get('text_need_approval');
             $_SESSION[ $this->session->data['token'].'show'] = 1;
        }

        return $this->load->view('common/vdi_header.tpl', $data);
    }
}
