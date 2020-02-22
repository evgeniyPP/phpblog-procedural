<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/add-edit.css">
    <title>Добавить пост | Блог на PHP</title>
</head>
<body>
    <header class="header">
        <h1 class="header__title">Добавить пост</h1>
        <div class="header__btns">
            <a href="index.php">Вернуться на главную</a>
        </div>
    </header>
    <? if ($error) : ?>
        <p class="error"><?=$error?></p>
    <? endif; ?>
    <form method="post">
        <label for="title">Название поста:</label>
        <input class="post__title" type="text" name="title" value="<?=$title?>">
        <label for="content">Текст поста:</label>
        <textarea class="post__content" name="content"><?=$content?></textarea>
        <button type="submit">Добавить</button>
    </form>
</body>
</html>