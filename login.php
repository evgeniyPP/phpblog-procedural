<?php
    include_once('models/auth.model.php');

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

    if (count($_POST) > 0) { // POST request
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
        } else {
            $error = "Неверные данные";
        }
    }

    include 'views/login.view.php';
?>