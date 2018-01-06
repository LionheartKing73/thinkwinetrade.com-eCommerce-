<?php
class ModelCatalogNotification extends Model {
	public function getOrder($data = array()) {
		$query = $this->db->query("SELECT COUNT(*) as total FROM  `" . DB_PREFIX . "order` WHERE  `date_added` >  now() - INTERVAL 30 SECOND ");
		return $query->row['total'];
	}
	public function getReturn($data = array()) {
		$query = $this->db->query("SELECT COUNT(*) as total FROM  `" . DB_PREFIX . "return` WHERE  `date_added` >  now() - INTERVAL 30 SECOND and opened = 1");
		return $query->row['total'];
	}
	public function getCustomersOnline($data = array()) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_online` WHERE `date_added` >  now() - INTERVAL 30 SECOND");
		return $query->row['total'];
	}
	public function getNewCustomer($data = array()) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM  `" . DB_PREFIX . "customer` WHERE  `date_added` > now() - INTERVAL 30 SECOND");
		return $query->row['total'];
	}
	public function getoutofstock($data = array()) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM  `" . DB_PREFIX . "product` WHERE  `date_modified` >  now() - INTERVAL 30 SECOND AND quantity <= 0");
		return $query->row['total'];
	}
	public function getreview($data = array()) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM  `" . DB_PREFIX . "review` WHERE  `date_added` >  now() - INTERVAL 30 SECOND");
		return $query->row['total'];
	}
	public function getAffiliates($data = array()) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM  `" . DB_PREFIX . "affiliate` WHERE  `date_added` >  now() - INTERVAL 30 SECOND");
		return $query->row['total'];
	}
}
