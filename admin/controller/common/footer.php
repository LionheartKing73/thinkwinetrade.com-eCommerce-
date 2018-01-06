<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');

		$data['text_footer'] = $this->language->get('text_footer');

		if ($this->user->isLogged() && isset($this->request->get['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
			$data['text_version'] = sprintf($this->language->get('text_version'), VERSION);
		} else {
			$data['text_version'] = '';
		}

		$data['admin_footer'] = $this->load->controller('common/admin_footer');

		$this->load->model('catalog/vdi_vendor_profile');
    $vendors_info = $this->model_catalog_vdi_vendor_profile->getVendorProfile($this->user->getId());
		if (isset($vendors_info['company'])) {
			$data['zopim_user'] = $vendors_info['firstname'] . ' / ' . $vendors_info['company'];
			$data['zopim_email'] = $vendors_info['email'];
		}

		return $this->load->view('common/footer.tpl', $data);
	}
}