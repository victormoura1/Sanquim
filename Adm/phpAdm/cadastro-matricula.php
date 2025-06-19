<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5; /* Fundo claro para a página */
            font-family: 'Poppins', Arial, sans-serif;
            display:hidden;
            overflow: hidden;
        }
        .admin-box-custom {
            background-color: #FFFDFC; /* Cor de fundo da caixa */
            color: #307f81; /* Cor do texto */
            border-radius: 8px;
            height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 1.3rem;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            padding: 1rem;
            text-decoration: none; /* Remover sublinhado do link */
        }

        .admin-box-custom:hover {
            transform: scale(1.05);
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            color: #307f81; /* Manter a cor do texto no hover */
        }
        /* Garantindo que o h2 dentro da caixa mantenha a cor */
        .admin-box-custom h2 {
            color: #307f81;
        }

        /* Centralizar o container na tela */
        html, body {
            height: 100%;
        }
        .d-flex.justify-content-center.align-items-center.min-vh-100 {
            /* Adicionado para centralizar verticalmente o conteúdo na tela */
            /* min-vh-100 já é do bootstrap e faz a magia */
        }

    </style>
</head>

<body>
    <?php
    include 'masterAdm.php';
    ?>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-3">
                <div class="col">
                    <a href="index.php" class="admin-box-custom">
                        <h2>Cadastrar novos usuários</h2>
                    </a>
                </div>
                <div class="col">
                    <a href="index-turmas.php" class="admin-box-custom">
                        <h2>Cadastrar novas turmas</h2>
                    </a>
                </div>
                <div class="col">
                    <a href="index-alunos.php" class="admin-box-custom">
                        <h2>Matricular Aluno</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>