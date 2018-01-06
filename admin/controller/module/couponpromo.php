<?php
class Controllermodulecouponpromo extends Controller {
	private $error = array();
 
	public function index() {
		$this->load->language('module/couponpromo');
 
		$this->document->setTitle($this->language->get('title'));
		$this->document->addLink("view/stylesheet/imdev.css","stylesheet");
 		
		$this->load->model('tool/couponpromo');
		$this->model_tool_couponpromo->createTable();
		$this->getList();
	}

	public function insert() {
		$this->load->language('module/couponpromo');

		$this->document->setTitle($this->language->get('title'));
		
		$this->load->model('tool/couponpromo');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_tool_couponpromo->addcouponpromo($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->response->redirect($this->url->link('module/couponpromo', 'token=' . $this->session->data['token'].$url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('module/couponpromo');

		$this->document->setTitle($this->language->get('title'));		
		
		$this->load->model('tool/couponpromo');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_tool_couponpromo->editcouponpromo($this->request->get['id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->response->redirect($this->url->link('module/couponpromo', 'token=' . $this->session->data['token'].$url, 'SSL'));
		}

		$this->getForm();
	}
		
	public function delete() { 
		$this->load->language('module/couponpromo');

		$this->document->setTitle($this->language->get('title'));		
		
		$this->load->model('tool/couponpromo');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
      		foreach ($this->request->post['selected'] as $id) {
				$this->model_tool_couponpromo->delete($id);	
			}
						
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->response->redirect($this->url->link('module/couponpromo', 'token=' . $this->session->data['token'].$url, 'SSL'));
		}

		$this->getList();
	}

	private function getList() {
		
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_condition'])) {
			$filter_condition = $this->request->get['filter_condition'];
		} else {
			$filter_condition = null;
		}

		if (isset($this->request->get['filter_date'])) {
			$filter_date = $this->request->get['filter_date'];
		} else {
			$filter_date = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

  		$data['breadcrumbs'] = array();

  		$data['breadcrumbs'][] = array(
       		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

  		$data['breadcrumbs'][] = array(
       		'href'      => $this->url->link('module/couponpromo', 'token=' . $this->session->data['token'], 'SSL'),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
							
		
		$data['insert']  = $this->url->link('module/couponpromo/insert', 'token=' . $this->session->data['token'], 'SSL');
		$data['delete']  = $this->url->link('module/couponpromo/delete', 'token=' . $this->session->data['token'], 'SSL');
		
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'c.id';
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
	
		$data['couponpromos'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name, 
			'filter_condition' => $filter_condition, 
			'filter_date'	  => $filter_date, 
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$data['conditions'] = array('1'=>"Show to all users",'2'=>"Show to all users only after they login",'3'=>"Show to selected customer group",'4'=>"Show to specific customers");
		$data['types'] = array('P'=>"Percentage Discount",'F'=>"Fixed Discount",'I'=>"Information Display Purpose");
		$couponpromo_total = $this->model_tool_couponpromo->getTotalcouponpromo($filter_data);
		$results = $this->model_tool_couponpromo->getcouponpromos($filter_data,($page - 1) * $this->config->get('config_limit_admin'),$this->config->get('config_limit_admin'));
		
		foreach ($results as $result) {
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('button_edit'),
				'href' => $this->url->link('module/couponpromo/update', 'token=' . $this->session->data['token'] . '&id=' . $result['id'], 'SSL')
			);		
			$dateavailable = 1;
			if($result['expiry'] == 2) {
				$dateavailable = $this->model_tool_couponpromo->isDateAvailable($result['id'],$result['date_start'],$result['date_end']);
			}
			$data['couponpromos'][] = array(
				'id' 		 	 => $result['id'],
				'name' 	 	     => $result['name'],
				'dateavailable'  => $dateavailable,
				'expiry'  		 => $result['expiry'],
				'date_start'  	 => date("F j, Y", strtotime($result['date_start'])),
				'date_end'  	 => date("F j, Y", strtotime($result['date_end'])),
				'condition' 	 => $data['conditions'][$result['condition']],
				'typename' 	     => $data['types'][$result['type']],
				'type' 	 		 => $result['type'],
				'amount' 	     => $result['amount'],
				'customergroup'  => $this->model_tool_couponpromo->getCustomerGroupsNames($result['id']),
				'status' 	 	 => $result['status'],
				'action'     	 => $action
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['currency'] = $this->currency->getSymbolLeft();
		$data['headerinfo'] = $this->language->get('headerinfo');

		$data['text_support'] = $this->language->get('text_support');
		$data['text_helpguide'] = $this->language->get('text_helpguide');

		$data['text_name'] = $this->language->get('text_name');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_condition'] = $this->language->get('text_condition');
		$data['text_active'] = $this->language->get('text_active');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_type_column'] = $this->language->get('text_type_column');
		$data['text_status'] = $this->language->get('text_status');
		$data['column_action'] = $this->language->get('column_action');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['text_enabled'] = $this->language->get('text_enabled');		
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];
			
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
		}
					
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
 
		$data['sort_name'] = $this->url->link('module/couponpromo', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('module/couponpromo', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');

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
		
		$url = "";
		
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_condition'])) {
			$url .= '&filter_condition=' . urlencode(html_entity_decode($this->request->get['filter_condition'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date'])) {
			$url .= '&filter_date=' . urlencode(html_entity_decode($this->request->get['filter_date'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . urlencode(html_entity_decode($this->request->get['filter_status'], ENT_QUOTES, 'UTF-8'));
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
		
		$pagination = new Pagination();
		$pagination->total = $couponpromo_total;
		$pagination->page  = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url   = $this->url->link('module/couponpromo/', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($couponpromo_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($couponpromo_total - $this->config->get('config_limit_admin'))) ? $couponpromo_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $couponpromo_total, ceil($couponpromo_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_condition'] = $filter_condition;
		$data['filter_date'] = $filter_date;
		$data['filter_status'] = $filter_status;
		
		$data['sort'] = $sort;
		$data['order'] = $order;


		$data['sort_name'] = $this->url->link('module/couponpromo/', 'token=' . $this->session->data['token']. '&sort=c.name' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('module/couponpromo/', 'token=' . $this->session->data['token']. '&sort=c.status' . $url, 'SSL');

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/couponpromo_list.tpl', $data));
 	}

	private function getForm() {
		$url = '';
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['date_added'] = $this->language->get('date_added');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['headerinfo1'] = $this->language->get('headerinfo1');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_helpguide'] = $this->language->get('text_helpguide');
		$version = str_replace(".","",VERSION);
		$data['text_name'] = $this->language->get('text_name');
		$data['text_status'] = $this->language->get('text_status');
		$data['text_expiry'] = $this->language->get('text_expiry');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_type'] = $this->language->get('text_type');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_fixed'] = $this->language->get('text_fixed');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_date_start'] = $this->language->get('text_date_start');
		$data['text_date_end'] = $this->language->get('text_date_end');
		$data['text_store'] = $this->language->get('text_store');
		$data['text_condition'] = $this->language->get('text_condition');
		$data['text_mobile'] = $this->language->get('text_mobile');
		$data['text_displaytype'] = $this->language->get('text_displaytype');
		$data['help_displaytype'] = $this->language->get('help_displaytype');
		$data['text_customize_theme'] = $this->language->get('text_customize_theme');
		$data['text_backgroundcolor'] = $this->language->get('text_backgroundcolor');
		$data['text_fontcolor'] = $this->language->get('text_fontcolor');

		$data['headingtext'] = $this->language->get('headingtext');
		$data['descriptiontext'] = $this->language->get('descriptiontext');
		$data['descriptionimage'] = $this->language->get('descriptionimage');
		$data['buttontext'] = $this->language->get('buttontext');		
		$data['discountapplied'] = $this->language->get('discountapplied');

		$data['help_headingtext'] = $this->language->get('help_headingtext');
		$data['help_descriptiontext'] = $this->language->get('help_descriptiontext');
		$data['help_descriptionimage'] = $this->language->get('help_descriptionimage');
		$data['help_buttontext'] = $this->language->get('help_buttontext');		
		$data['help_discountapplied'] = $this->language->get('help_discountapplied');

		$data['text_customergroup'] = $this->language->get('text_customergroup');
		$data['text_customer'] = $this->language->get('text_customer');
		$data['help_customer'] = $this->language->get('help_customer');
		
		$data['token'] = $this->session->data['token'];
		$data['text_default'] = $this->language->get('text_default');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['text_enabled'] = $this->language->get('text_enabled');		
		$data['text_disabled'] = $this->language->get('text_disabled');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['error_name'])) {
			$data['error_name'] = $this->error['error_name'];
		} else {
			$data['error_name'] = '';
		}
		
 		if (isset($this->error['error_couponpromo_exist'])) {
			$data['error_couponpromo_exist'] = $this->error['error_couponpromo_exist'];
		} else {
			$data['error_couponpromo_exist'] = '';
		}

		if (isset($this->error['error_couponpromo_empty'])) {
			$data['error_couponpromo_empty'] = $this->error['error_couponpromo_empty'];
		} else {
			$data['error_couponpromo_empty'] = '';
		}
		
  		$data['breadcrumbs'] = array();

  		$data['breadcrumbs'][] = array(
       		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

  		$data['breadcrumbs'][] = array(
       		'href'      => $this->url->link('module/couponpromo', 'token=' . $this->session->data['token'], 'SSL'),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
			
		if (!isset($this->request->get['id'])) {
			$data['action'] = $this->url->link('module/couponpromo/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/couponpromo/update', 'token=' . $this->session->data['token'] . '&id=' . $this->request->get['id'], 'SSL');
		}
		
		$data['token'] = $this->session->data['token'];
		  
    	$data['cancel'] = $this->url->link('module/couponpromo', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$couponpromo_info = $this->model_tool_couponpromo->getcouponpromo($this->request->get['id']);
		}
		
		if (isset($this->request->get['id'])) {
			$data['id'] = $this->request->get['id'];
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (isset($couponpromo_info)) {
			$data['name'] = $couponpromo_info['name'];
		} else {
			$data['name'] = '';
		}

		$data['expirys'] = array('1'=>"Active all time",'2'=>"Active for selected date range");

		if (isset($this->request->post['expiry'])) {
			$data['expiry'] = $this->request->post['expiry'];
		} elseif (isset($couponpromo_info)) {
			$data['expiry'] = $couponpromo_info['expiry'];
		} else {
			$data['expiry'] = 1;
		}

		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($couponpromo_info)) {
			$data['type'] = $couponpromo_info['type'];
		} else {
			$data['type'] = '';
		}


		if (isset($this->request->post['amount'])) {
			$data['amount'] = $this->request->post['amount'];
		} elseif (!empty($couponpromo_info)) {
			$data['amount'] = $couponpromo_info['amount'];
		} else {
			$data['amount'] = '';
		}

		if (isset($this->error['amount'])) {
			$data['error_amount'] = $this->error['amount'];
		} else {
			$data['error_amount'] = array();
		}

		if (isset($this->request->post['date_start'])) {
			$data['date_start'] = $this->request->post['date_start'];
		} elseif (!empty($couponpromo_info)) {
			$data['date_start'] = ($couponpromo_info['date_start'] != '0000-00-00') ? $couponpromo_info['date_start'] : '';
		} else {
			$data['date_start'] = date('Y-m-d');
		}

		if (isset($this->request->post['date_end'])) {
			$data['date_end'] = $this->request->post['date_end'];
		} elseif (!empty($couponpromo_info)) {
			$data['date_end'] = ($couponpromo_info['date_end'] != '0000-00-00') ? $couponpromo_info['date_end'] : '';
		} else {
			$data['date_end'] = date('Y-m-d');
		}

	
		$data['conditions'] = array('1'=>"Show to all users",'2'=>"Show to all users only after login",'3'=>"Show to selected customer group",'4'=>"Show to specific customer");

		if (isset($this->request->post['condition'])) {
			$data['condition'] = $this->request->post['condition'];
		} elseif (isset($couponpromo_info)) {
			$data['condition'] = $couponpromo_info['condition'];
		} else {
			$data['condition'] = 1;
		}

		if($version > 2100) {
			$this->load->model('customer/customer_group');
			$data['customergroups'] = $this->model_customer_customer_group->getCustomerGroups();
		} else {
			$this->load->model('sale/customer_group');
			$data['customergroups'] = $this->model_sale_customer_group->getCustomerGroups();
		}

		if (isset($this->request->post['customergroup'])) {
			$data['customergrouppromo'] = $this->request->post['customergroup'];
		} elseif (isset($couponpromo_info)) {
			$data['customergrouppromo'] = $this->model_tool_couponpromo->getCustomerGroups($this->request->get['id']);
		} else {
			$data['customergrouppromo'] = array();
		}

		if (isset($this->request->post['customers'])) {
			$data['customers'] = $this->request->post['customers'];
		} elseif (isset($couponpromo_info)) {
			$data['customers'] = $this->model_tool_couponpromo->getCustomerNames($this->request->get['id']);
		} else {
			$data['customers'] = array();
		}

		if (isset($this->error['displaytype'])) {
			$data['error_displaytype'] = $this->error['displaytype'];
		} else {
			$data['error_displaytype'] = array();
		}

		$data['displaytypes'] = array('1'=>"Show message in header all pages",'2'=>"Show description i.e message plus image as popup",'3'=>"Show only image as popup");

		if (isset($this->request->post['displaytype'])) {
			$data['displaytype'] = $this->request->post['displaytype'];
		} elseif (isset($couponpromo_info)) {
			$data['displaytype'] = $couponpromo_info['displaytype'];
		} else {
			$data['displaytype'] = "";
		}


		$this->load->model('setting/store');
		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['store'])) {
			$data['promo_store'] = $this->request->post['store'];
		} elseif (isset($this->request->get['id'])) {
			$data['promo_store'] = $this->model_tool_couponpromo->getStores($this->request->get['id']);
		} else {
			$data['promo_store'] = array(0);
		}

		if (isset($this->request->post['mobile'])) {
			$data['mobile'] = $this->request->post['mobile'];
		} elseif (isset($couponpromo_info)) {
			$data['mobile'] = $couponpromo_info['mobile'];
		} else {
			$data['mobile'] = '';
		}

		if (isset($this->request->post['backgroundcolor'])) {
			$data['backgroundcolor'] = $this->request->post['backgroundcolor'];
		} elseif (isset($couponpromo_info)) {
			$data['backgroundcolor'] = $couponpromo_info['backgroundcolor'];
		} else {
			$data['backgroundcolor'] = '';
		}

		if (isset($this->request->post['fontcolor'])) {
			$data['fontcolor'] = $this->request->post['fontcolor'];
		} elseif (isset($couponpromo_info)) {
			$data['fontcolor'] = $couponpromo_info['fontcolor'];
		} else {
			$data['fontcolor'] = '';
		}

		if (isset($this->request->post['link'])) {
			$data['link'] = $this->request->post['link'];
		} elseif (isset($couponpromo_info)) {
			$data['link'] = $couponpromo_info['link'];
		} else {
			$data['link'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (isset($couponpromo_info)) {
			$data['status'] = $couponpromo_info['status'];
		} else {
			$data['status'] = '1';
		}

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		$data['text_input1'] = $this->language->get('text_input1'); //input
		$data['help_input1'] = $this->language->get('help_input1'); //input

		$data['text_textarea1'] = $this->language->get('text_textarea1'); //textarea
		$data['help_textarea1'] = $this->language->get('help_textarea1'); //textarea

		$data['text_desc1'] = $this->language->get('text_desc1'); //ckeditor textarea
		$data['help_desc1'] = $this->language->get('help_desc1'); //ckeditor textarea


		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif (isset($this->request->get['id'])) {
			$data['description'] = $this->model_tool_couponpromo->getDescriptions($this->request->get['id']);
		} else {
			$data['description'] = array();
		}
		
		$this->load->model('tool/image');

		foreach ($data['description'] as $key => $value) {
			if (isset($data['description'][$key]['image'])) {
				$data['description'][$key]['image'] =$data['description'][$key]['image'];
			} elseif (!empty($data['description'])) {
				$data['description'][$key]['image'] =$data['description'][$key]['image'];
			} else {
				$data['description'][$key]['image'] = '';
			}
			
			if (isset($data['description'][$key]['image']) && is_file(DIR_IMAGE . $data['description'][$key]['image'])) {
				$data['description'][$key]['thumb'] = $this->model_tool_image->resize($data['description'][$key]['image'], 100, 100);
			} elseif (!empty($data['description']) && is_file(DIR_IMAGE . $data['description'][$key]['image'])) {
				$data['description'][$key]['thumb'] = $this->model_tool_image->resize($data['description'][$key]['image'], 100, 100);
			} else {
				$data['description'][$key]['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
			}
			
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/couponpromo_form.tpl', $data));
	}

	private function validateForm() {
		
		$this->load->model('tool/couponpromo');
		
		if (!$this->user->hasPermission('modify', 'module/couponpromo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 255)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if (($this->request->post['amount'] == "" || !is_numeric($this->request->post['amount'])) && $this->request->post['type'] != "I" ){
			$this->error['amount'] = $this->language->get('error_amount');
		}

		if ($this->request->post['displaytype'] == "*") {
			$this->error['displaytype'] = $this->language->get('error_displaytype');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'module/couponpromo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}


	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_condition'])) {
			$this->load->model('tool/couponpromo');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = null;
			}

			if (isset($this->request->get['filter_condition'])) {
				$filter_condition = $this->request->get['filter_condition'];
			} else {
				$filter_condition = null;
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}			

			$data = array(
				'filter_name'  => $filter_name,
				'filter_condition' => $filter_condition,
				'start'        => 0,
				'limit'        => $limit
			);

			$json = $this->model_tool_couponpromo->getcouponpromos($data);

		}

		$this->response->setOutput(json_encode($json));
	}
}
?>