<?php
session_start();
// Certifique-se de que o caminho para conexao2.php está correto em relação ao avisos.php
require '../../Adm/phpAdm/conexao2.php';

// Inicia o buffer de saída ANTES de qualquer HTML que você quer que vá para $page_content
ob_start();
?>

<div class="container mt-4">
    <?php
    // Exibe mensagens de sessão (e.g., sucesso/erro após adicionar um aviso)
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">' . $_SESSION['message'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        unset($_SESSION['message']); // Limpa a mensagem após exibir
    }

    // Busca os avisos do banco de dados
    $avisos = []; // Inicializa um array vazio
    $sql_select = "SELECT * FROM avisos ORDER BY data DESC"; // Seleciona tudo de 'avisos', ordenado por data
    $query_select = mysqli_query($conexao, $sql_select);

    if ($query_select) {
        if (mysqli_num_rows($query_select) > 0) {
            while ($row = mysqli_fetch_assoc($query_select)) {
                $avisos[] = $row;
            }
        }
    } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao carregar avisos: ' . mysqli_error($conexao) . '</div>';
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Avisos</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($avisos)): ?>
                        <?php foreach ($avisos as $aviso): ?>
                            <div class="card announcement-card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($aviso['titulo']) ?></h5>
                                    <p class="card-text"><?= nl2br(htmlspecialchars($aviso['conteudo'])) ?></p>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <span>Publicado por: <strong><?= htmlspecialchars($aviso['publicado_por']) ?></strong> em <?= date('d/m/Y', strtotime($aviso['data'])) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info text-center" role="alert">
                            Nenhum aviso cadastrado ainda.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newAnnouncementModal" tabindex="-1" aria-labelledby="newAnnouncementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAnnouncementModalLabel">Adicionar Novo Aviso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tituloAviso" class="form-label form-label-custom">Título do Aviso</label>
                        <input type="text" class="form-control" id="tituloAviso" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="conteudoAviso" class="form-label form-label-custom">Conteúdo do Aviso</label>
                        <textarea class="form-control" id="conteudoAviso" name="conteudo" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="publicadoPor" class="form-label form-label-custom">Publicado Por</label>
                        <input type="text" class="form-control" id="publicadoPor" name="publicado_por" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" name="adicionar_aviso" class="btn btn-custom">Salvar Aviso</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Capture o conteúdo do buffer e armazene em $page_content
$page_content = ob_get_clean();

// Inclua o masterA.php. Ele agora terá o $page_content para imprimir.
include 'masterA.php';
?>