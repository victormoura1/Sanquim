<?php
session_start(); // Inicia a sessão

include 'conexao.php'; // Inclui seu arquivo de conexão com o banco de dados

// Verifique se os dados do formulário foram enviados
if (!isset($_REQUEST['usuario']) || !isset($_REQUEST['senha'])) {
    // Se os dados não foram enviados, armazena a mensagem na sessão
    $_SESSION['mensagem_login'] = "Por favor, preencha todos os campos.";
    header("location: ./Login/login.php"); // Redireciona sem parâmetro de erro
    exit();
}

$user = $_REQUEST['usuario'];
$pass = $_REQUEST['senha'];

// Usando Prepared Statements para segurança (altamente recomendado!)
$stmt = mysqli_prepare($link, "SELECT senha, nivel FROM usuarios WHERE usuario = ?");

if ($stmt === false) {
    error_log("Erro ao preparar a consulta: " . mysqli_error($link));
    $_SESSION['mensagem_login'] = "Ocorreu um erro interno. Tente novamente mais tarde.";
    header("location: ./Login/login.php");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) > 0) {
    $row = mysqli_fetch_assoc($resultado);
    $hashed_password_from_db = $row['senha'];
    $user_level = $row['nivel'];

    if (password_verify($pass, $hashed_password_from_db)) {
        // Login bem-sucedido
        $_SESSION['usuario'] = $user;
        $_SESSION['nivel'] = $user_level;

        switch ($user_level) {
            case 'aluno':
                header("location: Aluno/phpA/pagina1.php");
                break;
            case 'professor':
                header("location: Professor/phpP/pagina1.php");
                break;
            case 'administrador':
                header("location: Adm/phpAdm/cadastro-matricula.php");
                break;
            default:
                // Nível desconhecido, armazena a mensagem na sessão
                $_SESSION['mensagem_login'] = "Erro interno: Nível de usuário desconhecido.";
                header("location: ./Login/login.php");
                break;
        }
        exit();
    } else {
        // Senha incorreta, armazena a mensagem na sessão
        $_SESSION['mensagem_login'] = "Usuário ou senha incorretos.";
        header("location: ./Login/login.php");
        exit();
    }
} else {
    // Usuário não encontrado, armazena a mensagem na sessão
    $_SESSION['mensagem_login'] = "Usuário ou senha incorretos.";
    header("location: ./Login/login.php");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($link);
?>