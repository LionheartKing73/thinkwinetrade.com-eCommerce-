<?php

class ModelCatalogCronInventory extends Model {

	
	public function getVendors() {

		

		

			

			
				$query = $this->db->query("SELECT *,v.commission_id AS commission_id, c.commission AS commission,v.sort_order as sort_order FROM " . DB_PREFIX . "vendors v LEFT JOIN " . DB_PREFIX . "commission c ON (v.commission_id = c.commission_id) LEFT JOIN " . DB_PREFIX . "user u ON (v.user_id = u.user_id)");

			

				$vendors_data = $query->rows;



				$this->cache->set('vendor', $vendors_data);

			



			return $vendors_data;

		

	}


	

	
	

	public function getTotalVendors($data = array()) {

		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "vendors";

		$query = $this->db->query($sql);



		return $query->row['total'];

	}

	


	

	public function getVendorsList() {

		$sql = "
			SELECT v.vendor_id,v.vendor_name,v.email 
			FROM " . DB_PREFIX . "vendors v
			LEFT JOIN " . DB_PREFIX . "user u ON (v.user_id = u.user_id) 
			WHERE 
				u.status = 1
				AND
				v.reminder_first = 0
			ORDER BY vendor_id" ;					
		
		$query = $this->db->query($sql);				

		return $query->rows;

	}

			

	public function updateNotification($vendor_id){
		$this->db->query("UPDATE " . DB_PREFIX . "vendors v SET v.reminder_first = '1', v.notification = '1', v.reminder_second_date = NOW() WHERE v.vendor_id = " . $vendor_id);
	}

	public function updateStockValue($product_id,$quantity){
		$this->db->query("UPDATE " . DB_PREFIX . "product p SET p.quantity = '".(int)$quantity."' WHERE p.product_id = ".$product_id);
	}
	
	public function updateStatusStock($vendor_id,$product_id){
		$this->db->query("UPDATE " . DB_PREFIX . "vendor v SET v.update_stock = '1' WHERE v.vendor = " . $vendor_id." AND vproduct_id = ".$product_id);
	}
	
	public function checkStatusStock($vendor_id,$product_id){
		$sql = "SELECT COUNT( vproduct_id ) as total , SUM( update_stock ) as num FROM  ". DB_PREFIX ."vendor WHERE vendor =".$vendor_id;
		$query = $this->db->query($sql);

		$total = $query->row['total'];
		$num = $query->row['num'];
		
		if($total == $num){ return TRUE;} else {return FALSE;}

	}
	
	public function getStatusUpdateStock($vendor_id,$product_id){
		$sql = "SELECT update_stock FROM  ". DB_PREFIX ."vendor WHERE vproduct_id = ".$product_id." AND vendor =".$vendor_id;
		$query = $this->db->query($sql);

		return $query->row['update_stock'];
		
	}
	public function updateNotificationUpdateStock($vendor_id){
		$this->db->query("UPDATE " . DB_PREFIX . "vendors v SET v.reminder_first = 0, v.reminder_second = 0, v.notification = 0 , v.status_vendor_update = 1 WHERE v.vendor_id =". $vendor_id);
		$this->db->query("UPDATE " . DB_PREFIX . "vendor v SET v.update_stock = 0 WHERE v.vendor = " . $vendor_id);
	}

	public function getVendorsListReminder() {

		$sql = "
			SELECT v.vendor_id,v.vendor_name,v.email,v.user_id 
			FROM " . DB_PREFIX . "vendors v
			LEFT JOIN " . DB_PREFIX . "user u ON (v.user_id = u.user_id) 
			WHERE 
				u.status = 1
				AND
				v.reminder_first = 1
				AND
				v.notification = 1
			ORDER BY vendor_id" ;					
		
		$query = $this->db->query($sql);				

		return $query->rows;

	}
	
	public function updateNotificationSecond($vendor_id){
		$this->db->query("UPDATE " . DB_PREFIX . "vendors v SET v.reminder_second = '1' AND v.status_vendor_update = '1',v.reminder_second_date = NOW() WHERE v.vendor_id = " . $vendor_id);
	}
	
