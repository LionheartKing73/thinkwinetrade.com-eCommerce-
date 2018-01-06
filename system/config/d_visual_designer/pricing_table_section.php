<?php
//отображение блока в окне при выборе блока
$_['display']          = true;
//Порядковый номер
$_['sort_order']       = 33;
//Категория(content, social, structure)
$_['category']         = 'conversion';
//отображать название блока
$_['display_title']    = true;
//Может содержать дочерние блоки
$_['child_blocks']     = false;
//Уровень доступный для добавления блока
$_['level_min']        = 3;
$_['level_max']        = 3;
//Расположение кнопок управления
$_['control_position'] ='popup';
//Отображение кнопок управления
$_['display_control']  = true;
//Кнопка перетаскивания
$_['button_drag']      = false;
//Кнопка редатирования
$_['button_edit']      = true;
//Кнопка копирования
$_['button_copy']      = true ;
//Кнопка сворачивания
$_['button_collapse']  = false;
//Кнопка удаления
$_['button_remove']    = true;
//Свой шаблон
$_['custom_layout'] = 'pricing_table_section';
//Настройки по умолчанию
$_['setting'] = array(
    'title' => 'Plan',
    'subtitle' => '',
    'background' => '#96c855',
    'color_text' => '#000',
    'style' => 'style_1',
    'currency' => '$',
    'price' => '25',
    'per' => 'month',
    'feautures' => 'feauture 1,feauture 2,feauture 3',
    'align_feauture' => 'center',
    
    'display_icon' => 0,
    'library' => 'fontawesome',
    'icon' => 'fa fa-adjust',
    
    'display_button' => 1,
    'button_text' => 'Buy',
    'button_link' => '',
    'button_border_width' => '0px',
    'button_border_color' => '#000',
    'button_color' => '#9c9c9c',
    'button_background' => '#cdcdcd',
    'button_style' => 'square',
    'button_padding_top' => '5px',
    'button_padding_bottom' => '20px'

);