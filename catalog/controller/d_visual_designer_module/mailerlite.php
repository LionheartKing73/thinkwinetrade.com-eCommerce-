<?php
/*
 *	location: admin/controller
 */

class ControllerDVisualDesignerModuleMailerLite extends Controller
{
     /**
     * module codename - keep it simple yet unique. add prefix
     */
     private $codename = 'mailerlite';

     private $route = 'd_visual_designer_module/mailerlite';

    /**
     * share loaded language files and models with all methods
     */
    public function __construct($registry)
    {
        parent::__construct($registry);
        
        $this->load->language($this->route);
        $this->load->model('module/d_visual_designer');
    }
    
    /**
     * returns the module block view
     */
    public function index($setting)
    {
        $data['entry_firstname'] = $this->language->get('entry_firstname');
        $data['entry_lastname'] = $this->language->get('entry_lastname');
        $data['entry_email'] = $this->language->get('entry_email');

        $data['text_success_subscribe'] = $this->language->get('text_success_subscribe');

        $data['button_subscribe'] = $this->language->get('button_subscribe');


        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

        $data['unique_id'] = uniqid();
        
        if(VERSION>='2.2.0.0') {
            return $this->load->view($this->route, $data);
        }
        else {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->route.'.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/'.$this->route.'.tpl', $data);
            } else {
                return $this->load->view('default/template/'.$this->route.'.tpl', $data);
            }
        }
    }

    public function setting($setting)
    {
        $data['entry_api'] = $this->language->get('entry_api');
        $data['entry_lists'] = $this->language->get('entry_lists');
        $data['entry_display_firstname'] = $this->language->get('entry_display_firstname');
        $data['entry_display_lastname'] = $this->language->get('entry_display_lastname');
        $data['entry_inline'] = $this->language->get('entry_inline');

        $data['entry_input_color_text'] = $this->language->get('entry_input_color_text');
        $data['entry_input_background_color'] = $this->language->get('entry_input_background_color');
        $data['entry_input_border_color'] = $this->language->get('entry_input_border_color');
        $data['entry_input_focus_border_color'] = $this->language->get('entry_input_focus_border_color');
        $data['entry_input_border_width'] = $this->language->get('entry_input_border_width');
        $data['entry_input_border_radius'] = $this->language->get('entry_input_border_radius');
        $data['entry_input_width'] = $this->language->get('entry_input_width');
        $data['entry_input_height'] = $this->language->get('entry_input_height');
        $data['entry_input_font_size'] = $this->language->get('entry_input_font_size');

        $data['entry_button_title'] = $this->language->get('entry_button_title');
        $data['entry_button_background_color'] = $this->language->get('entry_button_background_color');
        $data['entry_button_hover_background_color'] = $this->language->get('entry_button_hover_background_color');
        $data['entry_button_color_text'] = $this->language->get('entry_button_color_text');
        $data['entry_button_hover_color_text'] = $this->language->get('entry_button_hover_color_text');
        $data['entry_button_border_width'] = $this->language->get('entry_button_border_width');
        $data['entry_button_border_color'] = $this->language->get('entry_button_border_color');
        $data['entry_button_hover_border_color'] = $this->language->get('entry_button_hover_border_color');
        $data['entry_button_border_radius'] = $this->language->get('entry_button_border_radius');
        $data['entry_button_font_size'] = $this->language->get('entry_button_font_size');
        $data['entry_button_width'] = $this->language->get('entry_button_width');
        $data['entry_button_height'] = $this->language->get('entry_button_height');

        $data['help_api'] = $this->language->get('help_api');

        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_enabled'] = $this->language->get('text_enabled');

        $data['button_refresh'] = $this->language->get('button_refresh');

        $data['setting'] = $this->model_module_d_visual_designer->getSetting($setting, $this->codename);

        $data['lists'] = array();

        if (!empty($data['setting']['api'])) {
            $mailer_client =  new d_mailerlite($data['setting']['api']);

            $groups = $mailer_client->getGroups();

            if (!isset($groups["error"])) {
                foreach ($groups as $value) {
                    $data['lists'][$value['id']] = $value['name'];
                    $json['lists'][] = array(
                        'id' => $value['id'],
                        'name' => $value['name']
                        );
                }
            }
        }

        if(VERSION>='2.2.0.0') {
            return $this->load->view($this->route.'_setting', $data);
        }
        else {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/'.$this->route.'_setting.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/'.$this->route.'_setting.tpl', $data);
            } else {
                return $this->load->view('default/template/'.$this->route.'_setting.tpl', $data);
            }
        }
    }

    public function getList()
    {
        $json = array();

        if (!empty($this->request->post['api'])) {
            $api = $this->request->post['api'];
        }

        if (isset($api)) {

            $mailer_client =  new d_mailerlite($api);

            $groups = $mailer_client->getGroups();

            if (!isset($groups["error"])) {
                foreach ($groups as $value) {
                    $json['lists'][] = array(
                        'id' => $value['id'],
                        'name' => $value['name']
                        );
                }
            }
            $json['success'] = 'success';
        } else {
            $json['error'] = 'error';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function Subscribe()
    {
        $json = array();

        if (!empty($this->request->post['api'])) {
            $api = base64_decode($this->request->post['api']);
        }
        else{
            $json['error'] = 'error';
        }
        if (!empty($this->request->post['list_id'])) {
            $list_id = $this->request->post['list_id'];
        }
        else{
            $json['error'] = 'error';
        }
        if (!empty($this->request->post['email'])) {
            $email = $this->request->post['email'];
        }
        else{
            $json['error'] = $this->language->get('error_email');
        }
        if (isset($this->request->post['firstname'])) {
            $firstname = $this->request->post['firstname'];
        }
        else{
            $json['error'] = 'error';
        }
        if (isset($this->request->post['lastname'])) {
            $lastname = $this->request->post['lastname'];
        }
        else{
            $json['error'] = 'error';
        }

        if (!isset($json['error'])) {

            $mailer_client = new d_mailerlite($api);

            $subscriber = array(
                'email' => $email,
                'name' => $firstname,
                'fields' => array(
                    'last_name' => $lastname
                    )
                );

            $result = $mailer_client->addSubscription($list_id, $subscriber);

            if (isset($result["error"])) {
                $json['error'] = $result['error']['message'];
            } else {
                $json['result'] = $result;
                $json['success'] = 'success';
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}
