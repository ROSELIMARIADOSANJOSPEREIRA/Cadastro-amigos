<?php
/*
 * editar.php - metade "formulario" da operacao UPDATE do CRUD
 * ------------------------------------------------------------
 * Recebe o "id" do amigo pela URL (?id=5, por exemplo), busca os
 * dados atuais dele no banco, e preenche o formulario com esses
 * dados para o usuario poder alterar o que quiser.
 */
require "verifica_login.php";
require "conexao.php";

$id = $_GET['id'];

// O "AND usuario_id = ?" e uma trava de seguranca importante:
// impede que alguem edite um amigo de OUTRO usuario so trocando
// o numero na URL (ex: editar.php?id=8).
$sql = "SELECT * FROM amigos WHERE id = ? AND usuario_id = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "ii", $id, $_SESSION['usuario_id']);
mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);
$amigo = mysqli_fetch_assoc($resultado);

// Se nao encontrou nenhum amigo (id errado ou de outra pessoa), volta pra lista
if (!$amigo) {
    header("Location: listar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Amigo</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <div class="caixa-form">
        <h1>Editar amigo</h1>

        <form action="processa_editar.php" method="POST">
            <!-- campo escondido: viaja junto no POST para o processa_editar.php saber QUAL amigo alterar -->
            <input type="hidden" name="id" value="<?php echo $amigo['id']; ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($amigo['nome']); ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($amigo['telefone']); ?>">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($amigo['email']); ?>">

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($amigo['cidade']); ?>">

            <button type="submit">Salvar alterações</button>
            <a href="listar.php" class="link-voltar">Cancelar</a>
        </form>
    </div>

</body>
</html>
