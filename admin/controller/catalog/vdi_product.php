 <?php

class ControllerCatalogVDIProduct extends Controller {
	private $error = array();

	public function index() {
		//$this->load->controller('common/vdi_dashboard/checklist_venue');
		$this->checklist_venue(1);
		$this->load->language('catalog/vdi_product');

		$this->document->setTitle($this->language->get('heading_title'));


		$this->load->model('catalog/vdi_product');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/vdi_product');

        $this->document->addScript('view/javascript/bootstrap-multiselect.js');
        $this->document->addStyle('view/stylesheet/bootstrap-multiselect.css');


		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/vdi_product');

		if (!$this->OverMaxLimit()) {
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
               	 $product_id = $this->model_catalog_vdi_product->addProduct($this->request->post);

				$this->session->data['success'] = $this->language->get('text_success');

				$url = '';

				if (isset($this->request->get['filter_name'])) {
					$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
				}

				if (isset($this->request->get['filter_model'])) {
					$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
				}

				if (isset($this->request->get['filter_sku'])) {
					$url .= '&filter_sku=' . urlencode(html_entity_decode($this->request->get['filter_sku'], ENT_QUOTES, 'UTF-8'));
				}

				if (isset($this->request->get['filter_price'])) {
					$url .= '&filter_price=' . $this->request->get['filter_price'];
				}

				if (isset($this->request->get['filter_quantity'])) {
					$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
				}

				if (isset($this->request->get['filter_status'])) {
					$url .= '&filter_status=' . $this->request->get['filter_status'];
				}

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				if ($this->config->get('mvd_product_notification')) {
					$this->add_edit_notification(true,$this->request->post['product_name']);
				}
				$this->load->model('catalog/vendor');
				$profiles = $this->model_catalog_vendor->getVendorProfile($this->user->getId());
				$total_products = $this->model_catalog_vendor->getTotalProductVendors($profiles['vendor_id']);
				if(($profiles['paypal_email'] == '' || $profiles['payment'] == '')){
		        	$this->response->redirect($this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL'));
     			}else{
				//$this->response->redirect($this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
                $this->response->redirect($this->url->link('catalog/vdi_product/edit', 'action=save&product_id='.$product_id.'&token=' . $this->session->data['token'] . $url, 'SSL'));
				}

			}
			$this->getForm();
			$this->checklist_venue();
		} else {
			$this->getList();
		}
	}

