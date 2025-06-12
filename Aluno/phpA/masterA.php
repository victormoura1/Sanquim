<html>
    <body>
        <div><?php include '../htmlA/menu.html'; ?></div>
        <div><?php
                if (isset($page_content)) {
                    if (file_exists($page_content)) {
                        include $page_content;
                    } else {
                        echo $page_content;
                    }
                    
                } else {
                    echo "<h1>Erro: Conteúdo da página não especificado.</h1>";
                }
                ?>
        </div>
        <div><?php include '../htmlA/rodape.html'; ?></div>
    </body>
</html>