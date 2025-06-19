<?php
    $dados_dos_materiais = [
        'matematica' => [
            'titulo' => 'Matemática',
            'materiais' => [
                [
                    'nome_exibido' => 'Lista de Exercícios 1 - Funções',
                    'caminho_arquivo' => '../../materiais_pdf/matematica/lista_exercicios_01.pdf'
                ],
                [
                    'nome_exibido' => 'Resumo - Trigonometria',
                    'caminho_arquivo' => '../../materiais_pdf/matematica/resumo_trigonometria.pdf'
                ]
            ]
        ],
        'historia' => [
            'titulo' => 'História',
            'materiais' => [
                [
                    'nome_exibido' => 'Resumo - Revolução Francesa',
                    'caminho_arquivo' => '../../materiais_pdf/historia/resumo_rev_francesa.pdf'
                ],
                [
                    'nome_exibido' => 'Linha do Tempo - Brasil Colônia',
                    'caminho_arquivo' => '../../materiais_pdf/historia/linha_do_tempo_brasil_colonia.pdf'
                ]
            ]
        ],
        // Adicione as outras matérias aqui...
    ];
ob_start();

if (isset($_GET['materia']) && array_key_exists($_GET['materia'], $dados_dos_materiais)) {
    $materia_selecionada = $dados_dos_materiais[$_GET['materia']];
    
    // Botão Voltar
    echo '<a href="materiais.php" class="btn-voltar">‹ Voltar para Matérias</a>';
    
    // Container principal com o cartão
    echo '<div class="notas-container">'; // Reutilizando a classe do container
    echo '  <div class="notas-card">';   // Reutilizando a classe do cartão
    
    // Título da matéria
    echo "    <h1>Materiais de " . htmlspecialchars($materia_selecionada['titulo']) . "</h1>";
    
    // Lista de materiais
    echo '    <ul class="material-list">';
    
    // AQUI ESTÁ A MÁGICA: um loop para cada material da lista
    foreach ($materia_selecionada['materiais'] as $material) {
        echo '<li class="material-item">';
        // O link aponta para o caminho do arquivo e abre em uma nova aba (target="_blank")
        echo '  <a href="' . htmlspecialchars($material['caminho_arquivo']) . '" class="material-link" target="_blank">';
        echo '    📄 ' . htmlspecialchars($material['nome_exibido']); // Ícone de documento + nome
        echo '  </a>';
        echo '</li>';
    }
    
    echo '    </ul>';
    echo '  </div>';
    echo '</div>';

} else {
    echo "<h1>Matéria não encontrada ou não especificada.</h1>";
    echo '<a href="materiais.php" class="btn-voltar">‹ Voltar</a>';
}

$page_content = ob_get_clean();
include 'masterA.php';
?>
?>