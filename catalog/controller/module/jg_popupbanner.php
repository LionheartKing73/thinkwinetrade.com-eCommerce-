<?php
	class ControllerModuleJGPopupBanner extends Controller {
		public function index($setting) {
			static $module = 0;
			$this->load->model('module/jg_popupbanner');
			$this->document->addStyle('catalog/view/javascript/jquery.colorbox/colorbox.css');
			$this->document->addScript('catalog/view/javascript/jquery.colorbox/jquery.colorbox-min.js');
	
			$data['banners'] = array();
			
			//--- Get popup banner ---
			$data['banners'] = $setting; //--- get load setting ---
			list($width, $height, $type, $attr) = getimagesize("image/".$setting["bannerfile"]);
			$data['banners']["width"] = $width;
			$data['banners']["height"] = $height;
			//--- End Get popup banner ---
			
			$data['module'] = $module++;

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/jg_popupbanner.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/jg_popupbanner.tpl', $data);
			} else {
				return $this->load->view('module/jg_popupbanner.tpl', $data);
			}
		}
	}
?>