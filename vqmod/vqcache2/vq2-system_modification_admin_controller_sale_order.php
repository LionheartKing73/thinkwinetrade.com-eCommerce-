<?php
class ControllerSaleOrder extends Controller {
	private $error = array();

	public function truncate() {
    	$this->db->query("TRUNCATE TABLE oc_order");
    	$this->db->query("TRUNCATE TABLE oc_order_history");
    	$this->db->query("TRUNCATE TABLE oc_order_product");
    	$this->db->query("TRUNCATE TABLE oc_order_status_vendor_update");
   	 	$this->db->query("TRUNCATE TABLE oc_order_total");
    	$this->db->query("TRUNCATE TABLE oc_order_vendor_new");
   	 	$this->db->query("TRUNCATE TABLE oc_pallet");
    	$this->db->query("TRUNCATE TABLE oc_pallet_product");
    	$this->db->query("TRUNCATE TABLE oc_worksheet");
    	
    	$this->response->setOutput(json_encode(array('status' => 'ok')));
    }

	public function index() {
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		$this->getList();
	}

	public function add() {
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		unset($this->session->data['cookie']);

		if ($this->validate()) {
			// API
			$this->load->model('user/api');

			$api_info = $this->model_user_api->getApi($this->config->get('config_api_id'));

			if ($api_info) {
				$curl = curl_init();

				// Set SSL if required
				if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
					curl_setopt($curl, CURLOPT_PORT, 443);
				}

				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLINFO_HEADER_OUT, true);
				curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/login');
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($api_info));

				$json = curl_exec($curl);

				if (!$json) {
					$this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
				} else {
					$response = json_decode($json, true);

					if (isset($response['cookie'])) {
						$this->session->data['cookie'] = $response['cookie'];
					}

					curl_close($curl);
				}
			}
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		unset($this->session->data['cookie']);

		if ($this->validate()) {
			// API
			$this->load->model('user/api');

			$api_info = $this->model_user_api->getApi($this->config->get('config_api_id'));

			if ($api_info) {
				$curl = curl_init();

				// Set SSL if required
				if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
					curl_setopt($curl, CURLOPT_PORT, 443);
				}

				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLINFO_HEADER_OUT, true);
				curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/login');
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($api_info));

				$json = curl_exec($curl);

				if (!$json) {
					$this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
				} else {
					$response = json_decode($json, true);

					if (isset($response['cookie'])) {
						$this->session->data['cookie'] = $response['cookie'];
					}

					curl_close($curl);
				}
			}
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('sale/order');

		$this->document->setTitle($this->language->get('heading_title'));

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		//unset($this->session->data['cookie']);
		if (isset($this->request->get['order_id'])) {

			// API
			$this->load->model('user/api');

			$api_info = $this->model_user_api->getApi($this->config->get('config_api_id'));

			if ($api_info) {
				$curl = curl_init();

				// Set SSL if required
				if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
					curl_setopt($curl, CURLOPT_PORT, 443);
				}

				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLINFO_HEADER_OUT, true);
				curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/login');
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($api_info));

				$json = curl_exec($curl);

				if (!$json) {
					$this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
				} else {
					$response = json_decode($json, true);

					if (isset($response['cookie'])) {
						$this->session->data['cookie'] = $response['cookie'];
					}

					curl_close($curl);

          $this->load->model('pallet/worksheet');
          $this->model_pallet_worksheet->destroyWorksheetByOrderId($this->request->get['order_id']);
      
				}
			}
		}

		if (isset($this->session->data['cookie'])) {
			$curl = curl_init();

			// Set SSL if required
			if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
				curl_setopt($curl, CURLOPT_PORT, 443);
			}

			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLINFO_HEADER_OUT, true);
			curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/order/delete&order_id=' . $this->request->get['order_id']);
			curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

			$json = curl_exec($curl);

			if (!$json) {
				$this->error['warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
			} else {
				$response = json_decode($json, true);

				curl_close($curl);

				if (isset($response['error'])) {
					$this->error['warning'] = $response['error'];
				}
			}
		}

		if (isset($response['error'])) {
			$this->error['warning'] = $response['error'];
		}

		if (isset($response['success'])) {
			$this->session->data['success'] = $response['success'];

			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}

			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_order_status'])) {
				$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
			}

			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}


		if (isset($this->request->get['filter_container_id'])) {
			$filter_container_id = $this->request->get['filter_container_id'];
		} else {
			$filter_container_id = null;
		}
		if (isset($this->request->get['filter_shipment_id'])) {
			$filter_shipment_id = $this->request->get['filter_shipment_id'];
		} else {
			$filter_shipment_id = null;
		}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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

			$this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_order_id'])) {
			$filter_order_id = $this->request->get['filter_order_id'];
		} else {
			$filter_order_id = null;
		}

        if (isset($this->request->get['filter_container_id'])) {
			$filter_container_id = $this->request->get['filter_container_id'];
		} else {
			$filter_container_id = null;
		}

         if (isset($this->request->get['filter_shipment_id'])) {
			$filter_shipment_id = $this->request->get['filter_shipment_id'];
		} else {
			$filter_shipment_id = null;
		}

		if (isset($this->request->get['filter_customer'])) {
			$filter_customer = $this->request->get['filter_customer'];
		} else {
			$filter_customer = null;
		}


