<?php
include_once('models/auth.model.php');
include_once('models/db.model.php');

$is_auth = check_auth();
$log_btn = !$is_auth ? 'Войти' : 'Выйти';
$posts = db_get_all_posts();

include 'views/index.view.php';