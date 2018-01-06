<?php
class ModelCatalogAttribute extends Model {

                    public function getAttributesListing() {
                        $sql = "SELECT *, (SELECT agd.name FROM " . DB_PREFIX . "attribute_group_description agd WHERE agd.attribute_group_id = a.attribute_group_id AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS attribute_group FROM " . DB_PREFIX . "attribute a LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order ASC";
                        
                        $query = $this->db->query($sql);

                        foreach($query->rows as &$row) {        
                            $type = $this->getAttributeType($row['attribute_type']);

                            if(@$type['multilingual'] == 1) {

                                $row['values'] = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_value_description avd LEFT JOIN " . DB_PREFIX . "attribute_value_to_attribute ava ON avd.attribute_value_id = ava.attribute_value_id WHERE ava.attribute_id = '" . (int)$row['attribute_id'] . "' AND avd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY avd.name ASC")->rows;

                            } else if(@$type['ranged'] == 1) {

                                $row['ranges'] = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_value_range avd LEFT JOIN " . DB_PREFIX . "attribute_value_to_attribute ava ON avd.attribute_value_id = ava.attribute_value_id WHERE ava.attribute_id = '" . (int)$row['attribute_id'] . "'")->row;
                            
                            }

                        }


                        return $query->rows;
                    }
                    public function addAttributeType($data) {

                        $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_type SET sort_order = '" . (int)$data['sort_order'] . "', name = '" . $this->db->escape($value['name']) . "'");

                        $attribute_type_id = $this->db->getLastId();

                        return $attribute_type_id;
                    }

                    public function editAttributeType($attribute_type_id, $data) {

                        $this->db->query("UPDATE " . DB_PREFIX . "attribute_type SET sort_order = '" . (int)$data['sort_order'] . "', name = '" . $this->db->escape($value['name']) . "' WHERE attribute_type_id = '" . (int)$attribute_type_id . "'");

                    }

                    public function deleteAttributeType($attribute_type_id) {

                        $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_type WHERE attribute_type_id = '" . (int)$attribute_type_id . "'");

                    }

                    public function getAttributeType($attribute_type_id) {
                        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_type WHERE attribute_type_id = '" . (int)$attribute_type_id . "'");

                        return $query->row;
                    }

                    public function getAttributeTypes() {
                        $sql = "SELECT * FROM " . DB_PREFIX . "attribute_type ORDER BY sort_order";
                        
                        $query = $this->db->query($sql);

                        return $query->rows;
                    }
                    public function addAttributeValue($data) {

                        $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value SET sort_order = '" . (int)$data['sort_order'] . "'");

                        $attribute_value_id = $this->db->getLastId();

                        $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value_to_attribute SET attribute_id = '" . (int)$data['attribute_id'] . "', attribute_value_id = '" . (int)$data['attribute_value_id'] . "'");

                        foreach ($data['attribute_value_description'] as $language_id => $value) {
                            $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value_description SET attribute_value_id = '" . (int)$attribute_value_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
                        }

                        return $attribute_value_id;
                    }

                    public function editAttributeValue($attribute_value_id, $data) {

                        $this->db->query("UPDATE " . DB_PREFIX . "attribute_value SET sort_order = '" . (int)$data['sort_order'] . "' WHERE attribute_value_id = '" . (int)$attribute_value_id . "'");

                        $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_value_description WHERE attribute_value_id = '" . (int)$attribute_value_id . "'");

                        foreach ($data['attribute_value_description'] as $language_id => $value) {
                            $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value_description SET attribute_value_id = '" . (int)$attribute_value_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
                        }

                    }

                    public function deleteAttributeValue($attribute_value_id) {

                        $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_value WHERE attribute_value_id = '" . (int)$attribute_value_id . "'");
                        $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_value_description WHERE attribute_value_id = '" . (int)$attribute_value_id . "'");
                        $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_value_to_attribute WHERE attribute_value_id = '" . (int)$attribute_value_id . "'");

                    }

                    public function getAttributeValue($attribute_value_id) {
                        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_value WHERE attribute_value_id = '" . (int)$attribute_value_id . "'");

                        return $query->row;
                    }

