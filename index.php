<?php
include_once('models/auth.model.php');
include_once('models/db.model.php');
include_once('models/template.model.php');
session_start();

$is_auth = check_auth();
$log_btn = !$is_auth ? 'Войти' : 'Выйти';
$posts = db_get_all_posts();

$content = slot('index', [
    'is_auth' => $is_auth,
    'log_btn' => $log_btn,
    'posts' => $posts
]);

echo template('Блог на PHP', 'index', $content);