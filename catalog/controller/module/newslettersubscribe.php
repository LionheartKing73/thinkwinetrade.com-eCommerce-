<?php  
class ControllerModuleNewslettersubscribe extends Controller {
  	private $error = array();
	
	

	
	public function subscribe(){
	  $this->language->load('module/newslettersubscribe');
	$language_id= $this->config->get('config_language_id');
	$data['alreadyexist'] = $this->language->get('alreadyexist');
	  $data['subscribed'] = $this->language->get('subscribed');
	
	
			$prefix_eval = "";
		

		
		
		$this->load->model('account/newslettersubscribe');
		
	  		if ( $this->validate()) {
		
			 if(!$this->model_account_newslettersubscribe->checkmailid($this->request->post)){

		   


	
			
				 $this->model_account_newslettersubscribe->subscribe($this->request->post);
	echo('$("'.$prefix_eval.' #subscribe_result").html("<span class=\"alert-success kodesuccess\">'.$data['subscribed'].'</span>");$("'.$prefix_eval.' #subscribe")[0].reset();');
	
			 
		   }else{
				echo('$("'.$prefix_eval.' #subscribe_result").html("<span class=\"alert-danger kodedanger\">'.$data['alreadyexist'].'</span>");$("'.$prefix_eval.' #subscribe")[0].reset();');	 
				
		  }
		   
	  }else{
	    	
			echo('$("'.$prefix_eval.' #subscribe_result").html("<span class=\"alert-danger kodedanger\">'.$this->error['warning'].'</span>")');
		}
		

	}

	private function validate() {
  $this->language->load('module/newslettersubscribe');
     $language_id=$this->config->get('config_language_id');
	 $error_invalid= $this->language->get('error_invalid');
	  $error_name= $this->language->get('error_name');
		



if ((utf8_strlen($this->request->post['subscribe_email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['subscribe_email'])) {
      		$this->error['warning'] = $error_invalid;
    	}

    	
    	if ((utf8_strlen($this->request->post['subscribe_name']) < 1) || (utf8_strlen($this->request->post['subscribe_name']) > 32)) {
      		$this->error['warning'] = $error_name;
    	}

	
		
    	if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
  	}


}
?>