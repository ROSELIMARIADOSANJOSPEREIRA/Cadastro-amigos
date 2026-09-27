<?php
/*
 * listar.php - operacao READ (Ler) do CRUD
 * ------------------------------------------------------------
 * Mostra todos os amigos que o usuario logado ja cadastrou.
 * Repare que o SELECT filtra "WHERE usuario_id = ?": assim, cada
 * pessoa so ve os amigos que ELA cadastrou, nunca os de outro usuario.
 */
require "verifica_login.php"; // porteiro: barra quem nao esta logado
require "conexao.php";

$sql = "SELECT id, nome, telefone, email, cidade FROM amigos WHERE usuario_id = ? ORDER BY nome ASC";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $_SESSION['usuario_id']);
mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Amigos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <div class="topo">
        <h1>👥 Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
        <a href="logout.php" class="botao-sair">Sair</a>
    </div>

    <a href="cadastro.php" class="botao-novo">+ Cadastrar novo amigo</a>

    <table class="tabela-amigos">
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Cidade</th>
            <th>Ações</th>
        </tr>

        <?php
        // mysqli_fetch_assoc() traz uma linha do banco por vez, ate acabar.
        // O "while" repete a criacao da linha da tabela HTML para cada amigo encontrado.
        while ($amigo = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($amigo['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($amigo['telefone']) . "</td>";
            echo "<td>" . htmlspecialchars($amigo['email']) . "</td>";
            echo "<td>" . htmlspecialchars($amigo['cidade']) . "</td>";
            echo "<td>
                    <a href='editar.php?id=" . $amigo['id'] . "'>Editar</a> |
                    <a href='excluir.php?id=" . $amigo['id'] . "' onclick=\"return confirm('Excluir este amigo?');\">Excluir</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
