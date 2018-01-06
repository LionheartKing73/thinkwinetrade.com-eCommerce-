<?php 
	Class ModelModuleJGPopupBanner extends Model{ //--- Model => MVC ---
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
	}
?>
