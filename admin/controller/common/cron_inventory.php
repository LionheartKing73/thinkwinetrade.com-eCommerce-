<?php
class ControllerCommonCronInventory extends Controller {
	public function index() {
		$this->load->model('catalog/cron_inventory');
		$list_vendors = $this->model_catalog_cron_inventory->getVendorsList();

		foreach($list_vendors as $vendor){

			$this->send_email($vendor['email'],$vendor['vendor_name'],$vendor['vendor_id']);

		}


	}

	public function send_email($email,$name,$vendor_id){

		$this->load->language('catalog/rating_vendor');
		$email_subject = $this->language->get('email_cron_subject');
		$email_dear = $this->language->get('email_cron_dear');
		$email_body = $this->language->get('email_cron_body');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		$mail->setTo('admin@thinkwinetrade.com,'.$email);

		$mail->setFrom('support@thinkwinetrade.com');

		$mail->setSender('support@thinkwinetrade.com');

		$mail->setSubject(html_entity_decode($email_subject, ENT_QUOTES, 'UTF-8'));

		$mail->setHtml($email_dear.' '.$name.', <br>'.$email_body.' <br><br>'. date('d-m-Y').'<br><br>

		<a href="http://thinkwinetrade.com/admin" style="color: #ffffff;
    background-color: #1e91cf;
    border-color: #1978ab;padding: 8px 13px;
    font-size: 12px;border-radius: 3px;    vertical-align: middle;line-height: 1.42857143;">Login </a>');

		$mail->send();
		$this->load->model('catalog/cron_inventory');
		$this->model_catalog_cron_inventory->updateNotification($vendor_id);
	}
}
