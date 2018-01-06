<?php
class ControllerModuleRatings extends Controller {
    
    public function index() {
        
        $this->getList();
        
    }
    
    
    public function getList() {
        
        $data = array();
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
                'text' => "Wine Ratings",
                'href' => $this->url->link('module/ratings', 'token=' . $this->session->data['token'], 'SSL')
        );
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
	$data['brcr'] = $this->load->controller('common/brcr');
        $data['add'] = $this->url->link('module/ratings/add', 'token=' . $this->session->data['token'], 'SSL');
        
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
        
        $this->load->model('module/ratings');
        $data['ratings'] = $this->model_module_ratings->getAll();
        
        $this->response->setOutput($this->load->view('module/ratings.tpl', $data));
    }
 
    
    public function edit() {
        
        if (isset($this->request->get['id'])) {
        
            $this->load->model('module/ratings');
            
            if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
                $this->load->model('module/ratings');
                $this->model_module_ratings->editRating($this->request->post, $this->request->get['id']);

                $this->session->data['success'] = "Rating edited";
                $this->response->redirect($this->url->link('module/ratings', 'token=' . $this->session->data['token'], 'SSL'));
            }
            
            
            $data           = array();
            $data['rating'] = $this->model_module_ratings->getRating($this->request->get['id']);

            $data['breadcrumbs']    = array();
            $data['breadcrumbs'][]  = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
            );
            $data['breadcrumbs'][] = array(
                'text' => "Wine Ratings",
                'href' => $this->url->link('module/ratings', 'token=' . $this->session->data['token'], 'SSL')
            );
            $data['breadcrumbs'][] = array(
                'text' => "Edit rating",
                'href' => $this->url->link('module/ratings/edit', 'token=' . $this->session->data['token']."&id=".$this->request->get['id'], 'SSL')
            );
            
            $data['header']         = $this->load->controller('common/header');
            $data['column_left']    = $this->load->controller('common/column_left');
            $data['footer']         = $this->load->controller('common/footer');
            $data['brcr']           = $this->load->controller('common/brcr');
            $data['cancel']         = $this->url->link('module/ratings', 'token=' . $this->session->data['token'], 'SSL');
            $data['action']         = $this->url->link('module/ratings/edit', 'token=' . $this->session->data['token']."&id={$data['rating']['rating']['id']}", 'SSL');
            $data['title']          = "Edit rating";
            
            $this->response->setOutput($this->load->view('module/ratings_form.tpl', $data));
        } else {
            $this->response->redirect($this->url->link('module/ratings', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }
    
    public function add() {
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
            $this->load->model('module/ratings');
            $this->model_module_ratings->add($this->request->post);
            
            $this->session->data['success'] = "Rating added";
            $this->response->redirect($this->url->link('module/ratings', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        $data = array();
        
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );
        $data['breadcrumbs'][] = array(
                'text' => "Wine Ratings",
                'href' => $this->url->link('module/ratings', 'token=' . $this->session->data['token'], 'SSL')
        );
        $data['breadcrumbs'][] = array(
                'text' => "Add rating",
                'href' => $this->url->link('module/ratings/add', 'token=' . $this->session->data['token'], 'SSL')
        );
        
        $data['header']         = $this->load->controller('common/header');
        $data['column_left']    = $this->load->controller('common/column_left');
        $data['footer']         = $this->load->controller('common/footer');
	$data['brcr']           = $this->load->controller('common/brcr');
        $data['cancel']         = $this->url->link('module/ratings', 'token=' . $this->session->data['token'], 'SSL');
        $data['action']         = $this->url->link('module/ratings/add', 'token=' . $this->session->data['token'], 'SSL');
        $data['title']          = "Add rating";
        
        if (isset($this->error['warning'])) {
                $data['error_warning'] = $this->error['warning'];
        } else {
                $data['error_warning'] = '';
        }
        
        $this->response->setOutput($this->load->view('module/ratings_form.tpl', $data));
    }
    
    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'module/ratings')) {
                $this->error['warning'] = $this->language->get('error_permission');
        }
        
        return !$this->error;
    }
    
    public function delete(){
        if (isset($this->request->get['id'])) {
            $this->load->model('module/ratings');
            $this->model_module_ratings->deleteRating($this->request->get['id']);
            $this->session->data['success'] = "Rating deleted.";
        }

        $this->response->redirect($this->url->link('module/ratings', 'token=' . $this->session->data['token'], 'SSL'));
		
    }
}