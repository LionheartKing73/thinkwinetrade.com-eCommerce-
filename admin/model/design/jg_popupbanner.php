<?php 
	Class ModelDesignJGPopupBanner extends Model{ //--- Model => MVC ---
		//--- Set setting id ---
		private $module_setting_id = "1";
		
		//--- Set code ---
		private $module_code = "jg_popupbanner_setting";
		
		
		//--- Get common setting ---
		public function get_common_setting($all_data){
			//--- Set data ---
			if(!empty($all_data["output"])){
				$output = $all_data["output"];
			}
			//--- End Set data ---
			
			$all_return_data = array();
			
			//--- Get all dhl setting information ---
			$sql = "select * from `".DB_PREFIX."jg_popupbanner_setting` where `id` = '".$this->module_setting_id."'";
			$rs = $this->db->query($sql);
			$all_return_data["common_setting"] = $rs->rows;
			//--- end Get all dhl setting information ---
			
			
			//--- Get default setting informtion ---
			$sql = "select * from `".DB_PREFIX."setting`  where `code` = '".$this->module_code."'";
			$rs = $this->db->query($sql);
			$all_return_data["setting"] = $rs->rows;			
			//--- end Get default setting information ---
			
			return $all_return_data;
		}
		//--- End Get common setting ---
		
		//--- Update common setting ---
		public function update_common_setting($all_data){
			//--- Set data ---
			$all_post = $all_data["all_post"];
			//--- end Set data ---
			
			$sql = "update `".DB_PREFIX."jg_popupbanner_setting` set 
							`title` = '".$this->db->escape($all_post["title"])."',
							`desc` = '".$this->db->escape($all_post["desc"])."',
							`weblink` = '".$this->db->escape($all_post["weblink"])."',
							`bannerfile` = '".$this->db->escape($all_post["bannerfile"])."',
							`is_popup` = '".$this->db->escape($all_post["is_popup"] == "Y" ? "Y" : "N")."'
							 	where `id` = '".$this->module_setting_id."'";
			$rs = $this->db->query($sql);
		}
		//--- end Update common setting ---
		
		//--- Update default setting [is enable or not] ---
		function update_setting($all_data){
			//--- Set data ---
			$all_post = $all_data["all_post"];
			//--- end Set data ---
			
			$sql = "update `".DB_PREFIX."setting` set  
			  			`value` = '".$this->db->escape($all_post["status"])."'
							where`code` = '".$this->module_code."'";
			$this->db->query($sql);
		}
		//--- end Update default setting [is enable or not]  ---
		
		//---- Install module ---
		public function install(){
			$this->log->write('JG Popup Banner --> Starting install');
			
			//--- Create Table ---
			$sql = "CREATE TABLE `".DB_PREFIX."jg_popupbanner_setting` (
						`id` INT( 11 ) NOT NULL PRIMARY KEY AUTO_INCREMENT,
						`title` VARCHAR( 255 ) NOT NULL ,
						`desc` TEXT COLLATE utf8_unicode_ci NOT NULL,
						`weblink` VARCHAR( 255 )  NOT NULL,
						`bannerfile` VARCHAR( 255 )  NOT NULL,
						`is_popup` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
						`display` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
						`sorting` int(11) NOT NULL,
						`postdate` datetime NOT NULL
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
			$query = $this->db->query($sql);
			//--- End Create Table ---
			
			//--- Create First Record ---
			//--- insert ---
			$sql = "INSERT INTO `".DB_PREFIX."jg_popupbanner_setting` (`id`, `postdate`) VALUES (NULL, '".date("Y-m-d H:i:s")."');";
			$this->db->query($sql);
			//--- End insert ---
			
			//--- get insert id ---
			$this->module_setting_id = $this->db->getLastId();	
			//--- end get insert id ---			
			//--- end Create First Record ---
			
			//--- Create the  default setting [Must] ---
			$sql = "INSERT INTO `".DB_PREFIX."setting` (`code`, `key`, `value`) VALUES ('".$this->module_code."', '".$this->module_code."_status', '1');";
			$this->db->query($sql);
			//--- end Create the defaul setting [Must] ---

			$this->log->write('JG Popup Banner  --> Starting install');
		}
		//---- End Install module ---
		
		//---- Unstall module ---
		public function uninstall(){
			$this->log->write('JG Popup Banner  --> Starting uninstall');
			
			//--- Drop Table ---
			$this->db->query("DROP TABLE `".DB_PREFIX."jg_popupbanner_setting`");
			//--- End Drop Table ---
			
			//--- Drop Setting record ---
			$this->db->query("DELETE FROM `".DB_PREFIX."setting` WHERE  `code` = '".$this->module_code."'");
			//--- end Drop Setting record ---
			
			$this->log->write('JG Popup Banner  --> Completed uninstall');
		}
		//---- End Unstall module ---
	}
?>
