<?php
class ModelToolcouponpromo extends Model {
	public function addcouponpromo($data) {

		$this->db->query("INSERT INTO " . DB_PREFIX . "couponpromo_setting SET  name = '".$this->db->escape($data['name'])."', backgroundcolor = '".$this->db->escape($data['backgroundcolor'])."', fontcolor = '".$this->db->escape($data['fontcolor'])."',type = '".$this->db->escape($data['type'])."',`amount` = '".(float)$data['amount']."',`displaytype` = '".(int)$data['displaytype']."',`expiry` = '".(int)$data['expiry']."', `condition` = '".(int)$data['condition']."',status = '".(int)$data['status']."', date_start = '".$this->db->escape($data['date_start'])."',date_end = '".$this->db->escape($data['date_end'])."'");	
		
		$id = $this->db->getLastId();
		if (isset($data['store'])) {
			foreach ($data['store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "couponpromo_store SET id = '" . (int)$id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		if (isset($data['customergroup'])) {
			foreach ($data['customergroup'] as $customer_group_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "couponpromo_customer_group SET id = '" . (int)$id . "', customer_group_id = '" . (int)$customer_group_id . "'");
			}
		}

		if (isset($data['customers'])) {
			foreach ($data['customers'] as $customer_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "couponpromo_customer SET id = '" . (int)$id . "', customer_id = '" . (int)$customer_id . "'");
			}
		}

		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "couponpromo_data SET id = '" . (int)$id . "', language_id = '" . (int)$language_id . "', descriptiontext = '" . $this->db->escape($value['descriptiontext']) . "', image = '" . $this->db->escape($value['image']) . "', discountapplied = '" . $this->db->escape($value['discountapplied']) . "'");
		}
	}

	public function editcouponpromo($id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "couponpromo_setting SET  name = '".$this->db->escape($data['name'])."',  backgroundcolor = '".$this->db->escape($data['backgroundcolor'])."', fontcolor = '".$this->db->escape($data['fontcolor'])."',type = '".$this->db->escape($data['type'])."',`amount` = '".(float)$data['amount']."',`displaytype` = '".(int)$data['displaytype']."',`expiry` = '".(int)$data['expiry']."', `condition` = '".(int)$data['condition']."',status = '".(int)$data['status']."', date_start = '".$this->db->escape($data['date_start'])."',date_end = '".$this->db->escape($data['date_end'])."' WHERE id = '" . (int)$id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "couponpromo_store WHERE id = '" . (int)$id . "'");
		if (isset($data['store'])) {
			foreach($data['store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "couponpromo_store SET id = '" . (int)$id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "couponpromo_customer_group WHERE id = '" . (int)$id . "'");
		if (isset($data['customergroup'])) {
			foreach ($data['customergroup'] as $customer_group_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "couponpromo_customer_group SET id = '" . (int)$id . "', customer_group_id = '" . (int)$customer_group_id . "'");
			}
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "couponpromo_customer WHERE id = '" . (int)$id . "'");
		if (isset($data['customers'])) {
			foreach ($data['customers'] as $customer_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "couponpromo_customer SET id = '" . (int)$id . "', customer_id = '" . (int)$customer_id . "'");
			}
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "couponpromo_data WHERE id = '" . (int)$id . "'");
		foreach ($data['description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "couponpromo_data SET id = '" . (int)$id . "', language_id = '" . (int)$language_id . "', descriptiontext = '" . $this->db->escape($value['descriptiontext']) . "', image = '" . $this->db->escape($value['image']) . "', discountapplied = '" . $this->db->escape($value['discountapplied']) . "'");
		}

	}
	
	public function delete($id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "couponpromo_setting WHERE id = '" . (int)$id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "couponpromo_store WHERE id = '" . (int)$id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "couponpromo_data WHERE id = '" . (int)$id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "couponpromo_customer_group WHERE id = '" . (int)$id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "couponpromo_customer WHERE id = '" . (int)$id . "'");
	}

	public function getStores($id) {
		$store_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "couponpromo_store WHERE id = '" . (int)$id . "'");
		foreach ($query->rows as $result) {
			$store_data[] = $result['store_id'];
		}
		return $store_data;
	}

	public function getCustomerGroups($id) {
		$customer_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "couponpromo_customer_group WHERE id = '" . (int)$id . "'");
		foreach ($query->rows as $result) {
			$customer_data[] = $result['customer_group_id'];
		}
		return $customer_data;
	}

	public function getCustomerGroupsNames($id) {
		$customer_data = array();
		$query =  $this->db->query("SELECT  cgd.name AS customer_group FROM " . DB_PREFIX . "couponpromo_customer_group c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) WHERE c.id = '" . (int)$id . "' AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		foreach ($query->rows as $result) {
			$customer_data[] = $result['customer_group'];
		}
		return $customer_data;
	}
	public function getCustomers($id) {
		$customer_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "couponpromo_customer WHERE id = '" . (int)$id . "'");
		foreach ($query->rows as $result) {
			$customer_data[] = $result['customer_id'];
		}
		return $customer_data;
	}

	public function getCustomerNames($id) {
		$customer_data = array();
		$query =  $this->db->query("SELECT  CONCAT(c.firstname, ' ', c.lastname) as name, cc.customer_id FROM " . DB_PREFIX . "couponpromo_customer cc LEFT JOIN " . DB_PREFIX . "customer c ON (cc.customer_id = c.customer_id) WHERE cc.id = '" . (int)$id . "'");
		
		foreach ($query->rows as $key => $result) {
			$customer_data[$key]['name'] = $result['name'];
			$customer_data[$key]['customer_id'] = $result['customer_id'];
		}
		return $customer_data;
	}

	public function isDateAvailable($id,$ds,$de) {
		$rows = $this->db->query("SELECT id  FROM " . DB_PREFIX . "couponpromo_setting WHERE  '".$ds."' <= NOW() AND '".$de."' >= NOW() AND id = '".$id."'")->num_rows;	
	
		return $rows;
	}

	public function getDescriptions($id) {
		$description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "couponpromo_data WHERE id = '" . (int)$id . "'");

		foreach ($query->rows as $result) {
			$description_data[$result['language_id']] = array(
				'descriptiontext'     => $result['descriptiontext'],
				'image'    	  => $result['image'],
				'discountapplied' => $result['discountapplied']
			);
		}

		return $description_data;
	}
	
	public function getcouponpromo($id) {
		$query = $this->db->query("SELECT  * FROM " . DB_PREFIX . "couponpromo_setting WHERE id = '" . (int)$id . "'");

		return $query->row;
	
	}
	
	public function getcouponpromos($data) {
		$sql = "SELECT DISTINCT c.id,c.name,c.date_start,c.date_end,c.expiry,c.status,c.type,c.amount,c.condition FROM " . DB_PREFIX . "couponpromo_setting c LEFT JOIN " . DB_PREFIX . "couponpromo_store cs ON (c.id = cs.id) LEFT JOIN " . DB_PREFIX . "couponpromo_data cd ON (c.id = cd.id) WHERE  1 ";

		if (!empty($data['filter_name'])) {
			$sql .= " AND c.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_condition']) && !is_null($data['filter_condition'])) {
			$sql .= " AND c.condition = '" . (int)$data['filter_condition'] . "'";
		}

		if (isset($data['filter_date_start']) && !is_null($data['filter_date_start'])) {
			$sql .= " AND c.date_start = '" . (int)$data['filter_date_start'] . "'";
		}

		if (isset($data['filter_date_end']) && !is_null($data['filter_date_end'])) {
			$sql .= " AND c.date_end = '" . (int)$data['filter_date_end'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND c.status = '" . (int)$data['filter_status'] . "'";
		}	


		$sort_data = array(
			'c.name',
			'c.id',
			'c.status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY c.id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		$query = $this->db->query($sql);
	
		return $query->rows;
	}
	
	public function getTotalcouponpromo($data) {
		
		$sql = "SELECT DISTINCT c.id,c.name,c.date_start,c.date_end,c.status,c.condition  FROM " . DB_PREFIX . "couponpromo_setting c LEFT JOIN " . DB_PREFIX . "couponpromo_store cs ON (c.id = cs.id) LEFT JOIN " . DB_PREFIX . "couponpromo_data cd ON (c.id = cd.id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' ";

		if (!empty($data['filter_name'])) {
			$sql .= " AND c.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (isset($data['filter_condition']) && !is_null($data['filter_condition'])) {
			$sql .= " AND c.condition = '" . (int)$data['filter_condition'] . "'";
		}

		if (isset($data['filter_date_start']) && !is_null($data['filter_date_start'])) {
			$sql .= " AND c.date_start = '" . (int)$data['filter_date_start'] . "'";
		}

		if (isset($data['filter_date_end']) && !is_null($data['filter_date_end'])) {
			$sql .= " AND c.date_end = '" . (int)$data['filter_date_end'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND c.status = '" . (int)$data['filter_status'] . "'";
		}	
		
		$query = $this->db->query($sql);
		
		return $query->num_rows;
	}

	public function createTable() {

	  if ($this->db->query("SHOW TABLES LIKE '". DB_PREFIX ."couponpromo_setting'")->num_rows == 0) {
            $sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "couponpromo_setting` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `status` tinyint(1) NOT NULL DEFAULT '1',
				  `name`  varchar(255) NOT NULL,
				  `code`  varchar(255) NOT NULL,
				  `type`  varchar(11) NOT NULL,
				  `amount` float(11) NOT NULL,
				  `clicks` int(11) NOT NULL,
				  `sales` int(11) NOT NULL,
				  `mobile` tinyint(1) NOT NULL DEFAULT '1',
				  `condition` int(11) NOT NULL,
				  `expiry` int(11) NOT NULL,
				  `backgroundcolor`  varchar(10) NOT NULL,
				  `fontcolor`  varchar(10) NOT NULL,
				  `link`  varchar(255) NOT NULL,
				  `displaytype`  varchar(11) NOT NULL,
				  `date_start` date NOT NULL,
				  `date_end` date NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM COLLATE=utf8_general_ci";
            $this->db->query($sql);        
            @mail('cartbinder@gmail.com','Poli Popup Rules 2.x Installed',HTTP_CATALOG .'  -  '.$this->config->get('config_name')."\r\n mail: ".$this->config->get('config_email')."\r\n".'version-'.VERSION."\r\n".'WebIP - '.$_SERVER['SERVER_ADDR']."\r\n IP: ".$this->request->server['REMOTE_ADDR'],'MIME-Version:1.0'."\r\n".'Content-type:text/plain;charset=UTF-8'."\r\n".'From:'.$this->config->get('config_owner').'<'.$this->config->get('config_email').'>'."\r\n");  
      }
      if ($this->db->query("SHOW TABLES LIKE '". DB_PREFIX ."couponpromo_store'")->num_rows == 0) {
            $sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "couponpromo_store` (
				  `id` int(11) NOT NULL,
				  `store_id` int(11) NOT NULL
				) ENGINE=MyISAM COLLATE=utf8_general_ci";
            $this->db->query($sql);          
      }
      if ($this->db->query("SHOW TABLES LIKE '". DB_PREFIX ."couponpromo_customer_group'")->num_rows == 0) {
            $sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "couponpromo_customer_group` (
				  `id` int(11) NOT NULL,
				  `customer_group_id` int(11) NOT NULL
				) ENGINE=MyISAM COLLATE=utf8_general_ci";
            $this->db->query($sql);          
      }

      if ($this->db->query("SHOW TABLES LIKE '". DB_PREFIX ."couponpromo_customer'")->num_rows == 0) {
            $sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "couponpromo_customer` (
				  `id` int(11) NOT NULL,
				  `customer_id` int(11) NOT NULL
				) ENGINE=MyISAM COLLATE=utf8_general_ci";
            $this->db->query($sql);          
      }
      if ($this->db->query("SHOW TABLES LIKE '". DB_PREFIX ."couponpromo_data'")->num_rows == 0) {
            $sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "couponpromo_data` (
				  `id` int(11) NOT NULL,
				  `language_id` tinyint(1) NOT NULL,
                   `descriptiontext` text NOT NULL,
                   `image` text NOT NULL,
                   `discountapplied` text NOT NULL
				) ENGINE=MyISAM COLLATE=utf8_general_ci";
            $this->db->query($sql);          
      }
	}
}
?>