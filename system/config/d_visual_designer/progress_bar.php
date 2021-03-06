<?php
//отображение блока в окне при выборе блока
$_['display']         = true;
//Порядковый номер
$_['sort_order']      = 23;
//Категория(content, social, structure)
$_['category'] = 'content';
//отображать название блока
$_['display_title']   = true;
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
    'title' => '',
    'values' => array(
        'value0' => array(
            'label' => 'Development',
            'value' => '90',
            'color' => '#95CEFF'
        ),
        'value1' => array(
            'label' => 'Design',
            'value' => '80',
            'color' => '#434348'
        ),
        'value2' => array(
            'label' => 'Marketing',
            'value' => '70',
            'color' => '#90ED7D'
        ),
    ),
    'units' => '%',
    'animate' => '1',
    'stripes' => '1'
);