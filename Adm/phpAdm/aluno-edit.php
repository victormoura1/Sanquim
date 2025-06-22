<?php
session_start();
require 'conexao2.php';
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aluno - Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <style>
    .btn-custom {
        background-color: #379091;
        border-color: #379091;
        color: #fff;
    }

    .btn-custom:hover {
        background-color: #307f81;
        border-color: #307f81;
        color: #fff;
    }
    .form-control:focus,
    .form-select:focus {
        border-color: #379091; /* Border color when focused */
        box-shadow: 0 0 0 0.25rem rgba(55, 144, 145, 0.25); /* Subtle shadow with custom color */
    }
    </style>
  </head>
  <body>
    <?php
    include 'masterAdm.php';
    ?>
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Aluno
                            <a href="index-alunos.php" class="btn btn-custom float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                    if (isset($_GET['id'])){
                        $aluno_id = mysqli_real_escape_string($conexao, $_GET['id']);
                        $sql = "SELECT * FROM alunos WHERE id='$aluno_id'";
                        $query = mysqli_query($conexao, $sql);
                        
                        if (mysqli_num_rows($query) > 0){
                            $aluno = mysqli_fetch_array($query);
                        
                    ?>
                        <form action="acoes-aluno.php" method="POST">
                            <input type="hidden" name="aluno_id" value="<?=$aluno['id']?>">


                            <div class="mb-3">
                                <label>Nome</label>
                                <input type="text" name="nome" value="<?= $aluno['nome']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Data de Nascimento</label>
                                <input type="date" name="data_nascimento" value="<?= $aluno['data_nascimento']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>CPF</label>
                                <input type="text" name="cpf" value="<?= $aluno['cpf']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>RG</label>
                                <input type="text" name="rg" value="<?= $aluno['rg']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Endereço</label>
                                <input type="text" name="endereco" value="<?= $aluno['endereco']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Bairro</label>
                                <input type="text" name="bairro" value="<?= $aluno['bairro']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Cidade</label>
                                <input type="text" name="cidade" value="<?= $aluno['cidade']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Telefone</label>
                                <input type="text" name="telefone" value="<?= $aluno['fone']; ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="text" name="email" value="<?= $aluno['email']; ?>" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Status (1 para Ativo, 0 para Inativo)</label>
                                <input type="number" name="status" value="<?= $aluno['status']; ?>" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="update_aluno" class="btn btn-custom">Atualizar Aluno</button>
                            </div>
                        </form>
                        <?php
                        } else {
                            echo "<h5>Aluno não encontrado  </h5>";
                        }
                    }
                        ?>
                    </div>
                </div>
            </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>