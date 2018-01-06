<?php
class ControllerApipromo extends Controller {
	public function index() {
		$this->load->language('api/promo');

		// Delete past promo in case there is an error
		unset($this->session->data['promoavailable']);

		$json = array();

		if (!isset($this->session->data['api_id'])) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			$this->load->model('total/promo');

			if (isset($this->request->post['promoavailable'])) {
				$promoavailable = $this->request->post['promoavailable'];
			} else {
				$promoavailable = '';
			}

			$promo_info = $this->model_total_promo->getdetails($promoavailable);

			if ($promo_info) {
				$this->session->data['promoavailable'][] = $this->request->post['promoavailable'];

				$json['success'] = $this->language->get('text_success');
			} else {
				$json['error'] = $this->language->get('error_promo');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}