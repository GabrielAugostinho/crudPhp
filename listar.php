<?php 
require 'conexao.php';

try {
    $sql = "SELECT * FROM usuarios";
    $stmt = $conexao->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die ('Erro na consulta: ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de usuários</title>
</head>
<body>
    <h2>Lista de usuários</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
        <?php foreach($usuarios as $usuario) : ?>
            <tr>
                <td><?php echo $usuario['id'];?></td>
                <td><?php echo $usuario['nome'];?></td>
                <td><?php echo $usuario['email'];?></td>
                <td><a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a></td>
                <td><a href="excluir.php?id=<?php echo $usuario['id']; ?>">Excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>