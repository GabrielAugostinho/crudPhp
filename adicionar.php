<?php 
require 'conexao.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        try {
            $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            header('Location:listar.php');
            exit();
        }
        catch (PDOException $e) {
            echo 'Erro ao adicionar usuário: '. $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adicionar</title>
</head>
<body>
    <h2>Adicionar usuário</h2>
    <form action="adicionar.php" method="post">
       Nome: <input type="text" name="nome">
       Email: <input type="email" name="email">
        <input type="submit" value="Adicionar">
    </form>
</body>
</html>