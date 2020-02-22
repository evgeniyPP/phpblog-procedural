<?php
    include_once('functions.php');

    session_start();

    if (isset($_SESSION['is_auth'])) {
        unset($_SESSION['is_auth']);
    }
    if (isset($_COOKIE['login'])) {
        setcookie('login', null, 0, '/');
    }
    if (isset($_COOKIE['password'])) {
        setcookie('password', null, 0, '/');
    }

    if (count($_POST) > 0) {
        if ($_POST['login'] == 'root' && $_POST['password'] == 'toor') {
            $_SESSION['is_auth'] = true;

            if (isset($_POST['remember'])) {
                setcookie('login', $_POST['login'], time() + 3600 * 24 * 7, '/');
                setcookie('password', generate_hash($_POST['password']), time() + 3600 * 24 * 7, '/');
            }

            if (isset($_SESSION['return_url'])) {
                $return_url = $_SESSION['return_url'];
                unset($_SESSION['return_url']);
                header("Location: $return_url");
                exit();
            } else {
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
    <link rel="stylesheet" href="styles/login.css">
    <title>Авторизация | Блог на PHP</title>
</head>
<body>
    <form method="post">
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