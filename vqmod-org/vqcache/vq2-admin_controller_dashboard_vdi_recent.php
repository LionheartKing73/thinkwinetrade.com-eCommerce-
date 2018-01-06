<?php
class ControllerDashboardVDIRecent extends Controller {
	public function index() {
		$this->load->language('dashboard/vdi_recent');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['text_vintage'] = $this->language->get('text_vintage');

                        $data['column_product'] = $this->language->get('column_product');
                        $data['column_quantity'] = $this->language->get('column_quantity');
	
		$data['column_status'] = $this->language->get('column_status');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_action'] = $this->language->get('column_action');
		//GV
		$data['column_product'] = $this->language->get('column_product');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['text_vintage'] = $this->language->get('text_vintage');
		
		$data['button_view'] = $this->language->get('button_view');

		$data['token'] = $this->session->data['token'];

		// Last 5 Orders
		$data['orders'] = array();

		$filter_data = array(
			'sort'  => 'o.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => 5
		);
		
		$results = $this->model_sale_vdi_order->getOrders($filter_data);


		foreach ($results as $result) {

            $fob = $this->model_sale_vdi_order->FobTotal( $result['order_id'] );
            $ostatus = $this->model_sale_vdi_order->getPayementStatus($result['order_id']);
            $status ='';
            
           if($ostatus['order_status_payement']!=0) {
                $status ='<div style="font-size: 16px; font-weight: bold; color: rgb(102, 164, 0);">PAID</div>';
            /*    $status .= ($result['order_status_id'] == 2 ? "<i class=\"fa fa-money text-success\"></i>" : ""); 
      
               if($result['order_status_id']==20 && $result['verified_product']==1) 
                $status .= '<div style=""><span class="label label-success tab-label" style="padding:4px 5px"><i>OK</i></span></div>'; */
           }
           
			//$products = array();
			//$products = $this->model_sale_vdi_order->getproduct();
                        
                        $data['orders'][] = array(
				'order_id'   => $result['order_id'],

                            'products'   => $this->model_sale_vdi_order->getVendorProductsList( $result['order_id'] ),
				          
                       
				//'customer'   => $result['customer'],
				//'vintage'      => $vintage,
				'status'        => $this->model_sale_vdi_order->getOrderStatusName($this->model_sale_vdi_order->getVendorOrderStatus($result['order_id'])).$status,
				'total'         => $this->currency->format($fob),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'view'       => $this->url->link('sale/vdi_order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'], 'SSL'),
			);
		}

		return $this->load->view('dashboard/vdi_recent.tpl', $data);
	}
}
