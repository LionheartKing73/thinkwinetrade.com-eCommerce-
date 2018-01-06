<?php
/*
 *    location: admin/controller
 */

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
    
    public function required(){
        $this->load->language($this->route);
        $this->document->setTitle($this->language->get('heading_title_main'));
        $data['heading_title'] = $this->language->get('heading_title_main');
        $data['text_not_found'] = $this->language->get('text_not_found');
        $data['breadcrumbs'] = array();
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        
        $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
    }

    public function index() {

        if(!$this->d_shopunity){
            $this->required();
            return false;
        }

        $this->load->model('d_shopunity/mbooth');

        $this->model_d_shopunity_mbooth->validateDependencies($this->codename);
        $this->getList();
    }

    public function add(){
        if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()){

            $this->uninstallEvents();
            $this->installEvents();

            $page_id = $this->{'model_module_'.$this->codename}->addPage($this->request->post);

            $variation_data = array(
                'status' => 1,
                'sort_order' => 0,
                'description' => array()
                );

            $this->load->model('localisation/language');

            $languages = $this->model_localisation_language->getLanguages();

            foreach ($languages as $value) {
                $variation_data['description'][$value['language_id']] = array(
                    'description' => '');
            }

            $this->{'model_module_'.$this->codename}->addVariation($page_id, $variation_data);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link($this->route, 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit(){

        if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()){

            $this->uninstallEvents();
            $this->installEvents();

            $this->{'model_module_'.$this->codename}->editPage($this->request->get['page_id'], $this->request->post);
            if(!empty($this->request->post['variation'])){
                foreach ($this->request->post['variation'] as $variation_id => $status) {
                    $this->{'model_module_'.$this->codename}->setStatus($variation_id, $status);
                }
            }
            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link($this->route, 'token=' . $this->session->data['token'] . $url, true));        
        }
        $this->getForm();
    }
    public function delete(){

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $page_id) {
                $this->{'model_module_'.$this->codename}->deletePage($page_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link($this->route, 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getList();
    }

    protected function getList(){
        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'pd.title';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }
        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'].'&type=module', true)
            );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_main'),
            'href' => $this->url->link($this->route, 'token=' . $this->session->data['token'] . $url, true)
            );

        $data['add'] = $this->url->link($this->route.'/add', 'token=' . $this->session->data['token'] . $url, true);
        $data['delete'] = $this->url->link($this->route.'/delete', 'token=' . $this->session->data['token'] . $url, true);
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&type=module', true);

        $data['pages'] = array();

        $filter_data = array(
            'sort'  => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
            );

        $page_total = $this->{'model_module_'.$this->codename}->getTotalPages();

        $results = $this->{'model_module_'.$this->codename}->getPages($filter_data);

        foreach ($results as $result) {

            $variations = $this->{'model_module_'.$this->codename}->getVariations($result['page_id']);

            $implode = array();
            foreach ($variations as $key => $value) {
                $implode[] = $value['symbol'];
            }
            $data['pages'][] = array(
                'page_id' => $result['page_id'],
                'variations' => implode(', ', $implode),
                'title'          => $result['title'],
                'sort_order'     => $result['sort_order'],
                'view'     => $this->{'model_module_'.$this->codename}->getLink('module/d_visual_designer_landing', 'page_id='.$result['page_id'], true),
                'edit'           => $this->url->link($this->route.'/edit', 'token=' . $this->session->data['token'] . '&page_id=' . $result['page_id'] . $url, true)
                );
        }


        $data['version'] = $this->extension['version'];

        $this->document->setTitle($this->language->get('heading_title_main'));
        $data['heading_title'] = $this->language->get('heading_title_main');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_title'] = $this->language->get('column_title');
        $data['column_variations'] = $this->language->get('column_variations');
        $data['column_sort_order'] = $this->language->get('column_sort_order');
        $data['column_action'] = $this->language->get('column_action');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_view'] = $this->language->get('button_view');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_create_page'] = $this->language->get('button_create_page');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }
        $url = '';

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_title'] = $this->url->link($this->route, 'token=' . $this->session->data['token'] . '&sort=pd.title' . $url, true);
        $data['sort_sort_order'] = $this->url->link($this->route, 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, true);

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $page_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link($this->route, 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($page_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($page_total - $this->config->get('config_limit_admin'))) ? $page_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $page_total, ceil($page_total / $this->config->get('config_limit_admin')));

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view($this->codename . '/page_list.tpl', $data));
    }

    protected function getForm() {

        $this->document->addStyle('view/stylesheet/d_visual_designer_landing/d_visual_designer_landing.css');

        //Bootstrap Switch
        $this->document->addScript('view/javascript/shopunity/bootstrap-switch/bootstrap-switch.min.js');
        $this->document->addStyle('view/stylesheet/shopunity/bootstrap-switch/bootstrap-switch.css');

        $this->document->addStyle('view/stylesheet/shopunity/bootstrap.css');


        $data['version'] = $this->extension['version'];

        $data['heading_title'] = $this->language->get('heading_title_main');

        $data['text_form'] = !isset($this->request->get['page_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');

        $data['text_variation'] = $this->language->get('text_variation');
        $data['text_status'] = $this->language->get('text_status');
        $data['text_variation_edit'] = $this->language->get('text_variation_edit');
        $data['text_view_variation'] = $this->language->get('text_view_variation');
        $data['text_create_new_variation'] = $this->language->get('text_create_new_variation');
        $data['text_create_variation'] = $this->language->get('text_create_variation');
        $data['text_set_status'] = $this->language->get('text_set_status');
        $data['text_delete_variation'] = $this->language->get('text_delete_variation');
        $data['text_count_view'] = $this->language->get('text_count_view');
        $data['text_copy_variation'] = $this->language->get('text_copy_variation');
        $data['text_important'] = $this->language->get('text_important');
        $data['text_warning'] = $this->language->get('text_warning');

        $data['entry_title'] = $this->language->get('entry_title');
        $data['entry_description'] = $this->language->get('entry_description');
        $data['entry_meta_title'] = $this->language->get('entry_meta_title');
        $data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
        $data['entry_keyword'] = $this->language->get('entry_keyword');
        $data['entry_store'] = $this->language->get('entry_store');
        $data['entry_bottom'] = $this->language->get('entry_bottom');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_layout'] = $this->language->get('entry_layout');
        $data['entry_header_status'] = $this->language->get('entry_header_status');
        $data['entry_footer_status'] = $this->language->get('entry_footer_status');
        $data['entry_display_title'] = $this->language->get('entry_display_title');
        $data['entry_full_width'] = $this->language->get('entry_full_width');

        $data['help_keyword'] = $this->language->get('help_keyword');
        $data['help_bottom'] = $this->language->get('help_bottom');
        $data['help_event_support'] = $this->language->get('help_event_support');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_copy'] = $this->language->get('button_copy');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_add'] = $this->language->get('button_add');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_data'] = $this->language->get('tab_data');
        $data['tab_variation'] = $this->language->get('tab_variation');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = array();
        }

        if (isset($this->error['description'])) {
            $data['error_description'] = $this->error['description'];
        } else {
            $data['error_description'] = array();
        }

        if (isset($this->error['meta_title'])) {
            $data['error_meta_title'] = $this->error['meta_title'];
        } else {
            $data['error_meta_title'] = array();
        }

        if (isset($this->error['keyword'])) {
            $data['error_keyword'] = $this->error['keyword'];
        } else {
            $data['error_keyword'] = '';
        }

        $url = '';

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'].'&type=module', true)
            );


        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_main'),
            'href' => $this->url->link($this->route, 'token=' . $this->session->data['token'] . $url, true)
            );

        if (!isset($this->request->get['page_id'])) {
            $data['action'] = $this->url->link($this->route.'/add', 'token=' . $this->session->data['token'] . $url, true);
            $data['install_event_support'] = $this->url->link($this->route.'/install_event_support', 'token=' . $this->session->data['token'], 'SSL');
        } else {
            $data['action'] = $this->url->link($this->route.'/edit', 'token=' . $this->session->data['token'] . '&page_id=' . $this->request->get['page_id'] . $url, true);
            $data['install_event_support'] = $this->url->link($this->route.'/install_event_support', 'token=' . $this->session->data['token'], 'SSL');
            $data['add_variation'] = $this->url->link($this->route.'/addVariation', 'token=' . $this->session->data['token'] . '&page_id=' . $this->request->get['page_id'] . $url, true);
        }

        $data['cancel'] = $this->url->link($this->route, 'token=' . $this->session->data['token'] . $url, true);


        $data['text_install_event_support'] = $this->language->get('text_install_event_support');
        

        $data['page_id'] = '';

        if (isset($this->request->get['page_id'])) {
            $page_info = $this->{'model_module_'.$this->codename}->getPage($this->request->get['page_id']);
            $variations = $this->{'model_module_'.$this->codename}->getVariations($this->request->get['page_id']);
            $data['page_id'] = $this->request->get['page_id'];
        }

        $data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        foreach ($data['languages'] as $key =>  $language){
            if(VERSION >= '2.2.0.0'){
                $data['languages'][$key]['flag'] = 'language/'.$language['code'].'/'.$language['code'].'.png';
            }else{
                $data['languages'][$key]['flag'] = 'view/image/flags/'.$language['image'];
            }
        }

        if (isset($this->request->post['page_description'])) {
            $data['page_description'] = $this->request->post['page_description'];
        } elseif (isset($this->request->get['page_id'])) {
            $data['page_description'] = $this->{'model_module_'.$this->codename}->getPageDescriptions($this->request->get['page_id']);
        } else {
            $data['page_description'] = array();
        }
        if (isset($this->request->get['page_id'])) {
            $results = $this->{'model_module_'.$this->codename}->getVariations($this->request->get['page_id']);

            $data['variations'] = array();

            foreach ($results as $variation_id => $value) {

                $data['variations'][] = array(
                    'variation_id' => $variation_id,
                    'character' => $value['symbol'],
                    'status' => $value['status'],
                    'count_view' => $value['view'],
                    'view' => $this->{'model_module_'.$this->codename}->getLink($this->route, 'token='.$this->session->data['token'].'&variation_id='.$variation_id, true),
                    'copy' => $this->url->link($this->route.'/copyVariation', 'token='.$this->session->data['token'].'&page_id='.$this->request->get['page_id'].'&variation_id='.$variation_id, ''),
                    'edit' => $this->url->link($this->route.'/editVariation', 'token='.$this->session->data['token'].'&variation_id='.$variation_id, ''),
                    'delete' => $this->url->link($this->route.'/deleteVariation', 'token='.$this->session->data['token'].'&variation_id='.$variation_id.'&page_id='.$this->request->get['page_id'], ''),
                    );

            }
        }

        $this->load->model('setting/store');

        $data['stores'] = $this->model_setting_store->getStores();

        if (isset($this->request->post['page_store'])) {
            $data['page_store'] = $this->request->post['page_store'];
        } elseif (isset($this->request->get['page_id'])) {
            $data['page_store'] = $this->{'model_module_'.$this->codename}->getPageStores($this->request->get['page_id']);
        } else {
            $data['page_store'] = array(0);
        }

        if (isset($this->request->post['keyword'])) {
            $data['keyword'] = $this->request->post['keyword'];
        } elseif (isset($this->request->get['page_id'])) {
            $data['keyword'] = $this->{'model_module_'.$this->codename}->getPageSEOKeyword($this->request->get['page_id']);
        } else {
            $data['keyword'] = array();
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($page_info)) {
            $data['status'] = $page_info['status'];
        } else {
            $data['status'] = true;
        }

        if (isset($this->request->post['header_status'])) {
            $data['header_status'] = $this->request->post['header_status'];
        } elseif (!empty($page_info)) {
            $data['header_status'] = $page_info['header_status'];
        } else {
            $data['header_status'] = true;
        }

        if (isset($this->request->post['footer_status'])) {
            $data['footer_status'] = $this->request->post['footer_status'];
        } elseif (!empty($page_info)) {
            $data['footer_status'] = $page_info['footer_status'];
        } else {
            $data['footer_status'] = true;
        }

        if (isset($this->request->post['display_title'])) {
            $data['display_title'] = $this->request->post['display_title'];
        } elseif (isset($page_info['display_title'])) {
            $data['display_title'] = $page_info['display_title'];
        } else {
            $data['display_title'] = true;
        }

        if (isset($this->request->post['full_width'])) {
            $data['full_width'] = $this->request->post['full_width'];
        } elseif (isset($page_info['full_width'])) {
            $data['full_width'] = $page_info['full_width'];
        } else {
            $data['full_width'] = false;
        }

        if (isset($this->request->post['sort_order'])) {
            $data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($page_info)) {
            $data['sort_order'] = $page_info['sort_order'];
        } else {
            $data['sort_order'] = '';
        }
        $seo_module_support = (file_exists(DIR_SYSTEM.'mbooth/extension/d_seo_module.json'));

        $event_support = (file_exists(DIR_SYSTEM.'mbooth/extension/d_event_manager.json'));
        $data['event_support'] = false;
        if($event_support){
            $this->load->model('d_shopunity/ocmod');
            $data['event_support'] = $this->model_d_shopunity_ocmod->getModificationByName('d_event_manager');
        }
        $data['seo_module_support'] = false;
        if($seo_module_support){
            $seo_extensions = $this->{'model_module_' . $this->codename}->getSEOExtensions();
            if (in_array('d_seo_module', $seo_extensions)) {
                $data['seo_module_support'] = true;
                if (!in_array($this->codename, $seo_extensions)) {
                    $seo_extensions[] = $this->codename;
                    $this->{'model_module_' . $this->codename}->saveSEOExtensions($seo_extensions);
                }
            }
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view($this->codename.'/page_form.tpl', $data));
    }

    public function addVariation(){
        if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateVariationForm()){

            $this->{'model_module_'.$this->codename}->addVariation($this->request->get['page_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['page_id'])) {
                $url .= '&page_id=' . $this->request->get['page_id'];
            }

            $this->response->redirect($this->url->link($this->route.'/edit', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getVariationForm();
    }

    public function editVariation(){
        if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateVariationForm()){

            $this->{'model_module_'.$this->codename}->editVariation($this->request->get['variation_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['page_id'])) {
                $url .= '&page_id=' . $this->request->get['page_id'];
            }

            $this->response->redirect($this->url->link($this->route.'/edit', 'token=' . $this->session->data['token'] . $url, true));
        }

        $this->getVariationForm();
    }

    public function copyVariation(){
        if($this->validateVariationCopy()){

            $this->{'model_module_'.$this->codename}->copyVariation($this->request->get['variation_id']);

            $this->session->data['success'] = $this->language->get('text_success');
        }
        $url = '';
        if (isset($this->request->get['page_id'])) {
            $url .= '&page_id=' . $this->request->get['page_id'];
        }

        $this->response->redirect($this->url->link($this->route.'/edit', 'token=' . $this->session->data['token'] . $url, true));
    }

    public function deleteVariation(){
        if($this->validateVariationDelete()){

            $this->{'model_module_'.$this->codename}->deleteVariation($this->request->get['variation_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');
        }
        $url = '';

        if (isset($this->request->get['page_id'])) {
            $url .= '&page_id=' . $this->request->get['page_id'];
        }

        $this->response->redirect($this->url->link($this->route.'/edit', 'token=' . $this->session->data['token'] . $url, true));
    }

    public function getVariationForm(){

        $this->document->addStyle('view/stylesheet/d_visual_designer_landing/d_visual_designer_landing.css');

        $this->document->addStyle('view/stylesheet/shopunity/bootstrap.css');


        //Visual Designer
        $vd_status =$this->config->get('d_visual_designer_status');

        //Bootstrap Switch
        $this->document->addScript('view/javascript/shopunity/bootstrap-switch/bootstrap-switch.min.js');
        $this->document->addStyle('view/stylesheet/shopunity/bootstrap-switch/bootstrap-switch.css');


        $data['version'] = $this->extension['version'];

        $data['heading_title'] = $this->language->get('heading_title_main');

        $data['text_default'] = $this->language->get('text_default');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_use'] = sprintf($this->language->get('text_use'), $this->url->link('extension/module/d_visual_designer', 'token='.$this->session->data['token'], 'SSL'));
        $data['text_important'] = $this->language->get('text_important');

        $data['entry_description'] = $this->language->get('entry_description');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_copy'] = $this->language->get('button_copy');
        $data['button_delete'] = $this->language->get('button_delete');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['description'])) {
            $data['error_description'] = $this->error['description'];
        } else {
            $data['error_description'] = array();
        }
        if (isset($this->request->get['variation_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $variation_info = $this->{'model_module_'.$this->codename}->getVariation($this->request->get['variation_id']);
            $data['text_form'] = sprintf($this->language->get('text_edit_variation'), $variation_info['symbol']);
            $data['page_id'] = $variation_info['page_id'];
        }
        else{
            $symbol = $this->{'model_module_'.$this->codename}->getLastSymbol($this->request->get['page_id']);
            $data['text_form'] = sprintf($this->language->get('text_add_variation'), chr(ord($symbol)+1));
            $data['page_id'] = $this->request->get['page_id'];
        }

        if(!empty($this->request->get['page_id'])){
            $page_id = $this->request->get['page_id'];
        }
        elseif(!empty($variation_info)){
            $page_id = $variation_info['page_id'];
        }
        else{
            $page_id = 0;
        }

        $url = '';
        if(!empty($page_id)){
            $url .= '&page_id=' .  $page_id;
        }


        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
            );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'].'&type=module', true)
            );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title_main'),
            'href' => $this->url->link($this->route, 'token=' . $this->session->data['token'] . $url, true)
            );

        if (!isset($this->request->get['variation_id'])) {
            $data['action'] = $this->url->link($this->route.'/addVariation', 'token=' . $this->session->data['token'] . $url, true);
        } else {
            $data['action'] = $this->url->link($this->route.'/editVariation', 'token=' . $this->session->data['token'] . '&variation_id=' . $this->request->get['variation_id'] . $url, true);
        }

        $data['cancel'] = $this->url->link($this->route.'/edit', 'token=' . $this->session->data['token'] . $url, true);

        $data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        foreach ($data['languages'] as $key =>  $language){
            if(VERSION >= '2.2.0.0'){
                $data['languages'][$key]['flag'] = 'language/'.$language['code'].'/'.$language['code'].'.png';
            }else{
                $data['languages'][$key]['flag'] = 'view/image/flags/'.$language['image'];
            }
        }

        if (isset($this->request->post['variation_description'])) {
            $data['variation_description'] = $this->request->post['variation_description'];
        } elseif (isset($this->request->get['variation_id'])) {
            $data['variation_description'] = $this->{'model_module_'.$this->codename}->getVariationDescription($this->request->get['variation_id']);
        } else {
            $data['variation_description'] = array();
        }

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($variation_info)) {
            $data['status'] = $variation_info['status'];
        } else {
            $data['status'] = 1;
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view($this->codename.'/variation_form.tpl', $data));
    }

    public function install(){
        if($this->d_shopunity){
            $this->load->model('d_shopunity/mbooth');
            $this->model_d_shopunity_mbooth->installDependencies($this->codename);
        }

        $this->load->model('user/user_group');

        $this->model_user_user_group->addPermission($this->{'model_module_'.$this->codename}->getGroupId(), 'access', 'd_visual_designer_module/mailchimp');
        $this->model_user_user_group->addPermission($this->{'model_module_'.$this->codename}->getGroupId(), 'access', 'd_visual_designer_module/mailerlite');

        $this->{'model_module_'.$this->codename}->installModule();
    }

    public function uninstall(){
        $this->{'model_module_'.$this->codename}->uninstallModule();
        $this->uninstallEvents();
    }

    public function install_event_support(){
        if (!$this->user->hasPermission('modify', $this->route)) {
            $this->session->data['error'] = $this->language->get('error_permission');
            $this->response->redirect($this->url->link($this->route, 'token='.$this->session->data['token'], 'SSL'));
        }
        if(file_exists(DIR_SYSTEM.'mbooth/extension/d_event_manager.json')){
            $this->load->model('module/d_event_manager');
            $this->model_module_d_event_manager->installCompatibility();
            $this->installEvents();
        }
        $this->response->redirect($this->url->link($this->route, 'token='.$this->session->data['token'], 'SSL'));
    }

    public function installEvents(){
        $this->load->model('module/d_event_manager');
        $this->model_module_d_event_manager->addEvent($this->codename, 'admin/view/common/menu/after', 'event/d_visual_designer_landing/common_menu_after');
        $this->model_module_d_event_manager->addEvent($this->codename, 'catalog/controller/checkout/success/before', 'event/d_visual_designer_landing/eventSuccess');
    }
    public function uninstallEvents(){
        $this->load->model('module/d_event_manager');
        $this->model_module_d_event_manager->deleteEvent($this->codename);
    }

    protected function validateVariationForm(){
        if (!$this->user->hasPermission('modify', $this->route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', $this->route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (isset($this->request->post['keyword'])) {
            foreach ($this->request->post['keyword'] as $language_id => $seo_keyword) {
                if (utf8_strlen($seo_keyword) > 0) {
                    $aliases = $this->{'model_module_'.$this->codename}->getAliases(array('filter_keyword' => $seo_keyword));

                    if ($aliases) {
                        if (isset($this->request->get['page_id'])) {
                            foreach ($aliases as $alias) {
                                if ($alias['route'] != 'vdl_page_id=' . $this->request->get['page_id'].'&language_id='.$language_id) {
                                    $this->error['keyword'][$language_id] = $this->language->get('error_keyword');
                                }
                            }
                        } else {
                            $this->error['keyword'][$language_id] = $this->language->get('error_keyword');
                        }
                    }
                }
            }
        }

        foreach ($this->request->post['page_description'] as $language_id => $value) {
            if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 64)) {
                $this->error['title'][$language_id] = $this->language->get('error_title');
            }

            if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
                $this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', $this->route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
    protected function validateVariationDelete() {
        if (!$this->user->hasPermission('modify', $this->route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
    protected function validateVariationCopy() {
        if (!$this->user->hasPermission('modify', $this->route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}