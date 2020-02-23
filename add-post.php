<?php
include_once('models/auth.model.php');
include_once('models/validation.model.php');
include_once('models/db.model.php');
include_once('models/error.model.php');
include_once('models/template.model.php');
session_start();

if (!check_auth()) {
    $_SESSION['return_url'] = "add-post.php";
    header("Location: login.php");
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
        header("Location: post.php?id=$id");
        exit();
    }
}

$content = slot('add-post', [
    'error' => $error,
    'title' => $title,
    'content' => $content
]);

echo template('Добавить пост | Блог на PHP', 'add-edit',  $content);