<?php
// Lógica PHP no topo, antes de qualquer HTML
ob_start();

$dataFile = 'notas.json'; // Continua usando o mesmo arquivo
$mensagem = '';

// Função para ler os dados do arquivo JSON (sem alterações)
function lerDados() {
    global $dataFile;
    if (!file_exists($dataFile)) {
        return [];
    }
    $json_data = file_get_contents($dataFile);
    return json_decode($json_data, true);
}

// Função para salvar os dados no arquivo JSON (sem alterações)
function salvarDados($dados) {
    global $dataFile;
    file_put_contents($dataFile, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Carrega os dados das matérias
$dados_das_materias = lerDados();

// --- INÍCIO DA LÓGICA MODIFICADA ---
// Verifica se o formulário foi enviado para registrar a presença
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $materia_key = $_POST['materia'] ?? '';
    // Pega o status da presença (presente ou ausente)
    $presenca_status = $_POST['presenca_status'] ?? '';

    // Verifica se a matéria existe e se uma opção foi selecionada
    if (isset($dados_das_materias[$materia_key]) && in_array($presenca_status, ['presente', 'ausente'])) {
        
        // Pega os valores atuais ou define como 0 se não existirem
        $taulas_atuais = $dados_das_materias[$materia_key]['taulas'] ?? 0;
        $faltas_atuais = $dados_das_materias[$materia_key]['faltas'] ?? 0;

        // Lógica de incremento conforme a regra solicitada
        if ($presenca_status === 'presente') {
            // Se presente, incrementa apenas o total de aulas
            $dados_das_materias[$materia_key]['taulas'] = $taulas_atuais + 1;
        } elseif ($presenca_status === 'ausente') {
            // Se ausente, incrementa o total de aulas E as faltas
            $dados_das_materias[$materia_key]['taulas'] = $taulas_atuais + 1;
            $dados_das_materias[$materia_key]['faltas'] = $faltas_atuais + 1;
        }

        // Salva o array atualizado de volta no arquivo JSON
        salvarDados($dados_das_materias);

        // Define uma mensagem de sucesso
        $mensagem = '<p class="mensagem sucesso">Presença registrada com sucesso!</p>';
    } else {
        $mensagem = '<p class="mensagem erro">Ocorreu um erro. Por favor, selecione uma das opções.</p>';
    }
}
// --- FIM DA LÓGICA MODIFICADA ---
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Presença</title>
    <style>
        /* Estilos gerais (maioria reaproveitada) */
        body { font-family: sans-serif; background-color: #f4f7f6; }
        .notas-container { display: flex; justify-content: center; align-items: flex-start; padding: 40px 20px; min-height: 65vh; box-sizing: border-box; }
        .notas-card { background-color: #ffffff; padding: 2rem 3rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px; text-align: center; }
        .notas-card h1 { color: #333; font-size: 2.5rem; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 2px solid #f0f0f0; padding-bottom: 1rem; }
        .btn-voltar { display: inline-block; margin: 2rem 0 0 2.5rem; padding: 10px 20px; background-color: #307f81; color: #ffffff; text-decoration: none; border-radius: 8px; transition: background-color 0.3s; }
        .btn-voltar:hover { background-color: #2a6d6f; }
        .btn-salvar { display: block; width: 100%; padding: 15px; border: none; border-radius: 8px; background-color: #307f81; color: white; font-size: 1.2rem; font-weight: bold; cursor: pointer; transition: background-color 0.3s; margin-top: 2rem; }
        .btn-salvar:hover { background-color:#2a6d6f; }
        .mensagem { padding: 10px; margin-bottom: 1rem; border-radius: 5px; text-align: center; font-weight: bold; }
        .mensagem.sucesso { background-color: #d4edda; color: #155724; }
        .mensagem.erro { background-color: #f8d7da; color: #721c24; }

        /* NOVO: Estilos para o resumo de presença */
        .resumo-presenca { margin-bottom: 2rem; padding: 1rem; background-color: #f8f9fa; border-radius: 8px; text-align: left; }
        .resumo-presenca p { font-size: 1.1rem; margin: 8px 0; display: flex; justify-content: space-between; }
        .resumo-presenca strong { color: #307f81; }

        /* NOVO: Estilos para os quadradinhos de seleção (rádio) */
        .fieldset-presenca { border: 1px solid #ddd; border-radius: 8px; padding: 1rem; }
        .fieldset-presenca legend { font-size: 1.1rem; color: #307f81; font-weight: bold; padding: 0 10px; }
        .opcoes-presenca { display: flex; justify-content: space-around; gap: 1rem; }
        .opcoes-presenca input[type="radio"] { display: none; } /* Esconde o rádio padrão */
        .opcoes-presenca label {
            flex: 1; /* Ocupa espaço igual */
            display: block;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 8px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }
        /* Estilo para a opção selecionada */
        .opcoes-presenca input[type="radio"]:checked + label {
            border-color: #307f81;
            background-color: #eaf3f3;
            color: #307f81;
            transform: scale(1.05);
        }
        .opcoes-presenca label:hover {
            border-color: #7ab5b6;
        }
    </style>
</head>
<body>
    <?php

    if (isset($_GET['materia'])) {
        $materia_selecionada = $_GET['materia'];

        if (array_key_exists($materia_selecionada, $dados_das_materias)) {
            $materia_info = $dados_das_materias[$materia_selecionada];

            // Pega os dados atuais de presença para exibir
            $taulas = $materia_info['taulas'] ?? 0;
            $faltas = $materia_info['faltas'] ?? 0;
            $presencas = $taulas - $faltas;
            $frequencia = ($taulas > 0) ? (($presencas / $taulas) * 100) : 100;

            echo '<a href="pagina3.php" class="btn-voltar">‹ Voltar</a>'; // Ajuste o link de voltar se necessário

            echo '<div class="notas-container">';
            echo '  <div class="notas-card">';
            echo "      <h1>" . htmlspecialchars($materia_info['titulo']) . "</h1>";
            
            echo $mensagem; // Exibe a mensagem de sucesso ou erro

            // --- INÍCIO DO CONTEÚDO MODIFICADO ---

            // Exibe o resumo atual de presença do aluno
            echo '      <div class="resumo-presenca">';
            echo "          <p><strong>Aluno:</strong> " . htmlspecialchars($materia_info['professor']) . "</p><hr>";
            echo "          <p><strong>Aulas Registradas:</strong> " . $taulas . "</p>";
            echo "          <p><strong>Total de Faltas:</strong> " . $faltas . "</p>";
            echo "          <p><strong>Frequência:</strong> " . number_format($frequencia, 1, ',') . "%</p>";
            echo '      </div>';

            // Formulário para registrar a presença do dia
            echo '      <form action="" method="POST">';
            echo '          <input type="hidden" name="materia" value="' . htmlspecialchars($materia_selecionada) . '">';
            
            echo '          <fieldset class="fieldset-presenca">';
            echo '              <legend>Registrar Presença de Hoje</legend>';
            echo '              <div class="opcoes-presenca">';
            
            // Opção Presente
            echo '                  <div>';
            echo '                      <input type="radio" id="radio-presente" name="presenca_status" value="presente" required>';
            echo '                      <label for="radio-presente">Presente</label>';
            echo '                  </div>';
            
            // Opção Ausente
            echo '                  <div>';
            echo '                      <input type="radio" id="radio-ausente" name="presenca_status" value="ausente">';
            echo '                      <label for="radio-ausente">Ausente</label>';
            echo '                  </div>';

            echo '              </div>';
            echo '          </fieldset>';

            echo '          <button type="submit" class="btn-salvar">Registrar</button>';
            echo '      </form>';
            // --- FIM DO CONTEÚDO MODIFICADO ---

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