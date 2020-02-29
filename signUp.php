<?php

require 'lib/password.php';

session_start();
$db['host'] = 'localhost';
$db['user'] = 'root';
$db['pass'] = 'root';
$db['dbname'] = 'YIGroupBlog';

$errorMessage = '';
$signUpMessage = '';

if (isset($_POST['signUp'])) {
    if (empty($_POST['name'])) {
        $errorMessage = 'ユーザー名が未入力です。';
    } elseif (empty($_POST['password'])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST['name']) && !empty($_POST['password'])) {
        $username = $_POST['name'];
        $password = $_POST['password'];
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('INSERT INTO users(name, password) VALUES (:name, :password)');
            $stmt->execute(array(':name' => $username, ':password' => password_hash($password, PASSWORD_DEFAULT)));
            $userid = $pdo->lastinsertid('id');

            $signUpMessage = '登録が完了しました。';
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            echo $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>サインアップ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <h1>新規登録</h1>
    <form method="POST" action="">
        user:<br>
        <input type="text" name="name" id="name">
        <br>
        password:<br>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="submit" id="signUp" name="signUp">
    </form>
</body>
</html>