<?php
include_once 'models/db.model.php';

if (!check_auth()) {
    $_SESSION['return_url'] = "add-post";
    header('Location: ' . ROOT . "login");
    exit();
}

if (!count($_POST) > 0) { // GET request
    $title = '';
    $content = '';
    $error = '';
} else { // POST request
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));

    validate_post($title, $content);
    $error = error();
    if ($error == null) {
        $id = db_add_post($title, $content);
        header('Location: ' . ROOT . "post/$id");
        exit();
    }
}

$content = slot('add-post', [
    'error' => $error,
    'title' => $title,
    'content' => $content,
]);

echo template('Добавить пост | Блог на PHP', 'add-edit', $content);