<?php
session_start();
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Turma</title>
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

    /* Custom focus styles for form controls */
    .form-control:focus,
    .form-select:focus {
        border-color: #379091; /* Border color when focused */
        box-shadow: 0 0 0 0.25rem rgba(55, 144, 145, 0.25); /* Subtle shadow with custom color */
    }
    </style>
  </head>
  <body>
    <?php
    include'masterAdm.php'
    ?>
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar Turma
                            <a href="index-turmas.php" class="btn btn-custom float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="acoes-turma.php" method="POST">
                            <div class="mb-3">
                                <label>Turma</label>
                                <input type="text" name="turma" class="form-control" required>
                            </div>
                             <div class="mb-3">
                                <label>Curso</label>
                                <input type="text" name="curso" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Local</label>
                                <input type="text" name="local" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Periodo</label>
                                <input type="text" name="periodo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Status (1 para Ativo, 0 para Inativo)</label>
                                <input type="number" name="status" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="create_turma" class="btn btn-custom">Salvar Turma</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>