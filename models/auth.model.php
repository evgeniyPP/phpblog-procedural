<?php
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