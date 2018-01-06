<?php
//отображение блока в окне при выборе блока
$_['display']          = true;
//Порядковый номер
$_['sort_order']       = 17.2;
//Категория(content, social, structure)
$_['category']         = 'conversion';
//отображать название блока
$_['display_title']    = true;
//Может содержать дочерние блоки
$_['child_blocks']     = false;
//Уровень доступный для добавления блока
$_['level_min']        = 2;
$_['level_max']        = 6;
//Расположение кнопок управления
$_['control_position'] = 'popup';
//Отображение кнопок управления
$_['display_control']  = true;
//Кнопка перетаскивания
$_['button_drag']      = true;
//Кнопка редатирования
$_['button_edit']      = true;
//Кнопка копирования
$_['button_copy']      = true ;
//Кнопка сворачивания
$_['button_collapse']  = true;
//Кнопка удаления
$_['button_remove']    = true;
//Настройки по умолчанию
$_['setting'] = array(
    'datetime' => date('Y-m-d H:i', strtotime('1 hour')),
    'display_title' => '1',
    'text_arround_timer' => '{{timer}}',
    'color_title' => '#323434',
    'background' => 'rgb(51, 51, 51)',
    'color_number' => 'rgb(204, 204, 204)',
    'style' => 'default',
    'design_margin_bottom' => '15px',
    'scale' => 1,
    'position' => 'center'
);