<?php
class ControllerEventDVisualDesignerModule extends Controller {

    public $codename = 'd_visual_designer';

    public function view_after(&$route, &$data, &$output){

        $html_dom = new d_simple_html_dom();
        $html_dom->load($output, $lowercase = true, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);

        $this->load->model('localisation/language');

        $languages = $this->model_localisation_language->getLanguages();

        foreach ($languages as $language) {
            $html_dom->find('textarea[name^="description['.$language['language_id'].'][description]"]', 0)->class .=' d_visual_designer';
        }

        $html_dom->find('head', 0)->innertext  .= $this->addScript();

        $output = (string)$html_dom;
    }
    private function addScript(){
        $setting = $this->config->get($this->codename.'_setting');
        $status = false;
        if(!empty($setting)){
            if(!empty($setting['limit_access_user'])){
                if(!empty($setting['access_user']) && in_array($this->user->getId(), $setting['access_user'])){
                    $status = true;
                }
            }
            elseif(!empty($setting['limit_access_user_group'])){
                if(!empty($setting['access_user_group']) && in_array($this->user->getGroupId(), $setting['access_user_group'])){
                    $status = true;
                }
            }
            else{
                $status = true;
            }
        }
        else{
            $status = true;
        }

        if($status){
            return '<script src="view/javascript/d_visual_designer/d_visual_designer.js?'.rand(5,10).'" type="text/javascript"></script>';
        }
        return '';
    }
}
