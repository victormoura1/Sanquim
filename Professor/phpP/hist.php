<?php
// Lógica PHP no topo, antes de qualquer HTML
ob_start();
$dataFile ='notas.json'; 

// Função para ler os dados do arquivo JSON
function lerDados() {
    global $dataFile;
    if (!file_exists($dataFile)) {
        return [];
    }
    $json_data = file_get_contents($dataFile);
    return json_decode($json_data, true);
}

// Carrega os dados das matérias
$dados_das_materias = lerDados();

// ATENÇÃO: A função salvarDados() e todo o bloco 'if POST' foram removidos.
// O aluno não pode enviar dados para o servidor.

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Notas</title>
    <style>
        /* SEU CSS PODE VIR AQUI - estilos do arquivo original foram mantidos */
        .notas-container { display: flex; justify-content: center; align-items: flex-start; padding: 40px 20px; min-height: 65vh; box-sizing: border-box; }
        .notas-card { background-color: #ffffff; padding: 2rem 3rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px; text-align: center; }
        .notas-card h1 { color: #333; font-size: 2.5rem; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 2px solid #f0f0f0; padding-bottom: 1rem; }
        .notas-info p { font-size: 1.2rem; color: #555; margin: 16px 0; text-align: left; display: flex; justify-content: space-between; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px; }
        .notas-info p strong { color: #307f81; }
        .btn-voltar { display: inline-block; margin: 2rem 0 0 2.5rem; padding: 10px 20px; background-color: #307f81; color: #ffffff; font-size: 0.9rem; font-weight: bold; text-decoration: none; border-radius: 8px; transition: background-color 0.3s, transform 0.2s; }
        .btn-voltar:hover { background-color: #2a6d6f; transform: scale(1.05); cursor: pointer; }

        /* NOVO: Estilos para o status do aluno */
        .status { font-weight: bold; padding: 5px 10px; border-radius: 5px; color: white; }
        .status.aprovado { background-color: #28a745; }
        .status.reprovado { background-color: #dc3545; }
        .status.recuperacao { background-color: #ffc107; color: #333; }
    </style>
</head>
<body>
    <?php

    if (isset($_GET['materia'])) {
        $materia_selecionada = $_GET['materia'];

        if (array_key_exists($materia_selecionada, $dados_das_materias)) {
            $materia_info = $dados_das_materias[$materia_selecionada];

            
            // --- MELHORIA: Calcular a média e o status do aluno ---
            $nota1 = $materia_info['nota1'] ?? 0;
            $nota2 = $materia_info['nota2'] ?? 0;
            $media = ($nota1 + $nota2) / 2;
            $faltas = $materia_info['faltas'] ?? 0;
            $taulas = $materia_info['taulas'] ?? 0;
            $presenca = ($taulas - $faltas);
            $frequencia = ($taulas > 0) ? (($presenca / $taulas) * 100) : 100;
            $limfaltas = ($taulas * 0.2);
            
            $status_texto = 'Reprovado';
            $status_classe = 'reprovado';
            if (($media >= 6) and ($faltas < $limfaltas)) {
                $status_texto = 'Aprovado';
                $status_classe = 'aprovado';
            } elseif (($media >= 4) and ($faltas < $limfaltas)) {
                $status_texto = 'Em Recuperação';
                $status_classe = 'recuperacao';
            }

            echo '<a href="pagina4.php" class="btn-voltar">‹ Voltar</a>'; // Lembre-se de apontar para a página correta

            echo '<div class="notas-container">';
            echo '  <div class="notas-card">';
            echo "      <h1>" . htmlspecialchars($materia_info['titulo']) . "</h1>";
            echo '      <div class="notas-info">';
            echo "          <p><strong>Aluno:</strong> " . htmlspecialchars($materia_info['professor']) . "</p>";
            echo "          <p><strong>Média Final:</strong> " . htmlspecialchars(number_format($media, 1, ',')) . "</p>";
            echo "          <p><strong>Faltas:</strong> " . htmlspecialchars(number_format($faltas)) . "</p>";
            echo "          <p><strong>Frequência:</strong> " . htmlspecialchars(number_format($frequencia)) . "%</p>";
            echo "          <p><strong>Status:</strong> <span class='status " . $status_classe . "'>" . $status_texto . "</span></p>";
            
            echo '      </div>';

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