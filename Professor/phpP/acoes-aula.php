<?php
session_start();
require 'conexao2.php';

if (isset($_POST['create_aviso'])) {

    $titulo = mysqli_real_escape_string($conexao, trim($_POST['titulo']));
    $conteudo = mysqli_real_escape_string($conexao, trim($_POST['conteudo']));
    $data = mysqli_real_escape_string($conexao, trim($_POST['data']));
    $publicado_por = mysqli_real_escape_string($conexao, trim($_POST['publicado_por'])); 

    $sql = "INSERT INTO avisos (titulo, conteudo, data, publicado_por) VALUES ('$titulo', '$conteudo', '$data', '$publicado_por')";
    $query_run = mysqli_query($conexao, $sql);

    
    if ($query_run) {
        $_SESSION['mensagem'] = "Aviso criado com sucesso!";
        header("Location: central-avisos.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao criar aviso: " . mysqli_error($conexao);
        header("Location: central-avisos.php");
        exit();
    }
}

if (isset($_POST['update_aviso'])) {

    $aviso_id = mysqli_real_escape_string($conexao, $_POST['aviso_id']);

    // Captura dos dados, limpando e escapando
    // Certifique-se de que o 'name' do input no seu HTML de edição é 'turma'
    $titulo = mysqli_real_escape_string($conexao, trim($_POST['titulo'])); // Captura o valor do campo 'turma' do formulário
    $conteudo    = mysqli_real_escape_string($conexao, trim($_POST['conteudo']));
    $data    = mysqli_real_escape_string($conexao, trim($_POST['data']));
    $publicado_por  = mysqli_real_escape_string($conexao, trim($_POST['publicado_por']));

    // Iniciar a construção da query SQL
    $sql = "UPDATE avisos SET ";
    $updates = []; // Array para armazenar as partes da atualização

    $updates[] = "titulo = '$titulo'";
    $updates[] = "conteudo = '$conteudo'";
    $updates[] = "data = '$data'";
    $updates[] = "publicado_por = '$publicado_por'";

    $sql .= implode(', ', $updates);

    $sql .= " WHERE id = '$aviso_id'";

    $query_run = mysqli_query($conexao, $sql);

    if ($query_run) {
        $_SESSION['mensagem'] = "Aviso atualizado com sucesso!";
        header("Location: central-avisos.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Aviso não foi atualizado: " . mysqli_error($conexao);
        header("Location: aviso-editar.php?id=" . $aviso_id);
        exit();
    }
}

if(isset($_POST['delete_aviso'])){ // Verifica se o botão de submit 'delete_aviso' foi clicado
    
    // Pega o ID do aviso do campo oculto (input hidden)
    $aviso_id = mysqli_real_escape_string($conexao, $_POST['aviso_id']); 
    
    $sql = "DELETE FROM avisos WHERE id = '$aviso_id'"; 

    // Executa a consulta SQL de exclusão
    mysqli_query($conexao, $sql);

    // Verifica se alguma linha foi afetada (se o aviso foi realmente deletado)
    if (mysqli_affected_rows($conexao) > 0){
        $_SESSION['mensagem'] = 'Aviso deletado com sucesso!';
        header('Location: central-avisos.php'); // Redireciona de volta para a página principal
        exit(); // É crucial usar exit() após header() para parar a execução do script
    } else {
        $_SESSION['mensagem'] = 'Erro: Aviso não foi deletado ou não foi encontrado.';
        header('Location: central-avisos.php'); // Redireciona mesmo se houver erro
        exit();
    }
}
?>