<?php
session_start();
require 'conexao2.php';

// Verifica se o formulário com o nome 'create_usuario' foi submetido
if (isset($_POST['create_usuario'])) {

    // 1. VALIDAÇÃO: Adicionamos a verificação para o campo 'status'
    if (empty(trim($_POST['usuario'])) || empty(trim($_POST['nivel'])) || empty(trim($_POST['senha'])) || !isset($_POST['status'])) {
        $_SESSION['message'] = "Erro: Todos os campos são obrigatórios.";
        header("Location: usuario-create.php");
        exit();
    }
       
    // 2. CAPTURA DOS DADOS: Limpa e escapa os dados de entrada
    $usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
    $nivel = mysqli_real_escape_string($conexao, trim($_POST['nivel']));
    $senha = mysqli_real_escape_string($conexao, password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)); // Lembre-se de hashear no futuro!
    $status = (int)$_POST['status'];

    // 3. Monta a query SQL para incluir o novo campo 'status'
    // Como status é um número, não precisa de aspas simples ('') ao redor dele na query.
    $sql = "INSERT INTO usuarios (usuario, nivel, senha, status) VALUES ('$usuario', '$nivel', '$senha', $status)";

    $query_run = mysqli_query($conexao, $sql);

    
    if ($query_run) {
        $_SESSION['message'] = "Usuário criado com sucesso!";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['message'] = "Erro ao criar usuário: " . mysqli_error($conexao);
        header("Location: usuario-create.php");
        exit();
    }
}
?>
