<?php
class ControllerCommonVDITopMenu extends Controller {
	public function index() {
		if (isset($this->request->get['token']) && isset($this->session->data['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
			//$data['profile'] = $this->load->controller('common/profile');
			//$data['menu'] = $this->load->controller('common/top_menu');
			//$data['stats'] = $this->load->controller('common/stats');

            //$this->load->language('common/top_menu');
            $this->load->language('common/menu');

            //menu text
            $data['text_dashboard'] = $this->language->get('text_dashboard');
            $data['text_catalog'] = $this->language->get('text_catalog');
            $data['text_product'] = $this->language->get('text_product');
            $data['text_reports'] = $this->language->get('text_reports');
            $data['text_information'] = $this->language->get('text_information');
            $data['text_order'] = $this->language->get('text_order');
            $data['text_vendor_transaction'] = $this->language->get('text_vendor_transaction');
            $data['text_sale'] = $this->language->get('text_sale');
            $data['text_report_product_viewed'] = $this->language->get('text_report_product_viewed');
            $data['text_report_product_purchased'] = $this->language->get('text_report_product_purchased');
            $data['text_vendor_personal'] = $this->language->get('text_vendor_personal');
            $data['text_contract_history'] = $this->language->get('text_contract_history');
            $data['text_vendor_update_profile'] = $this->language->get('text_vendor_update_profile');
            $data['text_vendor_update_password'] = $this->language->get('text_vendor_update_password');
            $data['text_my_carriers'] = $this->language->get('text_my_carriers');


            //menu link
            $data['home'] = $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_product'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_category'] = $this->url->link('catalog/vdi_category', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_option'] = $this->url->link('catalog/vdi_option', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_attribute'] = $this->url->link('catalog/vdi_attribute', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_attribute_group'] = $this->url->link('catalog/vdi_attribute_group', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_information'] = $this->url->link('catalog/vdi_information', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_download'] = $this->url->link('catalog/vdi_download', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_report_product_viewed'] = $this->url->link('report/vdi_product_viewed', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_report_product_purchased'] = $this->url->link('report/vdi_product_purchased', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_report_shipping'] = $this->url->link('report/sale_shipping', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_contract_history'] = $this->url->link('sale/vdi_contract_history', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_update_vendor_profile'] = $this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_user_password'] = $this->url->link('user/vdi_user_password', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_sale_order'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_coupon'] = $this->url->link('marketing/vdi_coupon', 'token=' . $this->session->data['token'], 'SSL');
            $data['vdi_transaction'] = $this->url->link('report/vdi_transaction', 'token=' . $this->session->data['token'], 'SSL');
			$data['vdi_my_carriers']  = $this->url->link('module/vdi_my_carriers', 'token=' . $this->session->data['token'], 'SSL');

            $data['current_route'] = $this->request->get['route'];

            if ($this->user->getExpireDate()!= '0000-00-00') {
                $data['expiration_date'] = '<span style="color:white;background-color:#4AA02C;padding:1px 5px 1px 5px;border-radius: 3px 3px 3px 3px">' . $this->user->getExpireDate() . '</span>';
            } else {
                $data['expiration_date'] = false;
            }

            $data['welcome'] = $this->language->get('welcome');
            $this->load->model('user/user');
            $user_info = $this->model_user_user->getUser($this->user->getId());
            $this->load->model('catalog/vdi_vendor_profile');
            $vendors_info = $this->model_catalog_vdi_vendor_profile->getVendorProfile($this->user->getId());
            $data['firstname'] = $user_info['firstname'];
            $data['vendor_id'] = $vendors_info['vendor_id'];
            $data['lastname'] = $user_info['lastname'];
            $data['username'] = $user_info['username'];
            $data['company'] = $vendors_info['company'];
            $data['user_group'] = $user_info['user_group'] ;

            $this->load->model('catalog/vdi_product');
            $data['top_product_total'] = $this->model_catalog_vdi_product->getTotalProducts();

            $this->load->model('module/vdi_my_carriers');
            $data['top_transporteurs'] = $this->model_module_vdi_my_carriers->getTotalCarriers();


			return $this->load->view('common/vdi_top_menu.tpl', $data);
		}
	}
}
