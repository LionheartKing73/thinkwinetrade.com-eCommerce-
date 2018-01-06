<?php
class ModelAccountnewslettersubscribe extends Model {
	public function checkmailid($data) {
  	  
	  $query=$this->db->query("SELECT * FROM " . DB_PREFIX . "subscribe where email_id='".$data['subscribe_email']."' AND store_id='".$this->config->get('config_store_id')."'");
	   return $query->num_rows;
	}
	

	public function subscribe($data) {
	  	   $lccode=$this->config->get('config_language_id');
		      $this->db->query("INSERT INTO " . DB_PREFIX . "subscribe SET store_id='".$this->config->get('config_store_id')."',email_id='".$data['subscribe_email']."',name='".$data['subscribe_name']."',language_id='".$lccode."'");
		

			    
	}
	
 
	
}
?>
