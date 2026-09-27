<?php
/*
 * ARQUIVO AUXILIAR - gerar_hash.php
 * ------------------------------------------------------------
 * Esse arquivo NAO faz parte do sistema em si. Ele existe so
 * para gerar o "hash" (a versao criptografada) de uma senha.
 *
 * Por que isso e necessario?
 * Nunca devemos guardar senhas como texto puro no banco de dados.
 * Se alguem tivesse acesso ao banco, veria todas as senhas dos
 * usuarios. Por isso usamos a funcao password_hash(), que
 * transforma "123456" em um codigo embaralhado e irreversivel,
 * como "$2y$10$ab12cd34...".
 *
 * Como usar:
 * 1) Suba este arquivo no XAMPP junto com o resto do projeto
 * 2) Acesse no navegador: http://localhost/cadastro-amigos/gerar_hash.php
 * 3) Copie o hash gerado e cole no INSERT do database.sql
 */

// Troque '123456' pela senha que quiser usar no cadastro de teste
$senhaOriginal = '123456';

// password_hash() faz toda a criptografia sozinha, usando o
// algoritmo mais seguro disponivel no momento (PASSWORD_DEFAULT)
$hashGerado = password_hash($senhaOriginal, PASSWORD_DEFAULT);

echo "Senha original: " . $senhaOriginal . "<br>";
echo "Hash gerado (copie esta linha para o database.sql): <br>";
echo $hashGerado;