                    public function getAttributeValues($attribute_id) {
                        $sql = "SELECT * FROM " . DB_PREFIX . "attribute_value av LEFT JOIN " . DB_PREFIX . "attribute_value_to_attribute ava ON (av.attribute_value_id = ava.attribute_value_id) WHERE ava.attribute_id = '".$attribute_id."'";

                        $query = $this->db->query($sql);

                        foreach($query->rows as &$row) {
                            $row['attribute_value_description'] = $this->getAttributeValueDescriptions($row['attribute_value_id']);
                        }


                        return $query->rows;
                    }

                    public function getAttributeRanges($attribute_id) {
                        $sql = "SELECT * FROM " . DB_PREFIX . "attribute_value av LEFT JOIN " . DB_PREFIX . "attribute_value_to_attribute ava ON (av.attribute_value_id = ava.attribute_value_id) WHERE ava.attribute_id = '".$attribute_id."'";

                        $data = $this->db->query($sql)->row;

                        if($data) {
                            $return = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_value_range WHERE attribute_value_id = '" . (int)$data['attribute_value_id'] . "'")->row;
                        } else {
                            $return = array();
                        }

                        return $return;
                    }

                    public function getAttributeValueDescriptions($attribute_value_id) {
                        $attribute_value_data = array();

                        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_value_description WHERE attribute_value_id = '" . (int)$attribute_value_id . "'");

                        foreach ($query->rows as $result) {
                            $attribute_value_data[$result['language_id']] = array('name' => $result['name']);
                        }

                        return $attribute_value_data;
                    }
                
