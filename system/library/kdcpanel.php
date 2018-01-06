<?php
final class kdcpanel {
    private $data = array();	
    public function __construct() {

		global $config;
		global $language;
		global $session;
		 $language_id=$config->get('config_language_id'); 
		 
// Get Theme Name	
	 
//	echo "<pre>"  ;
//	print_r($this->data); 
//	 die();	

if (isset($_SESSION['customer_id'])) {
$this->data['logged'] = 1;
}
else {
$this->data['logged'] = 0;
}		
		
		
    }
	public function Get($key){
		
		if(isset($this->data[$key])){
			return $this->data[$key];
		}
	}
}
?>

