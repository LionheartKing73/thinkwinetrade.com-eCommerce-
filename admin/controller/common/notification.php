<?php
class ControllerCommonNotification extends Controller {
public function index() {
	$this->load->model('catalog/notification');

	$data['config'] = array(
		'icon' => HTTP_CATALOG.'image/'.$this->config->get('config_icon'),
		);
	$data['notification'] = array();
	$total = $this->model_catalog_notification->getOrder();
	if($total) $data['notification'][] = array( 'type' => 'New Order',
								'url' => $this->url->link('sale/order', 'token=' . $this->session->data['token'], 'SSL'),
								'text' => 'You Have Receive New Order.',
								'total' => $total );

	$total = $this->model_catalog_notification->getReturn();
	if($total) $data['notification'][] = array( 'type' => 'Product Return',
								'url' => $this->url->link('sale/return', 'token=' . $this->session->data['token'], 'SSL'),
								'text' => 'You Have Receive New Return Order.',
								'total' => $total );

	$total = $this->model_catalog_notification->getCustomersOnline();
	if($total) $data['notification'][] = array( 'type' => 'Customer Online',
								'url' => $this->url->link('report/customer_online', 'token=' . $this->session->data['token'], 'SSL'),
								'text' => 'There Are new online Customer.',
								'total' => $total );

	$total = $this->model_catalog_notification->getNewCustomer();
	if($total) $data['notification'][] = array( 'type' => 'New Customer Add',
								'url' => $this->url->link('customer/customer', 'token=' . $this->session->data['token'], 'SSL'),
								'text' => 'There Are new Customer Added.',
								'total' => $total );

	$total = $this->model_catalog_notification->getreview();
	if($total) $data['notification'][] = array( 'type' => 'New Product Reviews',
								'url' => $this->url->link('catalog/review', 'token=' . $this->session->data['token'], 'SSL'),
								'text' => 'There Are new Product Reviews.',
								'total' => $total );

	$total = $this->model_catalog_notification->getAffiliates();
	if($total) $data['notification'][] = array( 'type' => 'New Affiliate Added',
								'url' => $this->url->link('marketing/affiliate', 'token=' . $this->session->data['token'], 'SSL'),
								'text' => 'There Are New Affiliate Added.',
								'total' => $total );

	echo json_encode($data);
	die;
}
} ?>