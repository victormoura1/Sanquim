<?php
session_start();
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Usuário</title>
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
    include'masterAdm.php'
    ?>
      <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Adicionar Usuário
                            <a href="index.php" class="btn btn-custom float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="acoes.php" method="POST">
                            <div class="mb-3">
                                <label>Nome de Usuário</label>
                                <input type="text" name="usuario" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nivel">Nível</label>
                                <select name="nivel" id="nivel" class="form-select" required>
                                    <option value="" disabled selected>Selecione um nível</option>
                                    <option value="aluno">Aluno</option>
                                    <option value="professor">Professor</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Senha</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Status (1 para Ativo, 0 para Inativo)</label>
                                <input type="number" name="status" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="create_usuario" class="btn btn-custom">Salvar Usuário</button>
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
