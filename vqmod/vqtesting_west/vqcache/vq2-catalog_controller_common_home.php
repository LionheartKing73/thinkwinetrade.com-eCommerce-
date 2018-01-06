<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->language->load('module/newslettersubscribe');
		
		 $data['text_go'] = $this->language->get('text_go');
		 $data['text_news_email'] = $this->language->get('text_news_email');
		 $data['news_heading_title'] = $this->language->get('news_heading_title');
		 $data['news_heading_title2'] = $this->language->get('news_heading_title2');
		 
		 
		$this->document->setTitle($this->config->get('config_meta_title'));

			$this->load->model('localisation/language');

			$languages = $this->model_localisation_language->getLanguages();
			foreach ($languages as $language) {
				if ($language['code'] == $this->session->data['language']) {
					$data['language_id'] = $language['language_id'];
				}
			}
				
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		

			/* START */
			$layout_positions = $this->load->controller('common/layout_footer/layoutPositions');

			foreach($layout_positions as $position){
				$data[$position] = $this->load->controller('common/layout_footer/index', $position);
			}
			/* END */
			
			
			
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}
}