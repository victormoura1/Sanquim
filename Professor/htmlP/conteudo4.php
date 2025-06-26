<?php
    $caminho_json = '../phpP/notas.json';

    // 2. Ler o arquivo de dados.
    $materias = [];
    if (file_exists($caminho_json)) {
        $dados_json = file_get_contents($caminho_json);
        $materias = json_decode($dados_json, true);
    }
?>

<div class="h1"><h1>Matérias</h1></div>
<div class="container">
    <?php
    if (!empty($materias)) {
        foreach ($materias as $chave => $dados) {
            echo '<a href="../phpP/hist.php?materia=' . htmlspecialchars($chave) . '">';
            echo '  <div class="box">';
            echo '    <h2>' . htmlspecialchars($dados['titulo']) . '</h2>';
            echo '    <p>Visualizar Histórico</p>';
            echo '  </div>';
            echo '</a>';
        }
    } else {
        // Mensagem de erro se o arquivo JSON não for encontrado ou estiver vazio.
        echo '<p>Não foi possível carregar as matérias. Verifique o arquivo de dados.</p>';
    }
    ?>
</div>