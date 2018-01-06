<?php
class ControllerEventDVisualDesignerLanding extends Controller {
    private $codename = 'd_visual_designer';

    private $route = 'module/d_visual_designer';

    public function __construct($registry)
    {
        parent::__construct($registry);
        
        $this->load->model($this->route);
    }

    public function view_variation_before(&$view, &$data, &$output)
    {
        if(isset($data['description'])){
            $designer_data = array(
                'config' => 'd_visual_designer_landing',
                'content' => $data['description'],
                'field_name' => 'description',
                'id' => $data['variation_id']
                );
            
            $data['description'] = $this->{'model_module_'.$this->codename}->parseDescription($designer_data);
            $data['description'] = html_entity_decode($data['description'], ENT_QUOTES, 'UTF-8');
        }
    }

    public function eventSuccess(){
        if(!empty($this->session->data['order_id'])){
            $products = $this->cart->getProducts();
            foreach ($products as $product) {
                if(!empty($this->session->data['d_visual_designer_landing'][$product['product_id']])){
                    $description_id = $this->session->data['d_visual_designer_landing'][$product['product_id']];

                    $this->load->model('d_visual_designer_module/conversion');
                    $this->model_d_visual_designer_module_conversion->addConversion($description_id, 'buy');
                    break;
                }
            }
        }
        unset($this->session->data['d_visual_designer_landing']);
    }

}
