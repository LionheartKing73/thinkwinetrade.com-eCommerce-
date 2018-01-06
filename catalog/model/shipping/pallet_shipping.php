<?php
class ModelShippingPalletShipping extends Model {
	function getQuote($address, $order_id=false) {
		$this->load->language('shipping/pallet_shipping');

        if ( isset($this->session->data['order_id'])
                && ($order_id == $this->session->data['order_id']))
           $order_id = false;

		 if($order_id) {
			//$pallets = $this->db->query("SELECT count(*) AS pallets FROM " . DB_PREFIX . "pallet WHERE order_id = '" . (int)$order_id . "'");
			$pallets = $this->db->query("SELECT pallet_size, count(*) as pallet_qty FROM " . DB_PREFIX . "pallet WHERE order_id = '" . (int)$order_id . "' GROUP BY pallet_size");
		} else {
			$customer_id = $this->customer->isLogged();
			//$pallets = $this->db->query("SELECT count(*) AS pallets FROM " . DB_PREFIX . "pallet WHERE customer_id = '" . (int)$customer_id . "' AND pallet_no IS NULL AND order_id IS NULL");
			$pallets = $this->db->query("SELECT pallet_size, count(*) as pallet_qty FROM " . DB_PREFIX . "pallet WHERE customer_id = '" . (int)$customer_id . "' AND pallet_no IS NULL AND order_id IS NULL GROUP BY pallet_size");
		}

		if($shipping = $pallets->rows) {
			$shipping_data['cost'] = 0;

			if(isset($address['country_id'])) {
				$shipping_by_country = $this->db->query("SELECT * FROM " . DB_PREFIX . "pallet_shipping WHERE country_id = '" . (int)$address['country_id'] . "'");
				if($shipping_by_country->num_rows > 1) {
					foreach($shipping_by_country->rows as $shipping_by_country_price) {
						$shipping_country[$shipping_by_country_price['key']] = $shipping_by_country_price['value'];
					}

					foreach ($shipping as $shipping_pallet) {
						$shipping_data['cost'] += $shipping_country["pallets_shipping_x" . $shipping_pallet['pallet_qty'] . "_" . $shipping_pallet['pallet_size']];
						$shipping_text .= $shipping_pallet['pallet_qty'] . "x" . $shipping_pallet['pallet_size'] . " ";
					}
				} else {
					foreach ($shipping as $shipping_pallet) {
						$shipping_data['cost'] += $this->config->get("pallets_shipping_x" . $shipping_pallet['pallet_qty'] . "_" . $shipping_pallet['pallet_size']);
						$shipping_text .= $shipping_pallet['pallet_qty'] . "x" . $shipping_pallet['pallet_size'] . " ";
					}
				}
			} else {
				foreach ($shipping as $shipping_pallet) {
					$shipping_data['cost'] += $this->config->get("pallets_shipping_x" . $shipping_pallet['pallet_qty'] . "_" . $shipping_pallet['pallet_size']);
					$shipping_text .= $shipping_pallet['pallet_qty'] . "x" . $shipping_pallet['pallet_size'] . " ";
				}
			}

			$shipping_data['title'] = sprintf($this->language->get('text_shipping'), $shipping_text);
			//$shipping_data['cost'] = $this->config->get("pallets_shipping_x".$shipping);
		}

		$method_data = array();

		if (isset($shipping_data)) {
			$quote_data = array();

			$quote_data['pallet_shipping'] = array(
				'code'         => 'pallet_shipping.pallet_shipping',
				'title'        => $shipping_data['title'],
				'cost'         => $shipping_data['cost'],
				'tax_class_id' => '',
				'text'         => $this->currency->format($shipping_data['cost'])
			);

			$method_data = array(
				'code'       => 'pallet_shipping',
				'title'      => $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('pallet_shipping_sort_order'),
				'error'      => false
			);
		}

		return $method_data;
	}


}
