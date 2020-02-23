<?php
function error($input = null) {
    static $error;

    if ($input) {
        $error = $input;
        return true;
    }

    return $error;
}

function check_error() {
    $error = error();
    if ($error) {
        $_SESSION['error'] = $error;
        header("HTTP/1.1 404 Not Found");
        header('Location: ' . ROOT . '404');
        exit();
    }
}