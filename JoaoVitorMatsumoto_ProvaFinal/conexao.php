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
CREATE TABLE Fornecedor (
    idFornecedor INT PRIMARY KEY AUTO_INCREMENT,
    razaoSocial VARCHAR(255) NOT NULL,
    nomeFantasia VARCHAR(255) NOT NULL,
    cnpj VARCHAR(18) NOT NULL,
    responsavel VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    ddd VARCHAR(3) NOT NULL,
    telefone VARCHAR(10) NOT NULL
);
