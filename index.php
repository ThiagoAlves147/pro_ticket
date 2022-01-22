<!DOCTYPE html>
<html lang="pt-br">

<?php
    session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilo.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bodyL">
    <div class="containerL">
        <h1>Login</h1>
        <form method="POST" action="ver/verificarLogin.php">
            <label>
                <input class="inputL" type="email" name="email" placeholder="E-mail" autofocus/>
            </label>

            <label>
                <input class="inputL" type="password" name="senha" placeholder="Senha" />
            </label>

            <input class="botao" type="submit" value="Entrar"/>
        </form>
        <small>
            Novo usuário? <a href="cadastro.php" class="cadastro">Cadastre-se</a>
        </small>
    </div>
    <br>
    <p>
        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                $_SESSION['login'] = " ";
            } 
            if(isset($_SESSION['aviso'])){
                echo $_SESSION['aviso'];
                $_SESSION['aviso'] = " ";
            } 
            if(isset($_SESSION['sucess'])){
                echo $_SESSION['sucess'];
                $_SESSION['sucess'] = " ";
            }
        ?>
    </p>
    
</body>
</html>