if (isset($this->request->get['filter_pallet_id'])) {
      $filter_pallet_id = $this->request->get['filter_pallet_id'];
    } else {
      $filter_pallet_id = null;
    }
      
		if (isset($this->request->get['filter_order_status'])) {
			$filter_order_status = $this->request->get['filter_order_status'];
		} else {
			$filter_order_status = null;
		}

		if (isset($this->request->get['filter_total'])) {
			$filter_total = $this->request->get['filter_total'];
		} else {
			$filter_total = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}


		if (isset($this->request->get['filter_container_id'])) {
			$filter_container_id = $this->request->get['filter_container_id'];
		} else {
			$filter_container_id = null;
		}
		if (isset($this->request->get['filter_shipment_id'])) {
			$filter_shipment_id = $this->request->get['filter_shipment_id'];
		} else {
			$filter_shipment_id = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$filter_date_modified = $this->request->get['filter_date_modified'];
		} else {
			$filter_date_modified = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'o.order_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

        if (isset($this->request->get['filter_container_id'])) {
			$url .= '&filter_container_id=' . $this->request->get['filter_container_id'];
		}

        if (isset($this->request->get['filter_shipment_id'])) {
			$url .= '&filter_shipment_id=' . $this->request->get['filter_shipment_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

if (isset($this->request->get['filter_pallet_id'])) {
      $url .= '&filter_pallet_id=' . $this->request->get['filter_pallet_id'];
    }
      
		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}


		if (isset($this->request->get['filter_container_id'])) {
			$filter_container_id = $this->request->get['filter_container_id'];
		} else {
			$filter_container_id = null;
		}
		if (isset($this->request->get['filter_shipment_id'])) {
			$filter_shipment_id = $this->request->get['filter_shipment_id'];
		} else {
			$filter_shipment_id = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['invoice'] = $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'], 'SSL');
			$data['packing'] = $this->url->link('sale/order/packing', 'token=' . $this->session->data['token'], 'SSL');
			$data['variety_list'] = $this->url->link('sale/order/variety_list', 'token=' . $this->session->data['token'], 'SSL');
			$data['packing_list_pdf'] = $this->url->link('sale/order/packinglistpdf', 'token=' . $this->session->data['token'], 'SSL');
			$data['packing_list_xls'] = $this->url->link('sale/order/packinglistxls', 'token=' . $this->session->data['token'], 'SSL');
			$data['appendix_pdf'] = $this->url->link('sale/order/appendixpdf', 'token=' . $this->session->data['token'], 'SSL');
			$data['appendix_xls'] = $this->url->link('sale/order/appendixxls', 'token=' . $this->session->data['token'], 'SSL');
			$data['shipping_pdf'] = $this->url->link('sale/order/shippingpdf', 'token=' . $this->session->data['token'], 'SSL');
			$data['shipping_xls'] = $this->url->link('sale/order/shippingxls', 'token=' . $this->session->data['token'], 'SSL');
			$data['invoice_pdf'] = $this->url->link('sale/order/invoicepdf', 'token=' . $this->session->data['token'], 'SSL');
			$data['invoice_xls'] = $this->url->link('sale/order/invoicexls', 'token=' . $this->session->data['token'], 'SSL');	

		$data['shipping'] = $this->url->link('sale/order/shipping', 'token=' . $this->session->data['token'], 'SSL');
		$data['add'] = $this->url->link('sale/order/add', 'token=' . $this->session->data['token'], 'SSL');

		$data['orders'] = array();

		$filter_data = array(

      'filter_pallet_id'     => $filter_pallet_id,
      
			'filter_order_id'      => $filter_order_id,
            'filter_container_id'      => $filter_container_id,
			'filter_customer'	   => $filter_customer,
			'filter_order_status'  => $filter_order_status,
			'filter_total'         => $filter_total,
			'filter_date_added'    => $filter_date_added,

			'filter_container_id' => $filter_container_id,
			'filter_shipment_id' => $filter_shipment_id,

			'filter_date_modified' => $filter_date_modified,
			'sort'                 => $sort,
			'order'                => $order,
			'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                => $this->config->get('config_limit_admin')
		);

		$order_total = $this->model_sale_order->getTotalOrders($filter_data);
		$data['total_products_pallets'] = $this->model_sale_order->getTotalProductsInOrders($filter_data);

		$results = $this->model_sale_order->getOrders($filter_data);
$this->load->model('pallet/worksheet');

		foreach ($results as $result) {

              $status = $this->model_sale_order->getAllVendorOrderStatus($result['order_id']);
				
			if ($status) {
				$status = $status;
			} else {
				$status = $result['status'];
			}
                
                    $products = $this->model_sale_order->getOrderProducts($result['order_id']);
                    $verified_product=1;
                    if(count($products)>0)
                    {
                        foreach ($products as $prod) {
							if($prod["product_received"]==0 || $prod["documents_received"]==0)
                                $verified_product=0;
                        }
                    }
if($result['order_status_id'] == 19) {
          $pallets_ids = $this->model_pallet_worksheet->getConfirmedPalletsIds($result['order_id']);
$print_dots = 1;
        } elseif ($result['order_status_id'] == 3) {
          $pallets_ids = $this->model_pallet_worksheet->getShippedPalletsIds($result['order_id']);
$print_dots = 1;
        } else {
          $pallets_ids = $this->model_pallet_worksheet->getPalletsIds($result['order_id']);
$print_dots = 0;
        }
if(!isset($comment)) { $comment = ''; }
			$data['orders'][] = array(
                                'order_id'      => $result['order_id'],
'pallets'       => $pallets_ids,
        'noofpallets'   => $result['noofpallets'],
        'order_status_payement'   => $this->model_sale_order->getPayementStatus($result['order_id']),
'print_dots'   => $print_dots,
				'customer'      => $result['customer'],
				
          	'status'     => $status,

                  'container_id'         => $this->model_sale_order->getContainerID( $result['order_id'] ),
                  'shipment_id'         => $this->model_sale_order->getShipmentID( $result['order_id'] ),

                
				'total'         => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'shipping_code' => $result['shipping_code'],
				'view'          => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
				'edit'          => $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
				'delete'        => $this->url->link('sale/order/delete', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL'),
				'order_status_id' => $result['order_status_id']
                                ,'verified_product'      => $verified_product
			);

		}

    foreach ($data['orders'] as &$order) {
      $vendors_fob_totals = $this->model_sale_order->getVendorsFobTotals($order['order_id']);
      foreach ($vendors_fob_totals as &$product_fob_total) {
        $product_fob_total['fob_total'] = $this->currency->format($product_fob_total['fob_total'], $product_fob_total['currency_code'], $product_fob_total['currency_value']);
        $product_fob_total['vendor_url'] = $this->url->link('catalog/vendor/update', 'token='.$this->session->data['token']. '&vendor_id='.$product_fob_total['vendor_id'], 'SSL');
      }
      $order['fob_total'] = $vendors_fob_totals;
    }

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_missing'] = $this->language->get('text_missing');

		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_date_modified'] = $this->language->get('column_date_modified');
		$data['column_action'] = $this->language->get('column_action');


                  $data['column_fob_total'] = $this->language->get('column_fob_total');


                  $data['text_container_id'] = $this->language->get('text_containerid');
                  $data['text_shipment_id'] = $this->language->get('text_shipmentid');
                  $data['text_link_save'] = $this->language->get('text_link_save');
                  $data['text_link_edit'] = $this->language->get('text_link_edit');

		$data['entry_return_id'] = $this->language->get('entry_return_id');
		$data['entry_order_id'] = $this->language->get('entry_order_id');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_date_modified'] = $this->language->get('entry_date_modified');

		$data['button_invoice_print'] = $this->language->get('button_invoice_print');
		$data['button_cont_packing'] = $this->language->get('button_cont_packing');
			$data['button_variety']  = $this->language->get('button_variety');
			$data['button_packing_list_print_pdf']  = $this->language->get('button_packing_list_print_pdf');
			$data['button_packing_list_print_xls']  = $this->language->get('button_packing_list_print_xls');
			$data['button_appendix_print_pdf']  = $this->language->get('button_appendix_print_pdf');
			$data['button_appendix_print_xls']  = $this->language->get('button_appendix_print_xls');
			$data['button_shipping_print_pdf']  = $this->language->get('button_shipping_print_pdf');
			$data['button_shipping_print_xls']  = $this->language->get('button_shipping_print_xls');
			$data['button_invoice_print_pdf']  = $this->language->get('button_invoice_print_pdf');
			$data['button_invoice_print_xls']  = $this->language->get('button_invoice_print_xls');


		$data['button_shipping_print'] = $this->language->get('button_shipping_print');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_view'] = $this->language->get('button_view');

    $data['column_noofpallets'] = $this->language->get('column_noofpallets');
    $data['column_pallets'] = $this->language->get('column_pallets');
    $data['entry_pallet_id'] = $this->language->get('entry_pallet_id');
      

		$data['column_product_no'] = $this->language->get('column_product_no');

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

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

        if (isset($this->request->get['filter_container_id'])) {
			$url .= '&filter_container_id=' . $this->request->get['filter_container_id'];
		}

        if (isset($this->request->get['filter_shipment_id'])) {
			$url .= '&filter_shipment_id=' . $this->request->get['filter_shipment_id'];
		}

         if (isset($this->request->get['filter_shipment_id'])) {
			$url .= '&filter_shipment_id=' . $this->request->get['filter_shipment_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

if (isset($this->request->get['filter_pallet_id'])) {
      $url .= '&filter_pallet_id=' . $this->request->get['filter_pallet_id'];
    }
      
		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}


		if (isset($this->request->get['filter_container_id'])) {
			$filter_container_id = $this->request->get['filter_container_id'];
		} else {
			$filter_container_id = null;
		}
		if (isset($this->request->get['filter_shipment_id'])) {
			$filter_shipment_id = $this->request->get['filter_shipment_id'];
		} else {
			$filter_shipment_id = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_order'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.order_id' . $url, 'SSL');
		$data['sort_customer'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$data['sort_total'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.total' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_added' . $url, 'SSL');
		$data['sort_date_modified'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . '&sort=o.date_modified' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

        if (isset($this->request->get['filter_container_id'])) {
			$url .= '&filter_container_id=' . $this->request->get['filter_container_id'];
		}

        if (isset($this->request->get['filter_shipment_id'])) {
			$url .= '&filter_shipment_id=' . $this->request->get['filter_shipment_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

if (isset($this->request->get['filter_pallet_id'])) {
      $url .= '&filter_pallet_id=' . $this->request->get['filter_pallet_id'];
    }
      
		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}


		if (isset($this->request->get['filter_container_id'])) {
			$filter_container_id = $this->request->get['filter_container_id'];
		} else {
			$filter_container_id = null;
		}
		if (isset($this->request->get['filter_shipment_id'])) {
			$filter_shipment_id = $this->request->get['filter_shipment_id'];
		} else {
			$filter_shipment_id = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $order_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));

		$data['filter_order_id'] = $filter_order_id;
        $data['filter_container_id'] = $filter_container_id;
		$data['filter_customer'] = $filter_customer;

$data['filter_pallet_id'] = $filter_pallet_id;
      
		$data['filter_order_status'] = $filter_order_status;
		$data['filter_total'] = $filter_total;
		$data['filter_date_added'] = $filter_date_added;

                  $data['filter_container_id'] = $filter_container_id;
                  $data['filter_shipment_id']  = $filter_shipment_id;

		$data['filter_date_modified'] = $filter_date_modified;

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
		$data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('sale/order_list.tpl', $data));
	}

	public function getForm() {
		$this->load->model('sale/customer');

    foreach ($data['orders'] as &$order) {
      $vendors_fob_totals = $this->model_sale_order->getVendorsFobTotals($order['order_id']);
      foreach ($vendors_fob_totals as &$product_fob_total) {
        $product_fob_total['fob_total'] = $this->currency->format($product_fob_total['fob_total'], $product_fob_total['currency_code'], $product_fob_total['currency_value']);
        $product_fob_total['vendor_url'] = $this->url->link('catalog/vendor/update', 'token='.$this->session->data['token']. '&vendor_id='.$product_fob_total['vendor_id'], 'SSL');
      }
      $order['fob_total'] = $vendors_fob_totals;
    }

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['order_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_loading'] = $this->language->get('text_loading');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_order'] = $this->language->get('text_order');

		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_telephone'] = $this->language->get('entry_telephone');
		$data['entry_fax'] = $this->language->get('entry_fax');
		$data['entry_comment'] = $this->language->get('entry_comment');
		$data['entry_affiliate'] = $this->language->get('entry_affiliate');
		$data['entry_address'] = $this->language->get('entry_address');
		$data['entry_company'] = $this->language->get('entry_company');
		$data['entry_address_1'] = $this->language->get('entry_address_1');
		$data['entry_address_2'] = $this->language->get('entry_address_2');
		$data['entry_city'] = $this->language->get('entry_city');
		$data['entry_postcode'] = $this->language->get('entry_postcode');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_zone_code'] = $this->language->get('entry_zone_code');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_product'] = $this->language->get('entry_product');
		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_to_name'] = $this->language->get('entry_to_name');
		$data['entry_to_email'] = $this->language->get('entry_to_email');
		$data['entry_from_name'] = $this->language->get('entry_from_name');
		$data['entry_from_email'] = $this->language->get('entry_from_email');
		$data['entry_theme'] = $this->language->get('entry_theme');
		$data['entry_message'] = $this->language->get('entry_message');
		$data['entry_amount'] = $this->language->get('entry_amount');
		$data['entry_shipping_method'] = $this->language->get('entry_shipping_method');
		$data['entry_payment_method'] = $this->language->get('entry_payment_method');
		$data['entry_coupon'] = $this->language->get('entry_coupon');
		$data['entry_voucher'] = $this->language->get('entry_voucher');
		$data['entry_reward'] = $this->language->get('entry_reward');
		$data['entry_order_status'] = $this->language->get('entry_order_status');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_model'] = $this->language->get('column_model');
$data['column_sku'] = $this->language->get('column_sku');
						 
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_back'] = $this->language->get('button_back');
		$data['button_product_add'] = $this->language->get('button_product_add');
		$data['button_voucher_add'] = $this->language->get('button_voucher_add');

		$data['button_payment'] = $this->language->get('button_payment');
		$data['button_shipping'] = $this->language->get('button_shipping');
		$data['button_coupon'] = $this->language->get('button_coupon');
		$data['button_voucher'] = $this->language->get('button_voucher');
		$data['button_reward'] = $this->language->get('button_reward');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_remove'] = $this->language->get('button_remove');

		$data['tab_order'] = $this->language->get('tab_order');
		$data['tab_customer'] = $this->language->get('tab_customer');
		$data['tab_payment'] = $this->language->get('tab_payment');
		$data['tab_shipping'] = $this->language->get('tab_shipping');
		$data['tab_product'] = $this->language->get('tab_product');
		$data['tab_voucher'] = $this->language->get('tab_voucher');
		$data['tab_total'] = $this->language->get('tab_total');

$data['button_pallet_remove'] = $this->language->get('button_pallet_remove');
      

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}


		if (isset($this->request->get['filter_container_id'])) {
			$filter_container_id = $this->request->get['filter_container_id'];
		} else {
			$filter_container_id = null;
		}
		if (isset($this->request->get['filter_shipment_id'])) {
			$filter_shipment_id = $this->request->get['filter_shipment_id'];
		} else {
			$filter_shipment_id = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['cancel'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['order_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
		}

		if (!empty($order_info)) {
			$data['order_id'] = $this->request->get['order_id'];

$data['worksheet_id'] = $order_info['worksheet_id'];
      
			$data['store_id'] = $order_info['store_id'];

			$data['customer'] = $order_info['customer'];
			$data['customer_id'] = $order_info['customer_id'];
			$data['customer_group_id'] = $order_info['customer_group_id'];
			$data['firstname'] = $order_info['firstname'];
			$data['lastname'] = $order_info['lastname'];
			$data['email'] = $order_info['email'];
			$data['telephone'] = $order_info['telephone'];
			$data['fax'] = $order_info['fax'];
			$data['account_custom_field'] = $order_info['custom_field'];

			$this->load->model('sale/customer');

			$data['addresses'] = $this->model_sale_customer->getAddresses($order_info['customer_id']);

			$data['payment_firstname'] = $order_info['payment_firstname'];
			$data['payment_lastname'] = $order_info['payment_lastname'];
			$data['payment_company'] = $order_info['payment_company'];
			$data['payment_address_1'] = $order_info['payment_address_1'];
			$data['payment_address_2'] = $order_info['payment_address_2'];
			$data['payment_city'] = $order_info['payment_city'];
			$data['payment_postcode'] = $order_info['payment_postcode'];
			$data['payment_country_id'] = $order_info['payment_country_id'];
			$data['payment_zone_id'] = $order_info['payment_zone_id'];
			$data['payment_custom_field'] = $order_info['payment_custom_field'];
			$data['payment_method'] = $order_info['payment_method'];
			$data['payment_code'] = $order_info['payment_code'];

			$data['shipping_firstname'] = $order_info['shipping_firstname'];
			$data['shipping_lastname'] = $order_info['shipping_lastname'];
			$data['shipping_company'] = $order_info['shipping_company'];
			$data['shipping_address_1'] = $order_info['shipping_address_1'];
			$data['shipping_address_2'] = $order_info['shipping_address_2'];
			$data['shipping_city'] = $order_info['shipping_city'];
			$data['shipping_postcode'] = $order_info['shipping_postcode'];
			$data['shipping_country_id'] = $order_info['shipping_country_id'];
			$data['shipping_zone_id'] = $order_info['shipping_zone_id'];
			$data['shipping_custom_field'] = $order_info['shipping_custom_field'];
			$data['shipping_method'] = $order_info['shipping_method'];
			$data['shipping_code'] = $order_info['shipping_code'];

			// Add products to the API
			$data['products'] = array();

			

      $this->load->model('catalog/vendor');

      $worksheet_id = $data['worksheet_id'];

      $this->load->model('pallet/worksheet');

      if ($this->model_pallet_worksheet->hasPallets($worksheet_id)) {
        $palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id);

        $data['products'] = array();

        for($p = 0; $p < count($palletIds); $p++) {
          $pallet_id = $palletIds[$p];

          $palletId = array();

          $products = $this->model_pallet_worksheet->getOrderProductsByPalletId($pallet_id);

          if(isset($products)) {
            foreach ($products as $product) {

             $fob_price = $this->model_sale_order->getFobPrices($this->request->get['order_id'], $product['product_id']);
             $sp_price = $fob_price['fob_bottle_full_price'];

             foreach($this->config->get('fob_margins') as $margin) {
                          if($margin['fob'] == 1) {
                                eval('$sp_price = '."$sp_price + ($fob_price[fob_bottle_full_price] $margin[sign] $margin[value])".';');
                              } else {
                                eval('$sp_price = '."$sp_price $margin[sign] $margin[value]".';');
                              }
           }


           $sp_unit_price = $sp_price;
           $sp_price *= $fob_price['fob_case'];

           $fob_unit_price = $this->currency->format($fob_price['fob_bottle'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);

           $price = $this->currency->format($product['price'], $product['currency_code']);
           $price_total = $this->currency->format($product['total'], $product['currency_code']);

           if ($fob_price['fob_bottle'] != $fob_price['fob_bottle_full_price']){


                    $price =  '<del>'.
                                    $this->currency->format($sp_price + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).
                              '</del><br />
                                <font color="#cc0000">'.$price.'</font>';
                    $sp_unit_price =  '<del>'.
                                     $this->currency->format($sp_unit_price + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code']).
                              '</del><br />
                                <font color="#cc0000">'. $this->currency->format($product['price']/$fob_price['fob_case']+ ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</font>';

                    $price_total = '<del>'.
                                   $this->currency->format($sp_price*$product['quantity']+ ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']).
                                   '</del><br />
                                    <font color="#cc0000">'.$price_total.'</font>';
                   $fob_unit_price = '<del>'.
                                   $this->currency->format($fob_price['fob_bottle_full_price']+ ($this->config->get('config_tax') ? $product['tax']  : 0), $order_info['currency_code'], $order_info['currency_value']).
                                   '</del><br />
                                    <font color="#cc0000">'.$fob_unit_price.'</font>';
              }
			  else{
			  		  $sp_unit_price = $this->currency->format($sp_unit_price+ ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
			  }


              $palletId['products'][] = array(
                'pallet_id'  => $product['pallet_id'],
                'product_id' => $product['product_id'],
                'name'       => $product['name'],
                'model'      => $product['model'],
                //'option'     => $this->model_sale_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']),
                'option'     => array(),
                'quantity'   => $product['quantity'],
                'price'      => $price,
                'total'      => $price_total,
                'sp_price'   => $sp_unit_price,
                'fob_price'  => $fob_unit_price,
                'reward'     => '',
                'shipping'   => 1
              );
            }
          } else {
            $palletId['products'][] = array();
          }

          $palletId['tab'] = $p + 1;
          $palletId['id'] = $pallet_id;
          $palletId['size'] = $this->model_pallet_worksheet->getPalletSize($pallet_id);
          $data['pallets'][] = $palletId;
        }
      }
      $data['pallet_sizes'] = explode(",", $this->config->get('pallets_limit_p'));
      















			// Add vouchers to the API
			$data['order_vouchers'] = $this->model_sale_order->getOrderVouchers($this->request->get['order_id']);

			$data['coupon'] = '';
			$data['voucher'] = '';
			$data['reward'] = '';

			$data['order_totals'] = array();

			$order_totals = $this->model_sale_order->getOrderTotals($this->request->get['order_id']);

			foreach ($order_totals as $order_total) {
				// If coupon, voucher or reward points
				$start = strpos($order_total['title'], '(') + 1;
				$end = strrpos($order_total['title'], ')');

				if ($start && $end) {
					if ($order_total['code'] == 'coupon') {
						$data['coupon'] = substr($order_total['title'], $start, $end - $start);
					}

					if ($order_total['code'] == 'voucher') {
						$data['voucher'] = substr($order_total['title'], $start, $end - $start);
					}

					if ($order_total['code'] == 'reward') {
						$data['reward'] = substr($order_total['title'], $start, $end - $start);
					}
				}
			}

			$data['order_status_id'] = $order_info['order_status_id'];
			$data['comment'] = $order_info['comment'];
			$data['affiliate_id'] = $order_info['affiliate_id'];
			$data['affiliate'] = $order_info['affiliate_firstname'] . ' ' . $order_info['affiliate_lastname'];
		} else {

		$this->load->model('pallet/worksheet');
		$this->model_pallet_worksheet->destroyWorksheetByCustomerId(0);
		$worksheet_id = $this->model_pallet_worksheet->addBlankWorksheet();
		$this->model_pallet_worksheet->addPallet($worksheet_id, 0, 0);
		$palletIds = $this->model_pallet_worksheet->getPallets($worksheet_id);

		$data['products'] = array();

		for($p = 0; $p < count($palletIds); $p++) {
			$pallet_id = $palletIds[$p];

			$palletId = array();

			$products = $this->model_pallet_worksheet->getOrderProductsByPalletId($pallet_id);


			if(isset($products)) {
				foreach ($products as $product) {
				  $palletId['products'][] = array(
					'pallet_id'  => $product['pallet_id'],
					'product_id' => $product['product_id'],
					'name'       => $product['name'],
					'model'      => $product['model'],
					//'option'     => $this->model_sale_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']),
					'option'     => array(),
					'quantity'   => $product['quantity'],
					'price'      => $this->currency->format($product['price'], $product['currency_code']),
					'total'      => $this->currency->format($product['total'], $product['currency_code']),
					'reward'     => '',
					'shipping'   => 1
				  );
				}
			} else {
				$palletId['products'][] = array();
			}
		}

		$palletId['tab'] = 1;
		$palletId['id'] = $pallet_id;
		$data['pallets'][] = $palletId;
		$data['worksheet_id'] = $worksheet_id;

      
			$data['order_id'] = 0;
			$data['store_id'] = '';
			$data['customer'] = '';
			$data['customer_id'] = '';
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
			$data['firstname'] = '';
			$data['lastname'] = '';
			$data['email'] = '';
			$data['telephone'] = '';
			$data['fax'] = '';
			$data['customer_custom_field'] = array();

			$data['addresses'] = array();

			$data['payment_firstname'] = '';
			$data['payment_lastname'] = '';
			$data['payment_company'] = '';
			$data['payment_address_1'] = '';
			$data['payment_address_2'] = '';
			$data['payment_city'] = '';
			$data['payment_postcode'] = '';
			$data['payment_country_id'] = '';
			$data['payment_zone_id'] = '';
			$data['payment_custom_field'] = array();
			$data['payment_method'] = '';
			$data['payment_code'] = '';

			$data['shipping_firstname'] = '';
			$data['shipping_lastname'] = '';
			$data['shipping_company'] = '';
			$data['shipping_address_1'] = '';
			$data['shipping_address_2'] = '';
			$data['shipping_city'] = '';
			$data['shipping_postcode'] = '';
			$data['shipping_country_id'] = '';
			$data['shipping_zone_id'] = '';
			$data['shipping_custom_field'] = array();
			$data['shipping_method'] = '';
			$data['shipping_code'] = '';

			$data['order_products'] = array();
			$data['order_vouchers'] = array();
			$data['order_totals'] = array();

			$data['order_status_id'] = $this->config->get('config_order_status_id');

			$data['comment'] = '';
			$data['affiliate_id'] = '';
			$data['affiliate'] = '';

			$data['coupon'] = '';
			$data['voucher'] = '';
			$data['reward'] = '';
		}

		// Stores
		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		// Customer Groups
		$this->load->model('sale/customer_group');

		$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		// Custom Fields
		$this->load->model('sale/custom_field');


			
			$data['entry_update_currency'] = $this->language->get('entry_update_currency');
			$data['help_update_currency'] = $this->language->get('help_update_currency');

			if (version_compare(VERSION, '2.0.3.1', '<')) {
				$data['entry_change_currency'] = $this->language->get('entry_change_currency');
				$data['help_change_currency'] = $this->language->get('help_change_currency');
			}
			
			$data['text_yes'] = $this->language->get('text_yes');
			$data['text_no'] = $this->language->get('text_no');

			$this->load->model('localisation/currency');
			$data['currencies'] = $this->model_localisation_currency->getCurrencies();
			
			if (isset($this->request->post['currency_id'])) {
				$data['currency_id'] = $this->request->post['currency_id'];
			} elseif (!empty($order_info)) {
				$data['currency_id'] = $order_info['currency_id'];
			} else {
				if ($this->config->get('config_store_currency')) {
					$currency_id = $data['currencies'][$this->config->get('config_store_currency')]['currency_id'];
				} else {
					$currency_id = $data['currencies'][$this->config->get('config_currency')]['currency_id'];
				}
				
				$data['currency_id'] = $currency_id;
			}
			
			
		$data['custom_fields'] = array();

		$custom_fields = $this->model_sale_custom_field->getCustomFields();

		foreach ($custom_fields as $custom_field) {
			$data['custom_fields'][] = array(
				'custom_field_id'    => $custom_field['custom_field_id'],
				'custom_field_value' => $this->model_sale_custom_field->getCustomFieldValues($custom_field['custom_field_id']),
				'name'               => $custom_field['name'],
				'value'              => $custom_field['value'],
				'type'               => $custom_field['type'],
				'location'           => $custom_field['location']
			);
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();

		$data['voucher_min'] = $this->config->get('config_voucher_min');

		$this->load->model('sale/voucher_theme');

		$data['voucher_themes'] = $this->model_sale_voucher_theme->getVoucherThemes();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
		$data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('sale/order_form.tpl', $data));
	}

	public function info() {
include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		if (isset($this->request->get['order_id'])) {
			$order_id = $this->request->get['order_id'];
		} else {
			$order_id = 0;
		}

		$order_info = $this->model_sale_order->getOrder($order_id);

		if ($order_info) {
			$this->load->language('sale/order');

			$this->document->setTitle($this->language->get('heading_title'));

    foreach ($data['orders'] as &$order) {
      $vendors_fob_totals = $this->model_sale_order->getVendorsFobTotals($order['order_id']);
      foreach ($vendors_fob_totals as &$product_fob_total) {
        $product_fob_total['fob_total'] = $this->currency->format($product_fob_total['fob_total'], $product_fob_total['currency_code'], $product_fob_total['currency_value']);
        $product_fob_total['vendor_url'] = $this->url->link('catalog/vendor/update', 'token='.$this->session->data['token']. '&vendor_id='.$product_fob_total['vendor_id'], 'SSL');
      }
      $order['fob_total'] = $vendors_fob_totals;
    }

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_invoice_no'] = $this->language->get('text_invoice_no');
			$data['text_invoice_date'] = $this->language->get('text_invoice_date');
			$data['text_store_name'] = $this->language->get('text_store_name');
			$data['text_store_url'] = $this->language->get('text_store_url');
			$data['text_customer'] = $this->language->get('text_customer');
			$data['text_customer_group'] = $this->language->get('text_customer_group');
			$data['text_email'] = $this->language->get('text_email');
			$data['text_telephone'] = $this->language->get('text_telephone');
			$data['text_fax'] = $this->language->get('text_fax');
			$data['text_total'] = $this->language->get('text_total');
			$data['text_reward'] = $this->language->get('text_reward');
			$data['text_order_status'] = $this->language->get('text_order_status');
			$data['text_comment'] = $this->language->get('text_comment');
			$data['text_affiliate'] = $this->language->get('text_affiliate');
			$data['text_commission'] = $this->language->get('text_commission');
			$data['text_ip'] = $this->language->get('text_ip');
			$data['text_forwarded_ip'] = $this->language->get('text_forwarded_ip');
			$data['text_user_agent'] = $this->language->get('text_user_agent');
			$data['text_accept_language'] = $this->language->get('text_accept_language');
			$data['text_date_added'] = $this->language->get('text_date_added');
			$data['text_date_modified'] = $this->language->get('text_date_modified');
			$data['text_firstname'] = $this->language->get('text_firstname');
			$data['text_lastname'] = $this->language->get('text_lastname');
			$data['text_company'] = $this->language->get('text_company');
			$data['text_address_1'] = $this->language->get('text_address_1');
			$data['text_address_2'] = $this->language->get('text_address_2');
			$data['text_city'] = $this->language->get('text_city');
			$data['text_postcode'] = $this->language->get('text_postcode');
			$data['text_zone'] = $this->language->get('text_zone');
			$data['text_zone_code'] = $this->language->get('text_zone_code');
			$data['text_country'] = $this->language->get('text_country');
			$data['text_shipping_method'] = $this->language->get('text_shipping_method');
			$data['text_payment_method'] = $this->language->get('text_payment_method');
			$data['text_history'] = $this->language->get('text_history');
			$data['text_country_match'] = $this->language->get('text_country_match');
			$data['text_country_code'] = $this->language->get('text_country_code');
			$data['text_high_risk_country'] = $this->language->get('text_high_risk_country');
			$data['text_distance'] = $this->language->get('text_distance');
			$data['text_ip_region'] = $this->language->get('text_ip_region');
			$data['text_ip_city'] = $this->language->get('text_ip_city');
			$data['text_ip_latitude'] = $this->language->get('text_ip_latitude');
			$data['text_ip_longitude'] = $this->language->get('text_ip_longitude');
			$data['text_ip_isp'] = $this->language->get('text_ip_isp');
			$data['text_ip_org'] = $this->language->get('text_ip_org');
			$data['text_ip_asnum'] = $this->language->get('text_ip_asnum');
			$data['text_ip_user_type'] = $this->language->get('text_ip_user_type');
			$data['text_ip_country_confidence'] = $this->language->get('text_ip_country_confidence');
			$data['text_ip_region_confidence'] = $this->language->get('text_ip_region_confidence');
			$data['text_ip_city_confidence'] = $this->language->get('text_ip_city_confidence');
			$data['text_ip_postal_confidence'] = $this->language->get('text_ip_postal_confidence');
			$data['text_ip_postal_code'] = $this->language->get('text_ip_postal_code');
			$data['text_ip_accuracy_radius'] = $this->language->get('text_ip_accuracy_radius');
			$data['text_ip_net_speed_cell'] = $this->language->get('text_ip_net_speed_cell');
			$data['text_ip_metro_code'] = $this->language->get('text_ip_metro_code');
			$data['text_ip_area_code'] = $this->language->get('text_ip_area_code');
			$data['text_ip_time_zone'] = $this->language->get('text_ip_time_zone');
			$data['text_ip_region_name'] = $this->language->get('text_ip_region_name');
			$data['text_ip_domain'] = $this->language->get('text_ip_domain');
			$data['text_ip_country_name'] = $this->language->get('text_ip_country_name');
			$data['text_ip_continent_code'] = $this->language->get('text_ip_continent_code');
			$data['text_ip_corporate_proxy'] = $this->language->get('text_ip_corporate_proxy');
			$data['text_anonymous_proxy'] = $this->language->get('text_anonymous_proxy');
			$data['text_proxy_score'] = $this->language->get('text_proxy_score');
			$data['text_is_trans_proxy'] = $this->language->get('text_is_trans_proxy');
			$data['text_free_mail'] = $this->language->get('text_free_mail');
			$data['text_carder_email'] = $this->language->get('text_carder_email');
			$data['text_high_risk_username'] = $this->language->get('text_high_risk_username');
			$data['text_high_risk_password'] = $this->language->get('text_high_risk_password');
			$data['text_bin_match'] = $this->language->get('text_bin_match');
			$data['text_bin_country'] = $this->language->get('text_bin_country');
			$data['text_bin_name_match'] = $this->language->get('text_bin_name_match');
			$data['text_bin_name'] = $this->language->get('text_bin_name');
			$data['text_bin_phone_match'] = $this->language->get('text_bin_phone_match');
			$data['text_bin_phone'] = $this->language->get('text_bin_phone');
			$data['text_customer_phone_in_billing_location'] = $this->language->get('text_customer_phone_in_billing_location');
			$data['text_ship_forward'] = $this->language->get('text_ship_forward');
			$data['text_city_postal_match'] = $this->language->get('text_city_postal_match');
			$data['text_ship_city_postal_match'] = $this->language->get('text_ship_city_postal_match');
			$data['text_score'] = $this->language->get('text_score');
			$data['text_explanation'] = $this->language->get('text_explanation');
			$data['text_risk_score'] = $this->language->get('text_risk_score');
			$data['text_queries_remaining'] = $this->language->get('text_queries_remaining');
			$data['text_maxmind_id'] = $this->language->get('text_maxmind_id');
			$data['text_error'] = $this->language->get('text_error');
			$data['text_loading'] = $this->language->get('text_loading');

			$data['help_country_match'] = $this->language->get('help_country_match');
			$data['help_country_code'] = $this->language->get('help_country_code');
			$data['help_high_risk_country'] = $this->language->get('help_high_risk_country');
			$data['help_distance'] = $this->language->get('help_distance');
			$data['help_ip_region'] = $this->language->get('help_ip_region');
			$data['help_ip_city'] = $this->language->get('help_ip_city');
			$data['help_ip_latitude'] = $this->language->get('help_ip_latitude');
			$data['help_ip_longitude'] = $this->language->get('help_ip_longitude');
			$data['help_ip_isp'] = $this->language->get('help_ip_isp');
			$data['help_ip_org'] = $this->language->get('help_ip_org');
			$data['help_ip_asnum'] = $this->language->get('help_ip_asnum');
			$data['help_ip_user_type'] = $this->language->get('help_ip_user_type');
			$data['help_ip_country_confidence'] = $this->language->get('help_ip_country_confidence');
			$data['help_ip_region_confidence'] = $this->language->get('help_ip_region_confidence');
			$data['help_ip_city_confidence'] = $this->language->get('help_ip_city_confidence');
			$data['help_ip_postal_confidence'] = $this->language->get('help_ip_postal_confidence');
			$data['help_ip_postal_code'] = $this->language->get('help_ip_postal_code');
			$data['help_ip_accuracy_radius'] = $this->language->get('help_ip_accuracy_radius');
			$data['help_ip_net_speed_cell'] = $this->language->get('help_ip_net_speed_cell');
			$data['help_ip_metro_code'] = $this->language->get('help_ip_metro_code');
			$data['help_ip_area_code'] = $this->language->get('help_ip_area_code');
			$data['help_ip_time_zone'] = $this->language->get('help_ip_time_zone');
			$data['help_ip_region_name'] = $this->language->get('help_ip_region_name');
			$data['help_ip_domain'] = $this->language->get('help_ip_domain');
			$data['help_ip_country_name'] = $this->language->get('help_ip_country_name');
			$data['help_ip_continent_code'] = $this->language->get('help_ip_continent_code');
			$data['help_ip_corporate_proxy'] = $this->language->get('help_ip_corporate_proxy');
			$data['help_anonymous_proxy'] = $this->language->get('help_anonymous_proxy');
			$data['help_proxy_score'] = $this->language->get('help_proxy_score');
			$data['help_is_trans_proxy'] = $this->language->get('help_is_trans_proxy');
			$data['help_free_mail'] = $this->language->get('help_free_mail');
			$data['help_carder_email'] = $this->language->get('help_carder_email');
			$data['help_high_risk_username'] = $this->language->get('help_high_risk_username');
			$data['help_high_risk_password'] = $this->language->get('help_high_risk_password');
			$data['help_bin_match'] = $this->language->get('help_bin_match');
			$data['help_bin_country'] = $this->language->get('help_bin_country');
			$data['help_bin_name_match'] = $this->language->get('help_bin_name_match');
			$data['help_bin_name'] = $this->language->get('help_bin_name');
			$data['help_bin_phone_match'] = $this->language->get('help_bin_phone_match');
			$data['help_bin_phone'] = $this->language->get('help_bin_phone');
			$data['help_customer_phone_in_billing_location'] = $this->language->get('help_customer_phone_in_billing_location');
			$data['help_ship_forward'] = $this->language->get('help_ship_forward');
			$data['help_city_postal_match'] = $this->language->get('help_city_postal_match');
			$data['help_ship_city_postal_match'] = $this->language->get('help_ship_city_postal_match');
			$data['help_score'] = $this->language->get('help_score');
			$data['help_explanation'] = $this->language->get('help_explanation');
			$data['help_risk_score'] = $this->language->get('help_risk_score');
			$data['help_queries_remaining'] = $this->language->get('help_queries_remaining');
			$data['help_maxmind_id'] = $this->language->get('help_maxmind_id');
			$data['help_error'] = $this->language->get('help_error');

			$data['column_product'] = $this->language->get('column_product');
			$data['column_model'] = $this->language->get('column_model');
$data['column_sku'] = $this->language->get('column_sku');
						 
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_total'] = $this->language->get('column_total');

			$data['entry_order_status'] = $this->language->get('entry_order_status');
			$data['entry_notify'] = $this->language->get('entry_notify');
			$data['entry_comment'] = $this->language->get('entry_comment');

			$data['entry_sent_comment_to_all'] = $this->language->get('entry_sent_comment_to_all');
			$data['help_sent_comment_to_all'] = $this->language->get('help_sent_comment_to_all');
			

			$data['button_invoice_print'] = $this->language->get('button_invoice_print');
		$data['button_cont_packing'] = $this->language->get('button_cont_packing');
			$data['button_variety']  = $this->language->get('button_variety');
			$data['button_packing_list_print_pdf']  = $this->language->get('button_packing_list_print_pdf');
			$data['button_packing_list_print_xls']  = $this->language->get('button_packing_list_print_xls');
			$data['button_appendix_print_pdf']  = $this->language->get('button_appendix_print_pdf');
			$data['button_appendix_print_xls']  = $this->language->get('button_appendix_print_xls');
			$data['button_shipping_print_pdf']  = $this->language->get('button_shipping_print_pdf');
			$data['button_shipping_print_xls']  = $this->language->get('button_shipping_print_xls');
			$data['button_invoice_print_pdf']  = $this->language->get('button_invoice_print_pdf');
			$data['button_invoice_print_xls']  = $this->language->get('button_invoice_print_xls');


			$data['button_shipping_print'] = $this->language->get('button_shipping_print');
			$data['button_edit'] = $this->language->get('button_edit');
			$data['button_cancel'] = $this->language->get('button_cancel');
			$data['button_generate'] = $this->language->get('button_generate');
			$data['button_reward_add'] = $this->language->get('button_reward_add');
			$data['button_reward_remove'] = $this->language->get('button_reward_remove');
			$data['button_commission_add'] = $this->language->get('button_commission_add');
			$data['button_commission_remove'] = $this->language->get('button_commission_remove');
			$data['button_history_add'] = $this->language->get('button_history_add');

			$data['tab_order'] = $this->language->get('tab_order');
			$data['tab_payment'] = $this->language->get('tab_payment');
			$data['tab_shipping'] = $this->language->get('tab_shipping');
			$data['tab_product'] = $this->language->get('tab_product');
			$data['tab_history'] = $this->language->get('tab_history');
			$data['tab_fraud'] = $this->language->get('tab_fraud');
			$data['tab_action'] = $this->language->get('tab_action');

$data['text_worksheet_id'] = $this->language->get('text_worksheet_id');
      $data['column_pallet_no'] = $this->language->get('column_pallet_no');
      $data['column_vendor'] = $this->language->get('column_vendor');
      $data['button_pdf'] = $this->language->get('button_pdf');
      

			$data['token'] = $this->session->data['token'];

			$data['column_product_no'] = $this->language->get('column_product_no');

			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}

			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_order_status'])) {
				$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
			}

			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}


		if (isset($this->request->get['filter_container_id'])) {
			$filter_container_id = $this->request->get['filter_container_id'];
		} else {
			$filter_container_id = null;
		}
		if (isset($this->request->get['filter_shipment_id'])) {
			$filter_shipment_id = $this->request->get['filter_shipment_id'];
		} else {
			$filter_shipment_id = null;
		}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
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
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);

			$data['packing'] = $this->url->link('sale/order/packing', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
			$data['variety_list'] = $this->url->link('sale/order/variety_list', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');

			$data['shipping'] = $this->url->link('sale/order/shipping', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
			$data['invoice'] = $this->url->link('sale/order/invoice', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');

$data['pdf'] = $this->url->link('pallet/worksheet/pdf', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
      
			$data['edit'] = $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
			$data['cancel'] = $this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL');

			$data['order_id'] = $this->request->get['order_id'];

$data['worksheet_id'] = $order_info['worksheet_id'];
      

			if ($order_info['invoice_no']) {
				$data['invoice_no'] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
			} else {
				$data['invoice_no'] = '';
			}

			$data['store_name'] = $order_info['store_name'];
			$data['store_url'] = $order_info['store_url'];
			$data['firstname'] = $order_info['firstname'];
			$data['lastname'] = $order_info['lastname'];

			if ($order_info['customer_id']) {
				$data['customer'] = $this->url->link('sale/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $order_info['customer_id'], 'SSL');
			} else {
				$data['customer'] = '';
			}

			$this->load->model('sale/customer_group');

			$customer_group_info = $this->model_sale_customer_group->getCustomerGroup($order_info['customer_group_id']);

			if ($customer_group_info) {
				$data['customer_group'] = $customer_group_info['name'];
			} else {
				$data['customer_group'] = '';
			}

			$data['email'] = $order_info['email'];
			$data['telephone'] = $order_info['telephone'];
			$data['fax'] = $order_info['fax'];

			$data['account_custom_field'] = $order_info['custom_field'];

			// Uploaded files
			$this->load->model('tool/upload');

			// Custom Fields
			$this->load->model('sale/custom_field');

			$data['account_custom_fields'] = array();

			$custom_fields = $this->model_sale_custom_field->getCustomFields();

			foreach ($custom_fields as $custom_field) {
				if ($custom_field['location'] == 'account' && isset($order_info['custom_field'][$custom_field['custom_field_id']])) {
					if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio') {
						$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($order_info['custom_field'][$custom_field['custom_field_id']]);

						if ($custom_field_value_info) {
							$data['account_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $custom_field_value_info['name']
							);
						}
					}

					if ($custom_field['type'] == 'checkbox' && is_array($order_info['custom_field'][$custom_field['custom_field_id']])) {
						foreach ($order_info['custom_field'][$custom_field['custom_field_id']] as $custom_field_value_id) {
							$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($custom_field_value_id);

							if ($custom_field_value_info) {
								$data['account_custom_fields'][] = array(
									'name'  => $custom_field['name'],
									'value' => $custom_field_value_info['name']
								);
							}
						}
					}

					if ($custom_field['type'] == 'text' || $custom_field['type'] == 'textarea' || $custom_field['type'] == 'file' || $custom_field['type'] == 'date' || $custom_field['type'] == 'datetime' || $custom_field['type'] == 'time') {
						$data['account_custom_fields'][] = array(
							'name'  => $custom_field['name'],
							'value' => $order_info['custom_field'][$custom_field['custom_field_id']]
						);
					}

					if ($custom_field['type'] == 'file') {
						$upload_info = $this->model_tool_upload->getUploadByCode($order_info['custom_field'][$custom_field['custom_field_id']]);

						if ($upload_info) {
							$data['account_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $upload_info['name']
							);
						}
					}
				}
			}

			$data['comment'] = nl2br($order_info['comment']);
			$data['shipping_method'] = $order_info['shipping_method'];
			$data['payment_method'] = $order_info['payment_method'];
			$data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value']);

			$this->load->model('sale/customer');

			$data['reward'] = $order_info['reward'];

			$data['reward_total'] = $this->model_sale_customer->getTotalCustomerRewardsByOrderId($this->request->get['order_id']);

			$data['affiliate_firstname'] = $order_info['affiliate_firstname'];
			$data['affiliate_lastname'] = $order_info['affiliate_lastname'];

			if ($order_info['affiliate_id']) {
				$data['affiliate'] = $this->url->link('marketing/affiliate/edit', 'token=' . $this->session->data['token'] . '&affiliate_id=' . $order_info['affiliate_id'], 'SSL');
			} else {
				$data['affiliate'] = '';
			}

			$data['commission'] = $this->currency->format($order_info['commission'], $order_info['currency_code'], $order_info['currency_value']);

			$this->load->model('marketing/affiliate');

			$data['commission_total'] = $this->model_marketing_affiliate->getTotalTransactionsByOrderId($this->request->get['order_id']);

			$this->load->model('localisation/order_status');

			$order_status_info = $this->model_localisation_order_status->getOrderStatus($order_info['order_status_id']);

			if ($order_status_info) {
				$data['order_status'] = $order_status_info['name'];
			} else {
				$data['order_status'] = '';
			}

			$data['ip'] = $order_info['ip'];
			$data['forwarded_ip'] = $order_info['forwarded_ip'];
			$data['user_agent'] = $order_info['user_agent'];
			$data['accept_language'] = $order_info['accept_language'];
			$data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));
			$data['date_modified'] = date($this->language->get('date_format_short'), strtotime($order_info['date_modified']));

			// Payment
			$data['payment_firstname'] = $order_info['payment_firstname'];
			$data['payment_lastname'] = $order_info['payment_lastname'];
			$data['payment_company'] = $order_info['payment_company'];
			$data['payment_address_1'] = $order_info['payment_address_1'];
			$data['payment_address_2'] = $order_info['payment_address_2'];
			$data['payment_city'] = $order_info['payment_city'];
			$data['payment_postcode'] = $order_info['payment_postcode'];
			$data['payment_zone'] = $order_info['payment_zone'];
			$data['payment_zone_code'] = $order_info['payment_zone_code'];
			$data['payment_country'] = $order_info['payment_country'];

			// Custom fields
			$data['payment_custom_fields'] = array();

			foreach ($custom_fields as $custom_field) {
				if ($custom_field['location'] == 'address' && isset($order_info['payment_custom_field'][$custom_field['custom_field_id']])) {
					if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio') {
						$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($order_info['payment_custom_field'][$custom_field['custom_field_id']]);

						if ($custom_field_value_info) {
							$data['payment_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $custom_field_value_info['name']
							);
						}
					}

					if ($custom_field['type'] == 'checkbox' && is_array($order_info['payment_custom_field'][$custom_field['custom_field_id']])) {
						foreach ($order_info['payment_custom_field'][$custom_field['custom_field_id']] as $custom_field_value_id) {
							$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($custom_field_value_id);

							if ($custom_field_value_info) {
								$data['payment_custom_fields'][] = array(
									'name'  => $custom_field['name'],
									'value' => $custom_field_value_info['name']
								);
							}
						}
					}

					if ($custom_field['type'] == 'text' || $custom_field['type'] == 'textarea' || $custom_field['type'] == 'file' || $custom_field['type'] == 'date' || $custom_field['type'] == 'datetime' || $custom_field['type'] == 'time') {
						$data['payment_custom_fields'][] = array(
							'name'  => $custom_field['name'],
							'value' => $order_info['payment_custom_field'][$custom_field['custom_field_id']]
						);
					}

					if ($custom_field['type'] == 'file') {
						$upload_info = $this->model_tool_upload->getUploadByCode($order_info['payment_custom_field'][$custom_field['custom_field_id']]);

						if ($upload_info) {
							$data['payment_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $upload_info['name']
							);
						}
					}
				}
			}

			// Shipping
			$data['shipping_firstname'] = $order_info['shipping_firstname'];
			$data['shipping_lastname'] = $order_info['shipping_lastname'];
			$data['shipping_company'] = $order_info['shipping_company'];
			$data['shipping_address_1'] = $order_info['shipping_address_1'];
			$data['shipping_address_2'] = $order_info['shipping_address_2'];
			$data['shipping_city'] = $order_info['shipping_city'];
			$data['shipping_postcode'] = $order_info['shipping_postcode'];
			$data['shipping_zone'] = $order_info['shipping_zone'];
			$data['shipping_zone_code'] = $order_info['shipping_zone_code'];
			$data['shipping_country'] = $order_info['shipping_country'];

			$data['shipping_custom_fields'] = array();

			foreach ($custom_fields as $custom_field) {
				if ($custom_field['location'] == 'address' && isset($order_info['shipping_custom_field'][$custom_field['custom_field_id']])) {
					if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio') {
						$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($order_info['shipping_custom_field'][$custom_field['custom_field_id']]);

						if ($custom_field_value_info) {
							$data['shipping_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $custom_field_value_info['name']
							);
						}
					}

					if ($custom_field['type'] == 'checkbox' && is_array($order_info['shipping_custom_field'][$custom_field['custom_field_id']])) {
						foreach ($order_info['shipping_custom_field'][$custom_field['custom_field_id']] as $custom_field_value_id) {
							$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($custom_field_value_id);

							if ($custom_field_value_info) {
								$data['shipping_custom_fields'][] = array(
									'name'  => $custom_field['name'],
									'value' => $custom_field_value_info['name']
								);
							}
						}
					}

					if ($custom_field['type'] == 'text' || $custom_field['type'] == 'textarea' || $custom_field['type'] == 'file' || $custom_field['type'] == 'date' || $custom_field['type'] == 'datetime' || $custom_field['type'] == 'time') {
						$data['shipping_custom_fields'][] = array(
							'name'  => $custom_field['name'],
							'value' => $order_info['shipping_custom_field'][$custom_field['custom_field_id']]
						);
					}

					if ($custom_field['type'] == 'file') {
						$upload_info = $this->model_tool_upload->getUploadByCode($order_info['shipping_custom_field'][$custom_field['custom_field_id']]);

						if ($upload_info) {
							$data['shipping_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $upload_info['name']
							);
						}
					}
				}
			}

			$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

			$data['order_status_id'] = $order_info['order_status_id'];

			if($data['order_status_id'] == $this->config->get('po_status_waiting_po_confirmation_id')) {
				$data['print_dots'] = 1;
			} else {
				$data['print_dots'] = '';
			}

			if($data['order_status_id'] == $this->config->get('po_status_payment_confirmed_id')) {
				$data['button_action'] = $this->language->get('button_send_po');
			}

			if($data['order_status_id'] == $this->config->get('po_status_shipping_confirmed_id')) {
				$data['order_shipped'] = 1;
				$data['admin_confirmed'] = $this->model_sale_order->adminConfirmedReceived($this->request->get['order_id']);
			} else {
				$data['order_shipped'] = 0;
				$data['admin_confirmed'] = 0;
			}
//GV
			$data['column_model']         = $this->language->get('text_vintage');
			$this->load->model('sale/vdi_order');
			$data['products'] = array();


			$this->load->model('catalog/vendor');
			
			$products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);


			foreach ($products as $product) {
				$option_data = array();

				$options = $this->model_sale_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']);

			$vname = $this->model_catalog_vendor->getVendor($product['vendor_id']);
			

				foreach ($options as $option) {
					if ($option['type'] != 'file') {
						$option_data[] = array(
							'name'  => $option['name'],
							'value' => $option['value'],
							'type'  => $option['type']
						);
					} else {
						$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

						if ($upload_info) {
							$option_data[] = array(
								'name'  => $option['name'],
								'value' => $upload_info['name'],
								'type'  => $option['type'],
								'href'  => $this->url->link('tool/upload/download', 'token=' . $this->session->data['token'] . '&code=' . $upload_info['code'], 'SSL')
							);
						}
					}
				}
				//GV
				$vintage = $this->model_sale_vdi_order->getVintage( $product['product_id'] );
				$product['model'] = $vintage;

                 $fob_price = $this->model_sale_order->getFobPrices($this->request->get['order_id'], $product['product_id']);
             $sp_price = $fob_price['fob_bottle_full_price'];

             foreach($this->config->get('fob_margins') as $margin) {
                          if($margin['fob'] == 1) {
                                eval('$sp_price = '."$sp_price + ($fob_price[fob_bottle_full_price] $margin[sign] $margin[value])".';');
                              } else {
                                eval('$sp_price = '."$sp_price $margin[sign] $margin[value]".';');
                              }
           }


           $sp_unit_price = $sp_price;
           $sp_price *= $fob_price['fob_case'];

           $fob_unit_price = $this->currency->format($fob_price['fob_bottle'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);

           $price = $this->currency->format($product['price'], $product['currency_code']);
           $price_total = $this->currency->format($product['total'], $product['currency_code']);
        /*       echo '<pre>';
			   var_dump($fob_price);
			   echo '</pre>';*/
           if ($fob_price['fob_bottle'] != $fob_price['fob_bottle_full_price']){


                    $price =  '<del>'.
                                    $this->currency->format($sp_price + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).
                              '</del><br />
                                <font color="#cc0000">'.$price.'</font>';
                    $sp_unit_price =  '<del>'.
                                     $this->currency->format($sp_unit_price + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code']).
                              '</del><br />
                                <font color="#cc0000">'. $this->currency->format($product['price']/$fob_price['fob_case']+ ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</font>';

                    $price_total = '<del>'.
                                   $this->currency->format($sp_price*$product['quantity']+ ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']).
                                   '</del><br />
                                    <font color="#cc0000">'.$price_total.'</font>';
                /*   $fob_unit_price = '<del>'.
                                   $this->currency->format($fob_price['fob_bottle_full_price']+ ($this->config->get('config_tax') ? $product['tax']  : 0), $order_info['currency_code'], $order_info['currency_value']).
                                   '</del><br />
                                    <font color="#cc0000">'.$fob_unit_price.'</font>';*/
                    $fob_unit_price = '<del>'.$this->currency->format($fob_price['fob_bottle_full_price']  + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']).'</del>
                             <br />'.
                             ((strlen($product['obs'])>1)?"<font color='#cc0000' size='-1'>Discount: </font> ":"<font color='#cc0000' size='-1'>Promo: </font> ")
                             .'<font color="#cc0000">'.$fob_unit_price.'</font>';

              }
			  else{
			  		  $sp_unit_price = $this->currency->format($sp_unit_price+ ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
			  }



			$data['products'][] = array(
					'order_product_id' => $product['order_product_id'],
					'product_no'       => $product['product_no'],
					'product_received' => $product['product_received'],
					'documents_received' => $product['documents_received'],
					'product_received_date' => $product['product_received_date'],
					'documents_received_date' => $product['documents_received_date'],
					'pallet_id' 		 => $product['pallet_id'],
					'product_id'       => $product['product_id'],

    'pallet_no'        => $product['pallet_no'],
'vendor_confirmed'        => $product['vendor_confirmed'],
      
					'name'    	 	   => $product['name'],

			'vname' 		   => $vname['vendor_name'],
			'vhref' 		   => $this->url->link('catalog/vendor/update', 'token=' . $this->session->data['token'] . '&vendor_id=' . $product['vendor_id'], 'SSL'),
			
					'model'    		   => $product['model'],
					'option'   		   => $option_data,
					'quantity'		   => $product['quantity'],
					'price'    		   => $price,
	                'sp_price' 		   => $sp_unit_price,
    	            'fob_price'        => $fob_unit_price,
					'total'    		   => $price_total,
					'href'     		   => $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product['product_id'], 'SSL')
				);
			}

			$data['vouchers'] = array();

			$vouchers = $this->model_sale_order->getOrderVouchers($this->request->get['order_id']);

			foreach ($vouchers as $voucher) {
				$data['vouchers'][] = array(
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']),
					'href'        => $this->url->link('sale/voucher/edit', 'token=' . $this->session->data['token'] . '&voucher_id=' . $voucher['voucher_id'], 'SSL')
				);
			}

			$totals = $this->model_sale_order->getOrderTotals($this->request->get['order_id']);

			foreach ($totals as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
				);
			}

			$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

			$data['order_status_id'] = $order_info['order_status_id'];

			// Unset any past sessions this page date_added for the api to work.
			unset($this->session->data['cookie']);

			// Set up the API session
			if ($this->user->hasPermission('modify', 'sale/order')) {
				$this->load->model('user/api');

				$api_info = $this->model_user_api->getApi($this->config->get('config_api_id'));

				if ($api_info) {
					$curl = curl_init();

					// Set SSL if required
					if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
						curl_setopt($curl, CURLOPT_PORT, 443);
					}

					curl_setopt($curl, CURLOPT_HEADER, false);
					curl_setopt($curl, CURLINFO_HEADER_OUT, true);
					curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/login');
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($api_info));

					$json = curl_exec($curl);

					if (!$json) {
						$data['error_warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
					} else {
						$response = json_decode($json, true);
					}

					if (isset($response['cookie'])) {
						$this->session->data['cookie'] = $response['cookie'];
					}
				}
			}

			if (isset($response['cookie'])) {
				$this->session->data['cookie'] = $response['cookie'];
			} else {
				$data['error_warning'] = $this->language->get('error_permission');
			}

			// Fraud
			$this->load->model('sale/fraud');

			$fraud_info = $this->model_sale_fraud->getFraud($order_info['order_id']);

			if ($fraud_info) {
				$data['country_match'] = $fraud_info['country_match'];

				if ($fraud_info['country_code']) {
					$data['country_code'] = $fraud_info['country_code'];
				} else {
					$data['country_code'] = '';
				}

				$data['high_risk_country'] = $fraud_info['high_risk_country'];
				$data['distance'] = $fraud_info['distance'];

				if ($fraud_info['ip_region']) {
					$data['ip_region'] = $fraud_info['ip_region'];
				} else {
					$data['ip_region'] = '';
				}

				if ($fraud_info['ip_city']) {
					$data['ip_city'] = $fraud_info['ip_city'];
				} else {
					$data['ip_city'] = '';
				}

				$data['ip_latitude'] = $fraud_info['ip_latitude'];
				$data['ip_longitude'] = $fraud_info['ip_longitude'];

				if ($fraud_info['ip_isp']) {
					$data['ip_isp'] = $fraud_info['ip_isp'];
				} else {
					$data['ip_isp'] = '';
				}

				if ($fraud_info['ip_org']) {
					$data['ip_org'] = $fraud_info['ip_org'];
				} else {
					$data['ip_org'] = '';
				}

				$data['ip_asnum'] = $fraud_info['ip_asnum'];

				if ($fraud_info['ip_user_type']) {
					$data['ip_user_type'] = $fraud_info['ip_user_type'];
				} else {
					$data['ip_user_type'] = '';
				}

				if ($fraud_info['ip_country_confidence']) {
					$data['ip_country_confidence'] = $fraud_info['ip_country_confidence'];
				} else {
					$data['ip_country_confidence'] = '';
				}

				if ($fraud_info['ip_region_confidence']) {
					$data['ip_region_confidence'] = $fraud_info['ip_region_confidence'];
				} else {
					$data['ip_region_confidence'] = '';
				}

				if ($fraud_info['ip_city_confidence']) {
					$data['ip_city_confidence'] = $fraud_info['ip_city_confidence'];
				} else {
					$data['ip_city_confidence'] = '';
				}

				if ($fraud_info['ip_postal_confidence']) {
					$data['ip_postal_confidence'] = $fraud_info['ip_postal_confidence'];
				} else {
					$data['ip_postal_confidence'] = '';
				}

				if ($fraud_info['ip_postal_code']) {
					$data['ip_postal_code'] = $fraud_info['ip_postal_code'];
				} else {
					$data['ip_postal_code'] = '';
				}

				$data['ip_accuracy_radius'] = $fraud_info['ip_accuracy_radius'];

				if ($fraud_info['ip_net_speed_cell']) {
					$data['ip_net_speed_cell'] = $fraud_info['ip_net_speed_cell'];
				} else {
					$data['ip_net_speed_cell'] = '';
				}

				$data['ip_metro_code'] = $fraud_info['ip_metro_code'];
				$data['ip_area_code'] = $fraud_info['ip_area_code'];

				if ($fraud_info['ip_time_zone']) {
					$data['ip_time_zone'] = $fraud_info['ip_time_zone'];
				} else {
					$data['ip_time_zone'] = '';
				}

				if ($fraud_info['ip_region_name']) {
					$data['ip_region_name'] = $fraud_info['ip_region_name'];
				} else {
					$data['ip_region_name'] = '';
				}

				if ($fraud_info['ip_domain']) {
					$data['ip_domain'] = $fraud_info['ip_domain'];
				} else {
					$data['ip_domain'] = '';
				}

				if ($fraud_info['ip_country_name']) {
					$data['ip_country_name'] = $fraud_info['ip_country_name'];
				} else {
					$data['ip_country_name'] = '';
				}

				if ($fraud_info['ip_continent_code']) {
					$data['ip_continent_code'] = $fraud_info['ip_continent_code'];
				} else {
					$data['ip_continent_code'] = '';
				}

				if ($fraud_info['ip_corporate_proxy']) {
					$data['ip_corporate_proxy'] = $fraud_info['ip_corporate_proxy'];
				} else {
					$data['ip_corporate_proxy'] = '';
				}

				$data['anonymous_proxy'] = $fraud_info['anonymous_proxy'];
				$data['proxy_score'] = $fraud_info['proxy_score'];

				if ($fraud_info['is_trans_proxy']) {
					$data['is_trans_proxy'] = $fraud_info['is_trans_proxy'];
				} else {
					$data['is_trans_proxy'] = '';
				}

				$data['free_mail'] = $fraud_info['free_mail'];
				$data['carder_email'] = $fraud_info['carder_email'];

				if ($fraud_info['high_risk_username']) {
					$data['high_risk_username'] = $fraud_info['high_risk_username'];
				} else {
					$data['high_risk_username'] = '';
				}

				if ($fraud_info['high_risk_password']) {
					$data['high_risk_password'] = $fraud_info['high_risk_password'];
				} else {
					$data['high_risk_password'] = '';
				}

				$data['bin_match'] = $fraud_info['bin_match'];

				if ($fraud_info['bin_country']) {
					$data['bin_country'] = $fraud_info['bin_country'];
				} else {
					$data['bin_country'] = '';
				}

				$data['bin_name_match'] = $fraud_info['bin_name_match'];

				if ($fraud_info['bin_name']) {
					$data['bin_name'] = $fraud_info['bin_name'];
				} else {
					$data['bin_name'] = '';
				}

				$data['bin_phone_match'] = $fraud_info['bin_phone_match'];

				if ($fraud_info['bin_phone']) {
					$data['bin_phone'] = $fraud_info['bin_phone'];
				} else {
					$data['bin_phone'] = '';
				}

				if ($fraud_info['customer_phone_in_billing_location']) {
					$data['customer_phone_in_billing_location'] = $fraud_info['customer_phone_in_billing_location'];
				} else {
					$data['customer_phone_in_billing_location'] = '';
				}

				$data['ship_forward'] = $fraud_info['ship_forward'];

				if ($fraud_info['city_postal_match']) {
					$data['city_postal_match'] = $fraud_info['city_postal_match'];
				} else {
					$data['city_postal_match'] = '';
				}

				if ($fraud_info['ship_city_postal_match']) {
					$data['ship_city_postal_match'] = $fraud_info['ship_city_postal_match'];
				} else {
					$data['ship_city_postal_match'] = '';
				}

				$data['score'] = $fraud_info['score'];
				$data['explanation'] = $fraud_info['explanation'];
				$data['risk_score'] = $fraud_info['risk_score'];
				$data['queries_remaining'] = $fraud_info['queries_remaining'];
				$data['maxmind_id'] = $fraud_info['maxmind_id'];
				$data['error'] = $fraud_info['error'];
			} else {
				$data['maxmind_id'] = '';
			}

			$data['payment_action'] = $this->load->controller('payment/' . $order_info['payment_code'] . '/orderAction', '');

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
			$data['brcr'] = $this->load->controller('common/brcr');

			$this->response->setOutput($this->load->view('sale/order_info.tpl', $data));
		} else {
			$this->load->language('error/not_found');

			$this->document->setTitle($this->language->get('heading_title'));

    foreach ($data['orders'] as &$order) {
      $vendors_fob_totals = $this->model_sale_order->getVendorsFobTotals($order['order_id']);
      foreach ($vendors_fob_totals as &$product_fob_total) {
        $product_fob_total['fob_total'] = $this->currency->format($product_fob_total['fob_total'], $product_fob_total['currency_code'], $product_fob_total['currency_value']);
        $product_fob_total['vendor_url'] = $this->url->link('catalog/vendor/update', 'token='.$this->session->data['token']. '&vendor_id='.$product_fob_total['vendor_id'], 'SSL');
      }
      $order['fob_total'] = $vendors_fob_totals;
    }

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_not_found'] = $this->language->get('text_not_found');

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL')
			);

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

            $data['brcr'] = $this->load->controller('common/brcr');
				
			$data['brcr'] = $this->load->controller('common/brcr');

			$this->response->setOutput($this->load->view('error/not_found.tpl', $data));
		}
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'sale/order')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function createInvoiceNo() {
		$this->load->language('sale/order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/order')) {
			$json['error'] = $this->language->get('error_permission');
		} elseif (isset($this->request->get['order_id'])) {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

include 'controller/bar/switch.php';
					
			$this->load->model('sale/order');

			$invoice_no = $this->model_sale_order->createInvoiceNo($order_id);

			if ($invoice_no) {
				$json['invoice_no'] = $invoice_no;
			} else {
				$json['error'] = $this->language->get('error_action');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function addReward() {
		$this->load->language('sale/order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/order')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

include 'controller/bar/switch.php';
					
			$this->load->model('sale/order');

			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info && $order_info['customer_id'] && ($order_info['reward'] > 0)) {
				$this->load->model('sale/customer');

				$reward_total = $this->model_sale_customer->getTotalCustomerRewardsByOrderId($order_id);

				if (!$reward_total) {
					$this->model_sale_customer->addReward($order_info['customer_id'], $this->language->get('text_order_id') . ' #' . $order_id, $order_info['reward'], $order_id);
				}
			}

			$json['success'] = $this->language->get('text_reward_added');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function removeReward() {
		$this->load->language('sale/order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/order')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

include 'controller/bar/switch.php';
					
			$this->load->model('sale/order');

			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {
				$this->load->model('sale/customer');

				$this->model_sale_customer->deleteReward($order_id);
			}

			$json['success'] = $this->language->get('text_reward_removed');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function addCommission() {
		$this->load->language('sale/order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/order')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

include 'controller/bar/switch.php';
					
			$this->load->model('sale/order');

			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {
				$this->load->model('marketing/affiliate');

				$affiliate_total = $this->model_marketing_affiliate->getTotalTransactionsByOrderId($order_id);

				if (!$affiliate_total) {
					$this->model_marketing_affiliate->addTransaction($order_info['affiliate_id'], $this->language->get('text_order_id') . ' #' . $order_id, $order_info['commission'], $order_id);
				}
			}

			$json['success'] = $this->language->get('text_commission_added');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function removeCommission() {
		$this->load->language('sale/order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/order')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

include 'controller/bar/switch.php';
					
			$this->load->model('sale/order');

			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {
				$this->load->model('marketing/affiliate');

				$this->model_marketing_affiliate->deleteTransaction($order_id);
			}

			$json['success'] = $this->language->get('text_commission_removed');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function history() {
		$this->load->language('sale/order');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_notify'] = $this->language->get('column_notify');
		$data['column_comment'] = $this->language->get('column_comment');


		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['histories'] = array();

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		$results = $this->model_sale_order->getOrderHistories($this->request->get['order_id'], ($page - 1) * 10, 10);


			$this->load->model('catalog/vendor');
			
		foreach ($results as $result) {

			$vendor_info = $this->model_catalog_vendor->getVendor($result['vendor_id']);
			if (!empty($vendor_info)) {
				$vendor_name = $vendor_info['vendor_name'];
			} else {
				$vendor_name = $this->language->get('text_default_store');
			}
			

              $status = $this->model_sale_order->getAllVendorOrderStatus($result['order_id']);
				
			if ($status) {
				$status = $status;
			} else {
				$status = $result['status'];
			}
                
			$data['histories'][] = array(
				'notify'     => $result['notify'] ? $this->language->get('text_yes') : $this->language->get('text_no'),
				
			'status'     => $result['status'] . ' - ' . $vendor_name,
			
				'comment'    => nl2br($result['comment']),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$history_total = $this->model_sale_order->getTotalOrderHistories($this->request->get['order_id']);

		$pagination = new Pagination();
		$pagination->total = $history_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('sale/order/history', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

		$this->response->setOutput($this->load->view('sale/order_history.tpl', $data));
	}

	public function invoice() {

			if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
         $server = HTTPS_CATALOG."image/";
      } else {
         $server = HTTP_CATALOG."image/";
      }   
      
      if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
         $data['logo'] = $server . $this->config->get('config_logo');
      } else {
         $data['logo'] = '';
      }


		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_invoice');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');
			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_invoice_no_comm'] = $this->language->get('text_invoice_no_comm');
			$data['text_shipmentid'] = $this->language->get('text_shipmentid');
			$data['text_containerid'] = $this->language->get('text_containerid');
			$data['text_product_name'] = $this->language->get('text_product_name');
			$data['text_pallet_id'] = $this->language->get('text_pallet_id');
			$data['text_product_no'] = $this->language->get('text_product_no');
			$data['text_case_qty']  = $this->language->get('text_case_qty');
			$data['text_case_fmt']  = $this->language->get('text_case_fmt');
			$data['text_bottles']    = $this->language->get('text_bottles');
			$data['text_unit_price'] = $this->language->get('text_unit_price');
			$data['text_payment_date'] = $this->language->get('text_payment_date');
			$data['text_commercial_inv'] = $this->language->get('text_commercial_inv');
			$data['text_total_volume'] = $this->language->get('text_total_volume');
			$data['text_order_total_pallet'] = $this->language->get('text_order_total_pallet');
			$data['text_total_weight'] = $this->language->get('text_total_weight');
			$data['text_vol_pallet'] = $this->language->get('text_vol_pallet');

		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_ship_to'] = $this->language->get('text_ship_to');
		$data['text_payment_method'] = $this->language->get('text_payment_method');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_model'] = $this->language->get('column_model');
$data['column_sku'] = $this->language->get('column_sku');
						 
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_comment'] = $this->language->get('column_comment');

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {
				$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);

				if ($store_info) {
					$store_address = $store_info['config_address'];
					$store_email = $store_info['config_email'];
					$store_telephone = $store_info['config_telephone'];
					$store_fax = $store_info['config_fax'];
					$comment = $store_info['config_comment'];
				} else {
					$store_address = $this->config->get('config_address');
					$store_email = $this->config->get('config_email');
					$store_telephone = $this->config->get('config_telephone');
					$store_fax = $this->config->get('config_fax');
					$comment = $this->config->get('config_comment');
				}

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}

				if ($order_info['payment_address_format']) {
					$format = $order_info['payment_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['payment_firstname'],
					'lastname'  => $order_info['payment_lastname'],
					'company'   => $order_info['payment_company'],
					'address_1' => $order_info['payment_address_1'],
					'address_2' => $order_info['payment_address_2'],
					'city'      => $order_info['payment_city'],
					'postcode'  => $order_info['payment_postcode'],
					'zone'      => $order_info['payment_zone'],
					'zone_code' => $order_info['payment_zone_code'],
					'country'   => $order_info['payment_country']
				);

				$payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				if ($order_info['shipping_address_format']) {
					$format = $order_info['shipping_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['shipping_firstname'],
					'lastname'  => $order_info['shipping_lastname'],
					'company'   => $order_info['shipping_company'],
					'address_1' => $order_info['shipping_address_1'],
					'address_2' => $order_info['shipping_address_2'],
					'city'      => $order_info['shipping_city'],
					'postcode'  => $order_info['shipping_postcode'],
					'zone'      => $order_info['shipping_zone'],
					'zone_code' => $order_info['shipping_zone_code'],
					'country'   => $order_info['shipping_country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$this->load->model('tool/upload');

				$product_data = array();

			$hkd_sub_total = 0.0; $eur_sub_total = 0.0; $sub_total = 0.0; 
			$pallet_case = 50;
			$total_quantity = 0;
			$total_weight = 0.0;

				$products = $this->model_sale_order->getOrderProducts($order_id);

				foreach ($products as $product) {
					$option_data = array();

					$options = $this->model_sale_order->getOrderOptions($order_id, $product['order_product_id']);

					foreach ($options as $option) {
						if ($option['type'] != 'file') {
							$value = $option['value'];
						} else {
							$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

							if ($upload_info) {
								$value = $upload_info['name'];
							} else {
								$value = '';
							}
						}

						$option_data[] = array(
							'name'  => $option['name'],
							'value' => $value
						);
					}

            $this->load->model('catalog/product');

			$product_info = $this->model_catalog_product->getProduct($product['product_id']);
			$this->load->model('tool/image');
			if ($product_info['image']) {
			$productimage = $this->model_tool_image->resize($product_info['image'], 50, 50);
			} else {
			$productimage = false;
			}
			$this->load->model('sale/vdi_order');
			$fob = $this->model_sale_vdi_order->getFobPrice( $product['product_id'] );
			$weight_info = array();
			$weight_info = $this->model_sale_order->getProductWeight( $product['product_id'] );
			$weight_info['weight'] = (float) $product['quantity'] *  $weight_info['weight'] ;
			if( $order_info['currency_code'] == 'HKD' ) {
			    $hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
				$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
				$hkd_total = $this->currency->format(  ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']);
				$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR', 1.000000 );
				$eur_sub_total += ( $product['price'] * $product['quantity'] );
			} else {
			    $hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'HKD' );
				$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
				$hkd_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'HKD' );
				$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR' );
				$eur_sub_total += ( $product['price'] * $product['quantity'] );
			}
			$total_quantity += $product['quantity'];
			$total_weight +=  $weight_info['weight'];

					$product_data[] = array(
'sku'      => $product['sku'],
'image'    => $productimage,
						'name'     => $product['name'],
						'model'    => $product['model'],

			'product_no'   => $product['product_no'],
			'pallet_no'    => $product['pallet_no'],
			'product_format' => $fob['pf'],
			'total_bottles'  => ( $fob['pf'] * $product['quantity'] ),
			'eur_price'      => $eur_price,
			'hkd_price'      => $hkd_price,
			'hkd_total'      => $hkd_total,
			'eur_total'      => $eur_total,

						'option'   => $option_data,
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
					);
				}

				$voucher_data = array();

				$vouchers = $this->model_sale_order->getOrderVouchers($order_id);

				foreach ($vouchers as $voucher) {
					$voucher_data[] = array(
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value'])
					);
				}

				$total_data = array();

				
				//GV - START
				$totals = $this->model_sale_order->getOrderTotals($order_id);

				foreach ($totals as $total) {
				    $text = '';
					if ( $order_info['currency_code'] == 'HKD' ) {
						 $text = $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']);
						 $text .= "<br>" . $this->currency->format($total['value'], 'EUR');
					} else {
						 $text = $this->currency->format($total['value'], 'HKD' );
						 $text .= "<br>" . $this->currency->format($total['value'], 'EUR');
					}
					$total_data[] = array(
						'title' => $total['title'],
						'text'  => $text,
					);
				}
				//GV - END









if(!isset($comment)) { $comment = ''; }
				$data['orders'][] = array(
			'shipment_id' => $order_info['shipment_id'],
			'container_id' => $order_info['container_id'],
			'payment_date' =>  $this->model_sale_order->getOrderPaymentDate( $order_id ), //date($this->language->get('date_format_short'), strtotime( $this->model_sale_order->getOrderPaymentDate( $order_id ) )),
			'total_pallet' => $this->model_sale_order->getTotalPallet( $order_id ),
			'pallet_volume' => ( $pallet_case * 0.245 * 0.305 * 0.2 ),
			'total_volume'  => ( $total_quantity * 0.245 * 0.305 * 0.2 ),
			'total_weight'  =>  $total_weight . " " . $weight_info['unit'],

					'order_id'	         => $order_id,
					'invoice_no'         => $invoice_no,
					'date_added'         => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
					'store_name'         => $order_info['store_name'],
					'store_url'          => rtrim($order_info['store_url'], '/'),
					'store_address'      => nl2br($store_address),
					'store_email'        => $store_email,
					'store_telephone'    => $store_telephone,
					'store_fax'          => $store_fax,
					'email'              => $order_info['email'],
					'telephone'          => $order_info['telephone'],
					'shipping_address'   => $shipping_address,
					'shipping_method'    => $order_info['shipping_method'],
					'payment_address'    => $payment_address,
					'payment_method'     => $order_info['payment_method'],
 
			        'show_inv_sku'       => $show_inv_sku,
      				'invskubar'  	     => $invskubar,	
					'show_inv_number'  	 => $show_inv_number,
					'invbar'  	         => $invbar,
					'show_inv_model'  	 => $show_inv_model,
					'invmodelbar'  	     => $invmodelbar,
					
					'product'            => $product_data,
					'voucher'            => $voucher_data,
					'total'              => $total_data,
					'comment'            => nl2br($comment)
				);
			}
		}

				$this->response->setOutput($this->load->view('sale/order_invoice_new.tpl', $data));

	}

	public function invoicepdf() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_invoice');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');
			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_invoice_no_comm'] = $this->language->get('text_invoice_no_comm');
			$data['text_shipmentid'] = $this->language->get('text_shipmentid');
			$data['text_containerid'] = $this->language->get('text_containerid');
			$data['text_product_name'] = $this->language->get('text_product_name');
			$data['text_pallet_id'] = $this->language->get('text_pallet_id');
			$data['text_product_no'] = $this->language->get('text_product_no');
			$data['text_case_qty']  = $this->language->get('text_case_qty');
			$data['text_case_fmt']  = $this->language->get('text_case_fmt');
			$data['text_bottles']    = $this->language->get('text_bottles');
			$data['text_unit_price'] = $this->language->get('text_unit_price');
			$data['text_payment_date'] = $this->language->get('text_payment_date');
			$data['text_commercial_inv'] = $this->language->get('text_commercial_inv');
			$data['text_total_volume'] = $this->language->get('text_total_volume');
			$data['text_order_total_pallet'] = $this->language->get('text_order_total_pallet');
			$data['text_total_weight'] = $this->language->get('text_total_weight');
			$data['text_vol_pallet'] = $this->language->get('text_vol_pallet');

		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_ship_to'] = $this->language->get('text_ship_to');
		$data['text_payment_method'] = $this->language->get('text_payment_method');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_model'] = $this->language->get('column_model');
$data['column_sku'] = $this->language->get('column_sku');
						 
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_comment'] = $this->language->get('column_comment');

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {
				$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);

				if ($store_info) {
					$store_address = $store_info['config_address'];
					$store_email = $store_info['config_email'];
					$store_telephone = $store_info['config_telephone'];
					$store_fax = $store_info['config_fax'];
					$comment = $store_info['config_comment'];
				} else {
					$store_address = $this->config->get('config_address');
					$store_email = $this->config->get('config_email');
					$store_telephone = $this->config->get('config_telephone');
					$store_fax = $this->config->get('config_fax');
					$comment = $this->config->get('config_comment');
				}

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}

				if ($order_info['payment_address_format']) {
					$format = $order_info['payment_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['payment_firstname'],
					'lastname'  => $order_info['payment_lastname'],
					'company'   => $order_info['payment_company'],
					'address_1' => $order_info['payment_address_1'],
					'address_2' => $order_info['payment_address_2'],
					'city'      => $order_info['payment_city'],
					'postcode'  => $order_info['payment_postcode'],
					'zone'      => $order_info['payment_zone'],
					'zone_code' => $order_info['payment_zone_code'],
					'country'   => $order_info['payment_country']
				);

				$payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				if ($order_info['shipping_address_format']) {
					$format = $order_info['shipping_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['shipping_firstname'],
					'lastname'  => $order_info['shipping_lastname'],
					'company'   => $order_info['shipping_company'],
					'address_1' => $order_info['shipping_address_1'],
					'address_2' => $order_info['shipping_address_2'],
					'city'      => $order_info['shipping_city'],
					'postcode'  => $order_info['shipping_postcode'],
					'zone'      => $order_info['shipping_zone'],
					'zone_code' => $order_info['shipping_zone_code'],
					'country'   => $order_info['shipping_country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$this->load->model('tool/upload');

				$product_data = array();

			$hkd_sub_total = 0.0; $eur_sub_total = 0.0; $sub_total = 0.0; 
			$pallet_case = 50;
			$total_quantity = 0;
			$total_weight = 0.0;

				$products = $this->model_sale_order->getOrderProducts($order_id);

				foreach ($products as $product) {
					$option_data = array();

					$options = $this->model_sale_order->getOrderOptions($order_id, $product['order_product_id']);

					foreach ($options as $option) {
						if ($option['type'] != 'file') {
							$value = $option['value'];
						} else {
							$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

							if ($upload_info) {
								$value = $upload_info['name'];
							} else {
								$value = '';
							}
						}

						$option_data[] = array(
							'name'  => $option['name'],
							'value' => $value
						);
					}

            $this->load->model('catalog/product');

			$product_info = $this->model_catalog_product->getProduct($product['product_id']);
			$this->load->model('tool/image');
			if ($product_info['image']) {
			$productimage = $this->model_tool_image->resize($product_info['image'], 50, 50);
			} else {
			$productimage = false;
			}
			$this->load->model('sale/vdi_order');
			$fob = $this->model_sale_vdi_order->getFobPrice( $product['product_id'] );
			$weight_info = array();
			$weight_info = $this->model_sale_order->getProductWeight( $product['product_id'] );
			$weight_info['weight'] = (float) $product['quantity'] *  $weight_info['weight'] ;
			if( $order_info['currency_code'] == 'HKD' ) {
			    $hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
				$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
				$hkd_total = $this->currency->format(  ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']);
				$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR', 1.000000 );
				$eur_sub_total += ( $product['price'] * $product['quantity'] );
			} else {
			    $hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'HKD' );
				$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
				$hkd_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'HKD' );
				$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR' );
				$eur_sub_total += ( $product['price'] * $product['quantity'] );
			}
			$total_quantity += $product['quantity'];
			$total_weight +=  $weight_info['weight'];

					$product_data[] = array(
'sku'      => $product['sku'],
'image'    => $productimage,
						'name'     => $product['name'],
						'model'    => $product['model'],

			'product_no'   => $product['product_no'],
			'pallet_no'    => $product['pallet_no'],
			'product_format' => $fob['pf'],
			'total_bottles'  => ( $fob['pf'] * $product['quantity'] ),
			'eur_price'      => $eur_price,
			'hkd_price'      => $hkd_price,
			'hkd_total'      => $hkd_total,
			'eur_total'      => $eur_total,

						'option'   => $option_data,
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
					);
				}

				$voucher_data = array();

				$vouchers = $this->model_sale_order->getOrderVouchers($order_id);

				foreach ($vouchers as $voucher) {
					$voucher_data[] = array(
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value'])
					);
				}

				$total_data = array();

				
				//GV - START
				$totals = $this->model_sale_order->getOrderTotals($order_id);

				foreach ($totals as $total) {
				    $text = '';
					if ( $order_info['currency_code'] == 'HKD' ) {
						 $text = $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']);
						 $text .= "<br>" . $this->currency->format($total['value'], 'EUR');
					} else {
						 $text = $this->currency->format($total['value'], 'HKD' );
						 $text .= "<br>" . $this->currency->format($total['value'], 'EUR');
					}
					$total_data[] = array(
						'title' => $total['title'],
						'text'  => $text,
					);
				}
				//GV - END









if(!isset($comment)) { $comment = ''; }
				$data['orders'][] = array(
			'shipment_id' => $order_info['shipment_id'],
			'container_id' => $order_info['container_id'],
			'payment_date' =>  $this->model_sale_order->getOrderPaymentDate( $order_id ), //date($this->language->get('date_format_short'), strtotime( $this->model_sale_order->getOrderPaymentDate( $order_id ) )),
			'total_pallet' => $this->model_sale_order->getTotalPallet( $order_id ),
			'pallet_volume' => ( $pallet_case * 0.245 * 0.305 * 0.2 ),
			'total_volume'  => ( $total_quantity * 0.245 * 0.305 * 0.2 ),
			'total_weight'  =>  $total_weight . " " . $weight_info['unit'],

					'order_id'	         => $order_id,
					'invoice_no'         => $invoice_no,
					'date_added'         => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
					'store_name'         => $order_info['store_name'],
					'store_url'          => rtrim($order_info['store_url'], '/'),
					'store_address'      => nl2br($store_address),
					'store_email'        => $store_email,
					'store_telephone'    => $store_telephone,
					'store_fax'          => $store_fax,
					'email'              => $order_info['email'],
					'telephone'          => $order_info['telephone'],
					'shipping_address'   => $shipping_address,
					'shipping_method'    => $order_info['shipping_method'],
					'payment_address'    => $payment_address,
					'payment_method'     => $order_info['payment_method'],
 
			        'show_inv_sku'       => $show_inv_sku,
      				'invskubar'  	     => $invskubar,	
					'show_inv_number'  	 => $show_inv_number,
					'invbar'  	         => $invbar,
					'show_inv_model'  	 => $show_inv_model,
					'invmodelbar'  	     => $invmodelbar,
					
					'product'            => $product_data,
					'voucher'            => $voucher_data,
					'total'              => $total_data,
					'comment'            => nl2br($comment)
				);
			}
		}

		$this->response->setOutput($this->load->view('sale/order_invoice_pdf.tpl', $data));
	}

	public function invoicexls() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_invoice');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');
			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_invoice_no_comm'] = $this->language->get('text_invoice_no_comm');
			$data['text_shipmentid'] = $this->language->get('text_shipmentid');
			$data['text_containerid'] = $this->language->get('text_containerid');
			$data['text_product_name'] = $this->language->get('text_product_name');
			$data['text_pallet_id'] = $this->language->get('text_pallet_id');
			$data['text_product_no'] = $this->language->get('text_product_no');
			$data['text_case_qty']  = $this->language->get('text_case_qty');
			$data['text_case_fmt']  = $this->language->get('text_case_fmt');
			$data['text_bottles']    = $this->language->get('text_bottles');
			$data['text_unit_price'] = $this->language->get('text_unit_price');
			$data['text_payment_date'] = $this->language->get('text_payment_date');
			$data['text_commercial_inv'] = $this->language->get('text_commercial_inv');
			$data['text_total_volume'] = $this->language->get('text_total_volume');
			$data['text_order_total_pallet'] = $this->language->get('text_order_total_pallet');
			$data['text_total_weight'] = $this->language->get('text_total_weight');
			$data['text_vol_pallet'] = $this->language->get('text_vol_pallet');

		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_ship_to'] = $this->language->get('text_ship_to');
		$data['text_payment_method'] = $this->language->get('text_payment_method');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_model'] = $this->language->get('column_model');
$data['column_sku'] = $this->language->get('column_sku');
						 
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_comment'] = $this->language->get('column_comment');

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {
				$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);

				if ($store_info) {
					$store_address = $store_info['config_address'];
					$store_email = $store_info['config_email'];
					$store_telephone = $store_info['config_telephone'];
					$store_fax = $store_info['config_fax'];
					$comment = $store_info['config_comment'];
				} else {
					$store_address = $this->config->get('config_address');
					$store_email = $this->config->get('config_email');
					$store_telephone = $this->config->get('config_telephone');
					$store_fax = $this->config->get('config_fax');
					$comment = $this->config->get('config_comment');
				}

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}

				if ($order_info['payment_address_format']) {
					$format = $order_info['payment_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['payment_firstname'],
					'lastname'  => $order_info['payment_lastname'],
					'company'   => $order_info['payment_company'],
					'address_1' => $order_info['payment_address_1'],
					'address_2' => $order_info['payment_address_2'],
					'city'      => $order_info['payment_city'],
					'postcode'  => $order_info['payment_postcode'],
					'zone'      => $order_info['payment_zone'],
					'zone_code' => $order_info['payment_zone_code'],
					'country'   => $order_info['payment_country']
				);

				$payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				if ($order_info['shipping_address_format']) {
					$format = $order_info['shipping_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['shipping_firstname'],
					'lastname'  => $order_info['shipping_lastname'],
					'company'   => $order_info['shipping_company'],
					'address_1' => $order_info['shipping_address_1'],
					'address_2' => $order_info['shipping_address_2'],
					'city'      => $order_info['shipping_city'],
					'postcode'  => $order_info['shipping_postcode'],
					'zone'      => $order_info['shipping_zone'],
					'zone_code' => $order_info['shipping_zone_code'],
					'country'   => $order_info['shipping_country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$this->load->model('tool/upload');

				$product_data = array();

			$hkd_sub_total = 0.0; $eur_sub_total = 0.0; $sub_total = 0.0; 
			$pallet_case = 50;
			$total_quantity = 0;
			$total_weight = 0.0;

				$products = $this->model_sale_order->getOrderProducts($order_id);

				foreach ($products as $product) {
					$option_data = array();

					$options = $this->model_sale_order->getOrderOptions($order_id, $product['order_product_id']);

					foreach ($options as $option) {
						if ($option['type'] != 'file') {
							$value = $option['value'];
						} else {
							$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

							if ($upload_info) {
								$value = $upload_info['name'];
							} else {
								$value = '';
							}
						}

						$option_data[] = array(
							'name'  => $option['name'],
							'value' => $value
						);
					}

            $this->load->model('catalog/product');

			$product_info = $this->model_catalog_product->getProduct($product['product_id']);
			$this->load->model('tool/image');
			if ($product_info['image']) {
			$productimage = $this->model_tool_image->resize($product_info['image'], 50, 50);
			} else {
			$productimage = false;
			}
			$this->load->model('sale/vdi_order');
			$fob = $this->model_sale_vdi_order->getFobPrice( $product['product_id'] );
			$weight_info = array();
			$weight_info = $this->model_sale_order->getProductWeight( $product['product_id'] );
			$weight_info['weight'] = (float) $product['quantity'] *  $weight_info['weight'] ;
			if( $order_info['currency_code'] == 'HKD' ) {
			    $hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
				$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
				$hkd_total = $this->currency->format(  ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']);
				$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR', 1.000000 );
				$eur_sub_total += ( $product['price'] * $product['quantity'] );
			} else {
			    $hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'HKD' );
				$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
				$hkd_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'HKD' );
				$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR' );
				$eur_sub_total += ( $product['price'] * $product['quantity'] );
			}
			$total_quantity += $product['quantity'];
			$total_weight +=  $weight_info['weight'];

					$product_data[] = array(
'sku'      => $product['sku'],
'image'    => $productimage,
						'name'     => $product['name'],
						'model'    => $product['model'],

			'product_no'   => $product['product_no'],
			'pallet_no'    => $product['pallet_no'],
			'product_format' => $fob['pf'],
			'total_bottles'  => ( $fob['pf'] * $product['quantity'] ),
			'eur_price'      => $eur_price,
			'hkd_price'      => $hkd_price,
			'hkd_total'      => $hkd_total,
			'eur_total'      => $eur_total,

						'option'   => $option_data,
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
					);
				}

				$voucher_data = array();

				$vouchers = $this->model_sale_order->getOrderVouchers($order_id);

				foreach ($vouchers as $voucher) {
					$voucher_data[] = array(
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value'])
					);
				}

				$total_data = array();

				
				//GV - START
				$totals = $this->model_sale_order->getOrderTotals($order_id);

				foreach ($totals as $total) {
				    $text = '';
					$text2 = '';
					if ( $order_info['currency_code'] == 'HKD' ) {
						 $text = $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']);
						 
						 $text2 = $this->currency->format($total['value'], 'EUR');
					} else {
						 $text = $this->currency->format($total['value'], 'HKD' );
						 
						 $text2 = $this->currency->format($total['value'], 'EUR');
					}
					$total_data[] = array(
						'title' => $total['title'],
						'text'  => $text,
						'text2'  => $text2,
					);
				}
				//GV - END









if(!isset($comment)) { $comment = ''; }
				$data['orders'][] = array(
			'shipment_id' => $order_info['shipment_id'],
			'container_id' => $order_info['container_id'],
			'payment_date' =>  $this->model_sale_order->getOrderPaymentDate( $order_id ), //date($this->language->get('date_format_short'), strtotime( $this->model_sale_order->getOrderPaymentDate( $order_id ) )),
			'total_pallet' => $this->model_sale_order->getTotalPallet( $order_id ),
			'pallet_volume' => ( $pallet_case * 0.245 * 0.305 * 0.2 ),
			'total_volume'  => ( $total_quantity * 0.245 * 0.305 * 0.2 ),
			'total_weight'  =>  $total_weight . " " . $weight_info['unit'],

					'order_id'	         => $order_id,
					'invoice_no'         => $invoice_no,
					'date_added'         => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
					'store_name'         => $order_info['store_name'],
					'store_url'          => rtrim($order_info['store_url'], '/'),
					'store_address'      => nl2br($store_address),
					'store_email'        => $store_email,
					'store_telephone'    => $store_telephone,
					'store_fax'          => $store_fax,
					'email'              => $order_info['email'],
					'telephone'          => $order_info['telephone'],
					'shipping_address'   => $shipping_address,
					'shipping_method'    => $order_info['shipping_method'],
					'payment_address'    => $payment_address,
					'payment_method'     => $order_info['payment_method'],
 
			        'show_inv_sku'       => $show_inv_sku,
      				'invskubar'  	     => $invskubar,	
					'show_inv_number'  	 => $show_inv_number,
					'invbar'  	         => $invbar,
					'show_inv_model'  	 => $show_inv_model,
					'invmodelbar'  	     => $invmodelbar,
					
					'product'            => $product_data,
					'voucher'            => $voucher_data,
					'total'              => $total_data,
					'comment'            => nl2br($comment)
				);
			}
		}

		$this->response->setOutput($this->load->view('sale/order_invoice_xls.tpl', $data));
	}

	public function shipping() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_shipping');

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');

		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['text_picklist'] = $this->language->get('text_picklist');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_from'] = $this->language->get('text_from');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$data['text_sku'] = $this->language->get('text_sku');
		$data['text_upc'] = $this->language->get('text_upc');
		$data['text_ean'] = $this->language->get('text_ean');
		$data['text_jan'] = $this->language->get('text_jan');
		$data['text_isbn'] = $this->language->get('text_isbn');
		$data['text_mpn'] = $this->language->get('text_mpn');


$data['column_pallet_no'] = $this->language->get('column_pallet_no');
      
		$data['column_location'] = $this->language->get('column_location');
		$data['column_reference'] = $this->language->get('column_reference');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_model'] = $this->language->get('column_model');
$data['column_sku'] = $this->language->get('column_sku');
						 
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_comment'] = $this->language->get('column_comment');

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');
		$this->load->model('sale/vdi_order');

		$this->load->model('catalog/product');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}
		//GV - GENERAL
		$data['text_total_weight'] = $this->language->get('text_total_weight');
		$data['text_total_cases']  = $this->language->get('text_total_cases');
		$data['text_note']         = $this->language->get('text_note');
		$data['text_tracking_no']  = $this->language->get('text_tracking_no');
		$data['text_carrier']      = $this->language->get('text_carrier');
		$data['text_nof_prod']     = $this->language->get('text_nof_prod');
		$data['text_nof_pallet']   = $this->language->get('text_nof_pallet');
		$data['text_pal_total_prod']  = $this->language->get('text_pal_total_prod');
		$data['text_vintage']         = $this->language->get('text_vintage');
		$data['text_wh_contact']      = $this->language->get('text_wh_contact');
		$data['text_store_contact']   = $this->language->get('text_store_contact');
		$data['text_wh_info']         = $this->language->get('text_wh_info');
		$data['column_location'] = 'Prod#';
		$data['uom'] = $this->model_sale_vdi_order->getUOM( $this->config->get('config_weight_class_id') );
		$data['invbar'] = $this->model_sale_vdi_order->getInvoiceBarType();
		$data['store_email1'] = $this->config->get('config_email');
		$data['store_telephone1'] = $this->config->get('config_telephone');
		$data['store_fax1'] = $this->config->get('config_fax');
		$data['mvd_sales_order_invoice_address'] = $this->config->get('mvd_sales_order_invoice_address');

		//need to be added carefully in another way
		$data['carrier'] = '';
		$data['tracking_no'] = '';

		foreach ($orders as $order_id) {
			//$order_id = $orders[0];
			$order_info = $this->model_sale_order->getOrder($order_id);

			$vendors = array();
			$vendors = $this->model_sale_vdi_order->getOrderVendors($order_id);

			foreach ( $vendors as $vendor ) {
					//$vendor_id = $vendors[0]['vendor_id'];
					$vendor_id = $vendor['vendor_id'];

				$address_data = $this->model_sale_vdi_order->getVendorAddress( $vendor_id );
				$company = $address_data['company'];

				// Make sure there is a shipping method
				if ($order_info && $order_info['shipping_code']) {
					$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);

						$format = '{firstname} {lastname}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
						$find = array(
						'{firstname}',
						'{lastname}',
						'{address_1}',
						'{address_2}',
						'{city}',
						'{postcode}',
						'{zone}',
						'{zone_code}',
						'{country}'
						);

						$replace = array(
							'firstname' => $address_data['firstname'],
							'lastname'  => $address_data['lastname'],
							'address_1' => $address_data['address_1'],
							'address_2' => $address_data['address_2'],
							'city'      => $address_data['city'],
							'postcode'  => $address_data['postcode'],
							'zone'      => $address_data['zone'],
							'zone_code' => $address_data['zone_code'],
							'country'   => $address_data['country']
						);

					$vendor_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

					$store_address = $vendor_address;
					$store_email = $address_data['email'];
					$store_telephone = $address_data['telephone'];
					$store_fax = $address_data['fax'];
					if ($order_info['invoice_no']) {
						$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
					} else {
						$invoice_no = '';
					}

					$wh_info = $this->model_sale_vdi_order->getWarehouseAddress();
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

					$find = array(
						'{firstname}',
						'{lastname}',
						'{company}',
						'{address_1}',
						'{address_2}',
						'{city}',
						'{postcode}',
						'{zone}',
						//'{zone_code}',
						'{country}'
					);

					$replace = array(
						'firstname' => '',//$wh_info['shipping_firstname'],
						'lastname'  => '',//$wh_info['shipping_lastname'],
						'company'   => $wh_info['company'],
						'address_1' => $wh_info['address_1'],
						'address_2' => $wh_info['address_2'],
						'city'      => $wh_info['city'],
						'postcode'  => $wh_info['postcode'],
						'zone'      => '',
						//'zone_code' => $wh_info['zone_code'],
						'country'   => $wh_info['country']
					);

					$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
					$this->load->model('tool/upload');

					$product_data = array();

					$products = $this->model_sale_vdi_order->getOrderProductsNew($order_id, $vendor_id);

					//$products = $this->model_sale_vdi_order->getOrderProductsWarehouse($order_id);
					//GV
					$total_weight = 0.0;
					$total_quantity = 0;
					$weight1 = 0.0;

					foreach ($products as $product) {
						$product_info = $this->model_catalog_product->getProduct($product['product_id']);

						//GV
						$fob = $this->model_sale_vdi_order->getFobPrice( $product['product_id'] );
						if ( (int) $fob['pf'] == 6 ) {
							$weight1 = (float) ( $product_info['weight']  ) * (float) $product['quantity'];
						} if ( (int) $fob['pf'] == 12 ) {
							$weight1 = (float) ( $product_info['weight'] * 2 ) * (float) $product['quantity'];
						}
						$total_weight += (float) $weight1;
						$total_quantity += $product['quantity'];
						$product_no = $this->model_sale_vdi_order->getProductNo( $order_id, $product['product_id']);
						$product_info['location'] = $product_no; //location is replaced by product#
						$vintage = $this->model_sale_vdi_order->getVintage( $product['product_id'] );
						$pallet_no = $this->model_sale_vdi_order->getPalletID( $product['pallet_id'] );

						$options = $this->model_sale_order->getOrderOptions($order_id, $product['order_product_id']);

						$option_data = array();

						foreach ($options as $option) {
							if ($option['type'] != 'file') {
								$value = $option['value'];
							} else {
								$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

								if ($upload_info) {
									$value = $upload_info['name'];
								} else {
									$value = '';
								}
							}

							$option_data[] = array(
								'name'  => $option['name'],
								'value' => $value
							);
						}

            $this->load->model('catalog/product');

			$product_info = $this->model_catalog_product->getProduct($product['product_id']);
			$this->load->model('tool/image');
			if ($product_info['image']) {
			$productimage = $this->model_tool_image->resize($product_info['image'], 50, 50);
			} else {
			$productimage = false;
			}
						$product_data[] = array(
'sku'      => $product['sku'],
'image'    => $productimage,
							'name'     => $product_info['name'],
							'model'    => $product_info['model'],
							'option'   => $option_data,
							'quantity' => $product['quantity'],

'pallet_no' => $product['pallet_no'],
      
							'location' => $product_info['location'],
							'location1' => $product_no,
							'vintage'  => $vintage,
							'sku'      => $product_info['sku'],
							'upc'      => $product_info['upc'],
							'ean'      => $product_info['ean'],
							'jan'      => $product_info['jan'],
							'isbn'     => $product_info['isbn'],
							'mpn'      => $product_info['mpn'],
							'pallet_no' => $pallet_no,
							'weight'   => $this->weight->format( $weight1, $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'))
						);
					}

					//GV WAREHOUSE INFORMATION
					$wh_product_data = array();

					$wh_products = $this->model_sale_vdi_order->getOrderProductsWarehouse($order_id);
					//GV
					$wh_total_weight = 0.0;
					$wh_total_quantity = 0;
					$wh_weight1 = 0.0;

					foreach ($wh_products as $wh_product) {
						$wh_product_info = $this->model_catalog_product->getProduct($wh_product['product_id']);
						//GV
						$fob = $this->model_sale_vdi_order->getFobPrice( $wh_product['product_id'] );
						if ( (int) $fob['pf'] == 6 ) {
							$wh_weight1 = (float) ( $wh_product_info['weight']  ) * (float) $wh_product['quantity'];
						} if ( (int) $fob['pf'] == 12 ) {
							$wh_weight1 = (float) ( $wh_product_info['weight'] * 2 ) * (float) $wh_product['quantity'];
						}
						$wh_total_weight += (float) $wh_weight1;
						$wh_total_quantity += $wh_product['quantity'];
						$product_no = $this->model_sale_vdi_order->getProductNo( $order_id, $wh_product['product_id']);
						$wh_product_info['location'] = $product_no; //location is replaced by product#

						$wh_vintage = $this->model_sale_vdi_order->getVintage( $wh_product['product_id'] );
						$wh_pallet_no = $this->model_sale_vdi_order->getPalletID( $wh_product['pallet_id'] );
						$pal_total_product = $this->model_sale_vdi_order->getPalletProductTotal( $wh_pallet_no );

						$wh_product_data[] = array(
							'name'     => $wh_product_info['name'],
							'model'    => $wh_product_info['model'],
							'quantity' => $wh_product['quantity'],
							'location' => $wh_product_info['location'],
							'location1' => $wh_product_info['location'],
							'sku'      => $wh_product_info['sku'],
							'upc'      => $wh_product_info['upc'],
							'ean'      => $wh_product_info['ean'],
							'jan'      => $wh_product_info['jan'],
							'isbn'     => $wh_product_info['isbn'],
							'mpn'      => $wh_product_info['mpn'],
							'pallet_no' => $wh_pallet_no,
							'pal_total_product' => $pal_total_product,
							'weight1'  => $wh_weight1 ,
							'vintage'  => $wh_vintage,
							'weight'   => $this->weight->format( $wh_weight1, $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'))
						);
					}
					$admin_comment =  nl2br( $this->model_sale_vdi_order->getComment( $order_id ) );
					$total_pallet = $this->model_sale_vdi_order->getOrderPalletTotal( $order_id );
					$total_product = $this->model_sale_vdi_order->getOrderProductTotal( $order_id );

if(!isset($comment)) { $comment = ''; }
					$data['orders'][] = array(
						'order_id'	         => $order_id,
						'invoice_no'         => $invoice_no,
						'date_added'         => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
						'store_name'         => $order_info['store_name'],
						'store_url'          => rtrim($order_info['store_url'], '/'),
						'store_address'      => nl2br($store_address),
						'store_email'        => $store_email,
						'store_telephone'    => $store_telephone,
						'store_fax'          => $store_fax,
						'email'              => $order_info['email'],
						'telephone'          => $order_info['telephone'],
						'shipping_address'   => $shipping_address,
						'shipping_method'    => $order_info['shipping_method'],
						'product'            => $product_data,
						'wh_product'         => $wh_product_data,
						'comment'            => nl2br($comment),
						'vendor_id'          => $vendor_id,
						'wh_telephone'      => $wh_info['telephone'],
						'wh_email'          => $wh_info['email'],
						'total_quantity'   => $total_quantity,
						'total_weight'      => $this->weight->format( $total_weight , $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point')),
						'admin_comment'     => $admin_comment,
						'total_pallet'      => $total_pallet,
						'total_product'     => $total_product,
						'company'           => $company,
						'carrier'           => ($order_info['carrier'] ? $order_info['carrier'] : ""),
						'tracking_no'       => ($order_info['tracking_no'] ? $order_info['tracking_no'] : "")

					);

					//GV
					/*$data['vendor_id'] = $vendor_id;
					$data['store_email1'] = $this->config->get('config_email');
					$data['store_telephone1'] = $this->config->get('config_telephone');
					$data['store_fax1'] = $this->config->get('config_fax');
					$data['wh_telephone'] = $wh_info['telephone'];
					$data['wh_email'] = $wh_info['email'];

					$data['total_quantity'] = $total_quantity;
					$data['total_weight'] = $this->weight->format( $total_weight , $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'));*/

				 } //end if
			} //vendors
		} //Orders

		$this->response->setOutput($this->load->view('sale/order_shipping.tpl', $data));
	}

	public function api() {
		$this->load->language('sale/order');

		if ($this->validate()) {
			// Store
			if (isset($this->request->get['store_id'])) {
				$store_id = $this->request->get['store_id'];
			} else {
				$store_id = 0;
			}

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($store_id);

			if ($store_info) {
				$url = $store_info['ssl'];
			} else {
				$url = HTTPS_CATALOG;
			}

			if (isset($this->session->data['cookie']) && isset($this->request->get['api'])) {
				// Include any URL perameters
				$url_data = array();

				foreach($this->request->get as $key => $value) {
					if ($key != 'route' && $key != 'token' && $key != 'store_id') {
						$url_data[$key] = $value;
					}
				}

				$curl = curl_init();

				// Set SSL if required
				if (substr($url, 0, 5) == 'https') {
					curl_setopt($curl, CURLOPT_PORT, 443);
				}

				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLINFO_HEADER_OUT, true);
				curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_URL, $url . 'index.php?route=' . $this->request->get['api'] . ($url_data ? '&' . http_build_query($url_data) : ''));

				if ($this->request->post) {
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->request->post));
				}

				curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

				$json = curl_exec($curl);

				curl_close($curl);

				if($json['success']){
					if(isset($this->request->post['order_status_id'])){
						if($this->request->post['order_status_id'] == 20){
							$this->getorderdata($this->request->post['order_status_id'],$order_id);
include 'controller/bar/switch.php';
					
							$this->load->model('sale/order');
							$this->model_sale_order->update_email_review($this->request->get['order_id']);
						}
						if($this->request->post['order_status_id'] == 2 && $this->request->post['send_po'] == 1){
							$status=$this->request->post['order_status_id'];
							$this->sendsmsemail($status,$this->request->get['order_id'],'firstsms');
						}
					}
				}

			} else {
				$response = array();
				$response['error'] = 'Data missing, contact website administrator.';

				$json = json_encode($response);
			}
		} else {
			$response = array();
			$response['error'] = $this->error;
			unset($this->error);

			$json = json_encode($response);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput($json);
	}

	public function logger($message) {
			$log = new Log('sms.log');
			$log->write($message);
	}

	public function sendSms($mobile_no, $message) {

			$this->load->model('setting/setting');
			$sms_settings = $this->model_setting_setting->getSetting('config');

			if(!$sms_settings['config_sms_enable'])
					return;

			try {
					$wsdl = "http://api.clickatell.com/soap/document_literal/webservice.php?wsdl";
					$client = new SoapClient($wsdl);
					$params = array('api_id' => $sms_settings['config_sms_api_id'],
									'user' => $sms_settings['config_sms_api_username'],
									'password' => $sms_settings['config_sms_api_password'],
									'to' => array($mobile_no),
									'text' => $message);

					$response = $client->sendmsg($params);
					$this->logger('SEND_SMS :: VENDOR RESPONSE : ' . json_encode($response));
			} catch (Exception $e) {
					$this->logger('SEND_SMS :: VENDOR ERROR : ' . $e->getMessage());
			}
	}
	public function sendsmsemail($order_status_id,$order_id,$send_po){
include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');
		$this->load->language('catalog/rating_vendor');
		$order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);

		$order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		foreach ($order_product_query->rows as $order_product) {
				  $vmail = $this->db->query("SELECT pd.name AS name, p.model AS model, p.sku AS sku, vs.email AS email, vs.vendor_id AS vendor_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "vendor v ON (pd.product_id = v.vproduct_id) LEFT JOIN " . DB_PREFIX . "vendors vs ON (v.vendor = vs.vendor_id) WHERE p.product_id = '" . (int)$order_product['product_id'] . "'");

					$vendor_list[] = array ('vendor_id' => $vmail->row['vendor_id']);

		}
		$vendor_unique = array_map("unserialize", array_unique(array_map("serialize", $vendor_list)));
		foreach ($vendor_unique as $vendor) {
			if ($vendor['vendor_id']) {
				$data = array();
				$vemail = $this->db->query("SELECT *, CONCAT(firstname,' ',lastname) AS contact_name FROM `" . DB_PREFIX . "vendors` WHERE vendor_id = '" . (int)$vendor['vendor_id'] . "'");
				$cust_order_status_query = $this->db->query("SELECT name FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'");
				$language = new Language($order_info['language_directory']);
				$language->load('mail/vendor_email');
				$message ='';


				if($send_po == 'firstsms'){
					$subject = sprintf($language->get('text_new_subject'), $order_info['store_name'], $order_id);
					$this->load->model('setting/setting');
					$sms_settings = $this->model_setting_setting->getSetting('config');
					$message = $sms_settings['config_sms_new_order_message'];
					$message = str_replace("{vendor_name}", $vemail->row['contact_name'], $message);
					$message = str_replace("{order_id}", $order_id, $message);
					$message = str_replace("{order_date}", date('F j\, Y'), $message);
					$message = str_replace("{order_status}", $cust_order_status_query->row['name'], $message);
					$this->sendSms($vemail->row['telephone'], $message);
				}
				if($send_po == 'firstsms' || $send_po == 'secondsms'){
					$mail = new Mail();
					$mail->protocol = $this->config->get('config_mail_protocol');
					$mail->parameter = $this->config->get('config_mail_parameter');
					$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
					$mail->smtp_username = $this->config->get('config_mail_smtp_username');
					$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
					$mail->smtp_port = $this->config->get('config_mail_smtp_port');
					$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
					$subject='sms '.$order_status_id. ' PO:'.$send_po;
					$text = $vendor['vendor_id'].' Name:'.$vemail->row['contact_name'].'<br> Order Status '.$cust_order_status_query->row['name'].' <br>Tel: '.$vemail->row['telephone'].' : '.$message;
					$mail->setTo('admin@thinkwinetrade.com');
					$mail->setFrom($this->config->get('config_email'));
					$mail->setSender($this->config->get('config_email'));
					$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
					$mail->setHtml(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
					$mail->send();
				}

			}
		}
	}
	public function getorderdata($order_status_id,$order_id){

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');
		$this->load->language('catalog/rating_vendor');
		$order_info = $this->model_sale_order->getOrder($this->request->get['order_id']);
		if($order_info['email_review'] == 0){
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$subject=$this->language->get('email_header_text_order')." ".$order_info['order_id']." ".$this->language->get('email_header_text_complete');
			$text = $this->language->get('email_text_dear')." ".$order_info['firstname'].' '.$order_info['lastname']."
<br><br>".
$this->language->get('email_text_order_complete')."
<br><br>
".$this->language->get('email_text_your_order')." ".$order_info['order_id']." ".$this->language->get('email_text_section');
			$mail->setTo($order_info['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender($this->config->get('config_email'));
			$mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
			$mail->setHtml(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
			if($mail->send()){
				$this->model_sale_order->update_email_review($order_info['order_id']);
			}
		}
	}

	public function confirmProductReceived() {
		$json = array();

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		if (isset($this->request->get['order_id']) && isset($this->request->get['product_id']) && isset($this->request->get['pallet_id'])) {
			$this->model_sale_order->confirmProductReceived($this->request->get['order_id'], $this->request->get['product_id'], $this->request->get['pallet_id']);
			$json['success'] = "OK.";
		} else {
			$json['error'] = "Something failed.";
		}

                //////////////////////////////// Send mail notification ///////////////////////////
                $verified_product=1;
                $products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);
                    if(count($products)>0)
                    {
                        foreach ($products as $prod) {
                            if($prod["product_received"]==0 || $prod["documents_received"]==0)
                                $verified_product=0;
                        }
                    }

                if($verified_product==1){
                    $this->load->language('sale/order');

		if ($this->validate()) {
			// Store
			if (isset($this->request->get['store_id'])) {
				$store_id = $this->request->get['store_id'];
			} else {
				$store_id = 0;
			}

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($store_id);

			if ($store_info) {
				$url = $store_info['ssl'];
			} else {
				$url = HTTPS_CATALOG;
			}

			if (isset($this->session->data['cookie']) ) {
				// Include any URL perameters
				$url_data = array();

				foreach($this->request->get as $key => $value) {
					if ($key != 'route' && $key != 'token' && $key != 'store_id') {
						$url_data[$key] = $value;
					}
				}

				$curl = curl_init();

				// Set SSL if required
				if (substr($url, 0, 5) == 'https') {
					curl_setopt($curl, CURLOPT_PORT, 443);
				}

				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLINFO_HEADER_OUT, true);
				curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                $url=$url . 'index.php?route=' . "api/order/history" . ($url_data ? '&' . http_build_query($url_data) : '');

				curl_setopt($curl, CURLOPT_URL, $url);
                                $post=$this->request->get;
                                $post['send_reception_product']=1;

				if ($post) {
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
				}

				curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

				$json1 = curl_exec($curl);
                                curl_close($curl);
			} else {
				$response = array();
				$response['error'] = 'Data missing, contact website administrator.';

				$json1 = json_encode($response);
			}
		} else {
			$response = array();
			$response['error'] = $this->error;
			unset($this->error);

			$json1 = json_encode($response);
		}

		}
                //////////////////////////////// End Send mail notification ///////////////////////////


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


	//GV
	public function updateContainerID() {
		$json = array();

		$this->load->model('sale/order');

		if (isset($this->request->get['order_id']) && isset($this->request->get['cont_id']) ) {
		    $this->db->query("UPDATE `" . DB_PREFIX . "order` SET container_id = '" . $this->request->get['cont_id'] . "' WHERE order_id = '" . $this->request->get['order_id'] . "'");
			$json['success'] = "OK.";
		} else {
			$json['error'] = "Something failed.";
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	public function updateShipmentID() {
		$json = array();

		$this->load->model('sale/order');

		if (isset($this->request->get['order_id']) && isset($this->request->get['ship_id']) ) {
		    $this->db->query("UPDATE `" . DB_PREFIX . "order` SET shipment_id = '" . $this->request->get['ship_id'] . "' WHERE order_id = '" . $this->request->get['order_id'] . "'");
			$json['success'] = "OK.";
		} else {
			$json['error'] = "Something failed.";
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	//END

	public function packing() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_packing');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');
			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_invoice_no_comm'] = $this->language->get('text_invoice_no_comm');
			$data['text_shipmentid'] = $this->language->get('text_shipmentid');
			$data['text_containerid'] = $this->language->get('text_containerid');
			$data['text_product_name'] = $this->language->get('text_product_name');
			$data['text_pallet_id'] = $this->language->get('text_pallet_id');
			$data['text_product_no'] = $this->language->get('text_product_no');
			$data['text_case_qty']  = $this->language->get('text_case_qty');
			$data['text_case_fmt']  = $this->language->get('text_case_fmt');
			$data['text_bottles']    = $this->language->get('text_bottles');
			$data['text_unit_price'] = $this->language->get('text_unit_price');
			$data['text_payment_date'] = $this->language->get('text_payment_date');
			$data['text_commercial_inv'] = $this->language->get('text_commercial_inv');
			$data['text_total_volume'] = $this->language->get('text_total_volume');
			$data['text_order_total_pallet'] = $this->language->get('text_order_total_pallet');
			$data['text_total_weight'] = $this->language->get('text_total_weight');
			$data['text_vol_pallet'] = $this->language->get('text_vol_pallet');

		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_ship_to'] = $this->language->get('text_ship_to');
		$data['text_super_total'] = $this->language->get('text_super_total');
		$data['text_order_total'] = $this->language->get('text_order_total');
		$data['text_total_pallet'] = $this->language->get('text_total_pallet');
		$data['text_total_volume'] = $this->language->get('text_total_volume');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_order_date'] = $this->language->get('column_order_date');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_head_store']  = $this->language->get('column_head_store');
		$data['column_head_wh']     = $this->language->get('column_head_wh');
		$data['column_head_agent']  = $this->language->get('column_head_agent');

		include 'controller/bar/switch.php';
		
		$this->load->model('sale/order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		$store_info = $this->model_setting_setting->getSetting('config', 0 );

		if ($store_info) {
			$store_address = $store_info['config_address'];
			$store_email = $store_info['config_email'];
			$store_telephone = $store_info['config_telephone'];
			$store_fax = $store_info['config_fax'];
			$comment = $store_info['config_comment'];
		} else {
			$store_address = $this->config->get('config_address');
			$store_email = $this->config->get('config_email');
			$store_telephone = $this->config->get('config_telephone');
			$store_fax = $this->config->get('config_fax');
			$comment = $this->config->get('config_comment');
		}
		$store_name = $this->config->get('config_name');
		$data['store_name']         = $store_name;
		$data['store_address']      = nl2br($store_address);
		$data['store_email']        = $store_email;
		$data['store_telephone']    = $store_telephone;
		$data['store_fax']          = $store_fax;
		$data['store_url']          = rtrim(HTTP_CATALOG, '/');
		
		$this->load->model('sale/vdi_order');
		$wh_info = $this->model_sale_vdi_order->getWarehouseAddress();
		$format = '{firstname} {lastname}' .  "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

		$find = array(
			'{firstname}',
			'{lastname}',
			'{address_1}',
			'{address_2}',
			'{city}',
			'{postcode}',
			'{zone}',
			//'{zone_code}',
			'{country}'
		);

		$replace = array(
			'firstname' => '',//$wh_info['shipping_firstname'],
			'lastname'  => '',//$wh_info['shipping_lastname'],
			'address_1' => $wh_info['address_1'],
			'address_2' => $wh_info['address_2'],
			'city'      => $wh_info['city'],
			'postcode'  => $wh_info['postcode'],
			'zone'      => '',
			//'zone_code' => $wh_info['zone_code'],
			'country'   => $wh_info['country']
		);

				$wh_address_fr = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['wh_address_fr'] = $wh_address_fr;
				$data['wh_company']   = $wh_info['company'];
				$data['wh_telephone'] = $wh_info['telephone'];
				$data['wh_fax'] = $wh_info['fax'];
				$data['wh_email'] = $wh_info['email'];
				
		//Get HK WH address
		$wh_info_hk = $this->model_sale_vdi_order->getWarehouseAddressHK();
		$replace = array(
			'address_1' => $wh_info_hk['address_1'],
			'address_2' => $wh_info_hk['address_2'],
			'city'      => $wh_info_hk['city'],
			'postcode'  => $wh_info_hk['postcode'],
			'zone'      => '',
			'country'   => $wh_info_hk['country']
		);
		$wh_address_hk = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
		$data['wh_address_hk'] = $wh_address_hk;
		$data['wh_company_hk']   = $wh_info_hk['company'];
		$data['wh_telephone_hk'] = $wh_info_hk['telephone'];
		$data['wh_fax_hk'] = $wh_info_hk['fax'];
		$data['wh_email_hk'] = $wh_info_hk['email'];
		
		$product_data = array();
		$total_quantity = 0;
		$bottle_grand_total = 0;
		$weight_grand_total = 0.00;
		$eur_grand_total = 0.0000;
		$hkd_grand_total = 0.0000;
		$hkd_grand_order_total = 0.0;
		$eur_grand_order_total = 0.0;
		$total_pallet = 0;
		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}


				$this->load->model('tool/upload');


				$products = $this->model_sale_order->getOrderProducts($order_id);

				$eur_order_total =  $this->model_sale_order->getOrderCost( $order_id );
				$hkd_order_total =  ( $order_info['currency_code'] == 'HKD' ? $this->currency->format( $eur_order_total, 'HKD', $order_info['currency_value'] ) : $this->currency->format( $eur_order_total, 'HKD' ) );
				$eur_grand_order_total += $eur_order_total;
				$hkd_grand_order_total += ( $order_info['currency_code'] == 'HKD' ?  ( $eur_order_total * $order_info['currency_value'] ) : ( $eur_order_total * $this->currency->getValue('HKD') ) );
				
				$total_pallet +=  $this->model_sale_order->getTotalPallet( $order_id );
				
				$product_count = count( $products );
				$i = 1;
				foreach ($products as $product) {

					$this->load->model('sale/vdi_order');
					$fob = $this->model_sale_vdi_order->getFobPrice( $product['product_id'] );
					$weight_info = array();
					$weight_info = $this->model_sale_order->getProductWeight( $product['product_id'] );
					$weight_info['weight'] = (float) $product['quantity'] *  $weight_info['weight'] ;
					if( $order_info['currency_code'] == 'HKD' ) {
						$hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
						$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
						$hkd_total = $this->currency->format(  ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code']);
						$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR', 1.000000 );
						$hkd_grand_total +=  (float)( $product['price'] * $product['quantity'] * $order_info['currency_value'] );
					} else {
						$hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'HKD' );
						$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
						$hkd_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'HKD' );
						$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR' );
						$hkd_grand_total += (float) ( $product['price'] * $product['quantity']  * $this->currency->getValue('HKD') );

					}

					$total_quantity += $product['quantity'];
					$bottle_grand_total += ( $fob['pf'] * $product['quantity'] );
					$weight_grand_total +=  $weight_info['weight'] ;
					
					$eur_grand_total += ( $product['price'] * $product['quantity'] );
					
					$product_data[] = array(
						'order_id'	=> $order_id,
						'date_added'  => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
						'name'     => $product['name'],
						'product_no'   => $product['product_no'],
						'pallet_no'    => $product['pallet_no'],
						'product_format' => $fob['pf'],
						'total_bottles'  => ( $fob['pf'] * $product['quantity'] ),
						'eur_price'      => $eur_price,
						'hkd_price'      => $hkd_price,
						'hkd_total'      => $hkd_total,
						'eur_total'      => $eur_total,
						'eur_order_total' => ( $i == $product_count ? $this->currency->format( $eur_order_total, 'EUR' ) : '' ),
						'hkd_order_total' => ( $i == $product_count ? $hkd_order_total : '' ),
						'weight'   => $weight_info['weight'] . " " . $weight_info['unit'],
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
					);
					$i++;
				}
			}
		}
		
if(!isset($comment)) { $comment = ''; }
		$data['orders'][] = array(
				'product'            => $product_data,
				'total_quantity'     => $total_quantity,
				'container_id' => $order_info['container_id'],
				'shipment_id' => $order_info['shipment_id'],
				'bottle_grand_total' => $bottle_grand_total,
				'weight_grand_total' => $weight_grand_total . " " . $weight_info['unit'],
				'eur_grand_total' => $this->currency->format($eur_grand_total , 'EUR' ),
				'hkd_grand_total' => $this->currency->format($eur_grand_total, 'HKD' ),
				'eur_grand_order_total' => $this->currency->format( $eur_grand_order_total, 'EUR' ),
				'hkd_grand_order_total' => $this->currency->format( $hkd_grand_order_total, 'HKD', 1.0 ),
				'total_pallet'          => $total_pallet,
				'total_volume'         => ( $total_quantity * 0.245 * 0.305 * 0.2 )
		);
		$this->response->setOutput($this->load->view('sale/container_packing.tpl', $data));
			
	}
	public function packinglistpdf() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_packing');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');
			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_invoice_no_comm'] = $this->language->get('text_invoice_no_comm');
			$data['text_shipmentid'] = $this->language->get('text_shipmentid');
			$data['text_containerid'] = $this->language->get('text_containerid');
			$data['text_product_name'] = $this->language->get('text_product_name');
			$data['text_pallet_id'] = $this->language->get('text_pallet_id');
			$data['text_product_no'] = $this->language->get('text_product_no');
			$data['text_case_qty']  = $this->language->get('text_case_qty');
			$data['text_case_fmt']  = $this->language->get('text_case_fmt');
			$data['text_bottles']    = $this->language->get('text_bottles');
			$data['text_unit_price'] = $this->language->get('text_unit_price');
			$data['text_payment_date'] = $this->language->get('text_payment_date');
			$data['text_commercial_inv'] = $this->language->get('text_commercial_inv');
			$data['text_total_volume'] = $this->language->get('text_total_volume');
			$data['text_order_total_pallet'] = $this->language->get('text_order_total_pallet');
			$data['text_total_weight'] = $this->language->get('text_total_weight');
			$data['text_vol_pallet'] = $this->language->get('text_vol_pallet');

		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_ship_to'] = $this->language->get('text_ship_to');
		$data['text_super_total'] = $this->language->get('text_super_total');
		$data['text_order_total'] = $this->language->get('text_order_total');
		$data['text_total_pallet'] = $this->language->get('text_total_pallet');
		$data['text_total_volume'] = $this->language->get('text_total_volume');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_order_date'] = $this->language->get('column_order_date');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_head_store']  = $this->language->get('column_head_store');
		$data['column_head_wh']     = $this->language->get('column_head_wh');
		$data['column_head_agent']  = $this->language->get('column_head_agent');

		include 'controller/bar/switch.php';
		
		$this->load->model('sale/order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		$store_info = $this->model_setting_setting->getSetting('config', 0 );

		if ($store_info) {
			$store_address = $store_info['config_address'];
			$store_email = $store_info['config_email'];
			$store_telephone = $store_info['config_telephone'];
			$store_fax = $store_info['config_fax'];
			$comment = $store_info['config_comment'];
		} else {
			$store_address = $this->config->get('config_address');
			$store_email = $this->config->get('config_email');
			$store_telephone = $this->config->get('config_telephone');
			$store_fax = $this->config->get('config_fax');
			$comment = $this->config->get('config_comment');
		}
		$store_name = $this->config->get('config_name');
		$data['store_name']         = $store_name;
		$data['store_address']      = nl2br($store_address);
		$data['store_email']        = $store_email;
		$data['store_telephone']    = $store_telephone;
		$data['store_fax']          = $store_fax;
		$data['store_url']          = rtrim(HTTP_CATALOG, '/');
		
		$this->load->model('sale/vdi_order');
		$wh_info = $this->model_sale_vdi_order->getWarehouseAddress();
		$format = '{firstname} {lastname}' .  "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

		$find = array(
			'{firstname}',
			'{lastname}',
			'{address_1}',
			'{address_2}',
			'{city}',
			'{postcode}',
			'{zone}',
			//'{zone_code}',
			'{country}'
		);

		$replace = array(
			'firstname' => '',//$wh_info['shipping_firstname'],
			'lastname'  => '',//$wh_info['shipping_lastname'],
			'address_1' => $wh_info['address_1'],
			'address_2' => $wh_info['address_2'],
			'city'      => $wh_info['city'],
			'postcode'  => $wh_info['postcode'],
			'zone'      => '',
			//'zone_code' => $wh_info['zone_code'],
			'country'   => $wh_info['country']
		);

				$wh_address_fr = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['wh_address_fr'] = $wh_address_fr;
				$data['wh_company']   = $wh_info['company'];
				$data['wh_telephone'] = $wh_info['telephone'];
				$data['wh_fax'] = $wh_info['fax'];
				$data['wh_email'] = $wh_info['email'];
				
		//Get HK WH address
		$wh_info_hk = $this->model_sale_vdi_order->getWarehouseAddressHK();
		$replace = array(
			'address_1' => $wh_info_hk['address_1'],
			'address_2' => $wh_info_hk['address_2'],
			'city'      => $wh_info_hk['city'],
			'postcode'  => $wh_info_hk['postcode'],
			'zone'      => '',
			'country'   => $wh_info_hk['country']
		);
		$wh_address_hk = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
		$data['wh_address_hk'] = $wh_address_hk;
		$data['wh_company_hk']   = $wh_info_hk['company'];
		$data['wh_telephone_hk'] = $wh_info_hk['telephone'];
		$data['wh_fax_hk'] = $wh_info_hk['fax'];
		$data['wh_email_hk'] = $wh_info_hk['email'];
		
		$product_data = array();
		$total_quantity = 0;
		$bottle_grand_total = 0;
		$weight_grand_total = 0.00;
		$eur_grand_total = 0.0000;
		$hkd_grand_total = 0.0000;
		$hkd_grand_order_total = 0.0;
		$eur_grand_order_total = 0.0;
		$total_pallet = 0;
		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}


				$this->load->model('tool/upload');


				$products = $this->model_sale_order->getOrderProducts($order_id);

				$eur_order_total =  $this->model_sale_order->getOrderCost( $order_id );
				$hkd_order_total =  ( $order_info['currency_code'] == 'HKD' ? $this->currency->format( $eur_order_total, 'HKD', $order_info['currency_value'] ) : $this->currency->format( $eur_order_total, 'HKD' ) );
				$eur_grand_order_total += $eur_order_total;
				$hkd_grand_order_total += ( $order_info['currency_code'] == 'HKD' ?  ( $eur_order_total * $order_info['currency_value'] ) : ( $eur_order_total * $this->currency->getValue('HKD') ) );
				
				$total_pallet +=  $this->model_sale_order->getTotalPallet( $order_id );
				
				$product_count = count( $products );
				$i = 1;
				foreach ($products as $product) {

					$this->load->model('sale/vdi_order');
					$fob = $this->model_sale_vdi_order->getFobPrice( $product['product_id'] );
					$weight_info = array();
					$weight_info = $this->model_sale_order->getProductWeight( $product['product_id'] );
					$weight_info['weight'] = (float) $product['quantity'] *  $weight_info['weight'] ;
					if( $order_info['currency_code'] == 'HKD' ) {
						$hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
						$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
						$hkd_total = $this->currency->format(  ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code']);
						$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR', 1.000000 );
						$hkd_grand_total +=  (float)( $product['price'] * $product['quantity'] * $order_info['currency_value'] );
					} else {
						$hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'HKD' );
						$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
						$hkd_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'HKD' );
						$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR' );
						$hkd_grand_total += (float) ( $product['price'] * $product['quantity']  * $this->currency->getValue('HKD') );

					}

					$total_quantity += $product['quantity'];
					$bottle_grand_total += ( $fob['pf'] * $product['quantity'] );
					$weight_grand_total +=  $weight_info['weight'] ;
					
					$eur_grand_total += ( $product['price'] * $product['quantity'] );
					
					$product_data[] = array(
						'order_id'	=> $order_id,
						'date_added'  => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
						'name'     => $product['name'],
						'product_no'   => $product['product_no'],
						'pallet_no'    => $product['pallet_no'],
						'product_format' => $fob['pf'],
						'total_bottles'  => ( $fob['pf'] * $product['quantity'] ),
						'eur_price'      => $eur_price,
						'hkd_price'      => $hkd_price,
						'hkd_total'      => $hkd_total,
						'eur_total'      => $eur_total,
						'eur_order_total' => ( $i == $product_count ? $this->currency->format( $eur_order_total, 'EUR' ) : '' ),
						'hkd_order_total' => ( $i == $product_count ? $hkd_order_total : '' ),
						'weight'   => $weight_info['weight'] . " " . $weight_info['unit'],
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
					);
					$i++;
				}
			}
		}
		
