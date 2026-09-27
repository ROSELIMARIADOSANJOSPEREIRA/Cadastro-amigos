<?php
/*
 * index.php - Tela de Login
 * ------------------------------------------------------------
 * Esta e a "porta de entrada" do sistema. Ninguem consegue ver a
 * lista de amigos sem antes fazer login aqui.
 *
 * session_start() precisa ser SEMPRE a primeira coisa do arquivo.
 * E ela quem permite que o PHP "lembre" que um usuario esta logado
 * enquanto ele navega entre as paginas.
 */
session_start();

// Se o usuario JA estiver logado, nao faz sentido mostrar o login de novo:
// ele e mandado direto para a lista de amigos.
if (isset($_SESSION['usuario_id'])) {
    header("Location: listar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Cadastro de Amigos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <div class="caixa-login">
        <h1>👥 Cadastro de Amigos</h1>
        <p class="subtitulo">Faça login para continuar</p>

        <?php
        // Se veio um erro do processa_login.php (via redirecionamento), mostra aqui
        if (isset($_GET['erro'])) {
            echo "<p class='mensagem-erro'>E-mail ou senha incorretos.</p>";
        }
        ?>

        <!-- O formulário envia os dados via POST para processa_login.php -->
        <form action="processa_login.php" method="POST">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>
    </div>

</body>
</html>
