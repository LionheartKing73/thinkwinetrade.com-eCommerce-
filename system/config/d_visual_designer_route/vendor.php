<?php
//Название конфига
$_['name']                = 'Vendor';
//Статус Frontend редатора
$_['frontend_status']     = '1';
//GET параметр route в админке 
$_['backend_route']       = 'catalog/vendor/update';
//REGEX для GET параметров route в админке
$_['backend_route_regex'] = 'catalog/vendor/*';
//GET параметр route на Frontend 
$_['frontend_route']      = 'product/vendor';
//GET параметр содержащий id страницы в админке
$_['backend_param']       = 'category_id';
//GET параметр содержащий id страницы на Frontend
$_['frontend_param']      = 'path';
//Путь для сохранения описания на Frontend
$_['edit_url']            = 'index.php?route=module/d_visual_designer/saveCategory';
//События необходимые для работы данного route
$_['events']              = array(
    'admin/view/catalog/category_form/after' => 'event/d_visual_designer/view_vendor_after',
    'catalog/view/product/category/before' => 'event/d_visual_designer/view_category_before'
);