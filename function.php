<?php

/**
 * $_SESSION["user_name"]が空だった場合、ログインページにリダイレクトする.
 */
function check_user_logged_in()
{
    session_start();
    if (empty($_SESSION['user_name'])) {
        header('Location: login.php');
        exit;
    }
}

/**
 * 引数の値が空だった場合、main.phpにリダイレクトする.
 *
 * @param int $param
 */
function redirect_main_unless_parameter($param)
{
    if (empty($param)) {
        header('Location: main.php');
        exit;
    }
}

/**
 * 引数で与えられたidでpostsテーブルを検索する
 * もし対象のレコードがなければmain.phpに遷移させる.
 *
 * @param int $id
 *
 * @return array
 */
function find_post_by_id($id)
{
    $pdo = db_connect();
    try {
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
        die();
    }
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        return $row;
    } else {
        redirect_main_unless_parameter($row);
    }
}
