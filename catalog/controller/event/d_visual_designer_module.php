<?php
class ControllerEventDVisualDesignerModule extends Controller
{
    private $codename = 'd_visual_designer_module';

    private $route = 'module/d_visual_designer_module';

    public function __construct($registry)
    {
        parent::__construct($registry);
        $this->load->model('module/d_visual_designer');
    }
    public function view_before(&$view, &$data, &$output)
    {
        if(isset($data['description'])){
            $designer_data = array(
                'config' => 'd_visual_designer_module',
                'content' => $data['description'],
                'field_name' => 'description',
                'id' => $data['module_id']
                );
            
            $data['description'] = $this->model_module_d_visual_designer->parseDescription($designer_data);
            $data['description'] = html_entity_decode($data['description'], ENT_QUOTES, 'UTF-8');
        }
    }

}