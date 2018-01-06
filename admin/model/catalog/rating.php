<?php
class ModelCatalograting extends Model {
	public function addrating($data) {
		$this->event->trigger('pre.admin.rating.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "rating SET order_id = '" . $this->db->escape($data['order_id']) . "', author = '" . $this->db->escape($data['author']) . "', vendor_id = '" . (int)$data['vendor_id'] . "', rating = '" . (int)$data['rating_vendor'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$rating_id = $this->db->getLastId();

		$this->cache->delete('vendor');

		$this->event->trigger('post.admin.rating.add', $rating_id);

		return $rating_id;
	}

	public function editrating($rating_id, $data) {
		$this->event->trigger('pre.admin.rating.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "rating SET order_id = '" . $this->db->escape($data['order_id']) . "', author = '" . $this->db->escape($data['author']) . "', vendor_id = '" . (int)$data['vendor_id'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating_vendor'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE rating_id = '" . (int)$rating_id . "'");

		$this->cache->delete('vendor');

		$this->event->trigger('post.admin.rating.edit', $rating_id);
	}

	public function deleterating($rating_id) {
		$this->event->trigger('pre.admin.rating.delete', $rating_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "rating WHERE rating_id = '" . (int)$rating_id . "'");

		$this->cache->delete('vendor');

		$this->event->trigger('post.admin.rating.delete', $rating_id);
	}

	public function getrating($rating_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT v.vendor_name FROM " . DB_PREFIX . "vendors v WHERE v.vendor_id = r.vendor_id ) AS vendor FROM " . DB_PREFIX . "rating r WHERE r.rating_id = '" . (int)$rating_id . "'");

		return $query->row;
	}

	public function getratings($data = array()) {
		$sql = "SELECT r.rating_id, r.order_id,v.vendor_name, r.author, r.rating, r.status, r.date_added FROM " . DB_PREFIX . "rating r LEFT JOIN " . DB_PREFIX . "vendors v ON (r.vendor_id = v.vendor_id) WHERE 1=1";

		if (!empty($data['filter_vendor'])) {
			$sql .= " AND v.vendor_name LIKE '" . $this->db->escape($data['filter_vendor']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sort_data = array(
			'v.vendor_name',
			'r.author',
			'r.rating',
			'r.status',
			'r.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.date_added";
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

	public function getTotalRatings($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "rating r LEFT JOIN " . DB_PREFIX . "vendors v ON (r.vendor_id = v.vendor_id) where 1=1";

		if (!empty($data['filter_vendor'])) {
			$sql .= " AND v.vendor_name LIKE '" . $this->db->escape($data['filter_vendor']) . "%'";
		}

		if (!empty($data['filter_author'])) {
			$sql .= " AND r.author LIKE '" . $this->db->escape($data['filter_author']) . "%'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND r.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}

	public function getTotalratingsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "rating WHERE status = '0'");

		return $query->row['total'];
	}
}