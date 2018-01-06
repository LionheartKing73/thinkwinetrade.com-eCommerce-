<?php
class ControllerModuleDVisualDesignerLanding extends Controller {

    private $codename = 'd_visual_designer_landing';
    private $route = 'module/d_visual_designer_landing';
    private $extension = '';
    private $config_file = '';
    private $store_id = 0;
    private $error = array(); 
    
    public function __construct($registry) {
        parent::__construct($registry);
        
        $this->load->model($this->route);
        $this->load->language($this->route);
        
        $this->d_shopunity = (file_exists(DIR_SYSTEM.'mbooth/extension/d_shopunity.json'));
        $this->extension = json_decode(file_get_contents(DIR_SYSTEM.'mbooth/extension/'.$this->codename.'.json'), true);
        $this->store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] : 0;
    }
    
    public function index() {
			
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
            );

        if (isset($this->request->get['page_id'])) {
            $page_id = (int)$this->request->get['page_id'];
        } else {
            $page_id = 0;
        }

        if (isset($this->request->get['variation_id'])) {
            $variation_id = (int)$this->request->get['variation_id'];
        } else {
            $variation_id = 0;
        }

        if (VERSION >= '2.2.0.0') {
            $this->user = new Cart\User($this->registry);
        } else {
            $this->user = new User($this->registry);
        }

        if(isset($this->request->get['page_id'])&&!empty($this->request->cookie['vdl_page_'.$this->request->get['page_id']])&&!$this->user->isLogged()){
            $variation_id = $this->request->cookie['vdl_page_'.$this->request->get['page_id']];
            $page_info = $this->{'model_module_'.$this->codename}->getPageByVariation($variation_id);
        }
        elseif(!empty($variation_id)){
            $page_info = $this->{'model_module_'.$this->codename}->getPageByVariation($variation_id);
        }else if(!empty($page_id)){
            $variation_id = $this->{'model_module_'.$this->codename}->getCurrentVariation($page_id);
            $page_info = $this->{'model_module_'.$this->codename}->getPageByVariation($variation_id);
        }
        else{
            $page_info = false;
        }
        
        if ($page_info) {
            $page_id = $page_info['page_id'];

            $this->document->setTitle($page_info['meta_title']);
            $this->document->setDescription($page_info['meta_description']);
            $this->document->setKeywords($page_info['meta_keyword']);

            $data['breadcrumbs'][] = array(
                'text' => $page_info['title'],
                'href' => $this->url->link($this->route, 'page_id=' .  $page_id)
                );

            $data['button_continue'] = $this->language->get('button_continue');
            
            

            if($this->user->isLogged()){
                $results = $this->{'model_module_'.$this->codename}->getVariations($page_id);
                $data['variations'] = array();
                foreach ($results as $variation_id => $value) {
                    if($page_info['variation_id'] == $variation_id){
                        $active = true;
                    }
                    else{
                        $active = false;
                    }

                    if(isset($this->request->get['edit'])){
                        $addon = '&edit';
                    }
                    else{
                        $addon = '';
                    }

                    $data['variations'][] = array(
                        'variation_id'=> $variation_id,
                        'active' => $active,
                        'character' => $value['symbol'],
                        'link' => $this->url->link('module/d_visual_designer_landing','page_id='.$page_id.'&variation_id='.$variation_id.$addon,'')
                        );
                }

                $data['permission'] = true;
            }
            else{
                $this->{'model_module_'.$this->codename}->addView($page_info['variation_id']);
                $data['permission'] = false;
                if(isset($this->request->get['page_id'])){
                    setcookie( "vdl_page_".$page_info['page_id'], $page_info['variation_id'], strtotime( '+30 days' ) );
                }
            }

            $data['variation_id'] = $page_info['variation_id'];

            $content = $page_info['description'];

            $data['heading_title'] = html_entity_decode($page_info['title'], ENT_QUOTES, 'UTF-8');

            $data['description'] = html_entity_decode($content, ENT_QUOTES, 'UTF-8');

            $data['header_status'] = $page_info['header_status'];
            $data['footer_status'] = $page_info['footer_status'];
            $data['display_title'] = $page_info['display_title'];
            $data['full_width'] = $page_info['full_width'];

            $data['continue'] = $this->url->link('common/home');
        	$rt = $this->request->get['route']; //temp fix
            $data['header'] = $this->getHeader($page_info);
        	$this->request->get['route'] = $rt; //temp fix
            $data['footer'] = $this->getFooter($page_info);

            if(VERSION>='2.2.0.0') {
                $this->response->setOutput($this->load->view($this->route, $data));
            }
            else {
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->route.'.tpl')) {
                    $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/'.$this->route.'.tpl', $data));
                } else {
                    $this->response->setOutput($this->load->view('default/template/'.$this->route.'.tpl', $data));
                }
            }
        } else {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_error'),
                'href' => $this->url->link($this->route, 'page_id=' . $page_id)
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
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            if(VERSION>='2.2.0.0') {
                return $this->load->view('error/not_found', $data);
            }
            else {
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                    return $this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data);
                } else {
                    return $this->load->view('default/template/error/not_found.tpl', $data);
                }
            }
        }
    }
    
    public function getHeader($page_info){
        $output = $this->load->controller('common/header');
        
        if(!$page_info['header_status']){
            $html_dom = new d_simple_html_dom();
            $html_dom->load($output, $lowercase = true, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);
            
            $html_dom->find('body', 0)->innertext = '';
            
            $output = $html_dom->innertext;
        }

        return $output;
    }
    
    public function getFooter($page_info){

        if(!$page_info['footer_status']){
            $output = '</body></html>';
        }
        else{
            $output = $this->load->controller('common/footer');
        }
        
        return $output;
    }

    public function AjaxSave(){
        $json = array();

        if(isset($this->request->post['description'])){
            $description = $this->request->post['description'];
        }

        if(!empty($this->request->get['id'])){
            $variation_id = $this->request->get['id'];
        }

        if(isset($description)&&isset($variation_id)){

            $this->{'model_module_'.$this->codename}->editVariation($variation_id, $description);

            $json['success'] = 'success';
        }
        else{
            $json['error'] = 'error';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}