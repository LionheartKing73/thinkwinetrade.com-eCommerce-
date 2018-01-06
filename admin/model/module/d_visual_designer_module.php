<?php
/*
*	location: admin/model
*/

class ModelModuleDVisualDesignerModule extends Model {
	
	public function ajax($link){
		return str_replace('&amp;', '&', $link);
	}
		
	public function getGroupId(){
        if(VERSION == '2.0.0.0'){
            $user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . $this->user->getId() . "'");
            $user_group_id = (int)$user_query->row['user_group_id'];
        }else{
            $user_group_id = $this->user->getGroupId();
        }

        return $user_group_id;
    }
	
	public function getLink($route,$args,$catalog = false){
		$https = $this->request->server['HTTPS'];
		if(!empty($https)){
			if($catalog){
				$url = HTTPS_CATALOG;
			}else {
				$url = HTTPS_SERVER;
			}
		}
		else{
			if($catalog){
				$url = HTTP_CATALOG;
			}else {
				$url = HTTP_SERVER;
			}
		}
		
		$url .= 'index.php?route=' . $route;
		
		if ($args) {
			if (is_array($args)) {
				$url .= '&amp;' . http_build_query($args);
			} else {
				$url .= str_replace('&', '&amp;', '&' . ltrim($args, '&'));
			}
		}
		
		return $url;
	}
	
}