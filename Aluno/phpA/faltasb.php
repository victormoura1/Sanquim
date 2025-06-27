<?php
// Lógica PHP no topo, antes de qualquer HTML
ob_start();
// Certifique-se que o caminho para o JSON está correto
$dataFile ='../../Professor/phpP/notas.json'; 

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

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Notas e Presença</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* CSS do Código 1 */
        .notas-container { display: flex; justify-content: center; align-items: flex-start; padding: 40px 20px; min-height: 65vh; box-sizing: border-box; }
        .notas-card { background-color: #ffffff; padding: 2rem 3rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px; text-align: center; }
        .notas-card h1 { color: #333; font-size: 2.5rem; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 2px solid #f0f0f0; padding-bottom: 1rem; }
        .notas-info p { font-size: 1.2rem; color: #555; margin: 16px 0; text-align: left; display: flex; justify-content: space-between; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px; }
        .notas-info p strong { color: #307f81; }
        .btn-voltar { display: inline-block; margin: 2rem 0 0 2.5rem; padding: 10px 20px; background-color: #307f81; color: #ffffff; font-size: 0.9rem; font-weight: bold; text-decoration: none; border-radius: 8px; transition: background-color 0.3s, transform 0.2s; }
        .btn-voltar:hover { background-color: #2a6d6f; transform: scale(1.05); cursor: pointer; }
        .status { font-weight: bold; padding: 5px 10px; border-radius: 5px; color: white; }
        .status.aprovado { background-color: #28a745; }
        .status.reprovado { background-color: #dc3545; }
        .status.recuperacao { background-color: #ffc107; color: #333; }

        /* PASSO 2: Mesclar o CSS do gráfico (Código 2) aqui */
        .grafico-container {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 20px; /* Adiciona espaço acima do gráfico */
        }
        .grafico-container canvas {
            max-width: 300px;
            margin: auto;
        }
        .grafico-container h2 {
            margin-bottom: 10px;
            color: #333;
        }
        .grafico-container .info {
            margin-bottom: 20px;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
    <?php

    if (isset($_GET['materia'])) {
        $materia_selecionada = $_GET['materia'];

        if (array_key_exists($materia_selecionada, $dados_das_materias)) {
            $materia_info = $dados_das_materias[$materia_selecionada];
            
            // --- Lógica de cálculo do PHP (Código 1) ---
            $nota1 = $materia_info['nota1'] ?? 0;
            $nota2 = $materia_info['nota2'] ?? 0;
            $media = ($nota1 + $nota2) / 2;
            $faltas = $materia_info['faltas'] ?? 0;
            $taulas = $materia_info['taulas'] ?? 0;
            $presencas = ($taulas - $faltas); // Calculamos as presenças aqui
            $limfaltas = ($taulas > 0) ? ($taulas * 0.25) : 0; // Limite de 25% de faltas
            
            $status_texto = 'Reprovado';
            $status_classe = 'reprovado';
            if ($faltas > $limfaltas) {
                $status_texto = 'Reprovado por Falta';
                $status_classe = 'reprovado';
            } elseif ($media >= 6) {
                $status_texto = 'Aprovado';
                $status_classe = 'aprovado';
            } elseif ($media >= 4) {
                $status_texto = 'Em Recuperação';
                $status_classe = 'recuperacao';
            }

            echo '<a href="pagina5.php" class="btn-voltar">‹ Voltar</a>';

            echo '<div class="notas-container">';
            echo '  <div class="notas-card">';
            echo "      <h1>" . htmlspecialchars($materia_info['titulo']) . "</h1>";
            
            // --- Parte 1: Informações de Texto (Notas e Status) ---
            echo '      <div class="notas-info">';
            echo "          <p><strong>Aluno:</strong> " . htmlspecialchars($materia_info['professor']) . "</p>";
            echo "          <p><strong>Média Final:</strong> " . htmlspecialchars(number_format($media, 1, ',')) . "</p>";
            echo '      <div class="grafico-container">';
            echo '          <h2>Resumo de Frequência</h2>';
            echo '          <div class="info">Total de Aulas: <span id="total-aulas">' . $taulas . '</span></div>';
            echo '          <canvas id="graficoPresenca"></canvas>';
            echo '      </div>';
            echo "          <p><strong>Status:</strong> <span class='status " . $status_classe . "'>" . $status_texto . "</span></p>";
            echo '      </div>';

            // --- PASSO 3: Inserir a estrutura HTML do Gráfico aqui ---


            echo '  </div>';
            echo '</div>';

        } else {
            echo "<h1>Matéria não encontrada!</h1>";
        }
    } else {
        echo "<h1>Nenhuma matéria selecionada!</h1>";
    }

    $page_content = ob_get_clean();
    include 'masterA.php'; 
    ?>

    <script>
        // Garante que o script só rode se os dados do PHP existirem
        <?php if (isset($presencas) && isset($faltas)): ?>
        
        // Pega os dados calculados pelo PHP e os passa para o JavaScript
        const presencasAluno = <?php echo $presencas; ?>;
        const faltasAluno = <?php echo $faltas; ?>;

        const ctx = document.getElementById('graficoPresenca').getContext('2d');
        const graficoPresenca = new Chart(ctx, {
            type: 'doughnut', // Tipo de gráfico
            data: {
                labels: ['Presenças', 'Faltas'],
                datasets: [{
                    // Usa as variáveis do PHP para os dados do gráfico
                    data: [presencasAluno, faltasAluno],
                    backgroundColor: ['#307f81', '#f44336'], // Verde para presença, Vermelho para falta
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                cutout: '60%', // O "buraco" no meio do doughnut
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom' // Posição da legenda
                    },
                    tooltip: {
                        // Formata a dica que aparece ao passar o mouse
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
        <?php endif; ?>
    </script>
</body>
</html>