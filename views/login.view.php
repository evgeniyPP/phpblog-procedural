<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="styles/global.css">
    <link rel="stylesheet" href="styles/login.css">
    <title>Авторизация | Блог на PHP</title>
</head>
<body>
    <form method="post">
        <? if ($error) : ?>
            <p class="error"><?=$error?></p>
        <? endif; ?>
        <label for="login">Логин</label>
        <input type="text" name="login">
        <label for="password">Пароль</label>
        <input type="password" name="password">
        <label class="remember">
            <input type="checkbox" name="remember">
            <span></span>
            Запомнить
        </label>
        <div class="form__btns">
            <button type="submit" class="btns__submit">Войти</button>
            <a href="index.php" class="btns__toindex">На главную</a></button>
        </div>
    </form>  
</body>
</html>