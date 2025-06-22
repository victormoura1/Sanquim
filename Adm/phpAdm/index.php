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
      .btn-voltar {
            display: inline-block;
            /* Define a margem para posicionar o botão */
            margin: 2rem 0 0 2.5rem; /* Margem superior reduzida para 2rem */
            padding: 10px 20px;
            background-color: #379091;
            color: #ffffff;
            font-size: 0.9rem; /* Um pouco menor para não ser tão dominante */
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-voltar:hover {
            background-color: #307f81;
            transform: scale(1.05); /* Efeito de zoom sutil */
            cursor: pointer;
        }
    </style>
    
  </head>
  <body>
        <?php
        include 'masterAdm.php';
        include 'conexao2.php';
        ?>
        <a href="cadastro-matricula.php" class="btn-voltar">< Voltar </a>
      <div class="container mt-4">
        <?php
        include('mensagem.php');
        ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Lista de Usúarios
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
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = 'SELECT * FROM usuarios';
                    $usuarios = mysqli_query($conexao, $sql);
                    if(mysqli_num_rows($usuarios)>0){
                      foreach($usuarios as $usuario){
                    ?>
                    <tr>
                      <td><?=$usuario['id']?></td>
                      <td><?=$usuario['usuario']?></td>
                      <td><?=$usuario['nivel']?></td>
                      <td><?=$usuario['status']?></td>
                      <td>
                        <a href="usuario-view.php?id=<?=$usuario['id']?>" class="btn btn-secondary btn-sm">Visualizar</a>
                        <a href="usuario-edit.php?id=<?=$usuario['id']?>" class="btn btn-custom btn-sm">Editar</a>
                        <form action="acoes.php" method="post" class="d-inline">
                          <button onclick="return confirm('Tem certeza que deseja excluir')"
                          type="submit" name="delete_usuario" value="<?=$usuario['id']?>" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                      </td>
                    </tr>
                    <?php
                    }
                  }
                  else {
                    echo '<h5>Nenhum usuario encontrado</h5>';
                  }
                    ?>
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