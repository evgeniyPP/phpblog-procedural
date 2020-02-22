<?php

    function validate_post($title, $content) {
        if ($title == '' || $content == '') {
            $error = 'Заполните все поля';
        } else {
            $error = null;
        }
        return $error;
    }

    function validate_id($id) {
        if ($id == null) {
            $error = 'Ошибка 404. Нет id';
        } elseif (!preg_match('/^\d*$/', $id)) {
            $error = 'Ошибка 404. Некорректное id';
        }
        else {
            $error = null;
        }
        return $error;
    }

    function generate_hash($pass) {
        return hash_pbkdf2('sha256', $pass, 'lavriklavrik', 1000, 20);
    }

    function check_auth() {
        session_start();
        if (!(isset($_SESSION['is_auth']) && $_SESSION['is_auth'])) { 
            if (!(isset($_COOKIE['login'])
                && $_COOKIE['login'] == 'root'
                && isset($_COOKIE['password']) 
                && $_COOKIE['password'] == generate_hash('toor'))) {
                return false;
            }
            $_SESSION['is_auth'] = true;
        }
        return true;
    }

    function db($sql, $masks = []) {
        static $db;

        if ($db === null) {
            $db = new PDO('mysql:host=localhost;dbname=lavrik_blog', 'root', '');
            $db->exec('SET NAMES UTF8');
        }

        $query = $db->prepare($sql);
        $query->execute($masks);
    
        $error = $query->errorInfo();
        if ($error[0] != PDO::ERR_NONE) {
            exit($info[2]);
        }

        return $query;
    }
?>