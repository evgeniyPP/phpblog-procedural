<?php
include_once('functions.php');

$id = $_GET['id'] ?? null;

if (!check_auth()) {
    $_SESSION['return_url'] = "edit-post.php?id=$id";
    header("Location: login.php");
    exit();
}

$error = validate_id($id);

if (!count($_POST) > 0) { // GET request
    if ($error == null) {
        $query = db("SELECT * FROM posts WHERE id_post=:id", ['id' => $id]);
        $post = $query->fetch();
        if (!$post) {
            echo '404. Такой статьи нет<br>';
            exit();
        }
    }
} else { // POST request
    if ($error == null) {
        $title = htmlspecialchars(trim($_POST['title']));
        $content = htmlspecialchars(trim($_POST['content']));
        $error = validate_post($title, $content);
        if ($error == null) {
            db(
                "UPDATE posts SET title=:title, content=:content WHERE id_post=:id",
                ['title' => $title, 'content' => $content, 'id' => $id]
            );
            header("Location: index.php");
            exit();  
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/add-edit.css">
    <title>Редактировать пост | Блог на PHP</title>
</head>
<body>
    <header class="header">
        <h1 class="header__title">Редактировать пост</h1>
        <div class="header__btns">
            <a href="post.php?id=<?=$id?>">Вернуться к посту</a>
        </div>
    </header>
    <? if ($error) : ?>
        <p class="error"><?=$error?></p>
    <? endif; ?>
    <form method="post">
        <label for="title">Название поста:</label>
        <input class="post__title" type="text" name="title" value="<?=$post['title'] ?? $title?>">
        <label for="content">Текст поста:</label>
        <textarea class="post__content" name="content"><?=$post['content'] ?? $content?></textarea>
        <button type="submit">Отредактировать</button>
    </form>
</body>
</html>