if(!isset($comment)) { $comment = ''; }
		$data['orders'][] = array(
				'product'            => $product_data,
				'total_quantity'     => $total_quantity,
				'container_id' => $order_info['container_id'],
				'shipment_id' => $order_info['shipment_id'],
				'bottle_grand_total' => $bottle_grand_total,
				'weight_grand_total' => $weight_grand_total . " " . $weight_info['unit'],
				'eur_grand_total' => $this->currency->format($eur_grand_total , 'EUR' ),
				'hkd_grand_total' => $this->currency->format($eur_grand_total, 'HKD' ),
				'eur_grand_order_total' => $this->currency->format( $eur_grand_order_total, 'EUR' ),
				'hkd_grand_order_total' => $this->currency->format( $hkd_grand_order_total, 'HKD', 1.0 ),
				'total_pallet'          => $total_pallet,
				'total_volume'         => ( $total_quantity * 0.245 * 0.305 * 0.2 )
		);
		$this->response->setOutput($this->load->view('sale/container_packing_pdf.tpl', $data));
			
	}
	
	public function packinglistxls() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_packing');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');
			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_invoice_no_comm'] = $this->language->get('text_invoice_no_comm');
			$data['text_shipmentid'] = $this->language->get('text_shipmentid');
			$data['text_containerid'] = $this->language->get('text_containerid');
			$data['text_product_name'] = $this->language->get('text_product_name');
			$data['text_pallet_id'] = $this->language->get('text_pallet_id');
			$data['text_product_no'] = $this->language->get('text_product_no');
			$data['text_case_qty']  = $this->language->get('text_case_qty');
			$data['text_case_fmt']  = $this->language->get('text_case_fmt');
			$data['text_bottles']    = $this->language->get('text_bottles');
			$data['text_unit_price'] = $this->language->get('text_unit_price');
			$data['text_payment_date'] = $this->language->get('text_payment_date');
			$data['text_commercial_inv'] = $this->language->get('text_commercial_inv');
			$data['text_total_volume'] = $this->language->get('text_total_volume');
			$data['text_order_total_pallet'] = $this->language->get('text_order_total_pallet');
			$data['text_total_weight'] = $this->language->get('text_total_weight');
			$data['text_vol_pallet'] = $this->language->get('text_vol_pallet');

		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_ship_to'] = $this->language->get('text_ship_to');
		$data['text_super_total'] = $this->language->get('text_super_total');
		$data['text_order_total'] = $this->language->get('text_order_total');
		$data['text_total_pallet'] = $this->language->get('text_total_pallet');
		$data['text_total_volume'] = $this->language->get('text_total_volume');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_order_date'] = $this->language->get('column_order_date');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_head_store']  = $this->language->get('column_head_store');
		$data['column_head_wh']     = $this->language->get('column_head_wh');
		$data['column_head_agent']  = $this->language->get('column_head_agent');

		include 'controller/bar/switch.php';
		
		$this->load->model('sale/order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		$store_info = $this->model_setting_setting->getSetting('config', 0 );

		if ($store_info) {
			$store_address = $store_info['config_address'];
			$store_email = $store_info['config_email'];
			$store_telephone = $store_info['config_telephone'];
			$store_fax = $store_info['config_fax'];
			$comment = $store_info['config_comment'];
		} else {
			$store_address = $this->config->get('config_address');
			$store_email = $this->config->get('config_email');
			$store_telephone = $this->config->get('config_telephone');
			$store_fax = $this->config->get('config_fax');
			$comment = $this->config->get('config_comment');
		}
		$store_name = $this->config->get('config_name');
		$data['store_name']         = $store_name;
		$data['store_address']      = nl2br($store_address);
		$data['store_email']        = $store_email;
		$data['store_telephone']    = $store_telephone;
		$data['store_fax']          = $store_fax;
		$data['store_url']          = rtrim(HTTP_CATALOG, '/');
		
		$this->load->model('sale/vdi_order');
		$wh_info = $this->model_sale_vdi_order->getWarehouseAddress();
		$format = '{firstname} {lastname}' .  "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

		$find = array(
			'{firstname}',
			'{lastname}',
			'{address_1}',
			'{address_2}',
			'{city}',
			'{postcode}',
			'{zone}',
			//'{zone_code}',
			'{country}'
		);

		$replace = array(
			'firstname' => '',//$wh_info['shipping_firstname'],
			'lastname'  => '',//$wh_info['shipping_lastname'],
			'address_1' => $wh_info['address_1'],
			'address_2' => $wh_info['address_2'],
			'city'      => $wh_info['city'],
			'postcode'  => $wh_info['postcode'],
			'zone'      => '',
			//'zone_code' => $wh_info['zone_code'],
			'country'   => $wh_info['country']
		);

				$wh_address_fr = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['wh_address_fr'] = $wh_address_fr;
				$data['wh_company']   = $wh_info['company'];
				$data['wh_telephone'] = $wh_info['telephone'];
				$data['wh_fax'] = $wh_info['fax'];
				$data['wh_email'] = $wh_info['email'];
				
		//Get HK WH address
		$wh_info_hk = $this->model_sale_vdi_order->getWarehouseAddressHK();
		$replace = array(
			'address_1' => $wh_info_hk['address_1'],
			'address_2' => $wh_info_hk['address_2'],
			'city'      => $wh_info_hk['city'],
			'postcode'  => $wh_info_hk['postcode'],
			'zone'      => '',
			'country'   => $wh_info_hk['country']
		);
		$wh_address_hk = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
		$data['wh_address_hk'] = $wh_address_hk;
		$data['wh_company_hk']   = $wh_info_hk['company'];
		$data['wh_telephone_hk'] = $wh_info_hk['telephone'];
		$data['wh_fax_hk'] = $wh_info_hk['fax'];
		$data['wh_email_hk'] = $wh_info_hk['email'];
		
		$product_data = array();
		$total_quantity = 0;
		$bottle_grand_total = 0;
		$weight_grand_total = 0.00;
		$eur_grand_total = 0.0000;
		$hkd_grand_total = 0.0000;
		$hkd_grand_order_total = 0.0;
		$eur_grand_order_total = 0.0;
		$total_pallet = 0;
		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}


				$this->load->model('tool/upload');


				$products = $this->model_sale_order->getOrderProducts($order_id);

				$eur_order_total =  $this->model_sale_order->getOrderCost( $order_id );
				$hkd_order_total =  ( $order_info['currency_code'] == 'HKD' ? $this->currency->format( $eur_order_total, 'HKD', $order_info['currency_value'] ) : $this->currency->format( $eur_order_total, 'HKD' ) );
				$eur_grand_order_total += $eur_order_total;
				$hkd_grand_order_total += ( $order_info['currency_code'] == 'HKD' ?  ( $eur_order_total * $order_info['currency_value'] ) : ( $eur_order_total * $this->currency->getValue('HKD') ) );
				
				$total_pallet +=  $this->model_sale_order->getTotalPallet( $order_id );
				
				$product_count = count( $products );
				$i = 1;
				foreach ($products as $product) {

					$this->load->model('sale/vdi_order');
					$fob = $this->model_sale_vdi_order->getFobPrice( $product['product_id'] );
					$weight_info = array();
					$weight_info = $this->model_sale_order->getProductWeight( $product['product_id'] );
					$weight_info['weight'] = (float) $product['quantity'] *  $weight_info['weight'] ;
					if( $order_info['currency_code'] == 'HKD' ) {
						$hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']);
						$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
						$hkd_total = $this->currency->format(  ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code']);
						$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR', 1.000000 );
						$hkd_grand_total +=  (float)( $product['price'] * $product['quantity'] * $order_info['currency_value'] );
					} else {
						$hkd_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'HKD' );
						$eur_price = $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), 'EUR' );
						$hkd_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'HKD' );
						$eur_total = $this->currency->format( ( $product['price'] * $product['quantity'] ) + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), 'EUR' );
						$hkd_grand_total += (float) ( $product['price'] * $product['quantity']  * $this->currency->getValue('HKD') );

					}

					$total_quantity += $product['quantity'];
					$bottle_grand_total += ( $fob['pf'] * $product['quantity'] );
					$weight_grand_total +=  $weight_info['weight'] ;
					
					$eur_grand_total += ( $product['price'] * $product['quantity'] );
					
					$product_data[] = array(
						'order_id'	=> $order_id,
						'date_added'  => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
						'name'     => $product['name'],
						'product_no'   => $product['product_no'],
						'pallet_no'    => $product['pallet_no'],
						'product_format' => $fob['pf'],
						'total_bottles'  => ( $fob['pf'] * $product['quantity'] ),
						'eur_price'      => $eur_price,
						'hkd_price'      => $hkd_price,
						'hkd_total'      => $hkd_total,
						'eur_total'      => $eur_total,
						'eur_order_total' => ( $i == $product_count ? $this->currency->format( $eur_order_total, 'EUR' ) : '' ),
						'hkd_order_total' => ( $i == $product_count ? $hkd_order_total : '' ),
						'weight'   => $weight_info['weight'] . " " . $weight_info['unit'],
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
					);
					$i++;
				}
			}
		}
		
