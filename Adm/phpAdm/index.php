<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
      <div class="container mt-4">
        <?php
        if (file_exists('mensagem.php')) {
            include('mensagem.php');
        }
        include 'masterAdm.php'
        ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Lista de Usúarios
                <!-- A classe do botão foi alterada aqui -->
                <a href="usuario-create.php" class="btn btn-custom float-end">Adicionar usúario</a>
                </h4>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Nivel</th>
                      <th>Senha</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>teste</td>
                      <td>Aluno</td>
                      <td>12345</td>
                      <td>
                        <a href="" class="btn btn-secondary btn-sm">Visualizar</a>
                        <a href="" class="btn btn-custom btn-sm">Editar</a>
                        <form action="" method="post" class="d-inline">
                          <button type="submit" name="delete-usuario" value="1" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>