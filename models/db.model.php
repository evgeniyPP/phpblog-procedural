<?php
include_once('error.model.php');

function get_db() {
    static $db;
    if ($db === null) {
        $db = new PDO('mysql:host=localhost;dbname=lavrik_blog', 'root', '');
        $db->exec('SET NAMES UTF8');
    }
    return $db;
}

function db($sql, $masks = []) {
    $db = get_db();
    $query = $db->prepare($sql);
    $query->execute($masks);

    $error = $query->errorInfo();
    if ($error[0] != PDO::ERR_NONE) {
        exit($info[2]);
    }

    return $query;
}

function db_get_all_posts() {
    $query = db("SELECT * FROM posts ORDER BY dt DESC");
    $posts = $query->fetchAll();

    return $posts;
}

function db_get_single_post($id) {
    $query = db("SELECT * FROM posts WHERE id_post=:id", ['id' => $id]);
    $post = $query->fetch();

    if (!$post) {
        error('404. Такой статьи нет');
    }

    return $post;
}

function db_add_post($title, $content) {
    db(
        "INSERT INTO posts (title, content) VALUES (:title, :content)",
        ['title' => $title, 'content' => $content]
    );
    $db = get_db();
    return $db->lastInsertId();
}

function db_update_post($title, $content, $id) {
    db(
        "UPDATE posts SET title=:title, content=:content WHERE id_post=:id",
        ['title' => $title, 'content' => $content, 'id' => $id]
    );
    $db = get_db();
    return $db->lastInsertId();
}