<?php
include_once('error.model.php');

function validate_post($title, $content) {
    if ($title == '' || $content == '') {
        error('Заполните все поля');
    }

    return true;
}

function validate_id($id) {
    if ($id == null) {
        error('Ошибка 404. Нет id');
    } elseif (!preg_match('/^\d*$/', $id)) {
        error('Ошибка 404. Некорректный id');
    }

    return true;
}

function validate_controller($controller) {
    if (!preg_match('/^[\w-]*$/', $controller) || 
        !file_exists("controllers/$controller.php")) {
        error('Ошибка 404. Некорректный адрес');
    }
    
    return true;
}