	public function addAttribute($data) {
		$this->event->trigger('pre.admin.attribute.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "attribute SET attribute_group_id = '" . (int)$data['attribute_group_id'] . "', sort_order = '" . (int)$data['sort_order'] . "'");

		$attribute_id = $this->db->getLastId();


              $this->db->query("UPDATE " . DB_PREFIX . "attribute SET attribute_type = '" . (int)$data['attribute_type_id'] . "' WHERE attribute_id = '" . (int)$attribute_id . "'");
              
		foreach ($data['attribute_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . (int)$attribute_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->event->trigger('post.admin.attribute.add', $attribute_id);

		return $attribute_id;
	}

	public function editAttribute($attribute_id, $data) {
		$this->event->trigger('pre.admin.attribute.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "attribute SET attribute_group_id = '" . (int)$data['attribute_group_id'] . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE attribute_id = '" . (int)$attribute_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "attribute_description WHERE attribute_id = '" . (int)$attribute_id . "'");


              $this->db->query("UPDATE " . DB_PREFIX . "attribute SET attribute_type = '" . (int)$data['attribute_type_id'] . "' WHERE attribute_id = '" . (int)$attribute_id . "'");
              
		foreach ($data['attribute_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_description SET attribute_id = '" . (int)$attribute_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

$this->updateAttributeValues($attribute_id, $data);
		$this->event->trigger('post.admin.attribute.edit', $attribute_id);
	}

    
    private function updateAttributeValues($attribute_id, $data) {
        
        $type = $this->getAttributeType($data['attribute_type_id']);

        if($type['multilingual'] == 1) {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_value_description avd LEFT JOIN " . DB_PREFIX . "attribute_value_to_attribute ava ON avd.attribute_value_id = ava.attribute_value_id WHERE ava.attribute_id = '" . (int)$attribute_id . "'");
            
            foreach($query->rows as $result) {
                $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_value_description WHERE attribute_value_id = '" . (int)$result['attribute_value_id'] . "'");
            }

            $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_value_to_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

            foreach ($data['attribute_value'] as $k => $v) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value SET sort_order = '0'");

                $attribute_value_id = $this->db->getLastId();

                foreach ($v['attribute_value_description'] as $language_id => $value) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value_description SET attribute_value_id = '".$attribute_value_id."', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
                }
                

                $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value_to_attribute SET attribute_value_id = '" . (int)$attribute_value_id . "', attribute_id = '" . (int)$attribute_id . "'");
            }
        } else if($type['ranged'] == 1) {
            
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_value_range avd LEFT JOIN " . DB_PREFIX . "attribute_value_to_attribute ava ON avd.attribute_value_id = ava.attribute_value_id WHERE ava.attribute_id = '" . (int)$attribute_id . "'");
            
            foreach($query->rows as $result) {
                $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_value_range WHERE attribute_value_id = '" . (int)$result['attribute_value_id'] . "'");
            }

            $this->db->query("DELETE FROM " . DB_PREFIX . "attribute_value_to_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

            $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value SET sort_order = '0'");

            $attribute_value_id = $this->db->getLastId();

            $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value_range SET attribute_value_id = '".$attribute_value_id."', range_from = '" . (int)$data['attribute_range']['range_from'] . "', range_to = '" . (int)$data['attribute_range']['range_to'] . "', range_step = '" . (float)$data['attribute_range']['range_step'] . "'");

            $this->db->query("INSERT INTO " . DB_PREFIX . "attribute_value_to_attribute SET attribute_value_id = '" . (int)$attribute_value_id . "', attribute_id = '" . (int)$attribute_id . "'");
        
        }

    }
	public function deleteAttribute($attribute_id) {
		$this->event->trigger('pre.admin.attribute.delete', $attribute_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "attribute WHERE attribute_id = '" . (int)$attribute_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "attribute_description WHERE attribute_id = '" . (int)$attribute_id . "'");

		$this->event->trigger('post.admin.attribute.delete', $attribute_id);
	}

	
    public function getAttribute($attribute_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute a LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE a.attribute_id = '" . (int)$attribute_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "'");

        $row = $query->row;
        
        $type = $this->getAttributeType($row['attribute_type']);

        if(@$type['multilingual'] == 1) {

            $row['values'] = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_value_description avd LEFT JOIN " . DB_PREFIX . "attribute_value_to_attribute ava ON avd.attribute_value_id = ava.attribute_value_id WHERE ava.attribute_id = '" . (int)$row['attribute_id'] . "' AND avd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY avd.name ASC")->rows;

        } else if(@$type['ranged'] == 1) {

            $row['ranges'] = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_value_range avd LEFT JOIN " . DB_PREFIX . "attribute_value_to_attribute ava ON avd.attribute_value_id = ava.attribute_value_id WHERE ava.attribute_id = '" . (int)$row['attribute_id'] . "'")->row;
        
        }

        return $row;
    }

            

	public function getAttributes($data = array()) {
		$sql = "SELECT *, (SELECT agd.name FROM " . DB_PREFIX . "attribute_group_description agd WHERE agd.attribute_group_id = a.attribute_group_id AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS attribute_group FROM " . DB_PREFIX . "attribute a LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND ad.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_attribute_group_id'])) {
			$sql .= " AND a.attribute_group_id = '" . $this->db->escape($data['filter_attribute_group_id']) . "'";
		}

		$sort_data = array(
			'ad.name',
			'attribute_group',
			'a.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY attribute_group, ad.name";
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

	public function getAttributeDescriptions($attribute_id) {
		$attribute_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "attribute_description WHERE attribute_id = '" . (int)$attribute_id . "'");

		foreach ($query->rows as $result) {
			$attribute_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $attribute_data;
	}

	public function getAttributesByAttributeGroupId($data = array()) {
		$sql = "SELECT *, (SELECT agd.name FROM " . DB_PREFIX . "attribute_group_description agd WHERE agd.attribute_group_id = a.attribute_group_id AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS attribute_group FROM " . DB_PREFIX . "attribute a LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND ad.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_attribute_group_id'])) {
			$sql .= " AND a.attribute_group_id = '" . $this->db->escape($data['filter_attribute_group_id']) . "'";
		}

		$sort_data = array(
			'ad.name',
			'attribute_group',
			'a.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY ad.name";
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

	public function getTotalAttributes() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "attribute");

		return $query->row['total'];
	}

	public function getTotalAttributesByAttributeGroupId($attribute_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "attribute WHERE attribute_group_id = '" . (int)$attribute_group_id . "'");

		return $query->row['total'];
	}
}