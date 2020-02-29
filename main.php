<?php
require_once 'db_connect.php';
require_once 'function.php';
check_user_logged_in();

$pdo = db_connect();

try {
    $sql = 'SELECT * FROM posts ORDER BY id DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    echo 'Error: '.$e->getMessage();
    die();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>メイン</title>
</head>
<body>
    <h1>メインページ</h1>
    <p>ようこそ<?php echo $_SESSION['user_name']; ?>さん</p>
    <a href="logout.php">ログアウト</a>
    <a href="create_post.php">記事投稿！</a><br />
    <table>
        <tr>
            <td>記事ID</td>
            <td>タイトル</td>
            <td>本文</td>
            <td>投稿日</td>
              <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['content']; ?></td>
                <td><?php echo $row['time']; ?></td>
                  <td><a href="detail_post.php?id=<?php echo $row['id']; ?>">詳細</a></td>
                  <td><a href="edit_post.php?id=<?php echo $row['id']; ?>">編集</a></td>
                  <td><a href="delete_post.php?id=<?php echo $row['id']; ?>">削除</a></td>
            </tr>
        <?php
} ?>
    </table>
</body>
</html>