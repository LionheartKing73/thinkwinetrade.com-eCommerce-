<?php
//отображение блока в окне при выборе блока
$_['display']          = true;
//Порядковый номер
$_['sort_order']       = 17.1;
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
    'datetime' => date('Y-m-d H:i'),
    'display_week' => '1',
    'text_arround_timer' => '{{timer}}',
    'style' => 'default',
    'display_title' => '1',
    'color_number' => '#000000',
    'color_title' => '#000000',
    'background' => 'rgba(255,255,255,0)',
    'border_color' => 'rgba(255,255,255,0)',
    'design_margin_bottom' => '15px'
);