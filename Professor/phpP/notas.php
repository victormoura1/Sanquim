<?php
// Lógica PHP no topo, antes de qualquer HTML
ob_start();

$dataFile = 'notas.json';
$mensagem = '';

// Função para ler os dados do arquivo JSON
function lerDados() {
    global $dataFile;
    if (!file_exists($dataFile)) {
        return [];
    }
    $json_data = file_get_contents($dataFile);
    return json_decode($json_data, true);
}

// Função para salvar os dados no arquivo JSON
function salvarDados($dados) {
    global $dataFile;
    // JSON_PRETTY_PRINT deixa o arquivo organizado e legível
    file_put_contents($dataFile, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Carrega os dados das matérias
$dados_das_materias = lerDados();

// Verifica se o formulário foi enviado para salvar as notas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os dados enviados pelo formulário
    $materia_key = $_POST['materia'] ?? '';
    // Usa filter_input para mais segurança ao pegar números
    $nota1 = filter_input(INPUT_POST, 'nota1', FILTER_VALIDATE_FLOAT, ['options' => ['decimal' => ',']]);
    $nota2 = filter_input(INPUT_POST, 'nota2', FILTER_VALIDATE_FLOAT, ['options' => ['decimal' => ',']]);

    // Verifica se a matéria existe e se as notas são válidas
    if (isset($dados_das_materias[$materia_key]) && $nota1 !== false && $nota2 !== false) {
        // Atualiza as notas no array
        $dados_das_materias[$materia_key]['nota1'] = $nota1;
        $dados_das_materias[$materia_key]['nota2'] = $nota2;

        // Salva o array atualizado de volta no arquivo JSON
        salvarDados($dados_das_materias);

        // Define uma mensagem de sucesso
        $mensagem = '<p class="mensagem sucesso">Notas salvas com sucesso!</p>';
    } else {
        $mensagem = '<p class="mensagem erro">Ocorreu um erro ao salvar as notas. Verifique os valores inseridos.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Notas</title>
    <style>
        /* SEU CSS ORIGINAL VEM AQUI */
        .notas-container { display: flex; justify-content: center; align-items: flex-start; padding: 40px 20px; min-height: 65vh; box-sizing: border-box; }
        .notas-card { background-color: #ffffff; padding: 2rem 3rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px; text-align: center; }
        .notas-card h1 { color: #333; font-size: 2.5rem; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 2px solid #f0f0f0; padding-bottom: 1rem; }
        .notas-info p { font-size: 1.2rem; color: #555; margin: 12px 0; text-align: left; display: flex; justify-content: space-between; }
        .notas-info p strong { color: #307f81; }
        .btn-voltar { display: inline-block; margin: 2rem 0 0 2.5rem; padding: 10px 20px; background-color: #307f81; color: #ffffff; font-size: 0.9rem; font-weight: bold; text-decoration: none; border-radius: 8px; transition: background-color 0.3s, transform 0.2s; }
        .btn-voltar:hover { background-color: #2a6d6f; transform: scale(1.05); cursor: pointer; }

        /* --- NOVO: Estilos para o formulário e inputs --- */
        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-size: 1.1rem;
            color: #307f81;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .form-group input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1.1rem;
            box-sizing: border-box; /* Garante que padding não afete a largura total */
        }
        .btn-salvar {
            display: block;
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background-color: #28a745;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-salvar:hover {
            background-color: #218838;
        }
        .mensagem {
            padding: 10px;
            margin-bottom: 1rem;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .mensagem.sucesso { background-color: #d4edda; color: #155724; }
        .mensagem.erro { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <?php

    if (isset($_GET['materia'])) {
        $materia_selecionada = $_GET['materia'];

        if (array_key_exists($materia_selecionada, $dados_das_materias)) {
            $materia_info = $dados_das_materias[$materia_selecionada];

            echo '<a href="pagina2.php" class="btn-voltar">‹ Voltar</a>';

            echo '<div class="notas-container">';
            echo '  <div class="notas-card">';
            echo "    <h1>" . htmlspecialchars($materia_info['titulo']) . "</h1>";
            
            // Exibe a mensagem de sucesso ou erro, se houver
            echo $mensagem;

            // --- INÍCIO DO FORMULÁRIO DE EDIÇÃO ---
            echo '    <form action="" method="POST">';
            // Campo oculto para saber qual matéria estamos editando
            echo '      <input type="hidden" name="materia" value="' . htmlspecialchars($materia_selecionada) . '">';

            echo '      <div class="notas-info">';
            echo "        <p><strong>Aluno:</strong> " . htmlspecialchars($materia_info['professor']) . "</p>";
            echo '      </div>';

            echo '      <div class="form-group">';
            echo '        <label for="nota1">Nota 1:</label>';
            // step="0.1" permite notas decimais como 8.5
            // O value é preenchido com a nota atual
            echo '        <input type="number" id="nota1" name="nota1" min="0" max="10" step="0.1" value="' . htmlspecialchars(number_format($materia_info['nota1'], 1, ',')) . '" required>';
            echo '      </div>';

            echo '      <div class="form-group">';
            echo '        <label for="nota2">Nota 2:</label>';
            echo '        <input type="number" id="nota2" name="nota2" min="0" max="10" step="0.1" value="' . htmlspecialchars(number_format($materia_info['nota2'], 1, ',')) . '" required>';
            echo '      </div>';

            echo '      <button type="submit" class="btn-salvar">Salvar Alterações</button>';

            echo '    </form>';
            // --- FIM DO FORMULÁRIO DE EDIÇÃO ---

            echo '  </div>';
            echo '</div>';

        } else {
            echo "<h1>Matéria não encontrada!</h1>";
        }
    } else {
        echo "<h1>Nenhuma matéria selecionada!</h1>";
    }

    $page_content = ob_get_clean();
    include 'masterP.php';
    ?>
</body>
</html>