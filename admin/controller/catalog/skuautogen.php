<?php
// ------------------------------------------------------
// Product SKU auto Generator for Opencart 2.0
// By P.K Solutions
// enquiries@p-k-solutions.co.uk
// ------------------------------------------------------

class ControllerCatalogskuautogen extends Controller {
	
	private $error = array();
	private $_name = 'skuautogen';
	private $_version = '2.0';	
	
	public function updateAll() {

		$this->load->model('catalog/skuautogen');
		
		$this->model_catalog_skuautogen->updateAll($this->request->get);		
	}
	
	public function updateNew() {

		$this->load->model('catalog/skuautogen');
		
		$this->model_catalog_skuautogen->updateNew($this->request->get);		
	}	

	public function index() {
	   $this->load->model('catalog/skuautogen');
	   //check database
	   $this->model_catalog_skuautogen->check_db();
	   
		$this->load->language('catalog/' . $this->_name);

		$this->document->setTitle($this->language->get('skugen_title'));
		
		$data[$this->_name . '_version'] = $this->_version;
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_catalog_skuautogen->updateValues($this->request->post);	

            if ($this->request->post['buttonForm'] == 'apply') {
			$this->model_catalog_skuautogen->updateValues($this->request->post);	
			
			$this->session->data['success'] = $this->language->get('textApply');
			
                $this->response->redirect($this->url->link('catalog/skuautogen', 'token=' . $this->session->data['token'], 'SSL'));
            } else {			
			
            if ($this->request->post['buttonForm'] == 'applyAll') {
			$this->model_catalog_skuautogen->updateAll($this->request->post);		
			
			$this->session->data['success'] = $this->language->get('textApplyAll');
			
                $this->response->redirect($this->url->link('catalog/skuautogen', 'token=' . $this->session->data['token'], 'SSL'));
            } else {
            if ($this->request->post['buttonForm'] == 'applyNew') {
			$this->model_catalog_skuautogen->updateNew($this->request->post);		
			
			$this->session->data['success'] = $this->language->get('textApplyNew');
			
            $this->response->redirect($this->url->link('catalog/skuautogen', 'token=' . $this->session->data['token'], 'SSL'));
            } else {
			$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
            }		
		   }	
		  }
		}
		
		$data['heading_title'] = $this->language->get('skugen_title');
		
		$data['text_edit'] = !isset($this->request->get['product_id']) ? $this->language->get('text_edit') : $this->language->get('text_edit');
		
		$data['condition1'] = $this->language->get('condition1');
		$data['condition1Text'] = $this->language->get('condition1Text');
		$data['condition2'] = $this->language->get('condition2');
		$data['condition2Text'] = $this->language->get('condition2Text');
		$data['conditionOption1'] = $this->language->get('conditionOption1');
		$data['conditionOption2'] = $this->language->get('conditionOption2');

		$data['conditionUser'] = $this->language->get('conditionUser');
		$data['conditionUserText'] = $this->language->get('conditionUserText');
		
		$data['textApply'] = $this->language->get('textApply');
		$data['textApplyAll'] = $this->language->get('textApplyAll');
		$data['textApplyNew'] = $this->language->get('textApplyNew');		

		$data['sequential'] = $this->language->get('sequential');
		$data['sequentialText'] = $this->language->get('sequentialText');
		$data['useHyphens'] = $this->language->get('useHyphens');
		$data['useHyphensText'] = $this->language->get('useHyphensText');		
		$data['useHyphensYes'] = $this->language->get('useHyphensYes');
		$data['useHyphensNo'] = $this->language->get('useHyphensNo');	
		$data['updatebtn'] = $this->language->get('updatebtn');			
		
		$data['updateNew'] = $this->language->get('updateNew');	
		$data['updateNewText'] = $this->language->get('updateNewText');	
		$data['updateNewSuccess'] = $this->language->get('updateNewSuccess');		
		$data['updateAll'] = $this->language->get('updateAll');	
		$data['updateAllText'] = $this->language->get('updateAllText');	
		$data['updateSuccess'] = $this->language->get('updateSuccess');	
		$data['updateWarning'] = $this->language->get('updateWarning');		
		
		$data['conditions'] = $this->language->get('conditions');	
		$data['userConditions'] = $this->language->get('userConditions');	
		$data['defaults'] = $this->language->get('defaults');	
		$data['setup'] = $this->language->get('setup');				
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
	    $results = $this->model_catalog_skuautogen->getValues();	
		
		$data['condition1value'] = $results['condition1'];
		$data['condition2value'] = $results['condition2'];
		$data['conditionUserValue'] = $results['conditionUser'];
		$data['sequentialValue'] = $results['sequential'];
		$data['useHyphensValue'] = $results['useHyphens'];		
		
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
		
		$data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');			
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('module_title'),
			'href'      => $this->url->link('catalog/' . $this->_name, 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' : '
   		);						
		
		$data['templates'] = array();

		$directories = glob(DIR_CATALOG . 'view/theme/*', GLOB_ONLYDIR);
		
		foreach ($directories as $directory) {
			$data['templates'][] = basename($directory);
		}	
		
		if (isset($this->request->post['config_template'])) {
			$data['config_template'] = $this->request->post['config_template'];
		} else {
			$data['config_template'] = $this->config->get('config_template');			
		}	
			
		$this->load->model('design/layout');
		
		$data['layouts'] = $this->model_design_layout->getLayouts();
	
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['brcr'] = $this->load->controller('common/brcr');

		$this->response->setOutput($this->load->view('catalog/skuautogen.tpl', $data));						
}
}
?>
