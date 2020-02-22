<?php
    include_once('models/auth.model.php');
    include_once('models/validation.model.php');
    include_once('models/db.model.php');
    include_once('models/error.model.php');

    $id = $_GET['id'] ?? null;

    if (!check_auth()) {
        $_SESSION['return_url'] = "edit-post.php?id=$id";
        header("Location: login.php");
        exit();
    }

    validate_id($id);
    check_error();

    if (!count($_POST) > 0) { // GET request
        $post = db_get_single_post($id);
        check_error();
    } else { // POST request
        $title = htmlspecialchars(trim($_POST['title']));
        $content = htmlspecialchars(trim($_POST['content']));
        validate_post($title, $content);
        $error = error();
        if ($error == null) {
            db_update_post($title, $content, $id);
            header("Location: post.php?id=$id");
            exit();  
        }
    }

    include 'views/edit-post.view.php';
?>