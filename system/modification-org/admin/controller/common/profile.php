<?php
class ControllerCommonProfile extends Controller {
	public function index() {
		$this->load->language('common/menu');

		$this->load->model('user/user');

		$this->load->model('tool/image');

		$user_info = $this->model_user_user->getUser($this->user->getId());

		if ($user_info) {

          $this->load->model('catalog/vdi_vendor_profile');

          $vendor_info = $this->model_catalog_vdi_vendor_profile->getVendorProfile($this->user->getId());
          if(!empty($vendor_info)) {
            $data['user_vendor'] = $vendor_info['company'];
          }
          
			$data['firstname'] = $user_info['firstname'];
			$data['lastname'] = $user_info['lastname'];
			$data['username'] = $user_info['username'];

			$data['user_group'] = $user_info['user_group'] ;

			if (is_file(DIR_IMAGE . $user_info['image'])) {
				$data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);
			} else {
				$data['image'] = $this->model_tool_image->resize('no_image.png', 45, 45);
			}
		} else {
			$data['username'] = '';
			$data['image'] = '';
		}

		return $this->load->view('common/profile.tpl', $data);
	}
}