<?php
session_start();
require 'conexao2.php';
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuário - Editar</title>
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
                        <h4>Editar Usuário
                            <a href="index.php" class="btn btn-custom float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <?php
                    if (isset($_GET['id'])){
                        $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']);
                        $sql = "SELECT * FROM usuarios WHERE id='$usuario_id'";
                        $query = mysqli_query($conexao, $sql);
                        
                        if (mysqli_num_rows($query) > 0){
                            $usuario = mysqli_fetch_array($query);
                        
                    ?>
                        <form action="acoes.php" method="POST">
                            <input type="hidden" name="usuario_id" value="<?=$usuario['id']?>">


                            <div class="mb-3">
                                <label>Nome de Usuário</label>
                                <input type="text" name="usuario" value="<?= $usuario['usuario']; ?>" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nivel">Nível</label>
                                <select name="nivel" id="nivel" class="form-select" required>
                                    <option value="">Selecione um nível</option>
                                    <option value="aluno" <?= ($usuario['nivel'] == 'aluno') ? 'selected' : ''; ?>>Aluno</option>
                                    <option value="professor" <?= ($usuario['nivel'] == 'operador') ? 'selected' : ''; ?>>Professor</option>
                                    <option value="administrador" <?= ($usuario['nivel'] == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Status (1 para Ativo, 0 para Inativo)</label>
                                <input type="number" name="status" value="<?= $usuario['status']; ?>" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Senha (deixe em branco para não alterar)</label>
                                <input type="password" name="senha" class="form-control">
                                <small class="form-text text-muted">Apenas preencha este campo se quiser alterar a senha.</small>
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="update_usuario" class="btn btn-custom">Atualizar Usuário</button>
                            </div>
                        </form>
                        <?php
                        } else {
                            echo "<h5>Usuário não encontrado</h5>";
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