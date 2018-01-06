<?php
//Название конфига
$_['name']            = 'Visual Designer Module';
//Статус Frontend редатора
$_['frontend_status'] = '1';
//GET параметр route в админке 
$_['backend_route']   = 'module/d_visual_designer_module';
//GET параметр route на Frontend 
$_['frontend_route']  = 'common/home';
//GET параметр содержащий id страницы в админке
$_['backend_param']   = 'module_id';
//GET параметр содержащий id страницы на Frontend
$_['frontend_param']  = 'module_id';
//Путь для сохранения описания на Frontend
$_['edit_url']        = 'index.php?route=module/d_visual_designer_module/AjaxSave';
//События необходимые для работы данного route
$_['events']          = array(
    'admin/view/module/d_visual_designer_module/after' => 'event/d_visual_designer_module/view_after',
    'catalog/view/module/d_visual_designer_module/before' => 'event/d_visual_designer_module/view_before',
    );