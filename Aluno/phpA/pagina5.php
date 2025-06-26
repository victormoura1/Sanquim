<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Matérias</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        .h1 {
            color: #307f81 !important;
            background-color: #FFFDFC;
            border: none;
            border-radius: 8px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 1.2rem;
            user-select: none;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s; 
        }
        .container {
            padding: 1rem 2rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);/*deixei em 3 colunas*/
            gap: 1rem;
            min-height: calc(100vh - 60px);/*altura da tela*/
            box-sizing: border-box;
            font-family: 'Poppins', Arial, sans-serif;
        }
        .box {
            background-color: #FFFDFC;
            border: none;
            border-radius: 8px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-weight: bold;  
            font-size: 1.2rem;
            color: #307f81;
            user-select: none;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .box:hover {
            transform: scale(1.05);
            box-shadow: 2px 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
        .box h2 {
            text-align: center;
        }
        .container a {
            text-decoration: none !important;/
            color: inherit;
        }  
    </style>
</head>
<body>
    <?php
        $page_content = '../htmlA/conteudo5.php';
        include 'masterA.php';
    ?>
</body>
</html>