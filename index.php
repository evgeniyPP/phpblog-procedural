<?php
    include_once('functions.php');
    $is_auth = check_auth();
    $log_btn = !$is_auth ? 'Войти' : 'Выйти';
    $query = db("SELECT * FROM posts ORDER BY dt DESC");
    $posts = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/index.css">
    <title>Блог на PHP</title>
</head>
<body>
    <header class="header">
        <h1 class="header__title">Блог на PHP</h1>
        <div class="header__btns">
            <? if ($is_auth) : ?>
                <a href="add-post.php">Добавить пост</a>
            <? endif; ?>
            <a href="login.php"><?=$log_btn?></a>
        </div>
    </header>
    <ul class="posts">
        <? foreach($posts as $post) : ?>
            <li class="posts__item">
                <a href="post.php?id=<?=$post['id_post']?>"><?=$post['title']?></a>
            </li>
        <? endforeach; ?>
    </ul>
</body>
</html>