<?php
class ModelModuleMvdCarriers extends Model {
	public function getCarriers($data = array()) {
		$sql = "SELECT c.*, (SELECT vendor_name FROM " . DB_PREFIX . "vendors WHERE vendor_id=c.vendor_id) AS vendor_name FROM " . DB_PREFIX . "carrier c ORDER BY c.name ASC";

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

	public function getTotalCarriers($data = array()) {
		$sql = "SELECT COUNT(DISTINCT carrier_id) AS total FROM " . DB_PREFIX . "carrier";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
}
