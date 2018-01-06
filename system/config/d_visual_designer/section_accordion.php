<?php
//отображение блока в окне при выборе блока
$_['display']         = false;
//Категория(content, social, structure)
$_['category'] = 'content';
//отображать название блока
$_['display_title']   = false;
//Может содержать дочерние блоки
$_['child_blocks']    = true;
//Уровень доступный для добавления блока
$_['level_min']       = 3;
$_['level_max']       = 3;
//Расположение кнопок управления
$_['control_position'] ='top';
//Отображение кнопок управления
$_['display_control'] = true;
//Кнопка перетаскивания
$_['button_drag']     = false;
//Кнопка редатирования
$_['button_edit']     = true;
//Кнопка копирования
$_['button_copy']     = false ;
//Кнопка сворачивания
$_['button_collapse'] = true;
//Кнопка удаления
$_['button_remove']   = true;
//Свой шаблон
$_['custom_layout'] = 'section_accordion';
//Настройки по умолчанию
$_['setting'] = array(
    'section_id' => substr(md5(time()), 0, 7),
    'title' => 'Section'
);