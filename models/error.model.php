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
        header("Location: index.php?c=404");
        exit();
    }
}