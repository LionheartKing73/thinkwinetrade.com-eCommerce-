<?php
class ModelTotalPromo extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if (isset($this->session->data['promoavailable'])) {
		foreach ($this->session->data['promoavailable'] as $key => $value) {
			$promodetails = $this->getdetails($value);

			$discount_total = 0;
			
			$sub_total = $this->cart->getSubTotal();
			
			if ($promodetails['type'] == 'F') {
				$promodetails['amount'] = min($promodetails['amount'], $sub_total);
			}
			
			foreach ($this->cart->getProducts() as $product) {
				$amount = 0;

				if ($promodetails['type'] == 'F') {
					$amount = $promodetails['amount'] * ($product['total'] / $sub_total);
				} elseif ($promodetails['type'] == 'P') {
					$amount = $product['total'] / 100 * $promodetails['amount'];
				}

				if ($product['tax_class_id']) {
					$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $amount), $product['tax_class_id']);

					foreach ($tax_rates as $tax_rate) {
						if ($tax_rate['type'] == 'P') {
							$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
						}
					}
				}
			
				$discount_total += $amount;
			}

			if (isset($this->session->data['shipping_method'])) {
				if (!empty($this->session->data['shipping_method']['tax_class_id'])) {
					$tax_rates = $this->tax->getRates($this->session->data['shipping_method']['cost'], $this->session->data['shipping_method']['tax_class_id']);

					foreach ($tax_rates as $tax_rate) {
						if ($tax_rate['type'] == 'P') {
							$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
						}
					}
				}

				$discount_total += $this->session->data['shipping_method']['cost'];
			}

			// If discount greater than total
			if ($discount_total > $total) {
				$discount_total = $total;
			}

			$total_data[] = array(
				'code'       => "promo",
				'title'      => $promodetails['name'],
				'value'      => -$discount_total,
				'sort_order' => $this->config->get('promo_sort_order')
			);

			$total -= $discount_total;
			
		}
	}
	}

	public function getdetails($id) {
		$sql = "SELECT c.id,c.type,c.amount,c.name FROM " . DB_PREFIX . "couponpromo_setting c LEFT JOIN " . DB_PREFIX . "couponpromo_store cs ON (c.id = cs.id) WHERE  cs.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = 1 AND c.id = '".$id."'";	
		$query = $this->db->query($sql);
		
		return $query->row;
	}
}