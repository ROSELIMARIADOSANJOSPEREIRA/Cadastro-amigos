<?php
/*
 * conexao.php
 * ------------------------------------------------------------
 * Este arquivo tem uma unica responsabilidade: abrir a conexao
 * com o banco de dados MySQL. Todos os outros arquivos do sistema
 * "chamam" este aqui (com include ou require) sempre que precisam
 * conversar com o banco. Assim, se um dia o banco mudar de nome,
 * senha ou servidor, so precisamos alterar em UM lugar.
 */

// Dados de acesso ao banco (no XAMPP, o padrao e usuario "root" e senha vazia)
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "cadastro_amigos";

// mysqli_connect() abre a conexao e guarda o "canal aberto" na variavel $conexao
$conexao = mysqli_connect($host, $usuario, $senha, $banco);

// Se a conexao falhar, o sistema para aqui e mostra o motivo do erro,
// em vez de continuar e travar em outro lugar sem explicacao
if (!$conexao) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Garante que os acentos e caracteres especiais (a, ç, ã...) apareçam corretos
mysqli_set_charset($conexao, "utf8");
