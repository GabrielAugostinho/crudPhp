<?php 
$hostname = 'localhost';
$username = 'root';
$password = '1234';
$database = 'pdo_php';

try {
    $conexao = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro na conexão: ' . $e->getMessage());
}

?>