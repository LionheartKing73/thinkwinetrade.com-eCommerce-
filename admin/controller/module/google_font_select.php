<?php
class ControllerModuleGoogleFontSelect extends Controller {
    private $error = array(); // This is used to set the errors, if any.
 
    public function index() {
        // Loading the language file of google_font
        $this->load->language('module/google_font_select'); 
     
        // Set the title of the page to the heading title in the Language file i.e., Hello World
        $this->document->setTitle($this->language->get('heading_title'));
        
        // Include Google Font Picker JQuery Plugin
        $this->document->addStyle('view/javascript/jquery/google-font-picker/jquery.fontselect.css');
        $this->document->addScript('view/javascript/jquery/google-font-picker/jquery.fontselect.min.js');
     
        // Load the Setting Model  (All of the OpenCart Module & General Settings are saved using this Model )
        $this->load->model('setting/setting');
     
        // Start If: Validates and check if data is coming by save (POST) method
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            // Parse all the coming data to Setting Model to save it in database.
            $this->model_setting_setting->editSetting('google_font_select', $this->request->post);
     
            // To display the success text on data save
            $this->session->data['success'] = $this->language->get('text_success');
     
            // Redirect to the Module Listing
            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }
     
        // Assign the language data for parsing it to view
        $data['heading_title'] = $this->language->get('heading_title');
     
        $data['text_edit']    = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
     
        $data['entry_font_name'] = $this->language->get('entry_font_name');
        $data['entry_font_css'] = $this->language->get('entry_font_css');
        $data['entry_status'] = $this->language->get('entry_status');
     
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_add_module'] = $this->language->get('button_add_module');
        $data['button_remove'] = $this->language->get('button_remove');
         
        // This Block returns the warning if any
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
     
        // This Block returns the error code if any
        if (isset($this->error['font_name'])) {
            $data['error_font_name'] = $this->error['font_name'];
        } else {
            $data['error_font_name'] = '';
        } 
        if (isset($this->error['font_css'])) {
            $data['error_font_css'] = $this->error['font_css'];
        } else {
            $data['error_font_css'] = '';
        } 
     
        // Making of Breadcrumbs to be displayed on site
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_home'),
            'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('text_module'),
            'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        $data['breadcrumbs'][] = array(
            'text'      => $this->language->get('heading_title'),
            'href'      => $this->url->link('module/google_font_select', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
          
        $data['action'] = $this->url->link('module/google_font_select', 'token=' . $this->session->data['token'], 'SSL'); // URL to be directed when the save button is pressed
     
        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'); // URL to be redirected when cancel button is pressed
              
        // This block checks, if the field is set it parses it to view otherwise get the default 
        // text field from the database and parse it
        if (isset($this->request->post['google_font_select_font_name'])) {
            $data['google_font_select_font_name'] = $this->request->post['google_font_select_font_name'];
        } else {
            $data['google_font_select_font_name'] = $this->config->get('google_font_select_font_name');
        }
        
        // This block checks, if the field is set it parses it to view otherwise get the default 
        // text field from the database and parse it
        if (isset($this->request->post['google_font_select_font_css'])) {
            $data['google_font_select_font_css'] = $this->request->post['google_font_select_font_css'];
        } else {
            $data['google_font_select_font_css'] = $this->config->get('google_font_select_font_css');
        } 
          
        // This block parses the status (enabled / disabled)
        if (isset($this->request->post['google_font_select_status'])) {
            $data['google_font_select_status'] = $this->request->post['google_font_select_status'];
        } else {
            $data['google_font_select_status'] = $this->config->get('google_font_select_status');
        }
        
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/google_font_select.tpl', $data));

    }

    /* Function that validates the data when Save Button is pressed */
    protected function validate() {
 
        // Block to check the user permission to manipulate the module
        if (!$this->user->hasPermission('modify', 'module/google_font_select')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
 
        // Block to check if the google_font_select_font_name is properly set to save into database,
        // otherwise the error is returned
        if (!$this->request->post['google_font_select_font_name']) {
            $this->error['font_name'] = $this->language->get('error_font_name');
        }
        /* End Block*/
        
        // Block to check if the google_font_select_font_name is properly set to save into database,
        // otherwise the error is returned
        if (!$this->request->post['google_font_select_font_css']) {
            $this->error['font_css'] = $this->language->get('error_font_css');
        }
        /* End Block*/
 
        // Block returns true if no error is found, else false if any error detected
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}
