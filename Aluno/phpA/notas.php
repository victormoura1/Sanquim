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

        /* O 'cartão' branco que vai conter as informações das notas */
        .notas-card {
            background-color: #ffffff;
            padding: 2rem 3rem; /* Espaçamento interno do cartão */
            border-radius: 12px; /* Bordas arredondadas */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Sombra suave para dar profundidade */
            width: 100%;
            max-width: 500px; /* Largura máxima do cartão */
            text-align: center; /* Centraliza o texto dentro do cartão */
        }

        /* Estilo para o título da matéria (ex: "Matemática") */
        .notas-card h1 {
            color: #333;
            font-size: 2.5rem; /* Tamanho da fonte do título */
            margin-top: 0;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #f0f0f0; /* Linha sutil abaixo do título */
            padding-bottom: 1rem;
        }

        /* Estilo para os parágrafos com as informações de notas e faltas */
        .notas-info p {
            font-size: 1.2rem; /* Tamanho da fonte das informações */
            color: #555;
            margin: 12px 0; /* Espaçamento entre as linhas */
            text-align: left; /* Alinha o texto das notas à esquerda para melhor leitura */
            display: flex;
            justify-content: space-between; /* Coloca o Título e a Nota em lados opostos */
        }

        /* Estilo para o texto em negrito (Professor, Nota 1, etc.) */
        .notas-info p strong {
            color: #307f81; /* Usa a cor principal do seu site */
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
            'titulo'    => 'Matemática',
            'professor' => 'João',
            'nota1'     => 8.5,
            'nota2'     => 9.0
        ],
        'lingua-portuguesa' => [
            'titulo'    => 'Língua Portuguesa',
            'professor' => 'João',
            'nota1'     => 7.5,
            'nota2'     => 8.0
        ],
        'sociologia' => [
            'titulo'    => 'Sociologia',
            'professor' => 'João',
            'nota1'     => 9.5,
            'nota2'     => 9.0
        ],
        'pens-comp' => [
            'titulo'    => 'Pensamento Computacional',
            'professor' => 'João',
            'nota1'     => 10.0,
            'nota2'     => 10.0
        ],
        'ingles' => [
            'titulo'    => 'Inglês',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'quimica' => [
            'titulo'    => 'Química',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'biologia' => [
            'titulo'    => 'Biologia',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'historia' => [
            'titulo'    => 'História',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'geografia' => [
            'titulo'    => 'Geografia',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'fisica' => [
            'titulo'    => 'Física',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'atualidades' => [
            'titulo'    => 'Atualidades',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'hist-arte' => [
            'titulo'    => 'História da Arte',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'redacao' => [
            'titulo'    => 'Redação',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'ed-fisica' => [
            'titulo'    => 'Educação-Física',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ],
        'literatura' => [
            'titulo'    => 'Literatura',
            'professor' => 'João',
            'nota1'     => 6.0,
            'nota2'     => 7.5
        ]
    ];

    ob_start();
    if (isset($_GET['materia'])) {
        
        $materia_selecionada = $_GET['materia'];

        if (array_key_exists($materia_selecionada, $dados_das_materias)) {
            $materia_info = $dados_das_materias[$materia_selecionada];

            echo '<a href="pagina3.php" class="btn-voltar">< Voltar </a>';

            echo '<div class="notas-container">';
            echo '  <div class="notas-card">';
            echo "    <h1>" . htmlspecialchars($materia_info['titulo']) . "</h1>";
            echo '    <div class="notas-info">';
            echo "      <p><strong>Professor:</strong> " . htmlspecialchars($materia_info['professor']) . "</p>";
            echo "      <p><strong>Nota 1:</strong> " . htmlspecialchars(number_format($materia_info['nota1'], 1, ',')) . "</p>";
            echo "      <p><strong>Nota 2:</strong> " . htmlspecialchars(number_format($materia_info['nota2'], 1, ',')) . "</p>";
            echo '    </div>';
            echo '  </div>';
            echo '</div>';

        } else {
            echo "<h1>Matéria não encontrada!</h1>";
            echo "<p>A matéria que você tentou acessar não existe.</p>";
        }

    } else {
        echo "<h1>Nenhuma matéria selecionada!</h1>";
        echo "<p>Por favor, volte à página anterior e escolha uma matéria para ver os detalhes.</p>";
    }

    $page_content = ob_get_clean();
    include 'masterA.php';
    ?>

</body>
</html>