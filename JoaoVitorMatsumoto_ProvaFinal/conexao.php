<?php
$dsn = 'mysql:host=localhost;dbname=php;charset=utf8';
$username = 'root';
$password = '1234'; 

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Conexão falhou: ' . $e->getMessage());
}
?>
