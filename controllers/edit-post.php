<?php
include_once 'models/db.model.php';

$id = $params[1] ?? null;

if (!check_auth()) {
    $_SESSION['return_url'] = "edit-post/$id";
    header('Location: ' . ROOT . "login");
    exit();
}

validate_id($id);
check_error();

if (!count($_POST) > 0) { // GET request
    $post = db_get_single_post($id);
    check_error();
} else { // POST request
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    validate_post($title, $content);
    $error = error();
    if ($error == null) {
        db_update_post($title, $content, $id);
        header('Location: ' . ROOT . "post/$id");
        exit();
    }
}

$content = slot('edit-post', [
    'id' => $id,
    'error' => $error,
    'title' => $post['title'] ?? $title,
    'content' => $post['content'] ?? $content,
]);

echo template('Редактировать пост | Блог на PHP', 'add-edit', $content);