if(!isset($comment)) { $comment = ''; }
		$data['orders'][] = array(
				'product'            => $product_data,
				'total_quantity'     => $total_quantity,
				'container_id' => $order_info['container_id'],
				'shipment_id' => $order_info['shipment_id'],
				'bottle_grand_total' => $bottle_grand_total,
				'weight_grand_total' => $weight_grand_total . " " . $weight_info['unit'],
				'eur_grand_total' => $this->currency->format($eur_grand_total , 'EUR' ),
				'hkd_grand_total' => $this->currency->format($eur_grand_total, 'HKD' ),
				'eur_grand_order_total' => $this->currency->format( $eur_grand_order_total, 'EUR' ),
				'hkd_grand_order_total' => $this->currency->format( $hkd_grand_order_total, 'HKD', 1.0 ),
				'total_pallet'          => $total_pallet,
				'total_volume'         => ( $total_quantity * 0.245 * 0.305 * 0.2 )
		);
		$this->response->setOutput($this->load->view('sale/container_packing_xls.tpl', $data));
			
	}
	
	public function variety_list() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_variety_list');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');

		$data['text_containerid'] = $this->language->get('text_containerid');
		$data['text_shipmentid'] = $this->language->get('text_shipmentid');
		$data['text_pallet_id'] = $this->language->get('text_pallet_id');
		$data['text_product_no'] = $this->language->get('text_product_no');
		$data['text_product_name'] = $this->language->get('text_product_name');
		
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_super_total'] = $this->language->get('text_super_total');
		$data['column_head_store']  = $this->language->get('column_head_store');
		$data['column_head_wh']     = $this->language->get('column_head_wh');
		$data['column_head_agent']  = $this->language->get('column_head_agent');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_order_date'] = $this->language->get('column_order_date');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_color']          = $this->language->get('column_color');
		$data['column_vintage']        = $this->language->get('column_vintage');
		$data['column_grape_variety']  = $this->language->get('column_grape_variety');
		$data['column_appellation']    = $this->language->get('column_appellation');
		$data['column_origins']      = $this->language->get('column_origins');

		include 'controller/bar/switch.php';
		
		$this->load->model('sale/order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		$store_info = $this->model_setting_setting->getSetting('config', 0 );

		if ($store_info) {
			$store_address = $store_info['config_address'];
			$store_email = $store_info['config_email'];
			$store_telephone = $store_info['config_telephone'];
			$store_fax = $store_info['config_fax'];
			$comment = $store_info['config_comment'];
		} else {
			$store_address = $this->config->get('config_address');
			$store_email = $this->config->get('config_email');
			$store_telephone = $this->config->get('config_telephone');
			$store_fax = $this->config->get('config_fax');
			$comment = $this->config->get('config_comment');
		}
		$store_name = $this->config->get('config_name');
		$data['store_name']         = $store_name;
		$data['store_address']      = nl2br($store_address);
		$data['store_email']        = $store_email;
		$data['store_telephone']    = $store_telephone;
		$data['store_fax']          = $store_fax;
		$data['store_url']          = rtrim(HTTP_CATALOG, '/');
		
		$this->load->model('sale/vdi_order');
		$wh_info = $this->model_sale_vdi_order->getWarehouseAddress();
		$format = '{firstname} {lastname}' .  "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

		$find = array(
			'{firstname}',
			'{lastname}',
			'{address_1}',
			'{address_2}',
			'{city}',
			'{postcode}',
			'{zone}',
			//'{zone_code}',
			'{country}'
		);

		$replace = array(
			'firstname' => '',//$wh_info['shipping_firstname'],
			'lastname'  => '',//$wh_info['shipping_lastname'],
			'address_1' => $wh_info['address_1'],
			'address_2' => $wh_info['address_2'],
			'city'      => $wh_info['city'],
			'postcode'  => $wh_info['postcode'],
			'zone'      => '',
			//'zone_code' => $wh_info['zone_code'],
			'country'   => $wh_info['country']
		);

				$wh_address_fr = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['wh_address_fr'] = $wh_address_fr;
				$data['wh_company']   = $wh_info['company'];
				$data['wh_telephone'] = $wh_info['telephone'];
				$data['wh_fax'] = $wh_info['fax'];
				$data['wh_email'] = $wh_info['email'];
				
		//Get HK WH address
		$wh_info_hk = $this->model_sale_vdi_order->getWarehouseAddressHK();
		$replace = array(
			'address_1' => $wh_info_hk['address_1'],
			'address_2' => $wh_info_hk['address_2'],
			'city'      => $wh_info_hk['city'],
			'postcode'  => $wh_info_hk['postcode'],
			'zone'      => '',
			'country'   => $wh_info_hk['country']
		);
		$wh_address_hk = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
		$data['wh_address_hk'] = $wh_address_hk;
		$data['wh_company_hk']   = $wh_info_hk['company'];
		$data['wh_telephone_hk'] = $wh_info_hk['telephone'];
		$data['wh_fax_hk'] = $wh_info_hk['fax'];
		$data['wh_email_hk'] = $wh_info_hk['email'];
		
		$product_data = array();
		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {

				$products = $this->model_sale_order->getOrderProducts($order_id);

				foreach ($products as $product) {

					$vintage = $this->model_sale_order->getVariety( $product['product_id'], 13 );
					$color = $this->model_sale_order->getVariety( $product['product_id'], 14 );
					$grape_variety = $this->model_sale_order->getVariety( $product['product_id'], 15 );
					$appellation = $this->model_sale_order->getVariety( $product['product_id'], 25 );
					$origins = $this->model_sale_order->getOrigins( $product['vendor_id'] );
					
					$product_data[] = array(
						'order_id'	=> $order_id,
						'date_added'  => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
						'name'     => $product['name'],
						'product_no'   => $product['product_no'],
						'pallet_no'    => $product['pallet_no'],
						'vintage' => $vintage,
						'color'   => $color,
						'grape_variety' => $grape_variety,
						'appellation'   => $appellation,
						'origins'     => $origins
					);
				}

			}
		}
