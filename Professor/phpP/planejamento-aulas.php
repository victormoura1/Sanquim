<?php
session_start();
ob_start(); 
include '../../Adm/phpAdm/conexao2.php';
?>

<div class="container mt-4">
    <?php

    include('../../Adm/phpAdm/mensagem.php');
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Planejamento de Aulas
                        <a href="aviso-create.php" class="btn btn-custom float-end">Adicionar Planejamento</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    $sql = 'SELECT * FROM aulas';
                    $aulas = mysqli_query($conexao, $sql);

                    if(mysqli_num_rows($aulas) > 0){
                        foreach($aulas as $aula){
                    ?>
                            <div class="card announcement-card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($aula['titulo']) ?></h5>
                                    <p class="card-text"><?= nl2br(htmlspecialchars($aula['conteudo'])) ?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span>Publicado por: <strong><?= htmlspecialchars($aula['professor']) ?></strong> em <?= date('d/m/Y', strtotime($aula['data'])) ?></span>
                                    <div>
                                        <a href="aviso-edit.php?id=<?= htmlspecialchars($aula['id']) ?>" class="btn btn-custom btn-sm">Editar</a>
                                        <form action="acoes-aula.php" method="post" class="d-inline">
                                            <input type="hidden" name="aula_id" value="<?= htmlspecialchars($aula['id']) ?>">
                                            <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_aula" class="btn btn-danger btn-sm">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<h5>Nenhuma aula planejada</h5>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$page_content = ob_get_clean(); // Get the buffered output and store it in $page_content
include 'masterP.php'; // Now include the master page
?>