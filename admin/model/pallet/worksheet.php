<?php
class ModelPalletWorksheet extends Model {
	/*** yodapt 16 Oct 2015 ***/
	public function addBlankWorksheet($customer_id = 0) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "worksheet SET customer_id = '" . $customer_id . "', date_added = NOW(), date_modified = NOW()");
		return $this->db->getLastId();
	}
	public function destroyWorksheetByCustomerId($customer_id) {
		$pallets = $this->db->query("SELECT pallet_id FROM " . DB_PREFIX . "pallet WHERE customer_id = '" . (int)$customer_id . "'");
		foreach($pallets->rows as $row) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$row['pallet_id'] . "'");
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "pallet WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "worksheet WHERE customer_id = '" . (int)$customer_id . "'");
	}
	/*** // ***/
	public function getWorksheetByOrderId($order_id) {
		$worksheetId = $this->db->query("SELECT worksheet_id FROM " . DB_PREFIX . "worksheet WHERE order_id = '" . (int)$order_id . "'");
		if(isset($worksheetId->row['worksheet_id'])) {
			return $worksheetId->row['worksheet_id'];
		}
	}

	public function hasPallets($worksheet_id) {
		$hasPallets = $this->db->query("SELECT pallet_id FROM " . DB_PREFIX . "pallet WHERE worksheet_id = '" . (int)$worksheet_id . "'");
		return count($hasPallets->rows);
	}

	public function getPallets($worksheet_id) {
		$palletIds = $this->db->query("SELECT pallet_id FROM " . DB_PREFIX . "pallet WHERE worksheet_id = '" . (int)$worksheet_id . "' ORDER BY pallet_id");
		foreach ($palletIds->rows as $row) {
			$pallets[] = $row['pallet_id'];
		}
		return $pallets;
	}

	public function getOrderProductsByPalletId($pallet_id) {
		//$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pallet_product pp LEFT JOIN " . DB_PREFIX . "order_product op USING (product_id, order_id) where pp.pallet_id= '" . (int)$pallet_id . "'");
		//$query = $this->db->query("SELECT *, (SELECT currency_code FROM " . DB_PREFIX . "order o WHERE o.order_id = op.order_id) AS currency_code FROM " . DB_PREFIX . "pallet_product pp LEFT JOIN " . DB_PREFIX . "order_product op USING (product_id, order_id) where pp.pallet_id= '" . (int)$pallet_id . "'");
		$query = $this->db->query("SELECT *, (SELECT currency_code FROM " . DB_PREFIX . "order o WHERE o.order_id = pp.order_id) AS currency_code FROM " . DB_PREFIX . "pallet_product pp WHERE pallet_id = '" . (int)$pallet_id . "'");

		return $query->rows;
	}

	public function addToPallet($pallet_id, $order_id, $product, $qty = 1) {
		$palletProductId = $this->db->query("SELECT * FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "' AND product_id = '" . (int)$product['product_id'] . "'");

		if(isset($palletProductId->row['pallet_product_id'])) {
			$qty += $palletProductId->row['quantity'];
			//product['total'] += $palletProductId->row['total'];
            $product['total'] = $qty *$product['price'];
			//$product[''] += $palletProductId->row[''];
			$this->db->query("UPDATE " . DB_PREFIX . "pallet_product SET quantity = '" . (int)$qty . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "' WHERE pallet_product_id = '" . $palletProductId->row['pallet_product_id'] . "' AND product_id = '" . (int)$product['product_id'] . "'");
		} else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "pallet_product SET pallet_id = '" . (int)$pallet_id . "', order_id = '" . (int)$order_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $this->db->escape($product['name']) . "', model = '" . $this->db->escape($product['model']) . "', sku = '" . $this->db->escape($product['sku']) . "', quantity = '" . (int)$qty . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "', vendor_id = '" . (int)$product['vendor_id'] . "'");
			$pallet_product_id = $this->db->getLastId();
		}
	}

	public function getVendor($product_id) {
		$getVenId = $this->db->query("SELECT vs.vendor_id AS vendor_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "vendor v ON (p.product_id = v.vproduct_id) LEFT JOIN " . DB_PREFIX . "vendors vs ON (v.vendor = vs.vendor_id) WHERE p.product_id = '" . (int)$product_id . "'");

		return $getVenId->row['vendor_id'];
	}

	public function removeFromPallet($pallet_id, $product_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "' AND product_id = '" . (int)$product_id . "'");
	}

	public function addPallet($worksheet_id, $customer_id, $order_id, $pallet_size) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "pallet SET worksheet_id = '" . (int)$worksheet_id . "', order_id = '" . (int)$order_id . "', customer_id = '" . (int)$customer_id . "', pallet_size = '" . (int)$pallet_size . "', locked = '1', date_added = NOW(), date_modified = NOW()");
		return $this->db->getLastId();
	}

	public function getProducts($pallet_id) {
		$products = $this->db->query("SELECT * FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "'");
		return $products->rows;
	}

	public function getProductsExt($pallet_id) {
		$products = $this->db->query("SELECT * FROM " . DB_PREFIX . "pallet_product pp LEFT JOIN " . DB_PREFIX . "order_product USING (order_id) WHERE pallet_id = '" . (int)$pallet_id . "'");
		return $products->rows;
	}

	public function destroyWorksheetByOrderId($order_id) {
		$pallets = $this->db->query("SELECT pallet_id FROM " . DB_PREFIX . "pallet WHERE order_id = '" . (int)$order_id . "'");
		foreach($pallets->rows as $row) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$row['pallet_id'] . "'");
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "pallet WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "worksheet WHERE order_id = '" . (int)$order_id . "'");
	}

	public function destroyPallet($pallet_id, $order_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "pallet WHERE pallet_id = '" . (int)$pallet_id . "' AND order_id = '" . (int)$order_id . "'");
	}

	public function generatePalletNo($order_id, $pallet_by_order, $customer_id, $pallet_size) {

		if ($customer_id > 0) {
			$customer = $this->db->query("SELECT firstname, lastname FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
			$initials = strtoupper(substr($customer->row['firstname'], 0, 1).substr($customer->row['lastname'], 0, 1));

			$country = $this->db->query("SELECT shipping_country FROM " . DB_PREFIX . "order WHERE order_id = '" . (int)$order_id . "'");
			if(isset($country->row['shipping_country'])) {
				$country_code = $this->db->query("SELECT `iso_code_2` FROM " . DB_PREFIX . "country WHERE name = '" . $country->row['shipping_country'] . "'");
				if(isset($country_code->row['iso_code_2'])) {
					$country_code = $country_code->row['iso_code_2'];
				} else {
					$country_code = 'XX';
				}
			}
		}
		else {
			$initials = 'XX';
			$country_code = 'XX';
		}

		$date = date('dmy');
		$pallet_by_order++;

		//$no = "PALL-".$customer_id."-".$initials."-".$date."-".$order_id."-".$pallet_by_order;
		//$no = "PALL-".$country_code.$customer_id.$initials.$date."-".$order_id."-".$pallet_by_order;
		$nos = array();
		$nos['pallet'] = "PALL".$pallet_size."-".$country_code.$customer_id.$initials.$date."-".$order_id."-".$pallet_by_order;
		$nos['product'] = "PROD-".$order_id."-".$pallet_by_order;
		return $nos;
	}

	public function getCustomerId($order_id) {
		$customerId = $this->db->query("SELECT customer_id FROM " . DB_PREFIX . "order WHERE order_id = '" . (int)$order_id . "'");
		if(isset($customerId->row['customer_id'])) {
			return $customerId->row['customer_id'];
		}
	}

	public function archivePallet($pallet_id, $order_id, $archive_nos) {
		$this->db->query("UPDATE " . DB_PREFIX . "pallet SET order_id = '" . (int)$order_id . "', pallet_no = '" . $archive_nos['pallet'] . "' WHERE pallet_id = '" . (int)$pallet_id . "'");
		$this->db->query("UPDATE " . DB_PREFIX . "pallet_product SET order_id = '" . (int)$order_id . "' WHERE pallet_id = '" . (int)$pallet_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "pallet_product WHERE order_id = '" . (int)$order_id . "' AND pallet_id = '" . (int)$pallet_id . "'");
		$pi=1;
		foreach($query->rows as $row) {
			$product_no = $archive_nos['product']."-".$pi;
			$this->db->query("UPDATE " . DB_PREFIX . "pallet_product SET product_no = '" . $product_no . "' WHERE pallet_product_id = '" . $row['pallet_product_id'] . "' AND order_id = '" . (int)$order_id . "' AND pallet_id = '" . (int)$pallet_id . "'");
			$pi++;
		}
	}

	public function getPalletsIds($order_id) {
		$query = $this->db->query("SELECT pallet_no FROM " . DB_PREFIX . "pallet WHERE order_id = '" . (int)$order_id . "' ORDER BY pallet_no");
		//$palletsIds = $this->db->query("select p.pallet_no, (select vendor_confirmed from oc_order_product where order_id=p.order_id and product_id=pp.product_id) as vendor_confirmed from " . DB_PREFIX . "pallet p left join " . DB_PREFIX . "pallet_product pp using (pallet_id) WHERE p.order_id = '" . (int)$order_id . "' ORDER BY pallet_no");
		//$query = $this->db->query("select p.pallet_no, pp.vendor_confirmed from " . DB_PREFIX . "pallet p left join " . DB_PREFIX . "pallet_product pp using (pallet_id) WHERE p.order_id = '" . (int)$order_id . "' ORDER BY pallet_no");

		return $query->rows;
	}

	public function getConfirmedPalletsIds($order_id) {
		//$palletsIds = $this->db->query("SELECT pallet_no FROM " . DB_PREFIX . "pallet WHERE order_id = '" . (int)$order_id . "' ORDER BY pallet_no");
		//$palletsIds = $this->db->query("select p.pallet_no, (select vendor_confirmed from oc_order_product where order_id=p.order_id and product_id=pp.product_id) as vendor_confirmed from " . DB_PREFIX . "pallet p left join " . DB_PREFIX . "pallet_product pp using (pallet_id) WHERE p.order_id = '" . (int)$order_id . "' ORDER BY pallet_no");
		$query = $this->db->query("select p.pallet_no, pp.vendor_confirmed from " . DB_PREFIX . "pallet p left join " . DB_PREFIX . "pallet_product pp using (pallet_id) WHERE p.order_id = '" . (int)$order_id . "' ORDER BY pallet_no");

		$palletsIds = array();

		foreach ($query->rows as $row) {
			if(!isset($palletsIds[$row['pallet_no']])) {
				$palletId = array();
				$palletId[$row['pallet_no']]['pallet_no'] = $row['pallet_no'];
				$palletId[$row['pallet_no']]['vendor_confirmed'] = $row['vendor_confirmed'];
				$palletsIds = array_merge($palletsIds, $palletId);
			} elseif ($palletsIds[$row['pallet_no']]['vendor_confirmed'] > 0 && $row['vendor_confirmed'] < 1) {
				$palletsIds[$row['pallet_no']]['vendor_confirmed'] = 0;
			}
		}

		return $palletsIds;
	}

	public function getShippedPalletsIds($order_id) {
		//$palletsIds = $this->db->query("SELECT pallet_no FROM " . DB_PREFIX . "pallet WHERE order_id = '" . (int)$order_id . "' ORDER BY pallet_no");
		//$palletsIds = $this->db->query("select p.pallet_no, (select vendor_confirmed from oc_order_product where order_id=p.order_id and product_id=pp.product_id) as vendor_confirmed from " . DB_PREFIX . "pallet p left join " . DB_PREFIX . "pallet_product pp using (pallet_id) WHERE p.order_id = '" . (int)$order_id . "' ORDER BY pallet_no");
		$query = $this->db->query("select p.pallet_no, pp.vendor_confirmed, (select order_status_id from " . DB_PREFIX . "order_product where order_id=p.order_id and product_id=pp.product_id) as order_status_id from " . DB_PREFIX . "pallet p left join " . DB_PREFIX . "pallet_product pp using (pallet_id) WHERE p.order_id = '" . (int)$order_id . "' ORDER BY pallet_no");

		$palletsIds = array();

		foreach ($query->rows as $row) {
			if($row['order_status_id'] == 20) {
				$row['vendor_confirmed'] = 1;
			} else {
				$row['vendor_confirmed'] = 0;
			}
			if(!isset($palletsIds[$row['pallet_no']])) {
				$palletId = array();
				$palletId[$row['pallet_no']]['pallet_no'] = $row['pallet_no'];
				$palletId[$row['pallet_no']]['vendor_confirmed'] = $row['vendor_confirmed'];
				$palletsIds = array_merge($palletsIds, $palletId);
			} elseif ($palletsIds[$row['pallet_no']]['vendor_confirmed'] > 0 && $row['vendor_confirmed'] < 1) {
				$palletsIds[$row['pallet_no']]['vendor_confirmed'] = 0;
			}
		}

		return $palletsIds;
	}



















	public function getPallet($worksheet_id, $customer_id) {
		$palletId = $this->db->query("SELECT pallet_id FROM " . DB_PREFIX . "pallet WHERE worksheet_id = '" . (int)$worksheet_id . "' AND customer_id = '" . (int)$customer_id . "' AND locked='0'");
		if(isset($palletId->row['pallet_id'])) {
			return $palletId->row['pallet_id'];
		} else if (!$this->hasPallets($worksheet_id)) {
			return $this->addPallet($worksheet_id, $customer_id);
		}
	}

	public function getPalletSize($pallet_id) {
		$palletSize = $this->db->query("SELECT pallet_size FROM " . DB_PREFIX . "pallet WHERE pallet_id = '" . (int)$pallet_id . "'");
		if(isset($palletSize->row['pallet_size'])) {
			return $palletSize->row['pallet_size'];
		}
	}

	public function lockPallet($pallet_id, $customer_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "pallet SET locked='1' WHERE pallet_id = '" . (int)$pallet_id . "' AND customer_id = '" . (int)$customer_id . "'");
	}





	public function unlockPallet($pallet_id, $customer_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "pallet SET locked='1' WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("UPDATE " . DB_PREFIX . "pallet SET locked='0' WHERE pallet_id = '" . (int)$pallet_id . "' AND customer_id = '" . (int)$customer_id . "'");
	}





	public function hasProducts($pallet_id) {
		$hasProducts = $this->db->query("SELECT SUM(quantity) AS qty FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "'");
		return $hasProducts->row['qty'];
	}



	public function getPalletData($pallet_id) {
		$pallet = $this->db->query("SELECT * FROM " . DB_PREFIX . "pallet WHERE pallet_id = '" . (int)$pallet_id . "'");
		return $pallet->row;
	}

	public function getPalletStatusData($pallet_id, $customer_id) {
		$data = array();
		$totalRow = $this->db->query("SELECT SUM(total) AS total FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "'");
		if(isset($totalRow->row['total'])) {
			$data['total'] = $totalRow->row['total'];
		}
		$casesRow = $this->db->query("SELECT SUM(quantity) AS qty FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "'");
		if(isset($casesRow->row['qty'])) {
			$data['qty'] = $casesRow->row['qty'];
		}
		$vendorsRow = $this->db->query("SELECT vendor_id FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "' GROUP BY vendor_id");
		if(isset($vendorsRow->rows)) {
			$data['vendors'] = count($vendorsRow->rows);
		}
		return $data;
	}
	public function getProductQty($pallet_id, $product_id) {
		$product = $this->db->query("SELECT quantity FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "' AND product_id = '" . (int)$product_id . "'");
		if(isset($product->row['quantity'])) {
			return $product->row['quantity'];
		}
	}





	public function updatePallet($pallet_id, $product_id, $qty = 0) {
		$this->db->query("UPDATE " . DB_PREFIX . "pallet_product SET quantity = '" . (int)$qty . "' WHERE pallet_id = '" . $pallet_id . "' AND product_id = '" . (int)$product_id . "'");
	}

	public function getActivePallet($worksheet_id) {
		$activePallet = $this->db->query("SELECT pallet_id FROM " . DB_PREFIX . "pallet WHERE worksheet_id = '" . (int)$worksheet_id . "' AND locked='0' ");
		if(isset($activePallet->row['pallet_id'])) {
			return $activePallet->row['pallet_id'];
		}
	}

	public function isPalletLocked($pallet_id) {
		$locked = $this->db->query("SELECT locked FROM " . DB_PREFIX . "pallet WHERE pallet_id = '" . (int)$pallet_id . "' AND locked='1' ");
		if(isset($locked->row['locked'])) {
			return $locked->row['locked'];
		}
	}



	public function getBoxesPerVendor($pallet_id, $vendor_id) {
		$vendor = $this->db->query("SELECT vendor_id, sum(quantity) as qty FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . $pallet_id . "' AND vendor_id = '" . $vendor_id . "' GROUP BY vendor_id");
		return $vendor->row;
	}

	public function getVendorsPerPallet($pallet_id) {
		$vendors = $this->db->query("SELECT vendor_id FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . $pallet_id . "' GROUP BY vendor_id");
		return count($vendors->rows);
	}

	public function isVendorInPallet($pallet_id, $vendor_id) {
		$vendors = $this->db->query("SELECT vendor_id FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . $pallet_id . "' AND vendor_id = '". $vendor_id ."'");
		return count($vendors->rows);
	}

	public function updateTotals($pallet_id) {
		$products = $this->db->query("SELECT * FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . (int)$pallet_id . "'");

		foreach ($products->rows as $product) {
			$total = $product['price'] * $product['quantity'];
			$this->db->query("UPDATE " . DB_PREFIX . "pallet_product SET total = '" . (int)$total . "' WHERE pallet_id = '" . $pallet_id . "' AND product_id = '" . (int)$product['product_id'] . "'");
		}
	}

	public function getTotals($pallet_id) {
		$total = $this->db->query("SELECT SUM(total) AS total FROM " . DB_PREFIX . "pallet_product WHERE pallet_id = '" . $pallet_id . "'");
		return $total->row['total'];
	}

	public function getShipping($worksheet_id) {
		$pallets = $this->db->query("SELECT count(*) AS pallets FROM " . DB_PREFIX . "pallet WHERE worksheet_id = '" . $worksheet_id . "'");
		return $pallets->row['pallets'];
	}

	public function getWorksheetTotals($worksheet_id) {
		$total = $this->db->query("SELECT SUM(op.total) AS total FROM " . DB_PREFIX . "pallet p LEFT JOIN " . DB_PREFIX . "pallet_product op ON (p.pallet_id=op.pallet_id) WHERE worksheet_id = '" . $worksheet_id . "'");
		return $total->row['total'];
	}

	public function addOrder($data) {
		$this->event->trigger('pre.order.add', $data);

		$this->db->query("INSERT INTO `" . DB_PREFIX . "order` SET invoice_prefix = '" . $this->db->escape($data['invoice_prefix']) . "', store_id = '" . (int)$data['store_id'] . "', store_name = '" . $this->db->escape($data['store_name']) . "', store_url = '" . $this->db->escape($data['store_url']) . "', customer_id = '" . (int)$data['customer_id'] . "', customer_group_id = '" . (int)$data['customer_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? serialize($data['custom_field']) : '') . "', payment_firstname = '" . $this->db->escape($data['payment_firstname']) . "', payment_lastname = '" . $this->db->escape($data['payment_lastname']) . "', payment_company = '" . $this->db->escape($data['payment_company']) . "', payment_address_1 = '" . $this->db->escape($data['payment_address_1']) . "', payment_address_2 = '" . $this->db->escape($data['payment_address_2']) . "', payment_city = '" . $this->db->escape($data['payment_city']) . "', payment_postcode = '" . $this->db->escape($data['payment_postcode']) . "', payment_country = '" . $this->db->escape($data['payment_country']) . "', payment_country_id = '" . (int)$data['payment_country_id'] . "', payment_zone = '" . $this->db->escape($data['payment_zone']) . "', payment_zone_id = '" . (int)$data['payment_zone_id'] . "', payment_address_format = '" . $this->db->escape($data['payment_address_format']) . "', payment_custom_field = '" . $this->db->escape(isset($data['payment_custom_field']) ? serialize($data['payment_custom_field']) : '') . "', payment_method = '" . $this->db->escape($data['payment_method']) . "', payment_code = '" . $this->db->escape($data['payment_code']) . "', shipping_firstname = '" . $this->db->escape($data['shipping_firstname']) . "', shipping_lastname = '" . $this->db->escape($data['shipping_lastname']) . "', shipping_company = '" . $this->db->escape($data['shipping_company']) . "', shipping_address_1 = '" . $this->db->escape($data['shipping_address_1']) . "', shipping_address_2 = '" . $this->db->escape($data['shipping_address_2']) . "', shipping_city = '" . $this->db->escape($data['shipping_city']) . "', shipping_postcode = '" . $this->db->escape($data['shipping_postcode']) . "', shipping_country = '" . $this->db->escape($data['shipping_country']) . "', shipping_country_id = '" . (int)$data['shipping_country_id'] . "', shipping_zone = '" . $this->db->escape($data['shipping_zone']) . "', shipping_zone_id = '" . (int)$data['shipping_zone_id'] . "', shipping_address_format = '" . $this->db->escape($data['shipping_address_format']) . "', shipping_custom_field = '" . $this->db->escape(isset($data['shipping_custom_field']) ? serialize($data['shipping_custom_field']) : '') . "', shipping_method = '" . $this->db->escape($data['shipping_method']) . "', shipping_code = '" . $this->db->escape($data['shipping_code']) . "', comment = '" . $this->db->escape($data['comment']) . "', total = '" . (float)$data['total'] . "', affiliate_id = '" . (int)$data['affiliate_id'] . "', commission = '" . (float)$data['commission'] . "', marketing_id = '" . (int)$data['marketing_id'] . "', tracking = '" . $this->db->escape($data['tracking']) . "', language_id = '" . (int)$data['language_id'] . "', currency_id = '" . (int)$data['currency_id'] . "', currency_code = '" . $this->db->escape($data['currency_code']) . "', currency_value = '" . (float)$data['currency_value'] . "', ip = '" . $this->db->escape($data['ip']) . "', forwarded_ip = '" .  $this->db->escape($data['forwarded_ip']) . "', user_agent = '" . $this->db->escape($data['user_agent']) . "', accept_language = '" . $this->db->escape($data['accept_language']) . "', date_added = NOW(), date_modified = NOW()");

		$order_id = $this->db->getLastId();

		// Products
		if (isset($data['products'])) {
			foreach ($data['products'] as $product) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET order_id = '" . (int)$order_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $this->db->escape($product['name']) . "', model = '" . $this->db->escape($product['model']) . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "', tax = '" . (float)$product['tax'] . "', reward = '" . (int)$product['reward'] . "'");

				$order_product_id = $this->db->getLastId();

				foreach ($product['option'] as $option) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "order_option SET order_id = '" . (int)$order_id . "', order_product_id = '" . (int)$order_product_id . "', product_option_id = '" . (int)$option['product_option_id'] . "', product_option_value_id = '" . (int)$option['product_option_value_id'] . "', name = '" . $this->db->escape($option['name']) . "', `value` = '" . $this->db->escape($option['value']) . "', `type` = '" . $this->db->escape($option['type']) . "'");
				}
			}
		}

		// Gift Voucher
		$this->load->model('checkout/voucher');

		// Vouchers
		if (isset($data['vouchers'])) {
			foreach ($data['vouchers'] as $voucher) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_voucher SET order_id = '" . (int)$order_id . "', description = '" . $this->db->escape($voucher['description']) . "', code = '" . $this->db->escape($voucher['code']) . "', from_name = '" . $this->db->escape($voucher['from_name']) . "', from_email = '" . $this->db->escape($voucher['from_email']) . "', to_name = '" . $this->db->escape($voucher['to_name']) . "', to_email = '" . $this->db->escape($voucher['to_email']) . "', voucher_theme_id = '" . (int)$voucher['voucher_theme_id'] . "', message = '" . $this->db->escape($voucher['message']) . "', amount = '" . (float)$voucher['amount'] . "'");

				$order_voucher_id = $this->db->getLastId();

				$voucher_id = $this->model_checkout_voucher->addVoucher($order_id, $voucher);

				$this->db->query("UPDATE " . DB_PREFIX . "order_voucher SET voucher_id = '" . (int)$voucher_id . "' WHERE order_voucher_id = '" . (int)$order_voucher_id . "'");
			}
		}

		// Totals
		if (isset($data['totals'])) {
			foreach ($data['totals'] as $total) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_total SET order_id = '" . (int)$order_id . "', code = '" . $this->db->escape($total['code']) . "', title = '" . $this->db->escape($total['title']) . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "'");
			}
		}

		$this->event->trigger('post.order.add', $order_id);

		return $order_id;
	}

	public function editOrder($order_id, $data) {
		$this->event->trigger('pre.order.edit', $data);

		// Void the order first
		$this->addOrderHistory($order_id, 0);

		$this->db->query("UPDATE `" . DB_PREFIX . "order` SET invoice_prefix = '" . $this->db->escape($data['invoice_prefix']) . "', store_id = '" . (int)$data['store_id'] . "', store_name = '" . $this->db->escape($data['store_name']) . "', store_url = '" . $this->db->escape($data['store_url']) . "', customer_id = '" . (int)$data['customer_id'] . "', customer_group_id = '" . (int)$data['customer_group_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(serialize($data['custom_field'])) . "', payment_firstname = '" . $this->db->escape($data['payment_firstname']) . "', payment_lastname = '" . $this->db->escape($data['payment_lastname']) . "', payment_company = '" . $this->db->escape($data['payment_company']) . "', payment_address_1 = '" . $this->db->escape($data['payment_address_1']) . "', payment_address_2 = '" . $this->db->escape($data['payment_address_2']) . "', payment_city = '" . $this->db->escape($data['payment_city']) . "', payment_postcode = '" . $this->db->escape($data['payment_postcode']) . "', payment_country = '" . $this->db->escape($data['payment_country']) . "', payment_country_id = '" . (int)$data['payment_country_id'] . "', payment_zone = '" . $this->db->escape($data['payment_zone']) . "', payment_zone_id = '" . (int)$data['payment_zone_id'] . "', payment_address_format = '" . $this->db->escape($data['payment_address_format']) . "', payment_custom_field = '" . $this->db->escape(serialize($data['payment_custom_field'])) . "', payment_method = '" . $this->db->escape($data['payment_method']) . "', payment_code = '" . $this->db->escape($data['payment_code']) . "', shipping_firstname = '" . $this->db->escape($data['shipping_firstname']) . "', shipping_lastname = '" . $this->db->escape($data['shipping_lastname']) . "', shipping_company = '" . $this->db->escape($data['shipping_company']) . "', shipping_address_1 = '" . $this->db->escape($data['shipping_address_1']) . "', shipping_address_2 = '" . $this->db->escape($data['shipping_address_2']) . "', shipping_city = '" . $this->db->escape($data['shipping_city']) . "', shipping_postcode = '" . $this->db->escape($data['shipping_postcode']) . "', shipping_country = '" . $this->db->escape($data['shipping_country']) . "', shipping_country_id = '" . (int)$data['shipping_country_id'] . "', shipping_zone = '" . $this->db->escape($data['shipping_zone']) . "', shipping_zone_id = '" . (int)$data['shipping_zone_id'] . "', shipping_address_format = '" . $this->db->escape($data['shipping_address_format']) . "', shipping_custom_field = '" . $this->db->escape(serialize($data['shipping_custom_field'])) . "', shipping_method = '" . $this->db->escape($data['shipping_method']) . "', shipping_code = '" . $this->db->escape($data['shipping_code']) . "', comment = '" . $this->db->escape($data['comment']) . "', total = '" . (float)$data['total'] . "', affiliate_id = '" . (int)$data['affiliate_id'] . "', commission = '" . (float)$data['commission'] . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "'");

		// Products
		if (isset($data['products'])) {
			foreach ($data['products'] as $product) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_product SET order_id = '" . (int)$order_id . "', product_id = '" . (int)$product['product_id'] . "', name = '" . $this->db->escape($product['name']) . "', model = '" . $this->db->escape($product['model']) . "', quantity = '" . (int)$product['quantity'] . "', price = '" . (float)$product['price'] . "', total = '" . (float)$product['total'] . "', tax = '" . (float)$product['tax'] . "', reward = '" . (int)$product['reward'] . "'");

				$order_product_id = $this->db->getLastId();

				foreach ($product['option'] as $option) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "order_option SET order_id = '" . (int)$order_id . "', order_product_id = '" . (int)$order_product_id . "', product_option_id = '" . (int)$option['product_option_id'] . "', product_option_value_id = '" . (int)$option['product_option_value_id'] . "', name = '" . $this->db->escape($option['name']) . "', `value` = '" . $this->db->escape($option['value']) . "', `type` = '" . $this->db->escape($option['type']) . "'");
				}
			}
		}

		// Gift Voucher
		$this->load->model('checkout/voucher');

		$this->model_checkout_voucher->disableVoucher($order_id);

		// Vouchers
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_voucher WHERE order_id = '" . (int)$order_id . "'");

		if (isset($data['vouchers'])) {
			foreach ($data['vouchers'] as $voucher) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_voucher SET order_id = '" . (int)$order_id . "', description = '" . $this->db->escape($voucher['description']) . "', code = '" . $this->db->escape($voucher['code']) . "', from_name = '" . $this->db->escape($voucher['from_name']) . "', from_email = '" . $this->db->escape($voucher['from_email']) . "', to_name = '" . $this->db->escape($voucher['to_name']) . "', to_email = '" . $this->db->escape($voucher['to_email']) . "', voucher_theme_id = '" . (int)$voucher['voucher_theme_id'] . "', message = '" . $this->db->escape($voucher['message']) . "', amount = '" . (float)$voucher['amount'] . "'");

				$order_voucher_id = $this->db->getLastId();

				$voucher_id = $this->model_checkout_voucher->addVoucher($order_id, $voucher);

				$this->db->query("UPDATE " . DB_PREFIX . "order_voucher SET voucher_id = '" . (int)$voucher_id . "' WHERE order_voucher_id = '" . (int)$order_voucher_id . "'");
			}
		}

		// Totals
		$this->db->query("DELETE FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "'");

		if (isset($data['totals'])) {
			foreach ($data['totals'] as $total) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "order_total SET order_id = '" . (int)$order_id . "', code = '" . $this->db->escape($total['code']) . "', title = '" . $this->db->escape($total['title']) . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "'");
			}
		}

		$this->event->trigger('post.order.edit', $order_id);
	}

	public function deleteOrder($order_id) {
		$this->event->trigger('pre.order.delete', $order_id);

		// Void the order first
		$this->addOrderHistory($order_id, 0);

		$this->db->query("DELETE FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_option` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_voucher` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_history` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_fraud` WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE `or`, ort FROM `" . DB_PREFIX . "order_recurring` `or`, `" . DB_PREFIX . "order_recurring_transaction` `ort` WHERE order_id = '" . (int)$order_id . "' AND ort.order_recurring_id = `or`.order_recurring_id");

		$this->db->query("DELETE FROM `" . DB_PREFIX . "affiliate_transaction` WHERE order_id = '" . (int)$order_id . "'");

		// Gift Voucher
		$this->load->model('checkout/voucher');

		$this->model_checkout_voucher->disableVoucher($order_id);

		$this->event->trigger('post.order.delete', $order_id);
	}

	public function getOrder($order_id) {
		$order_query = $this->db->query("SELECT *, (SELECT os.name FROM `" . DB_PREFIX . "order_status` os WHERE os.order_status_id = o.order_status_id AND os.language_id = o.language_id) AS order_status FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['payment_country_id'] . "'");

			if ($country_query->num_rows) {
				$payment_iso_code_2 = $country_query->row['iso_code_2'];
				$payment_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$payment_iso_code_2 = '';
				$payment_iso_code_3 = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['payment_zone_id'] . "'");

			if ($zone_query->num_rows) {
				$payment_zone_code = $zone_query->row['code'];
			} else {
				$payment_zone_code = '';
			}

			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['shipping_country_id'] . "'");

			if ($country_query->num_rows) {
				$shipping_iso_code_2 = $country_query->row['iso_code_2'];
				$shipping_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$shipping_iso_code_2 = '';
				$shipping_iso_code_3 = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['shipping_zone_id'] . "'");

			if ($zone_query->num_rows) {
				$shipping_zone_code = $zone_query->row['code'];
			} else {
				$shipping_zone_code = '';
			}

			$this->load->model('localisation/language');

			$language_info = $this->model_localisation_language->getLanguage($order_query->row['language_id']);

			if ($language_info) {
				$language_code = $language_info['code'];
				$language_directory = $language_info['directory'];
			} else {
				$language_code = '';
				$language_directory = '';
			}

			return array(
				'order_id'                => $order_query->row['order_id'],
				'invoice_no'              => $order_query->row['invoice_no'],
				'invoice_prefix'          => $order_query->row['invoice_prefix'],
				'store_id'                => $order_query->row['store_id'],
				'store_name'              => $order_query->row['store_name'],
				'store_url'               => $order_query->row['store_url'],
				'customer_id'             => $order_query->row['customer_id'],
				'firstname'               => $order_query->row['firstname'],
				'lastname'                => $order_query->row['lastname'],
				'email'                   => $order_query->row['email'],
				'telephone'               => $order_query->row['telephone'],
				'fax'                     => $order_query->row['fax'],
				'custom_field'            => unserialize($order_query->row['custom_field']),
				'payment_firstname'       => $order_query->row['payment_firstname'],
				'payment_lastname'        => $order_query->row['payment_lastname'],
				'payment_company'         => $order_query->row['payment_company'],
				'payment_address_1'       => $order_query->row['payment_address_1'],
				'payment_address_2'       => $order_query->row['payment_address_2'],
				'payment_postcode'        => $order_query->row['payment_postcode'],
				'payment_city'            => $order_query->row['payment_city'],
				'payment_zone_id'         => $order_query->row['payment_zone_id'],
				'payment_zone'            => $order_query->row['payment_zone'],
				'payment_zone_code'       => $payment_zone_code,
				'payment_country_id'      => $order_query->row['payment_country_id'],
				'payment_country'         => $order_query->row['payment_country'],
				'payment_iso_code_2'      => $payment_iso_code_2,
				'payment_iso_code_3'      => $payment_iso_code_3,
				'payment_address_format'  => $order_query->row['payment_address_format'],
				'payment_custom_field'    => unserialize($order_query->row['payment_custom_field']),
				'payment_method'          => $order_query->row['payment_method'],
				'payment_code'            => $order_query->row['payment_code'],
				'shipping_firstname'      => $order_query->row['shipping_firstname'],
				'shipping_lastname'       => $order_query->row['shipping_lastname'],
				'shipping_company'        => $order_query->row['shipping_company'],
				'shipping_address_1'      => $order_query->row['shipping_address_1'],
				'shipping_address_2'      => $order_query->row['shipping_address_2'],
				'shipping_postcode'       => $order_query->row['shipping_postcode'],
				'shipping_city'           => $order_query->row['shipping_city'],
				'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
				'shipping_zone'           => $order_query->row['shipping_zone'],
				'shipping_zone_code'      => $shipping_zone_code,
				'shipping_country_id'     => $order_query->row['shipping_country_id'],
				'shipping_country'        => $order_query->row['shipping_country'],
				'shipping_iso_code_2'     => $shipping_iso_code_2,
				'shipping_iso_code_3'     => $shipping_iso_code_3,
				'shipping_address_format' => $order_query->row['shipping_address_format'],
				'shipping_custom_field'   => unserialize($order_query->row['shipping_custom_field']),
				'shipping_method'         => $order_query->row['shipping_method'],
				'shipping_code'           => $order_query->row['shipping_code'],
				'comment'                 => $order_query->row['comment'],
				'total'                   => $order_query->row['total'],
				'order_status_id'         => $order_query->row['order_status_id'],
				'order_status'            => $order_query->row['order_status'],
				'affiliate_id'            => $order_query->row['affiliate_id'],
				'commission'              => $order_query->row['commission'],
				'language_id'             => $order_query->row['language_id'],
				'language_code'           => $language_code,
				'language_directory'      => $language_directory,
				'currency_id'             => $order_query->row['currency_id'],
				'currency_code'           => $order_query->row['currency_code'],
				'currency_value'          => $order_query->row['currency_value'],
				'ip'                      => $order_query->row['ip'],
				'forwarded_ip'            => $order_query->row['forwarded_ip'],
				'user_agent'              => $order_query->row['user_agent'],
				'accept_language'         => $order_query->row['accept_language'],
				'date_modified'           => $order_query->row['date_modified'],
				'date_added'              => $order_query->row['date_added']
			);
		} else {
			return false;
		}
	}

	public function addOrderHistory($order_id, $order_status_id, $comment = '', $notify = false) {
		$this->event->trigger('pre.order.history.add', $order_id);

		$order_info = $this->getOrder($order_id);

		$this->log->write("addOrderHistory admin/model/pallet/worksheet.php");

		if ($order_info) {
			// Fraud Detection
			$this->load->model('account/customer');

			$customer_info = $this->model_account_customer->getCustomer($order_info['customer_id']);

			if ($customer_info && $customer_info['safe']) {
				$safe = true;
			} else {
				$safe = false;
			}

			if ($this->config->get('config_fraud_detection')) {
				$this->load->model('checkout/fraud');

				$risk_score = $this->model_checkout_fraud->getFraudScore($order_info);

				if (!$safe && $risk_score > $this->config->get('config_fraud_score')) {
					$order_status_id = $this->config->get('config_fraud_status_id');
				}
			}

			// Ban IP
			if (!$safe) {
				$status = false;

				if ($order_info['customer_id']) {
					$results = $this->model_account_customer->getIps($order_info['customer_id']);

					foreach ($results as $result) {
						if ($this->model_account_customer->isBanIp($result['ip'])) {
							$status = true;

							break;
						}
					}
				} else {
					$status = $this->model_account_customer->isBanIp($order_info['ip']);
				}

				if ($status) {
					$order_status_id = $this->config->get('config_order_status_id');
				}
			}

			$this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . (int)$order_status_id . "', date_modified = NOW() WHERE order_id = '" . (int)$order_id . "'");

			$this->db->query("INSERT INTO " . DB_PREFIX . "order_history SET order_id = '" . (int)$order_id . "', order_status_id = '" . (int)$order_status_id . "', notify = '" . (int)$notify . "', comment = '" . $this->db->escape($comment) . "', date_added = NOW()");

			// If current order status is not processing or complete but new status is processing or complete then commence completing the order
			if (!in_array($order_info['order_status_id'], array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status'))) && in_array($order_status_id, array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status')))) {
				// Stock subtraction
				$order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

				foreach ($order_product_query->rows as $order_product) {
					$this->db->query("UPDATE " . DB_PREFIX . "product SET quantity = (quantity - " . (int)$order_product['quantity'] . ") WHERE product_id = '" . (int)$order_product['product_id'] . "' AND subtract = '1'");

					$order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product['order_product_id'] . "'");

					foreach ($order_option_query->rows as $option) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET quantity = (quantity - " . (int)$order_product['quantity'] . ") WHERE product_option_value_id = '" . (int)$option['product_option_value_id'] . "' AND subtract = '1'");
					}
				}

				// Redeem coupon, vouchers and reward points
				$order_total_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order ASC");

				foreach ($order_total_query->rows as $order_total) {
					$this->load->model('total/' . $order_total['code']);

					if (method_exists($this->{'model_total_' . $order_total['code']}, 'confirm')) {
						$this->{'model_total_' . $order_total['code']}->confirm($order_info, $order_total);
					}
				}

				// Add commission if sale is linked to affiliate referral.
				if ($order_info['affiliate_id'] && $this->config->get('config_affiliate_auto')) {
					$this->load->model('affiliate/affiliate');

					$this->model_affiliate_affiliate->addTransaction($order_info['affiliate_id'], $order_info['commission'], $order_id);
				}
			}

			// If old order status is the processing or complete status but new status is not then commence restock, and remove coupon, voucher and reward history
			if (in_array($order_info['order_status_id'], array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status'))) && !in_array($order_status_id, array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status')))) {
				// Restock
				$product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

				foreach($product_query->rows as $product) {
					$this->db->query("UPDATE `" . DB_PREFIX . "product` SET quantity = (quantity + " . (int)$product['quantity'] . ") WHERE product_id = '" . (int)$product['product_id'] . "' AND subtract = '1'");

					$option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$product['order_product_id'] . "'");

					foreach ($option_query->rows as $option) {
						$this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET quantity = (quantity + " . (int)$product['quantity'] . ") WHERE product_option_value_id = '" . (int)$option['product_option_value_id'] . "' AND subtract = '1'");
					}
				}

				// Remove coupon, vouchers and reward points history
				$this->load->model('account/order');

				$order_total_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order ASC");

				foreach ($order_total_query->rows as $order_total) {
					$this->load->model('total/' . $order_total['code']);

					if (method_exists($this->{'model_total_' . $order_total['code']}, 'unconfirm')) {
						$this->{'model_total_' . $order_total['code']}->unconfirm($order_id);
					}
				}

				// Remove commission if sale is linked to affiliate referral.
				if ($order_info['affiliate_id']) {
					$this->load->model('affiliate/affiliate');

					$this->model_affiliate_affiliate->deleteTransaction($order_id);
				}
			}

			$this->cache->delete('product');

			// If order status is 0 then becomes greater than 0 send main html email
			if (!$order_info['order_status_id'] && $order_status_id) {
				// Check for any downloadable products
				$download_status = false;

				$order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

				foreach ($order_product_query->rows as $order_product) {
					// Check if there are any linked downloads
					$product_download_query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "product_to_download` WHERE product_id = '" . (int)$order_product['product_id'] . "'");

					if ($product_download_query->row['total']) {
						$download_status = true;
					}
				}

				// Load the language for any mails that might be required to be sent out
				$language = new Language($order_info['language_directory']);
				$language->load('default');
				$language->load('mail/order');

				$order_status_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'");

				if ($order_status_query->num_rows) {
					$order_status = $order_status_query->row['name'];
				} else {
					$order_status = '';
				}

				$subject = sprintf($language->get('text_new_subject'), $order_info['store_name'], $order_id);

				// HTML Mail
				$data = array();

				$data['title'] = sprintf($language->get('text_new_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);

				$data['text_greeting'] = sprintf($language->get('text_new_greeting'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'));
				$data['text_link'] = $language->get('text_new_link');
				$data['text_download'] = $language->get('text_new_download');
				$data['text_order_detail'] = $language->get('text_new_order_detail');
				$data['text_instruction'] = $language->get('text_new_instruction');
				$data['text_order_id'] = $language->get('text_new_order_id');
				$data['text_date_added'] = $language->get('text_new_date_added');
				$data['text_payment_method'] = $language->get('text_new_payment_method');
				$data['text_shipping_method'] = $language->get('text_new_shipping_method');
				$data['text_email'] = $language->get('text_new_email');
				$data['text_telephone'] = $language->get('text_new_telephone');
				$data['text_ip'] = $language->get('text_new_ip');
				$data['text_order_status'] = $language->get('text_new_order_status');
				$data['text_payment_address'] = $language->get('text_new_payment_address');
				$data['text_shipping_address'] = $language->get('text_new_shipping_address');
				$data['text_product'] = $language->get('text_new_product');
				$data['text_model'] = $language->get('text_new_model');
				$data['text_quantity'] = $language->get('text_new_quantity');
				$data['text_price'] = $language->get('text_new_price');
				$data['text_total'] = $language->get('text_new_total');
				$data['text_footer'] = $language->get('text_new_footer');

				$data['logo'] = $this->config->get('config_url') . 'image/' . $this->config->get('config_logo');
				$data['store_name'] = $order_info['store_name'];
				$data['store_url'] = $order_info['store_url'];
				$data['customer_id'] = $order_info['customer_id'];
				$data['link'] = $order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id;

				if ($download_status) {
					$data['download'] = $order_info['store_url'] . 'index.php?route=account/download';
				} else {
					$data['download'] = '';
				}

				$data['order_id'] = $order_id;
				$data['date_added'] = date($language->get('date_format_short'), strtotime($order_info['date_added']));
				$data['payment_method'] = $order_info['payment_method'];
				$data['shipping_method'] = $order_info['shipping_method'];
				$data['email'] = $order_info['email'];
				$data['telephone'] = $order_info['telephone'];
				$data['ip'] = $order_info['ip'];
				$data['order_status'] = $order_status;

				if ($comment && $notify) {
					$data['comment'] = nl2br($comment);
				} else {
					$data['comment'] = '';
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

				$data['payment_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

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

				$data['shipping_address'] = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$this->load->model('tool/upload');

				// Products
				$data['products'] = array();

				foreach ($order_product_query->rows as $product) {
					$option_data = array();

					$order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$product['order_product_id'] . "'");

					foreach ($order_option_query->rows as $option) {
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
							'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value)
						);
					}

					$data['products'][] = array(
						'name'     => $product['name'],
						'model'    => $product['model'],
						'option'   => $option_data,
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
					);
				}

				// Vouchers
				$data['vouchers'] = array();

				$order_voucher_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_voucher WHERE order_id = '" . (int)$order_id . "'");

				foreach ($order_voucher_query->rows as $voucher) {
					$data['vouchers'][] = array(
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']),
					);
				}

				// Order Totals
				$order_total_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order ASC");

				foreach ($order_total_query->rows as $total) {
					$data['totals'][] = array(
						'title' => $total['title'],
						'text'  => $this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']),
					);
				}

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/order.tpl')) {
					$html = $this->load->view($this->config->get('config_template') . '/template/mail/order.tpl', $data);
				} else {
					$html = $this->load->view('default/template/mail/order.tpl', $data);
				}

				// Can not send confirmation emails for CBA orders as email is unknown
				$this->load->model('payment/amazon_checkout');

				if (!$this->model_payment_amazon_checkout->isAmazonOrder($order_info['order_id'])) {
					// Text Mail
					$text  = sprintf($language->get('text_new_greeting'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8')) . "\n\n";
					$text .= $language->get('text_new_order_id') . ' ' . $order_id . "\n";
					$text .= $language->get('text_new_date_added') . ' ' . date($language->get('date_format_short'), strtotime($order_info['date_added'])) . "\n";
					$text .= $language->get('text_new_order_status') . ' ' . $order_status . "\n\n";

					if ($comment && $notify) {
						$text .= $language->get('text_new_instruction') . "\n\n";
						$text .= $comment . "\n\n";
					}

					// Products
					$text .= $language->get('text_new_products') . "\n";

					foreach ($order_product_query->rows as $product) {
						$text .= $product['quantity'] . 'x ' . $product['name'] . ' (' . $product['model'] . ') ' . html_entity_decode($this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']), ENT_NOQUOTES, 'UTF-8') . "\n";

						$order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . $product['order_product_id'] . "'");

						foreach ($order_option_query->rows as $option) {
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

							$text .= chr(9) . '-' . $option['name'] . ' ' . (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value) . "\n";
						}
					}

					foreach ($order_voucher_query->rows as $voucher) {
						$text .= '1x ' . $voucher['description'] . ' ' . $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']);
					}

					$text .= "\n";

					$text .= $language->get('text_new_order_total') . "\n";

					foreach ($order_total_query->rows as $total) {
						$text .= $total['title'] . ': ' . html_entity_decode($this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']), ENT_NOQUOTES, 'UTF-8') . "\n";
					}

					$text .= "\n";

					if ($order_info['customer_id']) {
						$text .= $language->get('text_new_link') . "\n";
						$text .= $order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id . "\n\n";
					}

					if ($download_status) {
						$text .= $language->get('text_new_download') . "\n";
						$text .= $order_info['store_url'] . 'index.php?route=account/download' . "\n\n";
					}

					// Comment
					if ($order_info['comment']) {
						$text .= $language->get('text_new_comment') . "\n\n";
						$text .= $order_info['comment'] . "\n\n";
					}

					$text .= $language->get('text_new_footer') . "\n\n";

					$mail = new Mail();
					$mail->protocol = $this->config->get('config_mail_protocol');
					$mail->parameter = $this->config->get('config_mail_parameter');
					$mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
					$mail->smtp_username = $this->config->get('config_mail_smtp_username');
					$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
					$mail->smtp_port = $this->config->get('config_mail_smtp_port');
					$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

					$mail->setTo($order_info['email']);
					$mail->setFrom($this->config->get('config_email'));
					$mail->setSender($order_info['store_name']);
					$mail->setSubject($subject);
					$mail->setHtml($html);
					$mail->setText($text);
					$mail->send();
				}

				// Admin Alert Mail
				if ($this->config->get('config_order_mail')) {
					$subject = sprintf($language->get('text_new_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'), $order_id);

					// HTML Mail
					$data['text_greeting'] = $language->get('text_new_received');

					if ($comment) {
						if ($order_info['comment']) {
							$data['comment'] = nl2br($comment) . '<br/><br/>' . $order_info['comment'];
						} else {
							$data['comment'] = nl2br($comment);
						}
					} else {
						if ($order_info['comment']) {
							$data['comment'] = $order_info['comment'];
						} else {
							$data['comment'] = '';
						}
					}
					$data['text_download'] = '';

					$data['text_footer'] = '';

					$data['text_link'] = '';
					$data['link'] = '';
					$data['download'] = '';

					if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/order.tpl')) {
						$html = $this->load->view($this->config->get('config_template') . '/template/mail/order.tpl', $data);
					} else {
						$html = $this->load->view('default/template/mail/order.tpl', $data);
					}

					// Text
					$text  = $language->get('text_new_received') . "\n\n";
					$text .= $language->get('text_new_order_id') . ' ' . $order_id . "\n";
					$text .= $language->get('text_new_date_added') . ' ' . date($language->get('date_format_short'), strtotime($order_info['date_added'])) . "\n";
					$text .= $language->get('text_new_order_status') . ' ' . $order_status . "\n\n";
					$text .= $language->get('text_new_products') . "\n";

					foreach ($order_product_query->rows as $product) {
						$text .= $product['quantity'] . 'x ' . $product['name'] . ' (' . $product['model'] . ') ' . html_entity_decode($this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']), ENT_NOQUOTES, 'UTF-8') . "\n";

						$order_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . $product['order_product_id'] . "'");

						foreach ($order_option_query->rows as $option) {
							if ($option['type'] != 'file') {
								$value = $option['value'];
							} else {
								$value = utf8_substr($option['value'], 0, utf8_strrpos($option['value'], '.'));
							}

							$text .= chr(9) . '-' . $option['name'] . ' ' . (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value) . "\n";
						}
					}

					foreach ($order_voucher_query->rows as $voucher) {
						$text .= '1x ' . $voucher['description'] . ' ' . $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']);
					}

					$text .= "\n";

					$text .= $language->get('text_new_order_total') . "\n";

					foreach ($order_total_query->rows as $total) {
						$text .= $total['title'] . ': ' . html_entity_decode($this->currency->format($total['value'], $order_info['currency_code'], $order_info['currency_value']), ENT_NOQUOTES, 'UTF-8') . "\n";
					}

					$text .= "\n";

					if ($order_info['comment']) {
						$text .= $language->get('text_new_comment') . "\n\n";
						$text .= $order_info['comment'] . "\n\n";
					}

					$mail = new Mail();
					$mail->protocol = $this->config->get('config_mail_protocol');
					$mail->parameter = $this->config->get('config_mail_parameter');
					$mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
					$mail->smtp_username = $this->config->get('config_mail_smtp_username');
					$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
					$mail->smtp_port = $this->config->get('config_mail_smtp_port');
					$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

					$mail->setTo($this->config->get('config_email'));
					$mail->setFrom($this->config->get('config_email'));
					$mail->setReplyTo($order_info['email']);
					$mail->setSender($order_info['store_name']);
					$mail->setSubject($subject);
					$mail->setHtml($html);
					$mail->setText($text);
					$mail->send();

					// Send to additional alert emails
					$emails = explode(',', $this->config->get('config_mail_alert'));

					foreach ($emails as $email) {
						if ($email && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
							$mail->setTo($email);
							$mail->send();
						}
					}
				}
			}

			// If order status is not 0 then send update text email
			if ($order_info['order_status_id'] && $order_status_id && $notify) {
				$language = new Language($order_info['language_directory']);
				$language->load('default');
				$language->load('mail/order');

				$subject = sprintf($language->get('text_update_subject'), html_entity_decode($order_info['store_name'], ENT_QUOTES, 'UTF-8'), $order_id);

				$message  = $language->get('text_update_order') . ' ' . $order_id . "\n";
				$message .= $language->get('text_update_date_added') . ' ' . date($language->get('date_format_short'), strtotime($order_info['date_added'])) . "\n\n";

				$order_status_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_status WHERE order_status_id = '" . (int)$order_status_id . "' AND language_id = '" . (int)$order_info['language_id'] . "'");

				if ($order_status_query->num_rows) {
					$message .= $language->get('text_update_order_status') . "\n\n";
					$message .= $order_status_query->row['name'] . "\n\n";
				}

				if ($order_info['customer_id']) {
					$message .= $language->get('text_update_link') . "\n";
					$message .= $order_info['store_url'] . 'index.php?route=account/order/info&order_id=' . $order_id . "\n\n";
				}

				if ($comment) {
					$message .= $language->get('text_update_comment') . "\n\n";
					$message .= strip_tags($comment) . "\n\n";
				}

				$message .= $language->get('text_update_footer');

				$mail = new Mail();
				$mail->protocol = $this->config->get('config_mail_protocol');
				$mail->parameter = $this->config->get('config_mail_parameter');
				$mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
				$mail->smtp_username = $this->config->get('config_mail_smtp_username');
				$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
				$mail->smtp_port = $this->config->get('config_mail_smtp_port');
				$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

				$mail->setTo($order_info['email']);
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender($order_info['store_name']);
				$mail->setSubject($subject);
				$mail->setText($message);
				$mail->send();
			}

			// If order status in the complete range create any vouchers that where in the order need to be made available.
			if (in_array($order_info['order_status_id'], $this->config->get('config_complete_status'))) {
				// Send out any gift voucher mails
				$this->load->model('checkout/voucher');

				$this->model_checkout_voucher->confirm($order_id);
			}
		}

		$this->event->trigger('post.order.history.add', $order_id);
	}
 //zighia   
    public function updatePrices($data){
        $product_id = $data['product_id'];
        //update prices in pallets
        //get all worksheets without order_id
        $sql = "SELECT * FROM `".DB_PREFIX ."worksheet` WHERE `order_id` IS NULL";
        $query = $this->db->query($sql);
		 
        if ($query->num_rows) {
             foreach ($query->rows as $row){
                 $new_price = $data['price'];
                     
                 if ($data['fob_price']>0){
                        $new_price = $data['sp_price']*$data['pf'];
                 }
                 $total_quantity  = $this->getWorksheetProductQty((int)$row['worksheet_id'], $product_id);
                 $discount = $this->getProductDiscount($product_id,$total_quantity);
                 $pallets = $this->getPallets((int)$row['worksheet_id']);
                 
                 if (count ($discount)){
                         $new_price = $discount['price'];
                 }
                 else{
                     if (count($data['product_special'])){
                         $new_price = $data['product_special'][0]['sp_price']*$data['pf'];
                     }
                         
                 }
                 
                 if (count($pallets))
                 foreach ($pallets as $pallet_id){
                  $this->db->query("update `".DB_PREFIX ."pallet_product` set `price`=".$new_price.",
                       `total`= `quantity`*`price` where order_id is null and `pallet_id`=".$pallet_id." and `product_id`=".$product_id);
                  
                   }
             }
        }
    }
    
         public function getWorksheetProductQty($worksheet_id, $product_id){
        $query = $this->db->query("SELECT sum(quantity) as total_quantity FROM `" . DB_PREFIX . "pallet_product` pp  left join oc_pallet p on p.pallet_id=pp.pallet_id WHERE product_id=".$product_id." and worksheet_id=".$worksheet_id);
		return ($query->row['total_quantity'] == null)?0:(int)$query->row['total_quantity'];

    }
     public function getProductDiscount($product_id, $quantity=9999999) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . 
          (int)$product_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') .
           "' AND quantity <= ".$quantity.
           " AND ((date_start = '0000-00-00' OR date_start < NOW())
            AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity desc limit 0,1");
          
		return $query->row;
	}

}
