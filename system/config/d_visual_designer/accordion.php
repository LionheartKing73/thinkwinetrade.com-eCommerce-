<?php
//отображение блока в окне при выборе блока
$_['display']          = true;
//Порядковый номер
$_['sort_order']       = 15;
//Категория(content, social, structure)
$_['category']         = 'structure';
//отображать название блока
$_['display_title']    = false;
//Может содержать дочерние блоки
$_['child_blocks']     = true;
//Обязательынй дочерний блок
$_['child']            = 'section_accordion';
//Уровень доступный для добавления блока
$_['level_min']        = 2;
$_['level_max']        = 2;
//Расположение кнопок управления
$_['control_position'] ='top-bordered';
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
//Свой шаблон
$_['custom_layout']    = 'accordion';
//Настройки по умолчанию
$_['setting']          = array(
    'active_section' => '1',
    'title' => '',
    'align' => 'left',
    'design_margin_top' => '40px'
);