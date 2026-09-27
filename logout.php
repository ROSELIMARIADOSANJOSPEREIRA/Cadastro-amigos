<?php
/*
 * logout.php
 * ------------------------------------------------------------
 * Encerra a sessao do usuario, ou seja, "tira o cracha" dele.
 * session_destroy() apaga todas as informacoes que estavam
 * guardadas na sessao (usuario_id, usuario_nome...).
 */
session_start();
session_destroy();
header("Location: index.php");
exit();
