<?php
/*
 * processa_cadastro.php - metade "grava no banco" da operacao CREATE
 * ------------------------------------------------------------
 * Recebe os dados do formulario de cadastro.php e faz um INSERT
 * na tabela "amigos", sempre amarrado ao usuario_id de quem esta
 * logado (para o amigo pertencer a pessoa certa).
 */
require "verifica_login.php";
require "conexao.php";

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$cidade = $_POST['cidade'];
$usuarioId = $_SESSION['usuario_id'];

// Novamente usamos "?" (prepared statement) em vez de colar o valor
// direto na string SQL, para proteger contra SQL Injection.
$sql = "INSERT INTO amigos (nome, telefone, email, cidade, usuario_id) VALUES (?, ?, ?, ?, ?)";
$comando = mysqli_prepare($conexao, $sql);

// "ssssi" indica o TIPO de cada valor, na ordem: s=string, i=inteiro
mysqli_stmt_bind_param($comando, "ssssi", $nome, $telefone, $email, $cidade, $usuarioId);
mysqli_stmt_execute($comando);

// Depois de salvar, volta para a listagem, que ja vai mostrar o novo amigo
header("Location: listar.php");
exit();
