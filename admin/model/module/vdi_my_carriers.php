<?php
class ModelModuleVdiMyCarriers extends Model {
	public function getCarriers($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "carrier WHERE vendor_id = '". (int)$this->user->getVP() ."' ORDER BY name ASC";

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

	public function getCarrier($carrier_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "carrier WHERE vendor_id = '". (int)$this->user->getVP() ."' AND carrier_id = '" . (int)$carrier_id . "'");

		return $query->row;
	}

	public function getTotalCarriers($data = array()) {
		$sql = "SELECT COUNT(DISTINCT carrier_id) AS total FROM " . DB_PREFIX . "carrier WHERE vendor_id = '". (int)$this->user->getVP() ."'";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function addCarrier($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "carrier SET vendor_id = '" . (int)$this->user->getVP() . "', name = '" . $this->db->escape($data['name']) . "', address = '" . $this->db->escape($data['address']) . "', city = '" . $this->db->escape($data['city']) . "', postal_code = '" . $this->db->escape($data['postal_code']) . "', phone = '" . $this->db->escape($data['phone']) . "', email = '" . $this->db->escape($data['email']) . "'");
	}

	public function updateCarrier($data) {
		$this->db->query("UPDATE " . DB_PREFIX . "carrier SET name = '" . $this->db->escape($data['name']) . "', address = '" . $this->db->escape($data['address']) . "', city = '" . $this->db->escape($data['city']) . "', postal_code = '" . $this->db->escape($data['postal_code']) . "', phone = '" . $this->db->escape($data['phone']) . "', email = '" . $this->db->escape($data['email']) . "' WHERE vendor_id = '" . (int)$this->user->getVP() . "' AND carrier_id = '" . (int)$data['carrier_id'] . "'");
	}

	public function deleteCarrier($data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "carrier WHERE vendor_id = '" . (int)$this->user->getVP() . "' AND carrier_id = '" . (int)$data['carrier_id'] . "'");
	}

	public function getCarriersDropdown() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "carrier WHERE vendor_id = '" . (int)$this->user->getVP() . "' ORDER BY name ASC");

		return $query->rows;
	}
}
