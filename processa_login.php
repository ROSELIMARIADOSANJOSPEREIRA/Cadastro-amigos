<?php
/*
 * processa_login.php
 * ------------------------------------------------------------
 * Este arquivo nunca e visto diretamente pelo usuario. Ele so
 * "trabalha nos bastidores": recebe o que foi digitado no
 * formulario de login, confere no banco de dados, e decide se
 * deixa a pessoa entrar ou nao.
 *
 * Passo a passo do que acontece aqui:
 *  1) Pega o e-mail e a senha que vieram do formulario (POST)
 *  2) Procura no banco um usuario com aquele e-mail
 *  3) Compara a senha digitada com o HASH guardado no banco
 *  4) Se bater, cria a "sessao" (o cracha temporario do usuario)
 *  5) Se nao bater, manda a pessoa de volta pro login com um aviso
 */
session_start();
require "conexao.php";

$email = $_POST['email'];
$senhaDigitada = $_POST['senha'];

// Prepared statement: usamos "?" no lugar do valor para evitar
// SQL Injection (um tipo de ataque onde alguem tenta "injetar"
// comandos SQL maliciosos dentro dos campos do formulario)
$sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "s", $email);
mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);
$usuario = mysqli_fetch_assoc($resultado);

// password_verify() compara a senha digitada com o hash do banco.
// Ela faz isso sem nunca "descriptografar" o hash, o que e o correto:
// um hash bom nao pode ser revertido, so comparado.
if ($usuario && password_verify($senhaDigitada, $usuario['senha'])) {

    // Login correto: guardamos os dados na SESSAO.
    // A partir daqui, todas as paginas do sistema vao poder checar
    // "existe um usuario_id na sessao?" para saber se pode liberar o acesso.
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];

    header("Location: listar.php");
    exit();

} else {
    // Login incorreto: volta para a tela de login com um aviso na URL
    header("Location: index.php?erro=1");
    exit();
}
