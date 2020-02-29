<?php
session_start();

$_SESSION = array();
session_destroy();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ログアウト</title>
</head>
    <body>
     <h1>ログアウト画面</h1>
    <div>ログアウトしました</div>
    <a href="login.php">ログイン画面に戻る</a>
    </body>
</html>