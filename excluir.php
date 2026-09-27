<?php
/*
 * excluir.php - operacao DELETE do CRUD
 * ------------------------------------------------------------
 * Apaga definitivamente um amigo do banco de dados. Repare que o
 * link que chama esta pagina (em listar.php) tem uma confirmacao
 * em JavaScript (confirm()) antes de deixar o clique acontecer,
 * evitando exclusao acidental.
 */
require "verifica_login.php";
require "conexao.php";

$id = $_GET['id'];

// De novo, o "AND usuario_id = ?" impede excluir amigo de outro usuario
$sql = "DELETE FROM amigos WHERE id = ? AND usuario_id = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "ii", $id, $_SESSION['usuario_id']);
mysqli_stmt_execute($comando);

header("Location: listar.php");
exit();
