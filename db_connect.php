<?php

define('DB_DATABASE', 'yigroupBlog');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('PDO_DSN', 'mysql:host=localhost;charset=utf8;dbname='.DB_DATABASE);

/**
 * @return object
 */
function db_connect()
{
    try {
        $pdo = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
        die();
    }
}
