<?php
/*
 * verifica_login.php
 * ------------------------------------------------------------
 * Este arquivo e um "porteiro". Toda pagina que so pode ser vista
 * por quem esta logado (listar, cadastrar, editar, excluir) comeca
 * incluindo este arquivo.
 *
 * Ele checa uma unica coisa: existe um usuario_id guardado na
 * sessao? Se nao existir, quer dizer que ninguem fez login, entao
 * a pagina e interrompida (exit) e o visitante e mandado para o login.
 */
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}