if(!isset($comment)) { $comment = ''; }
		$data['orders'][] = array(
				'product'            => $product_data,
				'container_id' => $order_info['container_id'],
				'shipment_id' => $order_info['shipment_id']
		);
		$this->response->setOutput($this->load->view('sale/order_variety_list.tpl', $data));
			
	}
	
	public function appendixpdf() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_variety_list');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');

		$data['text_containerid'] = $this->language->get('text_containerid');
		$data['text_shipmentid'] = $this->language->get('text_shipmentid');
		$data['text_pallet_id'] = $this->language->get('text_pallet_id');
		$data['text_product_no'] = $this->language->get('text_product_no');
		$data['text_product_name'] = $this->language->get('text_product_name');
		
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_super_total'] = $this->language->get('text_super_total');
		$data['column_head_store']  = $this->language->get('column_head_store');
		$data['column_head_wh']     = $this->language->get('column_head_wh');
		$data['column_head_agent']  = $this->language->get('column_head_agent');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_order_date'] = $this->language->get('column_order_date');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_color']          = $this->language->get('column_color');
		$data['column_vintage']        = $this->language->get('column_vintage');
		$data['column_grape_variety']  = $this->language->get('column_grape_variety');
		$data['column_alchogol_volume']    = $this->language->get('column_alchogol_volume');
		$data['column_appellation']    = $this->language->get('column_appellation');
		$data['column_origins']      = $this->language->get('column_origins');

		include 'controller/bar/switch.php';
		
		$this->load->model('sale/order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		$store_info = $this->model_setting_setting->getSetting('config', 0 );

		if ($store_info) {
			$store_address = $store_info['config_address'];
			$store_email = $store_info['config_email'];
			$store_telephone = $store_info['config_telephone'];
			$store_fax = $store_info['config_fax'];
			$comment = $store_info['config_comment'];
		} else {
			$store_address = $this->config->get('config_address');
			$store_email = $this->config->get('config_email');
			$store_telephone = $this->config->get('config_telephone');
			$store_fax = $this->config->get('config_fax');
			$comment = $this->config->get('config_comment');
		}
		$store_name = $this->config->get('config_name');
		$data['store_name']         = $store_name;
		$data['store_address']      = nl2br($store_address);
		$data['store_email']        = $store_email;
		$data['store_telephone']    = $store_telephone;
		$data['store_fax']          = $store_fax;
		$data['store_url']          = rtrim(HTTP_CATALOG, '/');
		
		$this->load->model('sale/vdi_order');
		$wh_info = $this->model_sale_vdi_order->getWarehouseAddress();
		$format = '{firstname} {lastname}' .  "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

		$find = array(
			'{firstname}',
			'{lastname}',
			'{address_1}',
			'{address_2}',
			'{city}',
			'{postcode}',
			'{zone}',
			//'{zone_code}',
			'{country}'
		);

		$replace = array(
			'firstname' => '',//$wh_info['shipping_firstname'],
			'lastname'  => '',//$wh_info['shipping_lastname'],
			'address_1' => $wh_info['address_1'],
			'address_2' => $wh_info['address_2'],
			'city'      => $wh_info['city'],
			'postcode'  => $wh_info['postcode'],
			'zone'      => '',
			//'zone_code' => $wh_info['zone_code'],
			'country'   => $wh_info['country']
		);

				$wh_address_fr = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['wh_address_fr'] = $wh_address_fr;
				$data['wh_company']   = $wh_info['company'];
				$data['wh_telephone'] = $wh_info['telephone'];
				$data['wh_fax'] = $wh_info['fax'];
				$data['wh_email'] = $wh_info['email'];
				
		//Get HK WH address
		$wh_info_hk = $this->model_sale_vdi_order->getWarehouseAddressHK();
		$replace = array(
			'address_1' => $wh_info_hk['address_1'],
			'address_2' => $wh_info_hk['address_2'],
			'city'      => $wh_info_hk['city'],
			'postcode'  => $wh_info_hk['postcode'],
			'zone'      => '',
			'country'   => $wh_info_hk['country']
		);
		$wh_address_hk = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
		$data['wh_address_hk'] = $wh_address_hk;
		$data['wh_company_hk']   = $wh_info_hk['company'];
		$data['wh_telephone_hk'] = $wh_info_hk['telephone'];
		$data['wh_fax_hk'] = $wh_info_hk['fax'];
		$data['wh_email_hk'] = $wh_info_hk['email'];
		
		$product_data = array();
		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {

				$products = $this->model_sale_order->getOrderProducts($order_id);

				foreach ($products as $product) {

					$vintage = $this->model_sale_order->getVariety( $product['product_id'], 13 );
					$alchogol_volume = $this->model_sale_order->getVariety( $product['product_id'], 16);
					$color = $this->model_sale_order->getVariety( $product['product_id'], 14 );
					$grape_variety = $this->model_sale_order->getVariety( $product['product_id'], 15 );
					$appellation = $this->model_sale_order->getVariety( $product['product_id'], 25 );
					$origins = $this->model_sale_order->getOrigins( $product['vendor_id'] );
					
					$product_data[] = array(
						'order_id'	=> $order_id,
						'date_added'  => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
						'name'     => $product['name'],
						'product_no'   => $product['product_no'],
						'pallet_no'    => $product['pallet_no'],
						'alchogol_volume' => $alchogol_volume.' °',
						'vintage' => $vintage,
						'color'   => $color,
						'grape_variety' => $grape_variety,
						'appellation'   => $appellation,
						'origins'     => $origins
					);
				}

			}
		}
