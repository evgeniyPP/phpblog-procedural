<?php
if (isset($_SESSION['error'])) {
    $error = htmlspecialchars($_SESSION['error']);
    unset($_SESSION['error']);
} else {
    $error = null;
}

$content = slot('404', [
    'error' => $error
]);

echo template('Страница не найдена | Блог на PHP', '404',  $content);