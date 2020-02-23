<?php
define('ROOT', '/blog/');

session_start();
include_once('models/auth.model.php');
include_once('models/template.model.php');
include_once('models/validation.model.php');

$params = explode('/', $_GET['uri']);
$last_index = count($params) - 1;

if ($params[$last_index] === '') {
    unset($params[$last_index]);
    $last_index--;
}

$controller = $params[0] ?? 'home';
validate_controller($controller);
check_error();

include_once("controllers/$controller.php");