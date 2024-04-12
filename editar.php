<?php 
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    try {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        header('Location: listar.php');
        exit();
    } catch (PDOException $e) {
        echo 'Erro ao editar o usuário: ' . $e->getMessage();
    }
} else if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo 'Usuário não encontrado.';
            exit();
        }
    } catch (PDOException $e) {
        echo 'Erro na consulta: ' . $e->getMessage();
    }
}
var_dump($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <h2>Editar</h2>
    <?php if (isset($usuario)): ?>
    <form action="editar.php" method="post">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>">
        <input type="email" name="email" value="<?php echo $usuario['email']; ?>">
        <input type="submit" value="Editar">
    </form>
    <?php else: ?>
    <p>Usuário não encontrado.</p>
    <?php endif; ?>
    <br>
    <a href="listar.php">Voltar para a lista</a>
</body>
</html>
