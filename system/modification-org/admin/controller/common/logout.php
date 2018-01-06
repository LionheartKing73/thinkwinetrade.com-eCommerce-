<?php
class ControllerCommonLogout extends Controller {
	public function index() {
		$this->user->logout();

        unset($this->session->data['admin_language_id']);
            

		unset($this->session->data['token']);

		$this->response->redirect($this->url->link('common/login', '', 'SSL'));
	}
}