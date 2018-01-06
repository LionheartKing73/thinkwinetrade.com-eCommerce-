<?php
class ControllerCommonVDIDashboard extends Controller {
	public function index() {
		$this->checklist_venue();
		$this->load->language('common/vdi_dashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_sale'] = $this->language->get('text_sale');
		$data['text_map'] = $this->language->get('text_map');
		$data['text_activity'] = $this->language->get('text_activity');
		$data['text_recent'] = $this->language->get('text_recent');



        if ($this->user->getExpireDate()!= '0000-00-00') {
            $data['expiration_date'] = '<span style="color:white;background-color:#4AA02C;padding:1px 5px 1px 5px;border-radius: 3px 3px 3px 3px">' . $this->user->getExpireDate() . '</span>';
        } else {
            $data['expiration_date'] = false;
        }

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/vdi_header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['menu_top'] = $this->load->controller('common/menu_top');
		$data['order'] = $this->load->controller('dashboard/vdi_order');
		$data['sale'] = $this->load->controller('dashboard/vdi_sale');
		$data['map'] = $this->load->controller('dashboard/vdi_map');
		$data['chart'] = $this->load->controller('dashboard/vdi_chart');
		$data['order_stock'] = $this->load->controller('dashboard/vdi_order_stock');
		$data['recent'] = $this->load->controller('dashboard/vdi_recent');
		$data['footer'] = $this->load->controller('common/footer');

        $data['top_menu'] = $this->load->controller('common/vdi_top_menu');

		//mvds
		$data['text_total_product'] = $this->language->get('text_total_product');
		$data['text_total_shipping'] = $this->language->get('text_total_shipping');
		$data['text_total_product_approval'] = $this->language->get('text_total_product_approval');
		$data['text_total_product_pendding'] = $this->language->get('text_total_product_pendding');
		$data['text_total_vendor_approval'] = $this->language->get('text_total_vendor_approval');
		//mvde
		$this->load->model('catalog/vendor');
		$this->load->model('user/user');
		$this->load->model('catalog/vdi_vendor_profile');
    $vendors_info = $this->model_catalog_vdi_vendor_profile->getVendorProfile($this->user->getId());
		$vrating = $this->model_catalog_vendor->getTotalRatingsVendorsByVendorId($vendors_info['vendor_id']);
		$data['vrating'] = $vrating;		
		$this->response->setOutput($this->load->view('common/vdi_dashboard.tpl', $data));
	}

	public function checklist_venue(){
		$this->load->model('catalog/vendor');
		$profiles = $this->model_catalog_vendor->getVendorProfile($this->user->getId());
		$total_products = $this->model_catalog_vendor->getTotalProductVendors($profiles['vendor_id']);

		$dashboard = true;
		if($profiles['vendor_image'] == ''){
			$dashboard = false;
			$this->response->redirect($this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if($total_products == 0 && $dashboard){
			$dashboard = false;
			$this->response->redirect($this->url->link('catalog/vdi_product/add', 'token=' . $this->session->data['token'], 'SSL'));
		}

		/*if($dashboard && ($profiles['paypal_email'] == '' || $profiles['payment'] == '')){
			$dashboard = false;
			$this->response->redirect($this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL'));
		}*/
		if($profiles['notification'] == 1 ){

			$dashboard = false;

			$this->response->redirect($this->url->link('catalog/vdi_product/', 'token=' . $this->session->data['token'], 'SSL'));

		}
	}
}