if(!isset($comment)) { $comment = ''; }
		$data['orders'][] = array(
				'product'            => $product_data,
				'container_id' => $order_info['container_id'],
				'shipment_id' => $order_info['shipment_id']
		);
		$this->response->setOutput($this->load->view('sale/order_variety_list_pdf.tpl', $data));
			
	}
	
	public function appendixxls() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_variety_list');

		if ($this->request->server['HTTPS'])
		{
			$data['base'] = HTTPS_SERVER;
		}
		else
		{
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');

		$data['text_containerid'] = $this->language->get('text_containerid');
		$data['text_shipmentid'] = $this->language->get('text_shipmentid');
		$data['text_pallet_id'] = $this->language->get('text_pallet_id');
		$data['text_product_no'] = $this->language->get('text_product_no');
		$data['text_product_name'] = $this->language->get('text_product_name');
		
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_super_total'] = $this->language->get('text_super_total');
		$data['column_head_store']  = $this->language->get('column_head_store');
		$data['column_head_wh']     = $this->language->get('column_head_wh');
		$data['column_head_agent']  = $this->language->get('column_head_agent');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_order_date'] = $this->language->get('column_order_date');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_color']          = $this->language->get('column_color');
		$data['column_vintage']        = $this->language->get('column_vintage');
		$data['column_grape_variety']  = $this->language->get('column_grape_variety');
		$data['column_alchogol_volume']    = $this->language->get('column_alchogol_volume');
		$data['column_appellation']    = $this->language->get('column_appellation');
		$data['column_origins']      = $this->language->get('column_origins');

		include 'controller/bar/switch.php';
		
		$this->load->model('sale/order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}

		$store_info = $this->model_setting_setting->getSetting('config', 0 );

		if ($store_info) {
			$store_address = $store_info['config_address'];
			$store_email = $store_info['config_email'];
			$store_telephone = $store_info['config_telephone'];
			$store_fax = $store_info['config_fax'];
			$comment = $store_info['config_comment'];
		} else {
			$store_address = $this->config->get('config_address');
			$store_email = $this->config->get('config_email');
			$store_telephone = $this->config->get('config_telephone');
			$store_fax = $this->config->get('config_fax');
			$comment = $this->config->get('config_comment');
		}
		$store_name = $this->config->get('config_name');
		$data['store_name']         = $store_name;
		$data['store_address']      = nl2br($store_address);
		$data['store_email']        = $store_email;
		$data['store_telephone']    = $store_telephone;
		$data['store_fax']          = $store_fax;
		$data['store_url']          = rtrim(HTTP_CATALOG, '/');
		
		$this->load->model('sale/vdi_order');
		$wh_info = $this->model_sale_vdi_order->getWarehouseAddress();
		$format = '{firstname} {lastname}' .  "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';

		$find = array(
			'{firstname}',
			'{lastname}',
			'{address_1}',
			'{address_2}',
			'{city}',
			'{postcode}',
			'{zone}',
			//'{zone_code}',
			'{country}'
		);

		$replace = array(
			'firstname' => '',//$wh_info['shipping_firstname'],
			'lastname'  => '',//$wh_info['shipping_lastname'],
			'address_1' => $wh_info['address_1'],
			'address_2' => $wh_info['address_2'],
			'city'      => $wh_info['city'],
			'postcode'  => $wh_info['postcode'],
			'zone'      => '',
			//'zone_code' => $wh_info['zone_code'],
			'country'   => $wh_info['country']
		);

				$wh_address_fr = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				$data['wh_address_fr'] = $wh_address_fr;
				$data['wh_company']   = $wh_info['company'];
				$data['wh_telephone'] = $wh_info['telephone'];
				$data['wh_fax'] = $wh_info['fax'];
				$data['wh_email'] = $wh_info['email'];
				
		//Get HK WH address
		$wh_info_hk = $this->model_sale_vdi_order->getWarehouseAddressHK();
		$replace = array(
			'address_1' => $wh_info_hk['address_1'],
			'address_2' => $wh_info_hk['address_2'],
			'city'      => $wh_info_hk['city'],
			'postcode'  => $wh_info_hk['postcode'],
			'zone'      => '',
			'country'   => $wh_info_hk['country']
		);
		$wh_address_hk = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
		$data['wh_address_hk'] = $wh_address_hk;
		$data['wh_company_hk']   = $wh_info_hk['company'];
		$data['wh_telephone_hk'] = $wh_info_hk['telephone'];
		$data['wh_fax_hk'] = $wh_info_hk['fax'];
		$data['wh_email_hk'] = $wh_info_hk['email'];
		
		$product_data = array();
		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if ($order_info) {

				$products = $this->model_sale_order->getOrderProducts($order_id);

				foreach ($products as $product) {

					$vintage = $this->model_sale_order->getVariety( $product['product_id'], 13 );
					$color = $this->model_sale_order->getVariety( $product['product_id'], 14 );
					$grape_variety = $this->model_sale_order->getVariety( $product['product_id'], 15 );
					$appellation = $this->model_sale_order->getVariety( $product['product_id'], 25 );
					$alchogol_volume = $this->model_sale_order->getVariety( $product['product_id'], 16);
					$origins = $this->model_sale_order->getOrigins( $product['vendor_id'] );
					
					$product_data[] = array(
						'order_id'	=> $order_id,
						'date_added'  => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
						'name'     => $product['name'],
						'product_no'   => $product['product_no'],
						'pallet_no'    => $product['pallet_no'],
						'vintage' => $vintage,
						'color'   => $color,
						'grape_variety' => $grape_variety,
						'alchogol_volume'   => $alchogol_volume.' °',
						'appellation'   => $appellation,
						'origins'     => $origins
					);
				}

			}
		}
