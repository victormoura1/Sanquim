<?php
$servidor = '127.0.0.1';
$usuario = 'root';
$senha = ''; // <-- A SENHA DEVE ESTAR VAZIA!
$banco = 'sanquim';

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}
?>