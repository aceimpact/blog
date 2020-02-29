<?php
require_once 'db_connect.php';
require_once 'function.php';

check_user_logged_in();

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$pdo = db_connect();

try {
    $sql = 'UPDATE posts SET title = :title, content = :content WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
} catch (PDOException $e) {
    exit('データベース接続失敗。'.$e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>編集完了</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <h1>編集完了</h1>
        <p>ID: <?php echo $id; ?>を編集しました。</p>
        <a href="main.php">ホームへ戻る</a>
    </body>
</html>