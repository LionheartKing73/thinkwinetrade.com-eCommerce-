<?php
//Название конфига
$_['name']                = 'Visual Designer Landing';
//Статус Frontend редатора
$_['frontend_status']     = '1';
//GET параметр route в админке 
$_['backend_route']       = 'module/d_visual_designer_landing/editVariation';
//REGEX для GET параметров route в админке
$_['backend_route_regex'] = 'module/d_visual_designer_landing/*Variation';
//GET параметр route на Frontend
$_['frontend_route']      = 'module/d_visual_designer_landing';
//GET параметр содержащий id страницы в админке
$_['backend_param']       = 'variation_id';
//GET параметр содержащий id страницы на Frontend
$_['frontend_param']      = 'variation_id';
//Путь для сохранения описания на Frontend
$_['edit_url']            = 'index.php?route=module/d_visual_designer_landing/ajaxSave';
//События необходимые для работы данного route
$_['events']            = array(
    'admin/view/d_visual_designer_landing/variation_form/after' => 'event/d_visual_designer_landing/view_variation_after',
    'catalog/view/module/d_visual_designer_landing/before' => 'event/d_visual_designer_landing/view_variation_before',
);
