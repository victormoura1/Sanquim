<?php
session_start();
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Aviso</title>
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
                        <h4>Adicionar Aviso
                            <a href="central-avisos.php" class="btn btn-custom float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="acoes-aviso.php" method="POST">
                            <div class="mb-3">
                                <label>Titulo</label>
                                <input type="text" name="titulo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Conteudo</label>
                                <textarea name="conteudo" class="form-control" rows="5" required></textarea>
                                </div>
                           <div class="mb-3">
                                <label>Data</label>
                                <input type="date" name="data" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Publicado Por:</label>
                                <input type="text" name="publicado_por" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="create_aviso" class="btn btn-custom">Salvar Aviso</button>
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