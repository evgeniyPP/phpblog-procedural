<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/post.css">
    <title><?=$post['title']?> | Блог на PHP</title>
</head>
<body>
    <header class="header">
        <h2 class="header__title"><?=$post['title']?></h2>
        <div class="header__btns">
            <a href="index.php">На главную</a>
            <? if ($is_auth) : ?>
                <a href="edit-post.php?id=<?=$id?>">Редактировать</a>
            <? endif; ?>
        </div>
    </header>
    <h4><?=$post['dt']?></h4>
    <?=nl2br($post['content'])?>
</body>
</html>