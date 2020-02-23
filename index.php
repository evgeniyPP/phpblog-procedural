<?php
session_start();
include_once('models/auth.model.php');
include_once('models/template.model.php');
include_once('models/validation.model.php');

$controller = $_GET['c'] ?? 'home';
validate_controller($controller);
check_error();

include_once("controllers/$controller.php");