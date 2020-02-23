<?php
include_once('models/db.model.php');

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