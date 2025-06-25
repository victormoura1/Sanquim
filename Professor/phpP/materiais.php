<?php
// ===================================================================
// TODA A LÓGICA PHP VEM AQUI PRIMEIRO, ANTES DE QUALQUER HTML
// ===================================================================

// Inicia o buffer de saída. Isso é uma boa prática, especialmente com includes.
ob_start();

$dados_das_materias = [
    'matematica' => ['titulo' => 'Matemática', 'pasta' => '../../materiais_pdf/matematica/'],
    'historia' => ['titulo' => 'História', 'pasta' => '../../materiais_pdf/historia/'],
    'fisica' => ['titulo' => 'Física', 'pasta' => '../../materiais_pdf/fisica/'],
    'geografia' => ['titulo' => 'Geografia', 'pasta' => '../../materiais_pdf/geografia/'],
    'lingua-portuguesa' => ['titulo' => 'Lingua Portuguesa', 'pasta' => '../../materiais_pdf/lingua-portuguesa/'],
    'redacao' => ['titulo' => 'Redação', 'pasta' => '../../materiais_pdf/redacao/'],
    'ingles' => ['titulo' => 'Inglês', 'pasta' => '../../materiais_pdf/ingles/'],
    'literatura' => ['titulo' => 'Literatura', 'pasta' => '../../materiais_pdf/literatura/'],
    'quimica' => ['titulo' => 'Química', 'pasta' => '../../materiais_pdf/quimica/'],
    'hist-arte' => ['titulo' => 'História da Arte', 'pasta' => '../../materiais_pdf/hist-arte/'],
    'pens-comp' => ['titulo' => 'Pens-Computacional', 'pasta' => '../../materiais_pdf/pens-comp/'],
    'biologia' => ['titulo' => 'Biologia', 'pasta' => '../../materiais_pdf/biologia/'],
    'sociologia' => ['titulo' => 'Sociologia', 'pasta' => '../../materiais_pdf/sociologia/'],
    'atualidades' => ['titulo' => 'Atualidades', 'pasta' => '../../materiais_pdf/atualidades/'],
    'ed-fisica' => ['titulo' => 'Educação-Física', 'pasta' => '../../materiais_pdf/ed-fisica/'],
];

$mensagem_upload = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se um arquivo foi enviado e se a matéria foi especificada
    if (isset($_FILES['novo_pdf']) && !empty($_POST['materia']) && array_key_exists($_POST['materia'], $dados_das_materias)) {

        $materia_key = $_POST['materia'];
        $pasta_destino = $dados_das_materias[$materia_key]['pasta'];
        $arquivo = $_FILES['novo_pdf'];

        // Verifica se não houve erros no upload
        if ($arquivo['error'] === UPLOAD_ERR_OK) {
            $nome_arquivo = basename($arquivo['name']);
            $caminho_final = $pasta_destino . $nome_arquivo;

            // Move o arquivo do diretório temporário para o diretório final
            if (move_uploaded_file($arquivo['tmp_name'], $caminho_final)) {
                // Monta a URL para redirecionamento
                $redirect_url = $_SERVER['PHP_SELF'] . "?materia=" . urlencode($materia_key) . "&upload=sucesso";
                // AGORA O HEADER() FUNCIONARÁ!
                header("Location: " . $redirect_url);
                exit; // Sempre use exit() após um header de redirecionamento
            } else {
                $mensagem_upload = '<div class="mensagem erro">Erro ao mover o arquivo. Verifique as permissões da pasta de destino.</div>';
            }
        } else {
            $mensagem_upload = '<div class="mensagem erro">Ocorreu um erro durante o upload. Código do erro: ' . $arquivo['error'] . '</div>';
        }
    } else {
        $mensagem_upload = '<div class="mensagem erro">Nenhum arquivo enviado ou matéria inválida.</div>';
    }
}

