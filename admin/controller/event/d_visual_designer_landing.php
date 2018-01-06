<?php
class ControllerEventDVisualDesignerLanding extends Controller {

    public $codename = 'd_visual_designer_landing';
    private $extension = '';

    public function __construct($registry)
    {
        parent::__construct($registry);
        $this->load->model('d_visual_designer/designer');
        $this->load->language('module/d_visual_designer_landing');

        $this->d_shopunity = (file_exists(DIR_SYSTEM.'mbooth/extension/d_shopunity.json'));
        if ($this->d_shopunity) {
            $this->load->model('d_shopunity/mbooth');
            $this->extension = $this->model_d_shopunity_mbooth->getExtension('d_visual_designer');
        }
    }

    public function view_variation_after(&$route, &$data, &$output){

        $html_dom = new d_simple_html_dom();
        $html_dom->load($output, $lowercase = true, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);

        $this->load->model('localisation/language');

        $languages = $this->model_localisation_language->getLanguages();

        foreach ($languages as $language) {
            $html_dom->find('textarea[name^="description['.$language['language_id'].'][description]"]', 0)->class .=' d_visual_designer';
        }
        
        if($this->{'model_d_visual_designer_designer'}->checkPermission()){
            $html_dom->find('head', 0)->innertext  .= '<script src="view/javascript/d_visual_designer/d_visual_designer.js?'.$this->extension['version'].'" type="text/javascript"></script>';
        }

        $output = (string)$html_dom;
    }

    public function common_menu_after(&$route, &$data, &$output){
        $html_dom = new d_simple_html_dom();
        $html_dom->load($output, $lowercase = true, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);
        
        $link = $this->url->link('module/'.$this->codename, 'token='.$this->session->data['token'], 'SSL');
        $text_menu_title = $this->language->get('text_menu_title');
        
        $html_dom->find('li#catalog', 0)->find('ul',0)->innertext .= '<li><a href="'.$link.'">'.$text_menu_title.'</a></li>';

        $output = $html_dom->innertext;
    }
}
