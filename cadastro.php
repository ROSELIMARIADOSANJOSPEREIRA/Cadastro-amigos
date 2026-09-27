<?php
/*
 * cadastro.php - metade "formulario" da operacao CREATE do CRUD
 * ------------------------------------------------------------
 * Esta pagina so mostra o formulario vazio. Quem realmente grava
 * no banco de dados e o processa_cadastro.php, para onde este
 * formulario envia os dados.
 */
require "verifica_login.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Amigo</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <div class="caixa-form">
        <h1>Cadastrar novo amigo</h1>

        <form action="processa_cadastro.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email">

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade">

            <button type="submit">Salvar</button>
            <a href="listar.php" class="link-voltar">Cancelar</a>
        </form>
    </div>

</body>
</html>
