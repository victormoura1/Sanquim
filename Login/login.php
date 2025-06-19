<?php
// Inicia a sessão. É crucial que session_start() seja a primeira coisa no script.
session_start();

// Pega a mensagem da sessão, se existir
$mensagem_erro = "";
if (isset($_SESSION['mensagem_login'])) {
    $mensagem_erro = $_SESSION['mensagem_login'];
    unset($_SESSION['mensagem_login']); // Remove a mensagem da sessão para que não apareça novamente
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<style>
    body {
    background-color: #FFD984;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    overflow: hidden;
    font-family: 'Poppins', Arial, sans-serif;
}


.container {
    width: 450px;
    height: 550px;
    display: flex;
    border-radius: 15px;
    box-shadow: 0px 5px 7px rgba(0, 0, 0, 0.1);
    align-items: center;
    flex-direction: column;
}

.login {
    background-color: white;
    max-width: 450px;
    width: 100%;
    height: 100%;
    border: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 18px;
    border-radius: 15px;
}

h1 {
    margin-top: -8px;
}

input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    width: 300px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border: none;
    font-family: 'Poppins', Arial, sans-serif;
}

img {
    margin-top: 10px;
    width: 312px;
    height: 142px;
}

#entrar {
    background-color: #379091;
    width: 300px;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 15px;
    cursor: pointer;
    font-family: 'Poppins', Arial, sans-serif;
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
    transition: background-color 0.5s;
}

#entrar:hover {
    background-color: #307f81;
}

a {
    color: #379091;
}

a:hover {
    color: #307f81;
}

.mensagem-erro {
    color: #dc3545; /* Vermelho Bootstrap */
    font-weight: 500;
    text-align: center;
    margin-top: -30px;
    margin-bottom: 0;
}

</style>

<body>
    <form action="../entrar.php" method="post">
        <div class="container">
            <div class="login">
                <img src="../img/logo.webp" alt="Logo da empresa">
                <h1>Login</h1>
                <?php if (!empty($mensagem_erro)): ?>
                    <p class="mensagem-erro"><?php echo $mensagem_erro; ?></p>
                <?php endif; ?>
                <input type="text" name="usuario" placeholder="Usuário*" required>
                <input type="password" name="senha" placeholder="Senha*" required>
                <p>Esqueceu sua senha? <a href="senha.html">Clique aqui</a></p>
                <button type="submit" id="entrar">Entrar</button>

            </div>
        </div>
    </form>
</body>
</html>