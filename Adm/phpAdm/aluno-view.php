<?php
require 'conexao2.php';
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aluno - Visualizar</title>
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
                        <h4>Visualizar Aluno
                            <a href="index-alunos.php" class="btn btn-custom float-end">Voltar para Alunos</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])){
                            $aluno_id = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT * FROM alunos WHERE id='$aluno_id'";
                            $query = mysqli_query($conexao, $sql);

                            if(mysqli_num_rows($query)>0){
                                $aluno = mysqli_fetch_array($query);

                                // Função para formatar o telefone para exibição
                                function formatarTelefone($numero) {
                                    // Remove tudo que não for dígito
                                    $numeroLimpo = preg_replace('/\D/', '', $numero);

                                    // Verifica se é um número de 11 dígitos (com 9º dígito)
                                    if (strlen($numeroLimpo) == 11) {
                                        return '(' . substr($numeroLimpo, 0, 2) . ')' . substr($numeroLimpo, 2, 5) . '-' . substr($numeroLimpo, 7, 4);
                                    } 
                                    // Verifica se é um número de 10 dígitos (sem 9º dígito)
                                    elseif (strlen($numeroLimpo) == 10) {
                                        return '(' . substr($numeroLimpo, 0, 2) . ')' . substr($numeroLimpo, 2, 4) . '-' . substr($numeroLimpo, 6, 4);
                                    }
                                    // Caso não seja 10 ou 11 dígitos, retorna o número como está
                                    return $numero; 
                                }
                        ?>
                        <form action="acoes-aluno.php" method="POST">
                            <div class="mb-3">
                                <label>Nome</label>
                                <p class="form-control">
                                    <?=$aluno['nome']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>RA</label>
                                <p class="form-control">
                                    <?=$aluno['ra']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Data de Nascimento</label>
                                <p class="form-control">
                                    <?=date('d/m/Y', strtotime($aluno['data_nascimento']))?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>CPF</label>
                                <p class="form-control" type="date">
                                    <?=$aluno['cpf']?>
                                </p>
                            </div>
                             <div class="mb-3">
                                <label>RG</label>
                                <p class="form-control">
                                    <?=$aluno['rg']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Endereço</label>
                                <p class="form-control">
                                    <?=$aluno['endereco']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Bairro</label>
                                <p class="form-control">
                                    <?=$aluno['bairro']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Cidade</label>
                                <p class="form-control">
                                    <?=$aluno['cidade']?>
                                </p>
                            </div>
                             <div class="mb-3">
                                <label>Telefone</label>
                                <p class="form-control">
                                    <?php
                                        $numeroFormatado = formatarTelefone($aluno['fone']); // Formata para exibição
                                    ?>
                                    <?=$numeroFormatado?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <p class="form-control">
                                    <?=$aluno['email']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <p class="form-control">
                                    <?=($aluno['status'] == 1) ? 'Ativo' : 'Inativo'; ?>
                                </p>
                            </div>
                        </form>
                        <?php
                            } else {
                                echo "<h5>Aluno não encontrada</h5>";
                            }
                        } else {
                            echo "<h5>ID do Aluno não fornecido</h5>";
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