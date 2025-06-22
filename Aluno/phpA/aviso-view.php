<?php
require 'conexao2.php';
// Inicie o buffer de saída AQUI
ob_start();
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Turma - Visualizar</title>
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
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar Turma
                            <a href="index-turmas.php" class="btn btn-custom float-end">Voltar para Turmas</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])){
                            $turma_id = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT * FROM turmas WHERE id='$turma_id'";
                            $query = mysqli_query($conexao, $sql);

                            if(mysqli_num_rows($query)>0){
                                $turma = mysqli_fetch_array($query);
                        ?>
                        <form action="acoes-turma.php" method="POST">
                            <div class="mb-3">
                                <label>Nome da Turma</label>
                                <p class="form-control">
                                    <?=$turma['nome_turma']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Curso</label>
                                <p class="form-control">
                                    <?=$turma['curso']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Local</label>
                                <p class="form-control">
                                    <?=$turma['local']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Periodo</label>
                                <p class="form-control">
                                    <?=$turma['periodo']?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Status</label>
                                <p class="form-control">
                                    <?=($turma['status'] == 1) ? 'Ativo' : 'Inativo'; ?>
                                </p>
                            </div>
                        </form>
                        <?php
                            } else {
                                echo "<h5>Turma não encontrada</h5>";
                            }
                        } else {
                            echo "<h5>ID da turma não fornecido</h5>";
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
<?php
// Capture o conteúdo do buffer de saída AQUI
$page_content = ob_get_clean();
// Inclua o masterA.php DEPOIS de capturar o conteúdo
include 'masterA.php';
?>