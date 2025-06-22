
<?php
session_start();

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Central de Avisos - Administrador</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5; /* Um cinza claro para o fundo */
        }
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
        .card-header h4 {
            color: #333;
            font-weight: 500;
        }
        .form-label-custom {
            font-weight: 500;
            color: #333;
        }
        /* Estilo para separar os avisos dentro do card-body */
        .announcement-card {
            margin-bottom: 1rem; /* Espaço entre os cartões de aviso */
            border: 1px solid #e0e0e0;
            border-radius: .5rem;
        }
        .announcement-card:last-child {
            margin-bottom: 0; /* Remover margem do último */
        }
    </style>
</head>
<body>
    <?php
    include 'conexao2.php';
    include 'masterAdm.php';
    ?>
    <div class="container mt-4">
        <?php
        include('mensagem.php');
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">Gerenciar Avisos
                            <a href="aviso-create.php" class="btn btn-custom float-end">Adicionar Aviso</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $sql = 'SELECT * FROM avisos';
                        $avisos = mysqli_query($conexao, $sql);

                        if(mysqli_num_rows($avisos) > 0){
                            foreach($avisos as $aviso){
                        ?>
                                <div class="card announcement-card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($aviso['titulo']) ?></h5>
                                        <p class="card-text"><?= nl2br(htmlspecialchars($aviso['conteudo'])) ?></p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between align-items-center">
                                        <span>Publicado por: <strong><?= htmlspecialchars($aviso['publicado_por']) ?></strong> em <?= date('d/m/Y', strtotime($aviso['data'])) ?></span>
                                        <div>
                                            <a href="aviso-edit.php?id=<?= htmlspecialchars($aviso['id']) ?>" class="btn btn-custom btn-sm">Editar</a>
                                            <form action="acoes-aviso.php" method="post" class="d-inline">
                                                <input type="hidden" name="aviso_id" value="<?= htmlspecialchars($aviso['id']) ?>">
                                                <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_aviso" class="btn btn-danger btn-sm">Excluir</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<h5>Nenhum aviso encontrado</h5>';
                        }
                        ?>
                    </div> 
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>