	public function edit() {
		$this->load->language('catalog/vdi_product');

		$this->document->setTitle($this->language->get('heading_title'));

       $this->document->addScript('view/javascript/bootstrap-multiselect.js');
        $this->document->addStyle('view/stylesheet/bootstrap-multiselect.css');

		$this->load->model('catalog/vdi_product');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->request->post['sku'] = $this->request->post['sku_'];

			$this->model_catalog_vdi_product->editProduct($this->request->get['product_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
            $data['success'] = $this->language->get('text_success');
			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}



			if (isset($this->request->get['filter_sku'])) {
				$url .= '&filter_sku=' . urlencode(html_entity_decode($this->request->get['filter_sku'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if ($this->config->get('mvd_product_notification')) {
				$this->add_edit_notification(false,$this->request->post['product_name']);
			}



		//	$this->response->redirect($this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}


		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/vdi_product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/vdi_product');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_catalog_vdi_product->deleteProduct($product_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_sku'])) {
				$url .= '&filter_sku=' . urlencode(html_entity_decode($this->request->get['filter_sku'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	public function copy() {
		$this->load->language('catalog/vdi_product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/vdi_product');

		if (isset($this->request->post['selected']) && $this->validateCopy() && !$this->OverMaxLimit()) {
			foreach ($this->request->post['selected'] as $product_id) {
				$this->model_catalog_vdi_product->copyProduct($product_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_sku'])) {
				$url .= '&filter_sku=' . urlencode(html_entity_decode($this->request->get['filter_sku'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
        $data['column_attribute_color'] =  $this->language->get('column_attribute_color');
        $data['column_attribute_year'] =  $this->language->get('column_attribute_year');

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}

		if (isset($this->request->get['filter_sku'])) {
			$filter_sku = $this->request->get['filter_sku'];
		} else {
			$filter_sku = null;
		}

		if (isset($this->request->get['filter_vendor'])) {
			$filter_vendor = $this->request->get['filter_vendor'];
		} else {
			$filter_vendor = null;
		}

		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_vendor'])) {
			$filter_vendor = $this->request->get['filter_vendor'];
		} else {
			$filter_vendor = NULL;
		}

		if (isset($this->request->get['filter_sku'])) {
			$filter_sku = $this->request->get['filter_sku'];
		} else {
			$filter_sku = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_sku'])) {
			$url .= '&filter_sku=' . urlencode(html_entity_decode($this->request->get['filter_sku'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_vendor'])) {
			$url .= '&filter_vendor=' . urlencode(html_entity_decode($this->request->get['filter_vendor'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

        $data['text_date_added'] = $this->language->get('text_date_added');
        $data['text_viewed'] = $this->language->get('text_viewed');
		$data['add'] = $this->url->link('catalog/vdi_product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['copy'] = $this->url->link('catalog/vdi_product/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/vdi_product/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['products'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_model'	  => $filter_model,
			'filter_price'	  => $filter_price,
			'filter_quantity' => $filter_quantity,
			'filter_status'   => $filter_status,
			'filter_sku'	  => $filter_sku,
			'filter_vendor'   => $filter_vendor,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$this->load->model('catalog/vendor');

		$vendor_info = $this->model_catalog_vendor->getVendorProfile($this->user->getId());



		if (isset($vendor_info['vendor_id'])) {

			$default_vendor = $vendor_info['vendor_id'];
			$default_vendor_notification = $vendor_info['notification'];

		}

		$product_total = $this->model_catalog_vdi_product->getTotalProducts($filter_data);

		$results = $this->model_catalog_vdi_product->getProducts($filter_data);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$special = false;

			$product_specials = $this->model_catalog_vdi_product->getProductSpecials($result['product_id']);

        	foreach ($product_specials  as $product_special) {
				if (($product_special['date_start'] == '0000-00-00' || strtotime($product_special['date_start']) < time()) && ($product_special['date_end'] == '0000-00-00' || strtotime($product_special['date_end']) > time())) {
					$special = $this->currency->format($product_special['price']);

					break;
				}
			}

			if ($result['status'] == 5) {
				$status = "<span class='status_pending' data-toggle='tooltip' title='".$this->language->get('text_status_tooltip')."'>".$this->language->get('txt_pending_approval')."</span>";
			} elseif ($result['status']) {
				$status = "<span class='status_enabled' data-toggle='tooltip' title='".$this->language->get('text_status_tooltip')."'>".$this->language->get('text_enabled')."</span>";
			} else {
				$status = "<span class='status_disabled' data-toggle='tooltip' title='".$this->language->get('text_status_tooltip')."'>".$this->language->get('text_disabled')."</span>";
			}

           $this->load->model('catalog/cron_inventory');
           $default_vendor_update_stock = $this->model_catalog_cron_inventory->getStatusUpdateStock($default_vendor,$result['product_id']);

			$year = '';
			$color ='';

			$year = $this->model_catalog_cron_inventory->getYearProduct($result['product_id'],1);
			$color = $this->model_catalog_cron_inventory->getColorProduct($result['product_id'],1);
            $date_added = new DateTime($result['date_added']);
           	$data['products'][] = array(
				'product_id' => $result['product_id'],
				'image'      => $image,
				'name'       => $result['name'],
				'model'      => $result['model'],
				'sku'      	 => $result['sku'],
				'price'      => $this->currency->format($result['price']),
				'special'    => $special,
                'date_added'  => date_format($date_added,"d-m-Y"),
                'viewed'      	 => $result['viewed'],
				'quantity'   => $result['quantity'],
				'status'     => $status,
				'notification' => $default_vendor_notification,

				'update_stock' => $default_vendor_update_stock,

				'vendor_id' => $default_vendor,
				'year' => $year,
				'color' =>$color,
				'edit'       => $this->url->link('catalog/vdi_product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
			);
		}

		$this->load->language('catalog/rating_vendor');
		$data['text_edit_stock'] = $this->language->get('text_edit_stock');
		$data['text_button_cancel'] = $this->language->get('text_button_cancel');
		$data['text_button_save'] = $this->language->get('text_button_save');
		$data['text_button_keep'] = $this->language->get('text_button_keep');
		$data['text_stock_update'] = $this->language->get('text_stock_update');
		$data['text_stock_updated'] = $this->language->get('text_stock_updated');
		$data['text_string_stock'] = $this->language->get('text_string_stock');
		$data['text_desc_stock'] = $this->language->get('text_desc_stock');
		$data['message_success_update'] = $this->language->get('message_success_update');
		$data['text_button_close'] = $this->language->get('text_button_close');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['txt_pending_approval'] = $this->language->get('txt_pending_approval');
		$data['column_sku'] = $this->language->get('column_sku');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_price'] = $this->language->get('entry_price');
        $data['entry_price_special'] = $this->language->get('entry_price_special');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
        $data['entry_quantity_down'] = $this->language->get('entry_quantity_down');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
    $data['button_edit_product'] = $this->language->get('button_edit_product');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_sku'])) {
			$url .= '&filter_sku=' . urlencode(html_entity_decode($this->request->get['filter_sku'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$data['sort_model'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$data['sort_sku'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . '&sort=p.sku' . $url, 'SSL');
		$data['sort_price'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$data['sort_quantity'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$data['sort_order'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_sku'])) {
			$url .= '&filter_sku=' . urlencode(html_entity_decode($this->request->get['filter_sku'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($product_total - $this->config->get('config_limit_admin'))) ? $product_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $product_total, ceil($product_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_model'] = $filter_model;
		$data['filter_sku'] = $filter_sku;
		$data['filter_price'] = $filter_price;
		$data['filter_quantity'] = $filter_quantity;
		$data['filter_status'] = $filter_status;

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/vdi_header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['top_menu'] = $this->load->controller('common/vdi_top_menu');


		$this->response->setOutput($this->load->view('catalog/vdi_product_list.tpl', $data));
	}

	protected function getForm() {

		$data['heading_title'] = $this->language->get('heading_title');
    $data['help_image'] = $this->language->get('help_image');

		$data['text_form'] = !isset($this->request->get['product_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_minus'] = $this->language->get('text_minus');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_option_value'] = $this->language->get('text_option_value');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
        $data['text_about_discount'] = $this->language->get('text_about_discount');
        $data['text_about_special'] = $this->language->get('text_about_special');

		$data['entry_name'] = $this->language->get('entry_name');
        $data['column_price1'] = $this->language->get('column_price1');
        $data['column_sp_price'] = $this->language->get('column_sp_price');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_sku'] = $this->language->get('entry_sku');
		$data['entry_upc'] = $this->language->get('entry_upc');
		$data['entry_ean'] = $this->language->get('entry_ean');
		$data['entry_jan'] = $this->language->get('entry_jan');
		$data['entry_isbn'] = $this->language->get('entry_isbn');
		$data['entry_mpn'] = $this->language->get('entry_mpn');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_minimum'] = $this->language->get('entry_minimum');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['entry_date_available'] = $this->language->get('entry_date_available');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
        $data['entry_quantity_down'] = $this->language->get('entry_quantity_down');
		$data['entry_stock_status'] = $this->language->get('entry_stock_status');
		$data['entry_price'] = $this->language->get('entry_price');
        $data['entry_price_special'] = $this->language->get('entry_price_special');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_points'] = $this->language->get('entry_points');
		$data['entry_option_points'] = $this->language->get('entry_option_points');
		$data['entry_subtract'] = $this->language->get('entry_subtract');
		$data['entry_weight_class'] = $this->language->get('entry_weight_class');
		$data['entry_weight'] = $this->language->get('entry_weight');
		$data['entry_dimension'] = $this->language->get('entry_dimension');
		$data['entry_length_class'] = $this->language->get('entry_length_class');
		$data['entry_length'] = $this->language->get('entry_length');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_download'] = $this->language->get('entry_download');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_related'] = $this->language->get('entry_related');
		$data['entry_attribute'] = $this->language->get('entry_attribute');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_option_value'] = $this->language->get('entry_option_value');
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_tag'] = $this->language->get('entry_tag');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_reward'] = $this->language->get('entry_reward');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_recurring'] = $this->language->get('entry_recurring');
        $data['entry_discount_head'] = $this->language->get('entry_discount_head');
        $data['head_special_text'] = $this->language->get('head_special_text');
        $data['special_giveup'] = $this->language->get('special_giveup');
        $data['discount_giveup'] = $this->language->get('discount_giveup');

        $data['twt_bottle_price'] = $this->language->get('twt_bottle_price');
        $data['twt_cartoon_price'] = $this->language->get('twt_cartoon_price');

		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_sku'] = $this->language->get('help_sku');
        $data['help_status'] = $this->language->get('help_status');
        $data['help_name'] = $this->language->get('help_name');
        $data['help_description'] = $this->language->get('help_description');
        $data['help_pf'] = $this->language->get('help_pf');
        $data['help_fob_price'] = $this->language->get('help_fob_price');
        $data['help_quantity'] = $this->language->get('help_quantity');
        $data['help_category'] = $this->language->get('help_category');

		$data['help_upc'] = $this->language->get('help_upc');
		$data['help_ean'] = $this->language->get('help_ean');
		$data['help_jan'] = $this->language->get('help_jan');
		$data['help_isbn'] = $this->language->get('help_isbn');
		$data['help_mpn'] = $this->language->get('help_mpn');
		$data['help_minimum'] = $this->language->get('help_minimum');
		$data['help_manufacturer'] = $this->language->get('help_manufacturer');
		$data['help_stock_status'] = $this->language->get('help_stock_status');
		$data['help_points'] = $this->language->get('help_points');
		$data['help_category'] = $this->language->get('help_category');
		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_download'] = $this->language->get('help_download');
		$data['help_related'] = $this->language->get('help_related');
		$data['help_tag'] = $this->language->get('help_tag');

		//mvds
		$data['entry_vendor_country_origin'] = $this->language->get('entry_vendor_country_origin');
		$data['entry_vendor_product_cost'] = $this->language->get('entry_vendor_product_cost');
		$data['entry_vendor_shipping_method'] = $this->language->get('entry_vendor_shipping_method');
		$data['entry_vendor_preferred_shipping_method'] = $this->language->get('entry_vendor_preferred_shipping_method');
		$data['entry_vendor_shipping_cost'] = $this->language->get('entry_vendor_shipping_cost');
		$data['entry_vendor_total'] = $this->language->get('entry_vendor_total');
		$data['entry_vendor_company'] = $this->language->get('entry_vendor_company');
		$data['entry_vendor_description'] = $this->language->get('entry_vendor_description');
		$data['entry_vendor_contact_name'] = $this->language->get('entry_vendor_contact_name');
		$data['entry_vendor_telephone'] = $this->language->get('entry_vendor_telephone');
		$data['entry_vendor_fax'] = $this->language->get('entry_vendor_fax');
		$data['entry_vendor_email'] = $this->language->get('entry_vendor_email');
		$data['entry_vendor_paypal_email'] = $this->language->get('entry_vendor_paypal_email');
		$data['entry_vendor_address'] = $this->language->get('entry_vendor_address');
		$data['entry_vendor_country_zone'] = $this->language->get('entry_vendor_country_zone');
		$data['entry_vendor_store_url'] = $this->language->get('entry_vendor_store_url');
		$data['entry_vendor_product_url'] = $this->language->get('entry_vendor_product_url');
		$data['entry_vendor_name'] = $this->language->get('entry_vendor_name');
		$data['entry_vendor_wholesale'] = $this->language->get('entry_vendor_wholesale');
		$data['entry_shipping_rate'] = $this->language->get('entry_shipping_rate');
		$data['tab_vendor'] = $this->language->get('tab_vendor');
		$data['tab_shipping'] = $this->language->get('tab_shipping');
		$data['txt_pending_approval'] = $this->language->get('txt_pending_approval');

		$data['entry_shipping_courier'] = $this->language->get('entry_shipping_courier');
		$data['entry_shipping_cost'] = $this->language->get('entry_shipping_cost');
		$data['entry_shipping_geozone'] = $this->language->get('entry_shipping_geozone');
		$data['button_add_shipping'] = $this->language->get('button_add_shipping');

		$data['help_vendor_country_origin'] = $this->language->get('help_vendor_country_origin');
		$data['help_vendor_shipping_method'] = $this->language->get('help_vendor_shipping_method');
		$data['help_vendor_preferred_shipping_method'] = $this->language->get('help_vendor_preferred_shipping_method');
		$data['help_vendor_total'] = $this->language->get('help_vendor_total');
		//mvde

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_attribute_add'] = $this->language->get('button_attribute_add');
		$data['button_option_add'] = $this->language->get('button_option_add');
		$data['button_option_value_add'] = $this->language->get('button_option_value_add');
		$data['button_discount_add'] = $this->language->get('button_discount_add');
		$data['button_special_add'] = $this->language->get('button_special_add');
		$data['button_image_add'] = $this->language->get('button_image_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_recurring_add'] = $this->language->get('button_recurring_add');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_attribute'] = $this->language->get('tab_attribute');
		$data['tab_option'] = $this->language->get('tab_option');
		$data['tab_recurring'] = $this->language->get('tab_recurring');
		$data['tab_discount'] = $this->language->get('tab_discount');
		$data['tab_special'] = $this->language->get('tab_special');
		$data['tab_image'] = $this->language->get('tab_image');
		$data['tab_links'] = $this->language->get('tab_links');
		$data['tab_reward'] = $this->language->get('tab_reward');
		$data['tab_design'] = $this->language->get('tab_design');
		$data['tab_openbay'] = $this->language->get('tab_openbay');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

        if (isset($this->error['more_images'])) {
			$data['error_more_images'] = $this->error['more_images'];
		} else {
			$data['error_more_images'] = '';
		}

        if (isset($this->error['main_image'])) {
			$data['error_main_image'] = $this->error['main_image'];
		} else {
			$data['error_main_image'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

        if (isset($this->error['attribute'])) {
			$data['error_attribute'] = $this->error['attribute'];
		} else {
			$data['error_attribute'] = array();
		}


		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		if (isset($this->error['model'])) {
			$data['error_model'] = $this->error['model'];
		} else {
			$data['error_model'] = '';
		}

		if (isset($this->error['fob_price'])) {
			$data['error_fob_price'] = $this->error['fob_price'];
		} else {
			$data['error_fob_price'] = '';
		}

		if (isset($this->error['error_special'])) {
			$data['error_special'] = $this->error['error_special'];
		} else {
			$data['error_special'] = '';
		}


		if (isset($this->error['category'])) {
			$data['error_category'] = $this->error['category'];
		} else {
			$data['error_category'] = '';
		}

		if (isset($this->error['error_quantity'])) {
			$data['error_quantity'] = $this->error['error_quantity'];
		} else {
			$data['error_quantity'] = '';
		}


		if (isset($this->error['date_available'])) {
			$data['error_date_available'] = $this->error['date_available'];
		} else {
			$data['error_date_available'] = '';
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

         if (isset($this->error['discount_price'])) {
			$data['error_discount_price'] = $this->error['discount_price'];
            $data['error_discount_price_row'] = $this->error['discount_price_row'];
		} else {
			$data['error_discount_price'] = '';
            $data['error_discount_price_row'] = '';
		}


		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if ($this->user->getCP()) {
			$data['category_access'] = unserialize($this->user->getCP());
		} else {
			$data['category_access'] = '0';
		}

		if ($this->user->getSP()) {
			$data['store_permission'] = unserialize($this->user->getSP());
		} else {
			$data['store_permission'] = '0';
		}

		if (!isset($this->request->get['product_id'])) {
			$data['action'] = $this->url->link('catalog/vdi_product/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/vdi_product/edit', 'action=save&token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/vdi_product', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST' ||
        (isset($this->request->get['action']) && ($this->request->get['action'] == "save")))) {
    		$product_info = $this->model_catalog_vdi_product->getProduct($this->request->get['product_id']);
		}

		if ($this->config->get('mvd_vendor_tab')) {
			$data['mvd_vendor_tab'] = true;
		} else {
			$data['mvd_vendor_tab'] = false;
		}

		if ($this->config->get('mvd_reward_points')) {
			$data['mvd_reward_points'] = true;
		} else {
			$data['mvd_reward_points'] = false;
		}

		if ($this->config->get('mvd_desgin_tab')) {
			$data['mvd_desgin_tab'] = true;
		} else {
			$data['mvd_desgin_tab'] = false;
		}

		if ($this->config->get('mvd_product_approval')) {
			$data['mvd_product_approval'] = true;
		} else {
			$data['mvd_product_approval'] = false;
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['product_description'])) {
			$data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_description'] = $this->model_catalog_vdi_product->getProductDescriptions($this->request->get['product_id']);
		} else {
			$data['product_description'] = array();
		}

		if (isset($this->request->get['product_id'])) {
			foreach ($this->model_catalog_vdi_product->getProductDescriptions($this->request->get['product_id']) as $pdname) {
				$product_name = $pdname['name'];
			}
		}

		if (isset($this->request->post['product_name'])) {
      		$data['product_name'] = $this->request->post['product_name'];
    	} elseif (!empty($product_name)) {
			$data['product_name'] = $product_name;
		} else {
      		$data['product_name'] = '';
    	}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($product_info)) {
			$data['image'] = $product_info['image'];
		} else {
			$data['image'] = '';
		}

        if (isset($this->request->post['main_image_name'])) {
			$data['main_image_name'] = $this->request->post['main_image_name'];
		}

        if (isset($this->request->post['addl_image1_name'])) {
			$data['addl_image1_name'] = $this->request->post['addl_image1_name'];
		}

        if (isset($this->request->post['addl_image2_name'])) {
			$data['addl_image2_name'] = $this->request->post['addl_image2_name'];
		}

        if (isset($this->request->post['addl_image3_name'])) {
              $data['addl_image3_name'] = $this->request->post['addl_image3_name'];
        }

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_info) && is_file(DIR_IMAGE . $product_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

        if (isset($this->request->post['main_image_name']) && is_file(DIR_IMAGE . $this->request->post['main_image_name'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['main_image_name'], 100, 100);
		}

        if (isset($this->request->post['addl_image1_name']) && is_file(DIR_IMAGE . $this->request->post['addl_image1_name'])) {
			$data['addl_image1_name_thumb'] = $this->model_tool_image->resize($this->request->post['addl_image1_name'], 100, 100);
		}

        if (isset($this->request->post['addl_image2_name']) && is_file(DIR_IMAGE . $this->request->post['addl_image2_name'])) {
			$data['addl_image2_name_thumb'] = $this->model_tool_image->resize($this->request->post['addl_image2_name'], 100, 100);
		}

    if (isset($this->request->post['addl_image3_name']) && is_file(DIR_IMAGE . $this->request->post['addl_image3_name'])) {
      $data['addl_image3_name_thumb'] = $this->model_tool_image->resize($this->request->post['addl_image3_name'], 100, 100);
    }

  		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['model'])) {
			$data['model'] = $this->request->post['model'];
		} elseif (!empty($product_info)) {
			$data['model'] = $product_info['model'];
		} else {
			$data['model'] = '';
		}

		if (isset($this->request->post['sku_'])) {
			$data['sku'] = $this->request->post['sku_'];
		} elseif (!empty($product_info)) {
			$data['sku'] = $product_info['sku'];
		} else {
			$data['sku'] = '';
		}

		if (isset($this->request->post['upc'])) {
			$data['upc'] = $this->request->post['upc'];
		} elseif (!empty($product_info)) {
			$data['upc'] = $product_info['upc'];
		} else {
			$data['upc'] = '';
		}

		if (isset($this->request->post['ean'])) {
			$data['ean'] = $this->request->post['ean'];
		} elseif (!empty($product_info)) {
			$data['ean'] = $product_info['ean'];
		} else {
			$data['ean'] = '';
		}

		if (isset($this->request->post['jan'])) {
			$data['jan'] = $this->request->post['jan'];
		} elseif (!empty($product_info)) {
			$data['jan'] = $product_info['jan'];
		} else {
			$data['jan'] = '';
		}

		if (isset($this->request->post['isbn'])) {
			$data['isbn'] = $this->request->post['isbn'];
		} elseif (!empty($product_info)) {
			$data['isbn'] = $product_info['isbn'];
		} else {
			$data['isbn'] = '';
		}

		if (isset($this->request->post['mpn'])) {
			$data['mpn'] = $this->request->post['mpn'];
		} elseif (!empty($product_info)) {
			$data['mpn'] = $product_info['mpn'];
		} else {
			$data['mpn'] = '';
		}

		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($product_info)) {
			$data['location'] = $product_info['location'];
		} else {
			$data['location'] = '';
		}

		if (isset($this->request->get['product_id'])) {
			foreach ($this->model_catalog_vdi_product->getProductDescriptions($this->request->get['product_id']) as $pdname) {
				$product_name = $pdname['name'];
			}
		}

		if (isset($this->request->post['product_name'])) {
			$data['product_name'] = $this->request->post['product_name'];
		} elseif (!empty($product_name)) {
			$data['product_name'] = $product_name;
		} else {
			$data['product_name'] = '';
		}

		$data['countries'] = $this->model_catalog_vdi_product->getCountry();

		if (isset($this->request->post['ori_country'])) {
      		$data['ori_country'] = $this->request->post['ori_country'];
    	} else if (isset($product_info)) {
			$data['ori_country'] = $product_info['ori_country'];
		} else {
      		$data['ori_country'] = '';
    	}

		if (isset($this->request->post['product_cost'])) {
      		$data['product_cost'] = $this->request->post['product_cost'];
    	} else if (isset($product_info)) {
			$data['product_cost'] = $product_info['product_cost'];
		} else {
      		$data['product_cost'] = '';
    	}

		$data['couriers'] = $this->model_catalog_vdi_product->getCourier();
		if (isset($this->request->post['shipping_method'])) {
      		$data['shipping_method'] = $this->request->post['shipping_method'];
    	} else if (isset($product_info)) {
			$data['shipping_method'] = $product_info['shipping_method'];
		} else {
      		$data['shipping_method'] = '0';
    	}

		if (isset($this->request->post['preferred_shipping'])) {
      		$data['preferred_shipping'] = $this->request->post['preferred_shipping'];
    	} else if (isset($product_info)) {
			$data['preferred_shipping'] = $product_info['prefered_shipping'];
		} else {
      		$data['preferred_shipping'] = '0';
    	}

		if (isset($this->request->post['shipping_cost'])) {
      		$data['shipping_cost'] = $this->request->post['shipping_cost'];
    	} else if (isset($product_info)) {
			$data['shipping_cost'] = $product_info['shipping_cost'];
		} else {
      		$data['shipping_cost'] = '';
    	}

		if (isset($this->request->post['vtotal'])) {
      		$data['vtotal'] = $this->request->post['vtotal'];
    	} else if (isset($product_info)) {
			$data['vtotal'] = $product_info['vtotal'];
		} else {
      		$data['vtotal'] = '';
    	}

		if (isset($this->request->post['product_url'])) {
      		$data['product_url'] = $this->request->post['product_url'];
    	} else if (isset($product_info)) {
			$data['product_url'] = $product_info['product_url'];
		} else {
      		$data['product_url'] = '';
    	}

		$data['vendors'] = $this->model_catalog_vdi_product->getVendors();

    	if (isset($this->request->post['vendor'])) {
      		$data['vendor'] = $this->request->post['vendor'];
		} elseif (isset($product_info)) {
			$data['vendor'] = $product_info['vendor'];
		} else {
      		$data['vendor'] = 0;
    	}

		if (isset($this->request->post['wholesale'])) {
      		$data['wholesale'] = $this->request->post['wholesale'];
    	} else if (isset($product_info)) {
			$data['wholesale'] = $product_info['wholesale'];
		} else {
      		$data['wholesale'] = '';
    	}

		if (isset($this->request->post['company'])) {
      		$data['company'] = $this->request->post['company'];
    	} else if (isset($product_info)) {
			$data['company'] = $product_info['company'];
		} else {
      		$data['company'] = '';
    	}

		if (isset($this->request->post['vname'])) {
      		$data['vname'] = $this->request->post['vname'];
    	} else if (isset($product_info)) {
			$data['vname'] = $product_info['vname'];
		} else {
      		$data['vname'] = '';
    	}

		if (isset($this->request->post['telephone'])) {
      		$data['telephone'] = $this->request->post['telephone'];
    	} else if (isset($product_info)) {
			$data['telephone'] = $product_info['telephone'];
		} else {
      		$data['telephone'] = '';
    	}

		if (isset($this->request->post['fax'])) {
      		$data['fax'] = $this->request->post['fax'];
    	} else if (isset($product_info)) {
			$data['fax'] = $product_info['fax'];
		} else {
      		$data['fax'] = '';
    	}

		if (isset($this->request->post['email'])) {
      		$data['email'] = $this->request->post['email'];
    	} else if (isset($product_info)) {
			$data['email'] = $product_info['email'];
		} else {
      		$data['email'] = '';
    	}

		if (isset($this->request->post['paypal_email'])) {
      		$data['paypal_email'] = $this->request->post['paypal_email'];
    	} else if (isset($product_info)) {
			$data['paypal_email'] = $product_info['paypal_email'];
		} else {
      		$data['paypal_email'] = '';
    	}

		if (isset($this->request->post['vendor_description'])) {
      		$data['vendor_description'] = $this->request->post['vendor_description'];
    	} else if (isset($product_info)) {
			$data['vendor_description'] = $product_info['vendor_description'];
		} else {
      		$data['vendor_description'] = '';
    	}

		if (isset($this->request->post['vendor_address'])) {
      		$data['vendor_address'] = $this->request->post['vendor_address'];
    	} else if (isset($product_info)) {
			$data['vendor_address'] = $product_info['address'];
		} else {
      		$data['vendor_address'] = '';
    	}

		if (isset($this->request->post['vendor_country_zone'])) {
      		$data['vendor_country_zone'] = $this->request->post['vendor_country_zone'];
    	} else if (isset($product_info)) {
			if (isset($product_info['country_id']) && isset($product_info['zone_id'])) {
				$this->load->model('localisation/zone');
				$zone = $this->model_localisation_zone->getZone((int)$product_info['zone_id']);
				if ($zone) {
					$vendor_zone = $zone['name'];
				} else {
					$vendor_zone =  $this->language->get('text_none');
				}

				$this->load->model('localisation/country');
				$country = $this->model_localisation_country->getCountry((int)$product_info['country_id']);
				$vendor_country = ', ' . $country['name'];
			} else {
				$vendor_zone = '';
				$vendor_country = '';
			}
			$data['vendor_country_zone'] = $vendor_zone . $vendor_country;
		} else {
      		$data['vendor_country_zone'] = '';
    	}

		if (isset($this->request->post['store_url'])) {
      		$data['store_url'] = $this->request->post['store_url'];
    	} else if (isset($product_info)) {
			$data['store_url'] = $product_info['store_url'];
		} else {
      		$data['store_url'] = '';
    	}

		$this->load->model('localisation/geo_zone');
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['product_shipping'])) {
			$data['product_shippings'] = $this->request->post['product_shipping'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_shippings'] = $this->model_catalog_vdi_product->getProductShippings($this->request->get['product_id']);
		} else {
			$data['product_shippings'] = array();
		}

		$this->load->model('catalog/vendor');
		$vendor_info = $this->model_catalog_vendor->getVendorProfile($this->user->getId());

		if (isset($vendor_info['vendor_id'])) {
			$data['default_vendor'] = $vendor_info['vendor_id'];
		} else {
			$data['default_vendor'] = '';
		}

		if (isset($vendor_info['country_id'])) {
			$data['default_country'] = $vendor_info['country_id'];
		} else {
			$data['default_country'] = '';
		}

		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['product_store'])) {
			$data['product_store'] = $this->request->post['product_store'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_store'] = $this->model_catalog_vdi_product->getProductStores($this->request->get['product_id']);
		} else {
			$data['product_store'] = array(0);
		}

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($product_info)) {
			$data['keyword'] = $product_info['keyword'];
		} else {
			$data['keyword'] = '';
		}

		if (isset($this->request->post['shipping'])) {
			$data['shipping'] = $this->request->post['shipping'];
		} elseif (!empty($product_info)) {
			$data['shipping'] = $product_info['shipping'];
		} else {
			$data['shipping'] = 1;
		}
/*
	if (isset($this->request->post['sp_price'])) {
      $data['sp_price'] = $this->currency->format($this->request->post['sp_price']);
    } elseif (!empty($product_info)) {
      $data['sp_price'] = $this->currency->format($product_info['sp_price']);
    } else {
      $data['sp_price'] = '';
    }

    if (isset($this->request->post['price'])) {
      $data['price'] = $this->currency->format($this->request->post['price']);
    } elseif (!empty($product_info)) {
      $data['price'] = $this->currency->format($product_info['price']);
    } else {
      $data['price'] = '';
    }
*/
		$this->load->model('catalog/recurring');

		$data['recurrings'] = $this->model_catalog_recurring->getRecurrings();

		if (isset($this->request->post['product_recurrings'])) {
			$data['product_recurrings'] = $this->request->post['product_recurrings'];
		} elseif (!empty($product_info)) {
			$data['product_recurrings'] = $this->model_catalog_vdi_product->getRecurrings($product_info['product_id']);
		} else {
			$data['product_recurrings'] = array();
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['tax_class_id'])) {
			$data['tax_class_id'] = $this->request->post['tax_class_id'];
		} elseif (!empty($product_info)) {
			$data['tax_class_id'] = $product_info['tax_class_id'];
		} else {
			$data['tax_class_id'] = 0;
		}

		if (isset($this->request->post['date_available'])) {
			$data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($product_info)) {
			$data['date_available'] = ($product_info['date_available'] != '0000-00-00') ? $product_info['date_available'] : '';
		} else {
			$data['date_available'] = date('Y-m-d');
		}

		if (isset($this->request->post['quantity'])) {
			$data['quantity'] = $this->request->post['quantity'];
		} elseif (!empty($product_info)) {
			$data['quantity'] = $product_info['quantity'];
		} else {
			$data['quantity'] = 10;
		}

		if (isset($this->request->post['minimum'])) {
			$data['minimum'] = $this->request->post['minimum'];
		} elseif (!empty($product_info)) {
			$data['minimum'] = $product_info['minimum'];
		} else {
			$data['minimum'] = 1;
		}

		if (isset($this->request->post['subtract'])) {
			$data['subtract'] = $this->request->post['subtract'];
		} elseif (!empty($product_info)) {
			$data['subtract'] = $product_info['subtract'];
		} else {
			$data['subtract'] = 1;
		}

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($product_info)) {
			$data['sort_order'] = $product_info['sort_order'];
		} else {
			$data['sort_order'] = 1;
		}

		$this->load->model('localisation/stock_status');

		$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();

		if (isset($this->request->post['stock_status_id'])) {
			$data['stock_status_id'] = $this->request->post['stock_status_id'];
		} elseif (!empty($product_info)) {
			$data['stock_status_id'] = $product_info['stock_status_id'];
		} else {
			$data['stock_status_id'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($product_info)) {
			$data['status'] = $product_info['status'];
		} else {
			$data['status'] = 5;
		}

	/*
		if (isset($this->request->post['fob_price'])) {
			$data['fob_price'] = $this->request->post['fob_price'];
		} elseif (!empty($product_info)) {
			$data['fob_price'] = $product_info['fob_price'];
		} else {
			$data['fob_price'] = 0;
		}*/

		if (isset($this->request->post['sp_price'])) {
			$data['sp_price'] = $this->request->post['sp_price'];
		} elseif (!empty($product_info)) {
			$data['sp_price'] = $this->currency->format($product_info['sp_price']);
		} else {
			$data['sp_price'] = 0;
		}

		if (isset($this->request->post['weight'])) {
			$data['weight'] = $this->request->post['weight'];
		} elseif (!empty($product_info)) {
			$data['weight'] = $product_info['weight'];
		} else {
			$data['weight'] = '';
		}

		$this->load->model('localisation/weight_class');

		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

		if (isset($this->request->post['weight_class_id'])) {
			$data['weight_class_id'] = $this->request->post['weight_class_id'];
		} elseif (!empty($product_info)) {
			$data['weight_class_id'] = $product_info['weight_class_id'];
		} else {
			$data['weight_class_id'] = $this->config->get('config_weight_class_id');
		}

		if (isset($this->request->post['length'])) {
			$data['length'] = $this->request->post['length'];
		} elseif (!empty($product_info)) {
			$data['length'] = $product_info['length'];
		} else {
			$data['length'] = '';
		}

		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($product_info)) {
			$data['width'] = $product_info['width'];
		} else {
			$data['width'] = '';
		}

		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($product_info)) {
			$data['height'] = $product_info['height'];
		} else {
			$data['height'] = '';
		}

		$this->load->model('localisation/length_class');

		$data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		if (isset($this->request->post['length_class_id'])) {
			$data['length_class_id'] = $this->request->post['length_class_id'];
		} elseif (!empty($product_info)) {
			$data['length_class_id'] = $product_info['length_class_id'];
		} else {
			$data['length_class_id'] = $this->config->get('config_length_class_id');
		}

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->post['manufacturer_id'])) {
			$data['manufacturer_id'] = $this->request->post['manufacturer_id'];
		} elseif (!empty($product_info)) {
			$data['manufacturer_id'] = $product_info['manufacturer_id'];
		} else {
			$data['manufacturer_id'] = 0;
		}

		if (isset($this->request->post['manufacturer'])) {
			$data['manufacturer'] = $this->request->post['manufacturer'];
		} elseif (!empty($product_info)) {
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($product_info['manufacturer_id']);

			if ($manufacturer_info) {
				$data['manufacturer'] = $manufacturer_info['name'];
			} else {
				$data['manufacturer'] = '';
			}
		} else {
			$data['manufacturer'] = '';
		}

		// Categories
		if (isset($this->request->post['product_category'])) {
			$data['product_category'] = $this->request->post['product_category'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_category'] = $this->model_catalog_vdi_product->getProductCategories($this->request->get['product_id']);
		} else {
			$data['product_category'] = array();
		}

		$this->load->model('catalog/vdi_category');
		$data['categories'] = $this->model_catalog_vdi_category->getCategories(0);

		/*$data['product_categories'] = array();

		foreach ($categories as $category_id) {
			$category_info = $this->model_catalog_category->getCategory($category_id);

			if ($category_info) {
				$data['product_categories'][] = array(
					'category_id' => $category_info['category_id'],
					'name' => ($category_info['path']) ? $category_info['path'] . ' &gt; ' . $category_info['name'] : $category_info['name']
				);
			}
		}*/

		// Filters
		$this->load->model('catalog/filter');

		if (isset($this->request->post['product_filter'])) {
			$filters = $this->request->post['product_filter'];
		} elseif (isset($this->request->get['product_id'])) {
			$filters = $this->model_catalog_vdi_product->getProductFilters($this->request->get['product_id']);
		} else {
			$filters = array();
		}

		$data['product_filters'] = array();

		foreach ($filters as $filter_id) {
			$filter_info = $this->model_catalog_filter->getFilter($filter_id);

			if ($filter_info) {
				$data['product_filters'][] = array(
					'filter_id' => $filter_info['filter_id'],
					'name'      => $filter_info['group'] . ' &gt; ' . $filter_info['name']
				);
			}
		}
		$product_attributes = array();
		$product_attributes_vals = array();

		// Attributes
		$this->load->model('catalog/attribute');

		if (isset($this->request->post['product_attribute'])) {
			$product_attributes = $this->request->post['product_attribute'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_attributes = $this->model_catalog_vdi_product->getProductAttributes($this->request->get['product_id']);
		} else {
			$product_attributes = array();
		}

		$data['product_attributes'] = array();


		foreach ($product_attributes as $product_attribute) {
     		$attribute_info = $this->model_catalog_attribute->getAttribute($product_attribute['attribute_id']);
			if ($attribute_info) {
				$data['product_attributes'][] = array(
					'attribute_id'                  => $product_attribute['attribute_id'],
					'name'                          => $attribute_info['name'],
					'product_attribute_description' => $product_attribute['product_attribute_description']
				);
			}
		}


		// Options
		$this->load->model('catalog/option');

		if (isset($this->request->post['product_option'])) {
			$product_options = $this->request->post['product_option'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_options = $this->model_catalog_vdi_product->getProductOptions($this->request->get['product_id']);
		} else {
			$product_options = array();
		}

		$data['product_options'] = array();

		foreach ($product_options as $product_option) {
			$product_option_value_data = array();

			if (isset($product_option['product_option_value'])) {
				foreach ($product_option['product_option_value'] as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'points'                  => $product_option_value['points'],
						'points_prefix'           => $product_option_value['points_prefix'],
						'weight'                  => $product_option_value['weight'],
						'weight_prefix'           => $product_option_value['weight_prefix']
					);
				}
			}

			$data['product_options'][] = array(
				'product_option_id'    => $product_option['product_option_id'],
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option['option_id'],
				'name'                 => $product_option['name'],
				'type'                 => $product_option['type'],
				'value'                => isset($product_option['value']) ? $product_option['value'] : '',
				'required'             => $product_option['required']
			);
		}

		$data['option_values'] = array();

		foreach ($data['product_options'] as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				if (!isset($data['option_values'][$product_option['option_id']])) {
					$data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
				}
			}
		}

		$this->load->model('sale/customer_group');

		$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		if (isset($this->request->post['product_discount']) && count($this->error)) {
			$product_discounts = $this->request->post['product_discount'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_discounts = $this->model_catalog_vdi_product->getProductDiscounts($this->request->get['product_id']);
		} else {
			$product_discounts = array();
		}


		$data['product_discounts'] = array();
        //zighia
        //same price for all users
        //yeah...in the future will be a modul for this
        $discount_steps = array(12,24,48,72,98,198,298,398,498,500);
        $data['discount_start_pallet'] =  $this->language->get('discount_start_pallet');
        $data['discount_end_pallet'] = 498;

        $curr_qty= 0;
        if (count ($product_discounts)){

                foreach ($product_discounts as $product_discount) {
/*                    echo '<pre>';
                    var_dump ($product_discount);
                    echo '</pre>';*/
                    if (!isset($product_discount['price'])&&
                       !isset($product_discount['sp_price'])&&
                       (float)$product_discount['fob_price'] > 0) {
                             $fob_price = (float)$product_discount['fob_price'];
                             $sp_price = $fob_price;
                             foreach($this->config->get('fob_margins') as $margin) {
                                 if($margin['fob'] == 1) {
                                    eval('$sp_price = '."$sp_price + ($fob_price $margin[sign] $margin[value])".';');
                                 } else {
                                        eval('$sp_price = '."$sp_price $margin[sign] $margin[value]".';');
                                  }
                              }
                              $product_discount['price'] = $data['pf'] * $sp_price;
                              $product_discount['sp_price'] = $sp_price;
                    }

                    if ($curr_qty != $product_discount['quantity']){
                            $curr_qty = $product_discount['quantity'];
                            $output_array = array();
                            preg_match("/(\d+).* (\d+)/", $product_discount['step-text'], $output_array);
                            $data['product_discounts'][] = array(
                                'customer_group_id' => $product_discount['customer_group_id'],
                                'quantity'          => $product_discount['quantity'],
                                'step_text'         => $product_discount['step-text'],
                                'step_per_bottle'   => !isset($output_array[2])?
                                                                null:
                                                      ($data['pf']*$product_discount['quantity'])."+ ".
                                                     ($data['pf']*$output_array[2]),
                                'priority'          => $product_discount['priority'],
                                'bottle_price'      =>  $this->currency->format((float)$product_discount['sp_price']),
                                'price'             =>  $this->currency->format((float)$product_discount['price']),
                                'fob_price'         =>  sprintf ("%6.2f",(float)$product_discount['fob_price']),
                                'date_start'        => ($product_discount['date_start'] != '0000-00-00') ? $product_discount['date_start'] : '',
                                'date_end'          => ($product_discount['date_end'] != '0000-00-00') ? $product_discount['date_end'] : ''
                            );
                    }
               }
        }
        else{
             for($i=0; $i<count($discount_steps)-1; $i++) {
                          $min = $discount_steps[$i];
                          $max = $discount_steps[$i+1];
                          $data['product_discounts'][] = array(
                                'customer_group_id' => 1,
                                'quantity'          => $min,
                                'step_text'         => $min."+ ".($max-1),
                                'step_per_bottle'   => ($data['pf']*$min)."+ ".($data['pf']*($max-1)),
                                'priority'          => '0',
                                'price'             =>  '',
                                'fob_price'         =>  '',
                                'bottle_price'        =>  '',
                                'date_start'        => ($product_discount['date_start'] != '0000-00-00') ? $product_discount['date_start'] : '',
                                'date_end'          => ($product_discount['date_end'] != '0000-00-00') ? $product_discount['date_end'] : ''
                            );
               }
          }

		if (isset($this->request->post['product_special'])) {
			$product_specials = $this->request->post['product_special'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_specials = $this->model_catalog_vdi_product->getProductSpecials($this->request->get['product_id']);
		} else {
			$product_specials = array();
		}


		foreach ($product_specials as $product_special) {
		    if (!isset($product_special['fob_price']))
			 	$product_special['fob_price'] = $product_special['price'];
			$data['product_specials'][] = array(
				'customer_group_id' => $product_special['customer_group_id'],
				'priority'          => $product_special['priority'],
				'price'             =>  sprintf ("%6.2f",$product_special['price']),
                'fob_price'         =>  sprintf ("%6.2f",$product_special['fob_price']), //round($product_special['fob_price'], 2),
				'date_start'        => ($product_special['date_start'] != '0000-00-00') ? $product_special['date_start'] : '',
				'date_end'          => ($product_special['date_end'] != '0000-00-00') ? $product_special['date_end'] :  ''
			);
		}

		// Images
		if (isset($this->request->post['product_image'])) {
			$product_images = $this->request->post['product_image'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_images = $this->model_catalog_vdi_product->getProductImages($this->request->get['product_id']);
		} else {
			$product_images = array();
		}

		$data['product_images'] = array();

		foreach ($product_images as $product_image) {
			if (is_file(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
				$thumb = $product_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['product_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order' => $product_image['sort_order']
			);
		}

		// Downloads
		$this->load->model('catalog/download');

		if (isset($this->request->post['product_download'])) {
			$product_downloads = $this->request->post['product_download'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_downloads = $this->model_catalog_vdi_product->getProductDownloads($this->request->get['product_id']);
		} else {
			$product_downloads = array();
		}

		$data['product_downloads'] = array();

		foreach ($product_downloads as $download_id) {
			$download_info = $this->model_catalog_download->getDownload($download_id);

			if ($download_info) {
				$data['product_downloads'][] = array(
					'download_id' => $download_info['download_id'],
					'name'        => $download_info['name']
				);
			}
		}

		if (isset($this->request->post['product_related'])) {
			$products = $this->request->post['product_related'];
		} elseif (isset($this->request->get['product_id'])) {
			$products = $this->model_catalog_vdi_product->getProductRelated($this->request->get['product_id']);
		} else {
			$products = array();
		}

		$data['product_relateds'] = array();

		foreach ($products as $product_id) {
			$related_info = $this->model_catalog_vdi_product->getProduct($product_id);

			if ($related_info) {
				$data['product_relateds'][] = array(
					'product_id' => $related_info['product_id'],
					'name'       => $related_info['name']
				);
			}
		}

		if (isset($this->request->post['points'])) {
			$data['points'] = $this->request->post['points'];
		} elseif (!empty($product_info)) {
			$data['points'] = $product_info['points'];
		} else {
			$data['points'] = '';
		}

		if (isset($this->request->post['product_reward'])) {
			$data['product_reward'] = $this->request->post['product_reward'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_reward'] = $this->model_catalog_vdi_product->getProductRewards($this->request->get['product_id']);
		} else {
			$data['product_reward'] = array();
		}

		if (isset($this->request->post['product_layout'])) {
			$data['product_layout'] = $this->request->post['product_layout'];
		} elseif (isset($this->request->get['product_id'])) {
			$data['product_layout'] = $this->model_catalog_vdi_product->getProductLayouts($this->request->get['product_id']);
		} else {
			$data['product_layout'] = array();
		}

		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/vdi_header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['top_menu'] = $this->load->controller('common/vdi_top_menu');

		$this->load->model('catalog/vdi_vendor_profile');

		$vendors_info = $this->model_catalog_vdi_vendor_profile->getVendorProfile($this->user->getId());
		$data['vendor_manufacturer'] = $vendors_info['company'];

		//custom rating
		$this->load->model('module/ratings');

		if (isset($this->request->get['product_id'])) {
			$data['ratingHtml']     = $this->model_module_ratings->buildRatings($this->request->get['product_id']);
		} else {
			$data['ratingHtml']     = $this->model_module_ratings->buildRatings();
		}

		$this->response->setOutput($this->load->view('catalog/vdi_product_form.tpl', $data));
	}

	protected function validateForm() {

		if (!$this->user->hasPermission('modify', 'catalog/vdi_product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}


        if ( $this->request->post['addl_image2_name'] == '' &&  $this->request->post['addl_image1_name'] == ''){
            $this->error['more_images'] = $this->language->get('error_more_images');
        }



        if ($this->request->post['main_image_name'] == '' ){
            $this->error['main_image'] = $this->language->get('error_main_image');
        }


        foreach ($this->request->post['product_attribute'] as $attribute_id => $value) {

            if ($value['attribute_type']== "Text")
                    continue;

            if (!isset($value['attribute_description']) ||
                 (is_array($value['attribute_description'])
                     && count($value['attribute_description']) ==1 && $value['attribute_description'][0] =='')||
                  (!is_array($value['attribute_description']) && $value['attribute_description'] == ''))
                    $this->error['attribute'][$value['attribute_id']] = $this->language->get('error_attribute');

		}

		foreach ($this->request->post['product_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				//$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

	/*	if ((utf8_strlen($this->request->post['quantity']) < 1) || (utf8_strlen($this->request->post['quantity']) > 4)) {
			$this->error['quantity'] = $this->language->get('error_quantity');
		}*/

		if (!$this->request->post['product_category']) {
			$this->error['category'] = $this->language->get('error_category');
		}

       // var_dump($this->request->post['fob_price']);

		if ((utf8_strlen($this->request->post['fob_price']) < 1)
                || (utf8_strlen($this->request->post['fob_price']) > 9)
                || (float)$this->request->post['fob_price'] == 0
                ) {
			$this->error['fob_price'] = $this->language->get('error_fob_price');
		}else{
			if (isset($this->request->post['product_special'][0]['price']))
				if (floatval($this->request->post['product_special'][0]['price']) > $this->request->post['fob_price'])
						$this->error['error_special'] = $this->language->get('special_bigger_than_price');
		}

        if (!is_numeric($this->request->post['fob_price']))
        {
             $this->error['fob_price'] = $this->language->get('error_NAN');
        }

		if (isset($this->request->post['product_special'][0]['price'])){
			if (floatval($this->request->post['product_special'][0]['price']) == 0)
					$this->error['error_special'] = $this->language->get('special_is_zero');

	    }

        if ((int)$this->request->post['quantity'] < 10){
			$this->error['error_quantity'] = $this->language->get('error_qty');

	    }

        if (strlen(trim($this->request->post['keyword'])) == 0){
			$this->error['keyword'] = $this->language->get('error_keyword_mandatory');

	    }

     	if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['product_id']) && $url_alias_info['query'] != 'product_id=' . $this->request->get['product_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}


			if ($url_alias_info && !isset($this->request->get['product_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

                if (isset($this->error['discount_price'])) {
	        		$data['error_discount_price'] = $this->error['discount_price'];
		         } else {
			        $data['error_discount_price'] = '';
		       }

		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

        if (isset($this->request->post['product_discount'])) {
			$product_discounts = $this->request->post['product_discount'];
            foreach ($product_discounts as  $row=>$pd){
                if ((float)$pd['fob_price'] > $this->request->post['fob_price']){
                    $this->error['discount_price'] = $this->language->get('error_discount_price');
                    $this->error['discount_price_row'] = $row;
                }
            }

            for ($i=1; $i<count($product_discounts); $i++){
                     if ($product_discounts[$i]['fob_price'] > $product_discounts[$i-1]['fob_price'] ){
                        $this->error['discount_price'] = $this->language->get('error_discount_price_min');
                        $this->error['discount_price_row'] = $i;
                        break;
                    }
            }
      	}

        if (count ($this->error))
         $this->error['warning'] = $this->language->get('error_warning');

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/vdi_product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateCopy() {
		if (!$this->user->hasPermission('modify', 'catalog/vdi_product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

   public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_sku'])) {
			$this->load->model('catalog/vdi_product');
			$this->load->model('catalog/vdi_option');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_sku'])) {
				$filter_sku = $this->request->get['filter_sku'];
			} else {
				$filter_sku = '';
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
				'filter_sku'   => $filter_sku,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_vdi_product->getProducts($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$product_options = $this->model_catalog_vdi_product->getProductOptions($result['product_id']);

				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_vdi_option->getOption($product_option['option_id']);

					if ($option_info) {
						$product_option_value_data = array();

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->model_catalog_vdi_option->getOptionValue($product_option_value['option_value_id']);

							if ($option_value_info) {
								$product_option_value_data[] = array(
									'product_option_value_id' => $product_option_value['product_option_value_id'],
									'option_value_id'         => $product_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
									'price_prefix'            => $product_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'product_option_id'    => $product_option['product_option_id'],
							'product_option_value' => $product_option_value_data,
							'option_id'            => $product_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $product_option['value'],
							'required'             => $product_option['required']
						);
					}
				}

				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'model'      => $result['model'],
					'option'     => $option_data,
					'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	/*mvds*/
	public function vendor() {
		$this->load->model('catalog/vdi_product');

		if (isset($this->request->get['vendor_id'])) {
			$vendor_id = $this->request->get['vendor_id'];
		} else {
			$vendor_id = 0;
		}

		$results = $this->model_catalog_vdi_product->getVendorsByVendorId($vendor_id);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($results));
	}

	private function validateUpdate() {

		$this->load->model('catalog/vdi_product');
    	$isproductexist = $this->model_catalog_vdi_product->ValidateVendorUpdate($this->request->get['product_id']);

		if ($isproductexist < 1 && !isset($this->error['warning'])) {
			//$this->error['warning'] = $this->language->get('error_warning');
		}

     	if ($isproductexist > 0) {
			return true;
    	} else {
      		return false;
    	}
  	}

	private function OverMaxLimit() {

		$this->load->model('catalog/prolimit');
    	$maxproducts = $this->model_catalog_prolimit->getTotalProducts();
		$assignLimit = $this->model_catalog_prolimit->getAssignLimit();

		if ($maxproducts > $assignLimit - 1) {
			$this->error['warning'] = $this->language->get('error_max_warning');
		}

		if (isset($this->request->post['selected'])) {
			if (($maxproducts + (isset($this->request->post['selected']) ? count($this->request->post['selected']) : 0)) > $assignLimit) {
				$this->error['warning'] = $this->language->get('error_max_warning');
			}
		}

     	if ($this->error) {
			return true;
    	} else {
      		return false;
    	}
  	}

	public function manufacturerAutocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/vdi_product');

			$data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);

			$results = $this->model_catalog_vdi_product->getManufacturers($data);

			foreach ($results as $result) {
				$json[] = array(
					'manufacturer_id' => $result['manufacturer_id'],
					'name'            => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function filterAutocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/vdi_product');

			$data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);

			$filters = $this->model_catalog_vdi_product->getFilters($data);

			foreach ($filters as $filter) {
				$json[] = array(
					'filter_id' => $filter['filter_id'],
					'name'      => strip_tags(html_entity_decode($filter['group'] . ' &gt; ' . $filter['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function add_edit_notification($pmode = true,$pname) {

		$this->language->load('mail/email_notification');

		$this->load->model('catalog/vdi_product');

		$vendor_data = $this->model_catalog_vdi_product->getVendorName($this->user->getId());

		if ($pmode) {
			$subject = sprintf($this->language->get('text_subject_add'), $pname, $vendor_data['vendor_name']);
		} else {
			$subject = sprintf($this->language->get('text_subject_edit'), $vendor_data['vendor_name'], $pname);
		}

		$text = sprintf($this->language->get('text_to'), $this->config->get('config_owner')) . "<br><br>";

		if ($pmode) {
			$text .= sprintf($this->language->get('text_message_add'), $vendor_data['vendor_name'], $pname) . "<br><br>";
		} else {
			$text .= sprintf($this->language->get('text_message_edit'), $pname, $vendor_data['vendor_name']) . "<br><br>";
		}

		$text .= $this->language->get('text_thanks') . "<br>";
		$text .= $this->config->get('config_name') . "<br><br>";
		$text .= $this->language->get('text_system');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		//$mail->setTo($this->config->get('config_email'));
        $mail->setTo("seller1@thinkwinetrade.com");
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($this->config->get('config_name'));
		$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
		$mail->setHtml(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
		$mail->send();
	}
	/*mvde*/

	public function checklist_venue($pro=0){
		$this->load->model('catalog/vendor');
		$profiles = $this->model_catalog_vendor->getVendorProfile($this->user->getId());
		$total_products = $this->model_catalog_vendor->getTotalProductVendors($profiles['vendor_id']);

		$dashboard = true;
		if($profiles['vendor_image'] == ''){
			$dashboard = false;
			$this->response->redirect($this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if($total_products == 0){
			$dashboard = false;
			if($pro == 1){
				$this->response->redirect($this->url->link('catalog/vdi_product/add', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}

		/*if(($profiles['paypal_email'] == '' || $profiles['payment'] == '') && $dashbpard){
			$dashboard = false;
			$this->response->redirect($this->url->link('catalog/vdi_vendor_profile', 'token=' . $this->session->data['token'], 'SSL'));
		}*/
		if($profiles['notification'] == 1 ){

			$dashboard = false;



		}
	}
	function update_new_stock(){
		$new_stock_num = $this->request->get['num_stock'];
		$product_id = $this->request->get['product_id'];
		$vendor_id = $this->request->get['vendor_id'];
		$done_update = $this->request->get['done_update'];



		$this->load->model('catalog/cron_inventory');

		if(!$done_update){
			$this->model_catalog_cron_inventory->updateStockValue($product_id,$new_stock_num);
		}

		$this->model_catalog_cron_inventory->updateStatusStock($vendor_id,$product_id);

		$check = $this->model_catalog_cron_inventory->checkStatusStock($vendor_id,$product_id);
		$refresh=0;
		if($check){
			$this->model_catalog_cron_inventory->updateNotificationUpdateStock($vendor_id);
			$user_id = $this->model_catalog_cron_inventory->get_user_vendor($vendor_id);
			//$this->model_catalog_cron_inventory->EnabledAllProducts($user_id);
			$refresh = 1;
		}
		echo $refresh;
	}

        public function ajax_popup(){
            $this->load->language('catalog/popup');
            $data['popups'] = array(
                array(
                    'title' => $this->language->get('product_name_title'),
                    'text' => $this->language->get('product_name_tip'),
                    'element' => "input[data-help=product_description]:visible"
                ),
                array(
                    'title' => $this->language->get('product_description_title'),
                    'text' => $this->language->get('product_description_tip'),
                    'element' => ".note-editable:visible"
                ),
                array(
                    'title' => $this->language->get('status_title'),
                    'text' => $this->language->get('status_tip'),
                    'element' => ".bootstrap-switch"
                ),
                array(
                    'title' => $this->language->get('sku_title'),
                    'text' => $this->language->get('sku_tip'),
                    'element' => "label[for=input-sku] span"
                ),
                array(
                    'title' => $this->language->get('carton_title'),
                    'text' => $this->language->get('carton_tip'),
                    'element' => 'label[for=input-pf] span'
                ),
                array(
                    'title' => $this->language->get('export_title'),
                    'text' => $this->language->get('export_tip'),
                    'element' => 'input[name=fob_price]'
                ),
                array(
                    'title' => $this->language->get('bottleprice_title'),
                    'text' => $this->language->get('bottleprice_tip'),
                    'element' => 'label:contains("Notre Prix de Vente par Bouteille")'
                ),
                array(
                    'title' => $this->language->get('box_title'),
                    'text' => $this->language->get('box_tip'),
                    'element' => 'label:contains("Notre Prix de Vente par Carton")'
                ),
                array(
                    'top' => '1794px',
                    'left' => '608.16px',
                    'title' => $this->language->get('stock_title'),
                    'text' => $this->language->get('stock_tip'),
                    'element' => "#input-quantity"
                ),
                array(
                    'title' => $this->language->get('keyword_title'),
                    'text' => $this->language->get('keyword_tip'),
                    'element' => "#input-keyword"
                ),
                array(
                    'title' => $this->language->get('weight_title'),
                    'text' => $this->language->get('weight_tip'),
                    'element' => "select[name=weight]"
                ),
                array(
                    'title' => $this->language->get('region_title'),
                    'text' => $this->language->get('region_tip'),
                    'element' => "label[for=input-category] span"
                ),
                array(
                    'title' => $this->language->get('attributes_title'),
                    'text' => $this->language->get('attributes_tip'),
                    'element' => "#attribute"
                ),
                array(
                    'title' => $this->language->get('upload_title'),
                    'text' => $this->language->get('upload_tip'),
                    'element' => "#tab-image td:first"
                )
            );
            echo json_encode($data);
            exit();

        }
}