if(!isset($comment)) { $comment = ''; }
		$data['orders'][] = array(
				'product'            => $product_data,
				'container_id' => $order_info['container_id'],
				'shipment_id' => $order_info['shipment_id']
		);
		$this->response->setOutput($this->load->view('sale/order_variety_list_xls.tpl', $data));
			
	}
	public function shippingpdf() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_shipping');

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');

		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['text_picklist'] = $this->language->get('text_picklist');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_from'] = $this->language->get('text_from');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$data['text_sku'] = $this->language->get('text_sku');
		$data['text_upc'] = $this->language->get('text_upc');
		$data['text_ean'] = $this->language->get('text_ean');
		$data['text_jan'] = $this->language->get('text_jan');
		$data['text_isbn'] = $this->language->get('text_isbn');
		$data['text_mpn'] = $this->language->get('text_mpn');


$data['column_pallet_no'] = $this->language->get('column_pallet_no');
      
		$data['column_location'] = $this->language->get('column_location');
		$data['column_reference'] = $this->language->get('column_reference');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_comment'] = $this->language->get('column_comment');

		$this->load->model('sale/order');
		$this->load->model('sale/vdi_order');

		$this->load->model('catalog/product');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}
		//GV - GENERAL
		$data['text_total_weight'] = $this->language->get('text_total_weight');
		$data['text_total_cases']  = $this->language->get('text_total_cases');
		$data['text_note']         = $this->language->get('text_note');
		$data['text_tracking_no']  = $this->language->get('text_tracking_no');
		$data['text_carrier']      = $this->language->get('text_carrier');
		$data['text_nof_prod']     = $this->language->get('text_nof_prod');
		$data['text_nof_pallet']   = $this->language->get('text_nof_pallet');
		$data['text_pal_total_prod']  = $this->language->get('text_pal_total_prod');
		$data['text_vintage']         = $this->language->get('text_vintage');
		$data['text_wh_contact']      = $this->language->get('text_wh_contact');
		$data['text_store_contact']   = $this->language->get('text_store_contact');
		$data['text_wh_info']         = $this->language->get('text_wh_info');
		$data['column_location'] = 'Prod#';
		$data['uom'] = $this->model_sale_vdi_order->getUOM( $this->config->get('config_weight_class_id') );
		$data['invbar'] = $this->model_sale_vdi_order->getInvoiceBarType();
		$data['store_email1'] = $this->config->get('config_email');
		$data['store_telephone1'] = $this->config->get('config_telephone');
		$data['store_fax1'] = $this->config->get('config_fax');
		$data['mvd_sales_order_invoice_address'] = $this->config->get('mvd_sales_order_invoice_address');
		
		//need to be added carefully in another way
		$data['carrier'] = '';
		$data['tracking_no'] = '';
		
		foreach ($orders as $order_id) {
			//$order_id = $orders[0];
			$order_info = $this->model_sale_order->getOrder($order_id);

			$vendors = array();
			$vendors = $this->model_sale_vdi_order->getOrderVendors($order_id);

			foreach ( $vendors as $vendor ) {
					//$vendor_id = $vendors[0]['vendor_id'];
					$vendor_id = $vendor['vendor_id'];
				
				$address_data = $this->model_sale_vdi_order->getVendorAddress( $vendor_id );
				$company = $address_data['company'];
	
				// Make sure there is a shipping method
				if ($order_info && $order_info['shipping_code']) {
					$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);
	
						$format = '{firstname} {lastname}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';				
						$find = array(
						'{firstname}',
						'{lastname}',
						'{address_1}',
						'{address_2}',
						'{city}',
						'{postcode}',
						'{zone}',
						'{zone_code}',
						'{country}'
						);
	
						$replace = array(
							'firstname' => $address_data['firstname'],
							'lastname'  => $address_data['lastname'],
							'address_1' => $address_data['address_1'],
							'address_2' => $address_data['address_2'],
							'city'      => $address_data['city'],
							'postcode'  => $address_data['postcode'],
							'zone'      => $address_data['zone'],
							'zone_code' => $address_data['zone_code'],
							'country'   => $address_data['country']
						);
	
					$vendor_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				
					$store_address = $vendor_address;
					$store_email = $address_data['email'];
					$store_telephone = $address_data['telephone'];
					$store_fax = $address_data['fax'];
					if ($order_info['invoice_no']) {
						$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
					} else {
						$invoice_no = '';
					}
					
					$wh_info = $this->model_sale_vdi_order->getWarehouseAddress();
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
	
					$find = array(
						'{firstname}',
						'{lastname}',
						'{company}',
						'{address_1}',
						'{address_2}',
						'{city}',
						'{postcode}',
						'{zone}',
						//'{zone_code}',
						'{country}'
					);
	
					$replace = array(
						'firstname' => '',//$wh_info['shipping_firstname'],
						'lastname'  => '',//$wh_info['shipping_lastname'],
						'company'   => $wh_info['company'],
						'address_1' => $wh_info['address_1'],
						'address_2' => $wh_info['address_2'],
						'city'      => $wh_info['city'],
						'postcode'  => $wh_info['postcode'],
						'zone'      => '',
						//'zone_code' => $wh_info['zone_code'],
						'country'   => $wh_info['country']
					);
	
					$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
					$this->load->model('tool/upload');
	
					$product_data = array();
	
					$products = $this->model_sale_vdi_order->getOrderProductsNew($order_id, $vendor_id);
	
					//$products = $this->model_sale_vdi_order->getOrderProductsWarehouse($order_id);
					//GV
					$total_weight = 0.0;
					$total_quantity = 0;
					$weight1 = 0.0;
	
					foreach ($products as $product) {
						$product_info = $this->model_catalog_product->getProduct($product['product_id']);
	
						//GV
						$fob = $this->model_sale_vdi_order->getFobPrice( $product['product_id'] );
						if ( (int) $fob['pf'] == 6 ) {
							$weight1 = (float) ( $product_info['weight']  ) * (float) $product['quantity'];
						} if ( (int) $fob['pf'] == 12 ) {
							$weight1 = (float) ( $product_info['weight'] * 2 ) * (float) $product['quantity'];
						}
						$total_weight += (float) $weight1;
						$total_quantity += $product['quantity'];
						$product_no = $this->model_sale_vdi_order->getProductNo( $order_id, $product['product_id']);
						$product_info['location'] = $product_no; //location is replaced by product#
						$vintage = $this->model_sale_vdi_order->getVintage( $product['product_id'] );
						$pallet_no = $this->model_sale_vdi_order->getPalletID( $product['pallet_id'] );
	
						$options = $this->model_sale_order->getOrderOptions($order_id, $product['order_product_id']);
	
						$option_data = array();
	
						foreach ($options as $option) {
							if ($option['type'] != 'file') {
								$value = $option['value'];
							} else {
								$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);
	
								if ($upload_info) {
									$value = $upload_info['name'];
								} else {
									$value = '';
								}
							}
	
							$option_data[] = array(
								'name'  => $option['name'],
								'value' => $value
							);
						}
	
						$product_data[] = array(
							'name'     => $product_info['name'],
							'model'    => $product_info['model'],
							'option'   => $option_data,
							'quantity' => $product['quantity'],

'pallet_no' => $product['pallet_no'],
      
							'location' => $product_info['location'],
							'location1' => $product_no,
							'vintage'  => $vintage,
							'sku'      => $product_info['sku'],
							'upc'      => $product_info['upc'],
							'ean'      => $product_info['ean'],
							'jan'      => $product_info['jan'],
							'isbn'     => $product_info['isbn'],
							'mpn'      => $product_info['mpn'],
							'pallet_no' => $pallet_no,
							'weight'   => $this->weight->format( $weight1, $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'))
						);
					}
	
					//GV WAREHOUSE INFORMATION
					$wh_product_data = array();
	
					$wh_products = $this->model_sale_vdi_order->getOrderProductsWarehouse($order_id);
					//GV
					$wh_total_weight = 0.0;
					$wh_total_quantity = 0;
					$wh_weight1 = 0.0;
					
					foreach ($wh_products as $wh_product) {
						$wh_product_info = $this->model_catalog_product->getProduct($wh_product['product_id']);
						//GV
						$fob = $this->model_sale_vdi_order->getFobPrice( $wh_product['product_id'] );
						if ( (int) $fob['pf'] == 6 ) {
							$wh_weight1 = (float) ( $wh_product_info['weight']  ) * (float) $wh_product['quantity'];
						} if ( (int) $fob['pf'] == 12 ) {
							$wh_weight1 = (float) ( $wh_product_info['weight'] * 2 ) * (float) $wh_product['quantity'];
						}
						$wh_total_weight += (float) $wh_weight1;
						$wh_total_quantity += $wh_product['quantity'];
						$product_no = $this->model_sale_vdi_order->getProductNo( $order_id, $wh_product['product_id']);
						$wh_product_info['location'] = $product_no; //location is replaced by product#
						
						$wh_vintage = $this->model_sale_vdi_order->getVintage( $wh_product['product_id'] );
						$wh_pallet_no = $this->model_sale_vdi_order->getPalletID( $wh_product['pallet_id'] );
						$pal_total_product = $this->model_sale_vdi_order->getPalletProductTotal( $wh_pallet_no );
	
						$wh_product_data[] = array(
							'name'     => $wh_product_info['name'],
							'model'    => $wh_product_info['model'],
							'quantity' => $wh_product['quantity'],
							'location' => $wh_product_info['location'],
							'location1' => $wh_product_info['location'],
							'sku'      => $wh_product_info['sku'],
							'upc'      => $wh_product_info['upc'],
							'ean'      => $wh_product_info['ean'],
							'jan'      => $wh_product_info['jan'],
							'isbn'     => $wh_product_info['isbn'],
							'mpn'      => $wh_product_info['mpn'],
							'pallet_no' => $wh_pallet_no,
							'pal_total_product' => $pal_total_product,
							'weight1'  => $wh_weight1 ,
							'vintage'  => $wh_vintage,
							'weight'   => $this->weight->format( $wh_weight1, $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'))
						);
					}
					$admin_comment =  nl2br( $this->model_sale_vdi_order->getComment( $order_id ) );
					$total_pallet = $this->model_sale_vdi_order->getOrderPalletTotal( $order_id );
					$total_product = $this->model_sale_vdi_order->getOrderProductTotal( $order_id );

if(!isset($comment)) { $comment = ''; }
					$data['orders'][] = array(
						'order_id'	         => $order_id,
						'invoice_no'         => $invoice_no,
						'date_added'         => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
						'store_name'         => $order_info['store_name'],
						'store_url'          => rtrim($order_info['store_url'], '/'),
						'store_address'      => nl2br($store_address),
						'store_email'        => $store_email,
						'store_telephone'    => $store_telephone,
						'store_fax'          => $store_fax,
						'email'              => $order_info['email'],
						'telephone'          => $order_info['telephone'],
						'shipping_address'   => $shipping_address,
						'shipping_method'    => $order_info['shipping_method'],
						'product'            => $product_data,
						'wh_product'         => $wh_product_data,
						'comment'            => nl2br($comment),
						'vendor_id'          => $vendor_id,
						'wh_telephone'      => $wh_info['telephone'],
						'wh_email'          => $wh_info['email'],
						'total_quantity'   => $total_quantity,
						'total_weight'      => $this->weight->format( $total_weight , $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point')),
						'admin_comment'     => $admin_comment,
						'total_pallet'      => $total_pallet,
						'total_product'     => $total_product,
						'company'           => $company,
						'carrier'           => ($order_info['carrier'] ? $order_info['carrier'] : ""),
						'tracking_no'       => ($order_info['tracking_no'] ? $order_info['tracking_no'] : "")

					);
	
					//GV
					/*$data['vendor_id'] = $vendor_id;
					$data['store_email1'] = $this->config->get('config_email');
					$data['store_telephone1'] = $this->config->get('config_telephone');
					$data['store_fax1'] = $this->config->get('config_fax');
					$data['wh_telephone'] = $wh_info['telephone'];
					$data['wh_email'] = $wh_info['email'];
	
					$data['total_quantity'] = $total_quantity;
					$data['total_weight'] = $this->weight->format( $total_weight , $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'));*/
	
				 } //end if
			} //vendors
		} //Orders
		
		$this->response->setOutput($this->load->view('sale/order_shipping_pdf.tpl', $data));
	}
	
	public function shippingxls() {
		$this->load->language('sale/order');

		$data['title'] = $this->language->get('text_shipping');

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');

		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['text_picklist'] = $this->language->get('text_picklist');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_from'] = $this->language->get('text_from');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$data['text_sku'] = $this->language->get('text_sku');
		$data['text_upc'] = $this->language->get('text_upc');
		$data['text_ean'] = $this->language->get('text_ean');
		$data['text_jan'] = $this->language->get('text_jan');
		$data['text_isbn'] = $this->language->get('text_isbn');
		$data['text_mpn'] = $this->language->get('text_mpn');


$data['column_pallet_no'] = $this->language->get('column_pallet_no');
      
		$data['column_location'] = $this->language->get('column_location');
		$data['column_reference'] = $this->language->get('column_reference');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_comment'] = $this->language->get('column_comment');

		$this->load->model('sale/order');
		$this->load->model('sale/vdi_order');

		$this->load->model('catalog/product');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}
		//GV - GENERAL
		$data['text_total_weight'] = $this->language->get('text_total_weight');
		$data['text_total_cases']  = $this->language->get('text_total_cases');
		$data['text_note']         = $this->language->get('text_note');
		$data['text_tracking_no']  = $this->language->get('text_tracking_no');
		$data['text_carrier']      = $this->language->get('text_carrier');
		$data['text_nof_prod']     = $this->language->get('text_nof_prod');
		$data['text_nof_pallet']   = $this->language->get('text_nof_pallet');
		$data['text_pal_total_prod']  = $this->language->get('text_pal_total_prod');
		$data['text_vintage']         = $this->language->get('text_vintage');
		$data['text_wh_contact']      = $this->language->get('text_wh_contact');
		$data['text_store_contact']   = $this->language->get('text_store_contact');
		$data['text_wh_info']         = $this->language->get('text_wh_info');
		$data['column_location'] = 'Prod#';
		$data['uom'] = $this->model_sale_vdi_order->getUOM( $this->config->get('config_weight_class_id') );
		$data['invbar'] = $this->model_sale_vdi_order->getInvoiceBarType();
		$data['store_email1'] = $this->config->get('config_email');
		$data['store_telephone1'] = $this->config->get('config_telephone');
		$data['store_fax1'] = $this->config->get('config_fax');
		$data['mvd_sales_order_invoice_address'] = $this->config->get('mvd_sales_order_invoice_address');
		
		//need to be added carefully in another way
		$data['carrier'] = '';
		$data['tracking_no'] = '';
		
		foreach ($orders as $order_id) {
			//$order_id = $orders[0];
			$order_info = $this->model_sale_order->getOrder($order_id);

			$vendors = array();
			$vendors = $this->model_sale_vdi_order->getOrderVendors($order_id);

			foreach ( $vendors as $vendor ) {
					//$vendor_id = $vendors[0]['vendor_id'];
					$vendor_id = $vendor['vendor_id'];
				
				$address_data = $this->model_sale_vdi_order->getVendorAddress( $vendor_id );
				$company = $address_data['company'];
	
				// Make sure there is a shipping method
				if ($order_info && $order_info['shipping_code']) {
					$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);
	
						$format = '{firstname} {lastname}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';				
						$find = array(
						'{firstname}',
						'{lastname}',
						'{address_1}',
						'{address_2}',
						'{city}',
						'{postcode}',
						'{zone}',
						'{zone_code}',
						'{country}'
						);
	
						$replace = array(
							'firstname' => $address_data['firstname'],
							'lastname'  => $address_data['lastname'],
							'address_1' => $address_data['address_1'],
							'address_2' => $address_data['address_2'],
							'city'      => $address_data['city'],
							'postcode'  => $address_data['postcode'],
							'zone'      => $address_data['zone'],
							'zone_code' => $address_data['zone_code'],
							'country'   => $address_data['country']
						);
	
					$vendor_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				
					$store_address = $vendor_address;
					$store_email = $address_data['email'];
					$store_telephone = $address_data['telephone'];
					$store_fax = $address_data['fax'];
					if ($order_info['invoice_no']) {
						$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
					} else {
						$invoice_no = '';
					}
					
					$wh_info = $this->model_sale_vdi_order->getWarehouseAddress();
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
	
					$find = array(
						'{firstname}',
						'{lastname}',
						'{company}',
						'{address_1}',
						'{address_2}',
						'{city}',
						'{postcode}',
						'{zone}',
						//'{zone_code}',
						'{country}'
					);
	
					$replace = array(
						'firstname' => '',//$wh_info['shipping_firstname'],
						'lastname'  => '',//$wh_info['shipping_lastname'],
						'company'   => $wh_info['company'],
						'address_1' => $wh_info['address_1'],
						'address_2' => $wh_info['address_2'],
						'city'      => $wh_info['city'],
						'postcode'  => $wh_info['postcode'],
						'zone'      => '',
						//'zone_code' => $wh_info['zone_code'],
						'country'   => $wh_info['country']
					);
	
					$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
					$this->load->model('tool/upload');
	
					$product_data = array();
	
					$products = $this->model_sale_vdi_order->getOrderProductsNew($order_id, $vendor_id);
	
					//$products = $this->model_sale_vdi_order->getOrderProductsWarehouse($order_id);
					//GV
					$total_weight = 0.0;
					$total_quantity = 0;
					$weight1 = 0.0;
	
					foreach ($products as $product) {
						$product_info = $this->model_catalog_product->getProduct($product['product_id']);
	
						//GV
						$fob = $this->model_sale_vdi_order->getFobPrice( $product['product_id'] );
						if ( (int) $fob['pf'] == 6 ) {
							$weight1 = (float) ( $product_info['weight']  ) * (float) $product['quantity'];
						} if ( (int) $fob['pf'] == 12 ) {
							$weight1 = (float) ( $product_info['weight'] * 2 ) * (float) $product['quantity'];
						}
						$total_weight += (float) $weight1;
						$total_quantity += $product['quantity'];
						$product_no = $this->model_sale_vdi_order->getProductNo( $order_id, $product['product_id']);
						$product_info['location'] = $product_no; //location is replaced by product#
						$vintage = $this->model_sale_vdi_order->getVintage( $product['product_id'] );
						$pallet_no = $this->model_sale_vdi_order->getPalletID( $product['pallet_id'] );
	
						$options = $this->model_sale_order->getOrderOptions($order_id, $product['order_product_id']);
	
						$option_data = array();
	
						foreach ($options as $option) {
							if ($option['type'] != 'file') {
								$value = $option['value'];
							} else {
								$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);
	
								if ($upload_info) {
									$value = $upload_info['name'];
								} else {
									$value = '';
								}
							}
	
							$option_data[] = array(
								'name'  => $option['name'],
								'value' => $value
							);
						}
	
						$product_data[] = array(
							'name'     => $product_info['name'],
							'model'    => $product_info['model'],
							'option'   => $option_data,
							'quantity' => $product['quantity'],

'pallet_no' => $product['pallet_no'],
      
							'location' => $product_info['location'],
							'location1' => $product_no,
							'vintage'  => $vintage,
							'sku'      => $product_info['sku'],
							'upc'      => $product_info['upc'],
							'ean'      => $product_info['ean'],
							'jan'      => $product_info['jan'],
							'isbn'     => $product_info['isbn'],
							'mpn'      => $product_info['mpn'],
							'pallet_no' => $pallet_no,
							'weight'   => $this->weight->format( $weight1, $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'))
						);
					}
	
					//GV WAREHOUSE INFORMATION
					$wh_product_data = array();
	
					$wh_products = $this->model_sale_vdi_order->getOrderProductsWarehouse($order_id);
					//GV
					$wh_total_weight = 0.0;
					$wh_total_quantity = 0;
					$wh_weight1 = 0.0;
					
					foreach ($wh_products as $wh_product) {
						$wh_product_info = $this->model_catalog_product->getProduct($wh_product['product_id']);
						//GV
						$fob = $this->model_sale_vdi_order->getFobPrice( $wh_product['product_id'] );
						if ( (int) $fob['pf'] == 6 ) {
							$wh_weight1 = (float) ( $wh_product_info['weight']  ) * (float) $wh_product['quantity'];
						} if ( (int) $fob['pf'] == 12 ) {
							$wh_weight1 = (float) ( $wh_product_info['weight'] * 2 ) * (float) $wh_product['quantity'];
						}
						$wh_total_weight += (float) $wh_weight1;
						$wh_total_quantity += $wh_product['quantity'];
						$product_no = $this->model_sale_vdi_order->getProductNo( $order_id, $wh_product['product_id']);
						$wh_product_info['location'] = $product_no; //location is replaced by product#
						
						$wh_vintage = $this->model_sale_vdi_order->getVintage( $wh_product['product_id'] );
						$wh_pallet_no = $this->model_sale_vdi_order->getPalletID( $wh_product['pallet_id'] );
						$pal_total_product = $this->model_sale_vdi_order->getPalletProductTotal( $wh_pallet_no );
	
						$wh_product_data[] = array(
							'name'     => $wh_product_info['name'],
							'model'    => $wh_product_info['model'],
							'quantity' => $wh_product['quantity'],
							'location' => $wh_product_info['location'],
							'location1' => $wh_product_info['location'],
							'sku'      => $wh_product_info['sku'],
							'upc'      => $wh_product_info['upc'],
							'ean'      => $wh_product_info['ean'],
							'jan'      => $wh_product_info['jan'],
							'isbn'     => $wh_product_info['isbn'],
							'mpn'      => $wh_product_info['mpn'],
							'pallet_no' => $wh_pallet_no,
							'pal_total_product' => $pal_total_product,
							'weight1'  => $wh_weight1 ,
							'vintage'  => $wh_vintage,
							'weight'   => $this->weight->format( $wh_weight1, $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'))
						);
					}
					$admin_comment =  nl2br( $this->model_sale_vdi_order->getComment( $order_id ) );
					$total_pallet = $this->model_sale_vdi_order->getOrderPalletTotal( $order_id );
					$total_product = $this->model_sale_vdi_order->getOrderProductTotal( $order_id );

if(!isset($comment)) { $comment = ''; }
					$data['orders'][] = array(
						'order_id'	         => $order_id,
						'invoice_no'         => $invoice_no,
						'date_added'         => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
						'store_name'         => $order_info['store_name'],
						'store_url'          => rtrim($order_info['store_url'], '/'),
						'store_address'      => nl2br($store_address),
						'store_email'        => $store_email,
						'store_telephone'    => $store_telephone,
						'store_fax'          => $store_fax,
						'email'              => $order_info['email'],
						'telephone'          => $order_info['telephone'],
						'shipping_address'   => $shipping_address,
						'shipping_method'    => $order_info['shipping_method'],
						'product'            => $product_data,
						'wh_product'         => $wh_product_data,
						'comment'            => nl2br($comment),
						'vendor_id'          => $vendor_id,
						'wh_telephone'      => $wh_info['telephone'],
						'wh_email'          => $wh_info['email'],
						'total_quantity'   => $total_quantity,
						'total_weight'      => $this->weight->format( $total_weight , $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point')),
						'admin_comment'     => $admin_comment,
						'total_pallet'      => $total_pallet,
						'total_product'     => $total_product,
						'company'           => $company,
						'carrier'           => ($order_info['carrier'] ? $order_info['carrier'] : ""),
						'tracking_no'       => ($order_info['tracking_no'] ? $order_info['tracking_no'] : "")

					);
	
					//GV
					/*$data['vendor_id'] = $vendor_id;
					$data['store_email1'] = $this->config->get('config_email');
					$data['store_telephone1'] = $this->config->get('config_telephone');
					$data['store_fax1'] = $this->config->get('config_fax');
					$data['wh_telephone'] = $wh_info['telephone'];
					$data['wh_email'] = $wh_info['email'];
	
					$data['total_quantity'] = $total_quantity;
					$data['total_weight'] = $this->weight->format( $total_weight , $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'));*/
	
				 } //end if
			} //vendors
		} //Orders
		
		$this->response->setOutput($this->load->view('sale/order_shipping_xls.tpl', $data));
	}


	public function confirmDocumentsReceived() {
		$json = array();

include 'controller/bar/switch.php';
					
		$this->load->model('sale/order');

		if (isset($this->request->get['order_id']) && isset($this->request->get['product_id']) && isset($this->request->get['pallet_id'])) {
			$this->model_sale_order->confirmDocumentsReceived($this->request->get['order_id'], $this->request->get['product_id'], $this->request->get['pallet_id']);
			$json['success'] = "OK.";
		} else {
			$json['error'] = "Something failed.";
		}


                //////////////////////////////// Send mail notification ///////////////////////////
                $verified_product=1;

                $products = $this->model_sale_order->getOrderProducts($this->request->get['order_id']);

                if(count($products)>0)
                    {
                        foreach ($products as $prod) {
                            if($prod["product_received"]==0 || $prod["documents_received"]==0)
                                $verified_product=0;
                        }
                    }

                if($verified_product==1){
                    $this->load->language('sale/order');

		if ($this->validate()) {
			// Store
			if (isset($this->request->get['store_id'])) {
				$store_id = $this->request->get['store_id'];
			} else {
				$store_id = 0;
			}

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($store_id);

			if ($store_info) {
				$url = $store_info['ssl'];
			} else {
				$url = HTTPS_CATALOG;
			}

			if (isset($this->session->data['cookie']) ) {
				// Include any URL perameters
				$url_data = array();

				foreach($this->request->get as $key => $value) {
					if ($key != 'route' && $key != 'token' && $key != 'store_id') {
						$url_data[$key] = $value;
					}
				}

				$curl = curl_init();

				// Set SSL if required
				if (substr($url, 0, 5) == 'https') {
					curl_setopt($curl, CURLOPT_PORT, 443);
				}

				curl_setopt($curl, CURLOPT_HEADER, false);
				curl_setopt($curl, CURLINFO_HEADER_OUT, true);
				curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                $url=$url . 'index.php?route=' . "api/order/history" . ($url_data ? '&' . http_build_query($url_data) : '');

				curl_setopt($curl, CURLOPT_URL, $url);
                                $post=$this->request->get;
                                $post['send_reception_product']=1;

				if ($post) {
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
				}

				curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

				$json1 = curl_exec($curl);
                                curl_close($curl);
			} else {
				$response = array();
				$response['error'] = 'Data missing, contact website administrator.';

				$json1 = json_encode($response);
			}
		} else {
			$response = array();
			$response['error'] = $this->error;
			unset($this->error);

			$json1 = json_encode($response);
		}

		}
                //////////////////////////////// End Send mail notification ///////////////////////////


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


    public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_container_id']) || isset($this->request->get['filter_shipment_id']) ) {

			if (isset($this->request->get['filter_container_id'])) {
				$filter_container_id = $this->request->get['filter_container_id'];
			} else {
				$filter_container_id = '';
			}

			if (isset($this->request->get['filter_shipment_id'])) {
				$filter_shipment_id = $this->request->get['filter_shipment_id'];
			} else {
				$filter_shipment_id = '';
			}

include 'controller/bar/switch.php';
					
			$this->load->model('sale/order');

			$filter_data = array(

      'filter_pallet_id'     => $filter_pallet_id,
      
		        'filter_container_id' => $filter_container_id,
				'filter_shipment_id' => $filter_shipment_id,
				'start'        => 0,
				'limit'        => 5
			);


			if ($filter_container_id){
				$results = $this->model_sale_order->getContainers($filter_data);
			}

			if ($filter_shipment_id){
				$results = $this->model_sale_order->getShipment($filter_data);
			}


			foreach ($results as $result) {

              $status = $this->model_sale_order->getAllVendorOrderStatus($result['order_id']);
				
			if ($status) {
				$status = $status;
			} else {
				$status = $result['status'];
			}
                
				$json[] = array(
					'name'       => $result['name'],

				);
			}
		}



		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
