<?php
session_start();
require 'conexao2.php';

if (isset($_POST['create_turma'])) {

    // 2. CAPTURA DOS DADOS: Limpa e escapa os dados de entrada
    $turma = mysqli_real_escape_string($conexao, trim($_POST['turma']));
    $curso = mysqli_real_escape_string($conexao, trim($_POST['curso']));
    $local = mysqli_real_escape_string($conexao, trim($_POST['local'])); 
    $periodo = mysqli_real_escape_string($conexao, trim($_POST['periodo'])); 
    $status = (int)$_POST['status'];

    // 3. Monta a query SQL para incluir o novo campo 'status'
    // Como status é um número, não precisa de aspas simples ('') ao redor dele na query.
    $sql = "INSERT INTO turmas (nome_turma, curso, local, periodo, status) VALUES ('$turma', '$curso', '$local','$periodo', $status)";

    $query_run = mysqli_query($conexao, $sql);

    
    if ($query_run) {
        $_SESSION['mensagem'] = "Turma criada com sucesso!";
        header("Location: index-turmas.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao criar turma: " . mysqli_error($conexao);
        header("Location: index-turmas.php");
        exit();
    }
}

if (isset($_POST['update_turma'])) {
    // 1. Variável de ID da turma
    $turma_id = mysqli_real_escape_string($conexao, $_POST['turma_id']);

    // Captura dos dados, limpando e escapando
    // Certifique-se de que o 'name' do input no seu HTML de edição é 'turma'
    $turma = mysqli_real_escape_string($conexao, trim($_POST['turma'])); // Captura o valor do campo 'turma' do formulário
    $curso    = mysqli_real_escape_string($conexao, trim($_POST['curso']));
    $local    = mysqli_real_escape_string($conexao, trim($_POST['local']));
    $periodo  = mysqli_real_escape_string($conexao, trim($_POST['periodo']));
    $status   = (int)$_POST['status']; 

    // Iniciar a construção da query SQL
    $sql = "UPDATE turmas SET ";
    $updates = []; // Array para armazenar as partes da atualização

    // Adiciona os campos que serão atualizados
    // CORRIGIDO: O nome da coluna no banco de dados deve ser 'nome_turma'
    $updates[] = "nome_turma = '$turma'"; // Agora o nome da coluna no SQL é 'nome_turma'
    $updates[] = "curso = '$curso'";
    $updates[] = "local = '$local'";
    $updates[] = "periodo = '$periodo'";
    $updates[] = "status = $status"; // Sem aspas para tipo numérico

    // Une todas as partes da atualização com vírgulas
    $sql .= implode(', ', $updates);

    // Cláusula WHERE usando o ID da turma
    $sql .= " WHERE id = '$turma_id'";

    $query_run = mysqli_query($conexao, $sql);

    if ($query_run) {
        $_SESSION['mensagem'] = "Turma atualizada com sucesso!";
        header("Location: index-turmas.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Turma não foi atualizada: " . mysqli_error($conexao);
        header("Location: turma-editar.php?id=" . $turma_id);
        exit();
    }
}

if(isset($_POST['delete_turma'])){
    $turma_id = mysqli_real_escape_string($conexao, $_POST['delete_turma']);
    
    $sql = "DELETE FROM turmas WHERE id = '$turma_id'"; 

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao)>0){
        $_SESSION['mensagem'] = 'Turma deletada com sucesso';
        header ('Location: index-turmas.php');
    } else{
        $_SESSION['mensagem'] = 'Turma não foi deletada';
        header ('Location: index-turmas.php');
        exit;
    }
}
?>
