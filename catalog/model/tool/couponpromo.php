<?php
class ModelToolCouponPromo extends Model {
	public function getcouponpromos() {
		$sql = "SELECT c.backgroundcolor,c.fontcolor,cd.image,cd.descriptiontext,cd.discountapplied,c.type,c.id,c.date_start,c.date_end,c.condition,c.expiry,c.displaytype FROM " . DB_PREFIX . "couponpromo_setting c LEFT JOIN " . DB_PREFIX . "couponpromo_store cs ON (c.id = cs.id) LEFT JOIN " . DB_PREFIX . "couponpromo_data cd ON (c.id = cd.id) WHERE  cs.store_id = '" . (int)$this->config->get('config_store_id') . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status = 1 ";	
		
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

	public function isDateAvailable($id,$ds,$de) {
		$rows = $this->db->query("SELECT id  FROM " . DB_PREFIX . "couponpromo_setting WHERE  '".$ds."' <= NOW() AND '".$de."' >= NOW() AND id = '".$id."'")->num_rows;	
	
		return $rows;
	}

	public function updateclick($id) {
		$this->db->query("UPDATE " . DB_PREFIX . "couponpromo_setting SET `clicks` = `clicks` + 1");
	}

	public function successclick() {
		$this->db->query("UPDATE " . DB_PREFIX . "couponpromotion SET `sales` = `sales` + 1 ");
	}
	
	public function getCustomers($id) {
		$customer_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "couponpromo_customer WHERE id = '" . (int)$id . "'");
		foreach ($query->rows as $result) {
			$customer_data[] = $result['customer_id'];
		}
		return $customer_data;
	}

	public function getCustomerGroups($id) {
		$customer_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "couponpromo_customer_group WHERE id = '" . (int)$id . "'");
		foreach ($query->rows as $result) {
			$customer_data[] = $result['customer_group_id'];
		}
		return $customer_data;
	}
}
