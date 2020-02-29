<?php

require_once 'db_connect.php';
require_once 'function.php';
check_user_logged_in();

if (!empty($_POST)) {
    if (empty($_POST['title'])) {
        echo 'タイトルが未入力です。';
    } elseif (empty($_POST['content'])) {
        echo 'コンテンツが未入力です。';
    }

    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $pdo = db_connect();

        try {
            $sql = 'INSERT INTO posts(title, content) VALUES (:title, :content)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->execute();
            header('Location: main.php');
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
            die();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <h1>記事登録</h1>
    <form method="POST" action="">
        title:<br>
        <input type="text" name="title" id="title" style="width:200px;height:50px;">
        <br>
        content:<br>
        <input type="text" name="content" id="content" style="width:200px;height:100px;"><br>
        <input type="submit" value="submit" id="post" name="post">
    </form>
</body>
</html>