	public function getYearProduct($product_id,$language_id=1){
		$language_id = (int)$this->config->get('config_language_id');
		$sql = "SELECT text as year FROM  ". DB_PREFIX ."product_attribute WHERE product_id = ".$product_id." AND attribute_id =13 AND language_id =".$language_id;
		$query = $this->db->query($sql);

		return $query->row['year'];
		
	}
	public function getColorProduct($product_id,$language_id=1){
		$language_id = (int)$this->config->get('config_language_id');
		$sql = "SELECT text as color FROM  ". DB_PREFIX ."product_attribute WHERE product_id = ".$product_id." AND attribute_id =14 AND language_id =".$language_id;
		$query = $this->db->query($sql);

		return $query->row['color'];
		
	}
	
	public function resetcrondb(){
		$this->db->query("UPDATE " . DB_PREFIX . "vendors v SET v.reminder_first = 0, v.reminder_second = 0, v.notification = 0 , v.status_vendor_update = 0 ");
		$this->db->query("UPDATE " . DB_PREFIX . "vendor v SET v.update_stock = 0");
	}
	
	Public function DisabledAllProducts($user_id) {

		$this->db->query("UPDATE " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "vendor v ON (p.product_id = v.vproduct_id) LEFT JOIN " . DB_PREFIX . "vendors vds ON (v.vendor = vds.vendor_id) LEFT JOIN " . DB_PREFIX . "user u ON (vds.user_id = u.user_id) SET p.status = '0' WHERE u.user_id = '" . (int)$this->db->escape($user_id) . "' AND p.status = '1'");

	}
	
	Public function ResetAllProducts($user_id) {

		$this->db->query("UPDATE " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "vendor v ON (p.product_id = v.vproduct_id) LEFT JOIN " . DB_PREFIX . "vendors vds ON (v.vendor = vds.vendor_id) LEFT JOIN " . DB_PREFIX . "user u ON (vds.user_id = u.user_id) SET p.quantity = '0' WHERE u.user_id = '" . (int)$this->db->escape($user_id) . "' AND p.status = '1'");

	}

			

	Public function EnabledAllProducts($user_id) {

		$this->db->query("UPDATE " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "vendor v ON (p.product_id = v.vproduct_id) LEFT JOIN " . DB_PREFIX . "vendors vds ON (v.vendor = vds.vendor_id) LEFT JOIN " . DB_PREFIX . "user u ON (vds.user_id = u.user_id) SET p.status = '1' WHERE u.user_id = '" . (int)$this->db->escape($user_id) . "' AND p.status = '0'");

	}

	Public function get_user_vendor($vendor_id) {
		$sql = "SELECT user_id FROM " . DB_PREFIX . "vendors WHERE vendor_id = ".$vendor_id;
		$query = $this->db->query($sql);

		//mvde

		return $query->row['user_id'];
	}

	public function getUsers($data = array()) {

		$sql = "SELECT * FROM `" . DB_PREFIX . "user`";

		

		//mvds

		if (isset($this->request->get['filter_status']) && !is_null($this->request->get['filter_status'])) {

			$sql .= " WHERE status = '" . (int)$this->request->get['filter_status'] . "'";

		}

		//mvde

		

		$sort_data = array(

			'username',

			'status',

			'date_added'

		);



		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {

			$sql .= " ORDER BY " . $data['sort'];

		} else {

			$sql .= " ORDER BY username";

		}



		if (isset($data['order']) && ($data['order'] == 'DESC')) {

			$sql .= " DESC";

		} else {

			$sql .= " ASC";

		}



		if (isset($data['start']) || isset($data['limit'])) {

			if ($data['start'] < 0) {

				$data['start'] = 0;

			}



			if ($data['limit'] < 1) {

				$data['limit'] = 20;

			}



			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];

		}



		$query = $this->db->query($sql);



		return $query->rows;

	}



	public function getTotalUsers() {

		//$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user`");

		//mvds

		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user`";

		if (isset($this->request->get['filter_status']) && !is_null($this->request->get['filter_status'])) {

			$sql .= " WHERE status = '" . (int)$this->request->get['filter_status'] . "'";

		}

		$query = $this->db->query($sql);

		//mvde

		return $query->row['total'];

	}

	

	
	

	public function getTotalProductVendors($vendor_id) {

		$sql = "SELECT COUNT(vproduct_id) AS total FROM " . DB_PREFIX . "vendor WHERE vendor ='".$vendor_id."'";

		$query = $this->db->query($sql);

		return $query->row['total'];

	}

}

?>