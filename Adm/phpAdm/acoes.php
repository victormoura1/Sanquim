<?php
session_start();
require 'conexao2.php';

if (isset($_POST['create_usuario'])) {

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
        $_SESSION['mensagem'] = "Usuário criado com sucesso!";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao criar usuário: " . mysqli_error($conexao);
        header("Location: index.php");
        exit();
    }
}

if (isset($_POST['update_usuario'])) {
    // 1. Variável de ID do usuário corrigida
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);

    $usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
    $nivel = mysqli_real_escape_string($conexao, trim($_POST['nivel']));
    // O status já vem como número, mas garantir que é um int é bom
    $status = (int)$_POST['status'];
    // Senha digitada, será hasheada se não for vazia
    $senha_digitada = mysqli_real_escape_string($conexao, trim($_POST['senha']));

    // Iniciar a construção da query SQL
    // A vírgula é importante para separar os pares coluna=valor
    $sql = "UPDATE usuarios SET ";
    $updates = []; // Array para armazenar as partes da atualização

    // Adiciona os campos que sempre serão atualizados
    $updates[] = "usuario = '$usuario'";
    $updates[] = "nivel = '$nivel'";
    $updates[] = "status = '$status'";

    // 3. Lógica da senha corrigida: adicionar apenas se não estiver vazia
    if (!empty($senha_digitada)) {
        $senha_hash = password_hash($senha_digitada, PASSWORD_DEFAULT);
        $updates[] = "senha = '$senha_hash'";
    }

    // Une todas as partes da atualização com vírgulas
    $sql .= implode(', ', $updates);

    // 4. Cláusula WHERE corrigida: usando a variável $usuario_id
    $sql .= " WHERE id = '$usuario_id'"; // Se 'id' for INT, as aspas são opcionais mas não prejudicam

    $query_run = mysqli_query($conexao, $sql);

    if ($query_run) {
        $_SESSION['mensagem'] = "Usuário atualizado com sucesso!";
        header("Location: index.php");
        exit();
    } else {
        // É bom redirecionar de volta para a página de edição em caso de erro,
        // para que o usuário saiba qual usuário não foi atualizado.
        $_SESSION['mensagem'] = "Usuário não foi atualizado: " . mysqli_error($conexao);
        header("Location: editar_usuario.php?id=" . $usuario_id); // Passa o ID novamente
        exit();
    }
}

if(isset($_POST['delete_usuario'])){
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_usuario']);
    
    $sql = "DELETE FROM usuarios WHERE id = '$usuario_id'"; 

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao)>0){
        $_SESSION['mensagem'] = 'Usuario deletado com sucesso';
        header ('Location: index.php');
    } else{
        $_SESSION['mensagem'] = 'Usuario não foi deletado';
        header ('Location: index.php');
        exit;
    }
}
?>
