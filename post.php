<?php
include_once('models/auth.model.php');
include_once('models/validation.model.php');
include_once('models/db.model.php');
include_once('models/error.model.php');
include_once('models/template.model.php');
session_start();

$is_auth = check_auth();
$id = $_GET['id'] ?? null;

validate_id($id);
check_error();

$post = db_get_single_post($id);
check_error();

$content = slot('post', [
    'is_auth' => $is_auth,
    'id' => $id,
    'post' => $post
]);

echo template($post['title'] . ' | Блог на PHP', 'post', $content);