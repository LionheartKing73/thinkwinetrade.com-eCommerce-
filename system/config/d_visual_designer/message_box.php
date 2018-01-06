<?php
//отображение блока в окне при выборе блока
$_['display']         = true;
//Порядковый номер
$_['sort_order']      = 5;
//Категория(content, social, structure)
$_['category'] = 'content';
//отображать название блока
$_['display_title']   = false;
//Может содержать дочерние блоки
$_['child_blocks']    = false;
//Уровень доступный для добавления блока
$_['level_min']       = 2;
$_['level_max']       = 6;
//Расположение кнопок управления
$_['control_position'] ='popup';
//Отображение кнопок управления
$_['display_control'] = true;
//Кнопка перетаскивания
$_['button_drag']     = true;
//Кнопка редатирования
$_['button_edit']     = true;
//Кнопка копирования
$_['button_copy']     = true ;
//Кнопка сворачивания
$_['button_collapse'] = true;
//Кнопка удаления
$_['button_remove']   = true;
//Настройки по умолчанию
$_['setting'] = array(
    'style' => '',
    'share' => 'rounded',
    'color' => '#dff2fe',
    'border_color' => '#5e7f96',
    'library' => 'fontawesome',
    'icon' => 'fa fa-info-circle',
    'text' => 'Information message.'
);