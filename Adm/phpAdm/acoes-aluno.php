<?php
session_start();
require 'conexao2.php';

if (isset($_POST['create_aluno'])) {

    // 2. CAPTURA DOS DADOS: Limpa e escapa os dados de entrada
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
    $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf'])); 
    $rg = mysqli_real_escape_string($conexao, trim($_POST['rg'])); 
    $endereco= mysqli_real_escape_string($conexao, trim($_POST['endereco']));
    $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro'])); 
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email'])); 
    $status = (int)$_POST['status'];

    // 3. Monta a query SQL para incluir o novo campo 'status'
    // Como status é um número, não precisa de aspas simples ('') ao redor dele na query.
    $sql = "INSERT INTO alunos (nome, data_nascimento, cpf, rg, endereco, bairro, cidade, fone, email, status) VALUES ('$nome', '$data_nascimento', '$cpf','$rg', '$endereco', '$bairro', '$cidade', '$telefone', '$email', $status)";
    $query_run = mysqli_query($conexao, $sql);

    
    if ($query_run) {
        $_SESSION['mensagem'] = "Aluno matriculado com sucesso!";
        header("Location: index-alunos.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Erro ao matricular aluno: " . mysqli_error($conexao);
        header("Location: index-alunos.php");
        exit();
    }
}

if (isset($_POST['update_aluno'])) {
    // 1. Variável de ID da turma
    $aluno_id = mysqli_real_escape_string($conexao, $_POST['aluno_id']);

    // Captura dos dados, limpando e escapando
    // Certifique-se de que o 'name' do input no seu HTML de edição é 'turma'
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
    $data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));
    $cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf'])); 
    $rg = mysqli_real_escape_string($conexao, trim($_POST['rg'])); 
    $endereco= mysqli_real_escape_string($conexao, trim($_POST['endereco']));
    $bairro = mysqli_real_escape_string($conexao, trim($_POST['bairro'])); 
    $cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
    $telefone = mysqli_real_escape_string($conexao, trim($_POST['telefone']));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email'])); 
    $status = (int)$_POST['status'];
    // Iniciar a construção da query SQL
    $sql = "UPDATE alunos SET ";
    $updates = []; // Array para armazenar as partes da atualização

    // Adiciona os campos que serão atualizados
    // CORRIGIDO: O nome da coluna no banco de dados deve ser 'nome_turma'
    $updates[] = "nome = '$nome'"; // Agora o nome da coluna no SQL é 'nome_turma'
    $updates[] = "data_nascimento = '$data_nascimento'";
    $updates[] = "cpf = '$cpf'";
    $updates[] = "rg = '$rg'";
    $updates[] = "endereco = '$endereco'";
    $updates[] = "bairro = '$bairro'";
    $updates[] = "cidade = '$cidade'";
    $updates[] = "fone = '$telefone'";
    $updates[] = "email = '$email'";
    $updates[] = "status = $status"; // Sem aspas para tipo numérico

    // Une todas as partes da atualização com vírgulas
    $sql .= implode(', ', $updates);

    // Cláusula WHERE usando o ID da turma
    $sql .= " WHERE id = '$aluno_id'";

    $query_run = mysqli_query($conexao, $sql);

    if ($query_run) {
        $_SESSION['mensagem'] = "Aluno atualizado com sucesso!";
        header("Location: index-alunos.php");
        exit();
    } else {
        $_SESSION['mensagem'] = "Aluno não foi atualizado: " . mysqli_error($conexao);
        header("Location: aluno-editar.php?id=" . $aluno_id);
        exit();
    }
}

if(isset($_POST['delete_aluno'])){
    $aluno_id = mysqli_real_escape_string($conexao, $_POST['delete_aluno']);
    
    $sql = "DELETE FROM alunos WHERE id = '$aluno_id'"; 

    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao)>0){
        $_SESSION['mensagem'] = 'Aluno deletado com sucesso';
        header ('Location: index-alunos.php');
    } else{
        $_SESSION['mensagem'] = 'Aluno não foi deletado';
        header ('Location: index-alunos.php');
        exit;
    }
}
?>
