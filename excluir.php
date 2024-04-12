<?php 
require 'conexao.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Consulta para obter informações do usuário antes de excluir
        $sql_select = "SELECT * FROM usuarios WHERE id = :id";
        $stmt_select = $conexao->prepare($sql_select);
        $stmt_select->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_select->execute();
        $usuario = $stmt_select->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo 'Usuário não encontrado.';
            exit();
        }

        // Exclusão do usuário
        $sql_delete = "DELETE FROM usuarios WHERE id = :id";
        $stmt_delete = $conexao->prepare($sql_delete);
        $stmt_delete->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_delete->execute();

        echo 'Usuário excluído com sucesso.';
    } catch (PDOException $e) {
        echo 'Erro ao excluir o usuário: ' . $e->getMessage();
    }
} else {
    echo 'ID de usuário inválido.';
}
?>

?>