// --- Exibe mensagem de sucesso após o redirecionamento ---
if (isset($_GET['upload']) && $_GET['upload'] === 'sucesso') {
    $mensagem_upload = '<div class="mensagem sucesso">Arquivo enviado com sucesso!</div>';
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiais da Disciplina</title>
    <style>
        body { font-family: sans-serif; }
        .notas-container { display: flex; justify-content: center; align-items: flex-start; padding: 40px 20px; min-height: 65vh; box-sizing: border-box; }
        .notas-card { width: 100%; max-width: 800px; }
        .material-list { list-style: none; padding: 0; margin: 1.5rem 0 0 0; text-align: left; width: 100%; }
        .material-item { margin-bottom: 1rem; }
        .material-link { display: block; padding: 15px; background-color: #f8f9fa; border-radius: 8px; text-decoration: none; color: #343a40; font-weight: 500; transition: all 0.2s ease-in-out; border: 1px solid #e9ecef; }
        .material-link:hover { background-color: #e9ecef; border-color: #dee2e6; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .btn-voltar { display: inline-block; margin: 2rem 0 0 2.5rem; padding: 10px 20px; background-color: #307f81; color: #ffffff; font-size: 0.9rem; font-weight: bold; text-decoration: none; border-radius: 8px; transition: background-color 0.3s, transform 0.2s; }
        .btn-voltar:hover { background-color: #2a6d6f; transform: scale(1.05); cursor: pointer; }
        .upload-form { background-color: #f1f1f1; padding: 20px; border-radius: 8px; margin-top: 1.5rem; border: 1px dashed #ccc; }
        .upload-form label { font-weight: bold; display: block; margin-bottom: 10px; }
        .btn-upload { padding: 10px 15px; background-color: #307f81; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; transition: background-color 0.3s; }
        .btn-upload:hover { background-color:#2a6d6f; }   
        .mensagem { padding: 10px; margin-bottom: 1rem; border-radius: 5px; text-align: center; }
        .mensagem.sucesso { background-color: #d4edda; color: #155724; }
        .mensagem.erro { background-color: #f8d7da; color: #721c24; }
        .input-file-container { position: relative; display: inline-block; margin-bottom: 15px; vertical-align: middle;}
        .input-file-trigger { display: inline-block; padding: 10px 15px; background: #6c757d; color: #fff; font-size: 0.9rem; border-radius: 5px; cursor: pointer; transition: background-color 0.3s; }
        .input-file-trigger:hover { background: #5a6268; }
        .input-file { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; }
        .file-name { display: inline-block; margin-left: 10px; color: #495057; font-style: italic; vertical-align: middle;}
    </style>
</head>
<body>

<?php

if (isset($_GET['materia']) && array_key_exists($_GET['materia'], $dados_das_materias)) {
    
    $materia_selecionada_key = $_GET['materia'];
    $materia_selecionada = $dados_das_materias[$materia_selecionada_key];
    
    echo '<a href="materiais.php" class="btn-voltar">‹ Voltar</a>';
    
    echo '<div class="notas-container">';
    echo '  <div class="notas-card">';
    echo "    <h1>Materiais de " . htmlspecialchars($materia_selecionada['titulo']) . "</h1>";

    // Exibe a mensagem de upload (se houver alguma)
    echo $mensagem_upload;

    $caminho_da_pasta = $materia_selecionada['pasta'];
    $arquivos_pdf = glob($caminho_da_pasta . '*.pdf');

    if (!empty($arquivos_pdf)) {
        echo '    <ul class="material-list">';
        foreach ($arquivos_pdf as $caminho_completo_pdf) {
            $nome_do_arquivo = basename($caminho_completo_pdf);
            $nome_bonito = str_replace(['_', '-'], ' ', pathinfo($nome_do_arquivo, PATHINFO_FILENAME));
            
            echo '<li class="material-item">';
            echo '  <a href="' . htmlspecialchars($caminho_completo_pdf) . '" class="material-link" target="_blank">';
            echo '    <span class="pdf-icon">📄</span> ' . htmlspecialchars(ucwords($nome_bonito));
            echo '  </a>';
            echo '</li>';
        }
        echo '    </ul>';
    } else {
        echo '<p style="text-align:center; margin-top: 2rem;">Nenhum material disponível para esta disciplina no momento.</p>';
    }

    // Formulário para adicionar novos PDFs
    echo '<div class="upload-form">';
    echo '  <form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?materia=' . urlencode($materia_selecionada_key) . '" method="post" enctype="multipart/form-data">';
    echo '      <label>Adicionar novo material (PDF):</label>';
    echo '      <div class="input-file-container">';
    echo '          <input type="file" name="novo_pdf" id="novo_pdf" class="input-file" accept=".pdf" required>';
    echo '          <label for="novo_pdf" class="input-file-trigger">Escolher arquivo</label>';
    echo '      </div>';
    echo '      <span class="file-name">Nenhum arquivo selecionado</span>';
    echo '      <br><br>';
    echo '      <input type="hidden" name="materia" value="' . htmlspecialchars($materia_selecionada_key) . '">';
    echo '      <button type="submit" class="btn-upload">Enviar Arquivo</button>';
    echo '  </form>';
    echo '</div>';

    echo '  </div>';
    echo '</div>';

} else {
    // Se nenhuma matéria foi selecionada, mostramos a página inicial de seleção (ou uma mensagem)
    // Adapte esta parte para listar as matérias clicáveis, se for o caso.
    echo "<h1>Por favor, selecione uma matéria.</h1>";
    echo '<a href="alguma-pagina-anterior.php" class="btn-voltar">‹ Voltar</a>';
}

// O conteúdo gerado é capturado pelo buffer e incluído no seu template master
$page_content = ob_get_clean();
include 'masterP.php';
?>

<script>
// JS para mostrar o nome do arquivo selecionado
document.addEventListener('DOMContentLoaded', function() {
    const inputFile = document.getElementById('novo_pdf');
    const fileNameSpan = document.querySelector('.file-name');

    if (inputFile && fileNameSpan) {
        inputFile.addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Nenhum arquivo selecionado';
            fileNameSpan.textContent = fileName;
        });
    }
});
</script>

</body>
</html>