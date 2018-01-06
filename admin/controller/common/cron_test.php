<?php
class ControllerCommonCronTest extends Controller {
	public function index() {

		$this->load->language('catalog/rating_vendor');
		$email_subject = 'Test Cron';
		$email_dear = 'Dear';
		$email_body = 'Test Cron Dear';

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

		//$mail->setTo('rseptiane@gmail.com');

		$mail->setFrom('sales@thinkwinetrade.com');

		$mail->setSender('sales@thinkwinetrade.com');

		$mail->setSubject(html_entity_decode($email_subject, ENT_QUOTES, 'UTF-8'));

		$mail->setHtml($email_dear.' '.$email_body);

		$mail->send();

		echo 'test';

	}

	public function resetcrondb(){
		$this->load->model('catalog/cron_inventory');
		$this->model_catalog_cron_inventory->resetcrondb();
		echo 'Reset Cron Db Succesfully';
	}

}
