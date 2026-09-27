<?php
/*
 * processa_editar.php - metade "grava no banco" da operacao UPDATE
 * ------------------------------------------------------------
 * Recebe os dados alterados no formulario de editar.php e atualiza
 * a linha correspondente na tabela "amigos" usando UPDATE.
 */
require "verifica_login.php";
require "conexao.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$cidade = $_POST['cidade'];

// "WHERE id = ? AND usuario_id = ?" garante, de novo, que a pessoa
// so consegue alterar amigos que pertencem a ela mesma.
$sql = "UPDATE amigos SET nome = ?, telefone = ?, email = ?, cidade = ? WHERE id = ? AND usuario_id = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "ssssii", $nome, $telefone, $email, $cidade, $id, $_SESSION['usuario_id']);
mysqli_stmt_execute($comando);

header("Location: listar.php");
exit();
