<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina 1</title>
    <style>
        .notas-container {

            display: flex; /* Ativa o modo flexbox */
            justify-content: center; /* Centraliza na horizontal (esquerda/direita) */
            align-items: flex-start;  /* Alinha os itens ao topo do contêiner */
            padding: 40px 20px;       /* Espaçamento interno */
            min-height: 65vh;         /* Altura mínima para ocupar a maior parte da tela */
            box-sizing: border-box;
        }
        .material-list {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0 0 0;
            text-align: left;
        }

        .material-item {
            margin-bottom: 1rem;
        }

        .material-link {
            display: block;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            text-decoration: none;
            color: #343a40;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
            border: 1px solid #e9ecef;
        }

        .material-link:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .btn-voltar {
            display: inline-block;
            /* Define a margem para posicionar o botão */
            margin: 2rem 0 0 2.5rem; /* Margem superior reduzida para 2rem */
            padding: 10px 20px;
            background-color: #307f81;
            color: #ffffff;
            font-size: 0.9rem; /* Um pouco menor para não ser tão dominante */
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-voltar:hover {
            background-color: #2a6d6f;
            transform: scale(1.05); /* Efeito de zoom sutil */
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php   
    $dados_das_materias = [
    'matematica' => [
        'titulo' => 'Matemática',
        'pasta'  => '../../materiais_pdf/matematica/'
    ],
    'historia' => [
        'titulo' => 'História',
        'pasta'  => '../../materiais_pdf/historia/'
    ],
    'fisica' => [
        'titulo' => 'Física',
        'pasta'  => '../../materiais_pdf/fisica/'
    ],
    'geografia' => [
        'titulo' => 'Geografia',
        'pasta'  => '../../materiais_pdf/geografia/'
    ],
    'lingua-portuguesa' => [
        'titulo' => 'Lingua Portuguesa',
        'pasta'  => '../../materiais_pdf/lingua-portuguesa/'
    ],
    'redacao' => [
        'titulo' => 'Redação',
        'pasta'  => '../../materiais_pdf/redacao/'
    ],
    'ingles' => [
        'titulo' => 'Inglês',
        'pasta'  => '../../materiais_pdf/ingles/'
    ],
    'literatura' => [
        'titulo' => 'Literatura',
        'pasta'  => '../../materiais_pdf/literatura/'
    ],
    'quimica' => [
        'titulo' => 'Química',
        'pasta'  => '../../materiais_pdf/quimica/'
    ],
    'hist-arte' => [
        'titulo' => 'História da Arte',
        'pasta'  => '../../materiais_pdf/hist-arte/'
    ],
    'pens-comp' => [
        'titulo' => 'Pens-Computacional',
        'pasta'  => '../../materiais_pdf/pens-comp/'
    ],
    'biologia' => [
        'titulo' => 'Biologia',
        'pasta'  => '../../materiais_pdf/biologia/'
    ],
    'sociologia' => [
        'titulo' => 'Sociologia',
        'pasta'  => '../../materiais_pdf/sociologia/'
    ],
    'atualidades' => [
        'titulo' => 'Atualidades',
        'pasta'  => '../../materiais_pdf/atualidades/'
    ],
    'ed-fisica' => [
        'titulo' => 'Educação-Física',
        'pasta'  => '../../materiais_pdf/ed-fisica/'
    ],
    
    ];

    ob_start();

    if (isset($_GET['materia']) && array_key_exists($_GET['materia'], $dados_das_materias)) {
        
        $materia_selecionada = $dados_das_materias[$_GET['materia']];
        
        echo '<a href="../phpA/pagina2.php" class="btn-voltar">‹ Voltar</a>';
        
        echo '<div class="notas-container">';
        echo '  <div class="notas-card">';
        echo "    <h1>Materiais de " . htmlspecialchars($materia_selecionada['titulo']) . "</h1>";

        // --- A MÁGICA ACONTECE AQUI ---
        
        // PASSO 2: USAR GLOB() PARA ENCONTRAR TODOS OS ARQUIVOS .PDF NA PASTA
        $caminho_da_pasta = $materia_selecionada['pasta'];
        $arquivos_pdf = glob($caminho_da_pasta . '*.pdf');

        // PASSO 3: VERIFICAR SE FORAM ENCONTRADOS ARQUIVOS
        if (!empty($arquivos_pdf)) {
            
            echo '    <ul class="material-list">';
            
            // PASSO 4: LOOP ATRAVÉS DOS ARQUIVOS ENCONTRADOS
            foreach ($arquivos_pdf as $caminho_completo_pdf) {
                
                // Pega apenas o nome do arquivo (ex: 'resumo_trigonometria.pdf')
                $nome_do_arquivo = basename($caminho_completo_pdf);
                
                // Bônus: Deixa o nome mais bonito para exibição
                // Remove a extensão '.pdf' e troca '_' por espaço
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

        echo '  </div>';
        echo '</div>';

    } else {
        echo "<h1>Matéria não encontrada ou não especificada.</h1>";
        echo '<a href="materiais.php" class="btn-voltar">‹ Voltar</a>';
    }

    $page_content = ob_get_clean();
    include 'masterA.php';
?>
</body>
</html>