<?php 
class ModelModuleLinkedinLogin extends Model {
	public function __construct($register) {
		if (!defined('IMODULE_ROOT')) define('IMODULE_ROOT', substr(DIR_APPLICATION, 0, strrpos(DIR_APPLICATION, '/', -2)) . '/');
		if (!defined('IMODULE_SERVER_NAME')) define('IMODULE_SERVER_NAME', substr((defined('HTTP_CATALOG') ? HTTP_CATALOG : HTTP_SERVER), 7, strlen((defined('HTTP_CATALOG') ? HTTP_CATALOG : HTTP_SERVER)) - 8));
		$folder_parts = array_values(array_filter(explode('/', HTTP_SERVER)));
		if (!defined('IMODULE_ADMIN_FOLDER')) define('IMODULE_ADMIN_FOLDER', $folder_parts[count($folder_parts) - 1]);
		parent::__construct($register);
	}

	public function getLastModuleByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module` WHERE `code` = '" . $this->db->escape($code) . "' ORDER BY `module_id` DESC");

		return $query->rows;
	}

	public function duplicatedModuleName($name, $module_id=0) {
		if(!empty($module_id)) {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module` WHERE `code` = 'linkedinlogin' AND `name` = '" . $this->db->escape($name) . "' AND `module_id` != '" . $this->db->escape($module_id) . "'");
			return empty($query->rows);
		} else {
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "module` WHERE `code` = 'linkedinlogin' AND `name` = '" . $this->db->escape($name) . "'");
			return empty($query->rows);
		}
	}
	
	public function getSetting($group, $store_id = 0) {
		$data = array(); 
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `group` = '" . $this->db->escape($group) . "'");
		
		foreach ($query->rows as $result) {
			if (!$result['serialized']) {
				$data[$result['key']] = $result['value'];
			} else {
				$data[$result['key']] = unserialize($result['value']);
			}
		}

		return $data;
	}
	
	public function editSetting($group, $data, $store_id = 0) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `group` = '" . $this->db->escape($group) . "'");

		foreach ($data as $key => $value) {
			if (!is_array($value)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `group` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape($value) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET store_id = '" . (int)$store_id . "', `group` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape(serialize($value)) . "', serialized = '1'");
			}
		}
	}
	
	public function deleteSetting($group, $store_id = 0) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE store_id = '" . (int)$store_id . "' AND `group` = '" . $this->db->escape($group) . "'");
	}

	public function is_https($url) {
		set_error_handler(
		    create_function(
		        '$severity, $message, $file, $line',
		        'throw new ErrorException($message, $severity, $severity, $file, $line);'
		    )
		);

		$data = $url;
		
		try {
			$context = stream_context_create(array(
				'http' => array(
					'follow_location' => 1
				)
			));

			$stream = fopen($url, 'r', false, $context);
			$stream_data = stream_get_meta_data($stream);
			fclose($stream);

		    $temp_url = $url;
		    
		    if (!empty($stream_data['wrapper_data'])) {
		    	$iterate = $stream_data['wrapper_data'];
		    	
		    	while (!empty($iterate)) {
		    		$header = array_pop($iterate);
		    		if (stripos($header, "Location:") === 0) {
		    			$temp_url = trim(substr($header, 9));
		    			break;
		    		}
		    	}
		    }

		    $data = $temp_url;
		} catch (Exception $e) {
		    $data = $url;
		}

		$scheme = strtolower(parse_url($data, PHP_URL_SCHEME));

		restore_error_handler();

		return $scheme == 'https';
	}
}
?>