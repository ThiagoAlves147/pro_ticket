<!DOCTYPE html>
<html lang="pt-br">

<?php
    session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <script src="https://kit.fontawesome.com/f5c5b70e3a.js" crossorigin="anonymous"></script>
    <link href="estilo.css" rel="stylesheet">
    <title>Cadastro</title>
</head>
<body class="bodyL">
    
<div class="containerL" id="containerC">
        <h1>Cadastrar</h1>
        <form method="POST" action="ver/verificarCadastro.php">
            <label>
                <input class="inputL" type="text" name="nome" placeholder="Nome Completo" autofocus/>
            </label>

            <label>
                <input class="inputL" type="email" name="email" placeholder="E-mail" />
            </label>

            <label>
                <input class="inputL" type="password" name="senha" placeholder="Senha" />
            </label>

            <label>
                <input class="inputL" type="password" name="senhaC" placeholder="Confirmar Senha" />
            </label>

            <input class="botao" type="submit" value="Enviar"/>
        </form>
        <a href="index.php" id="linkB"><i class="fas fa-arrow-left"></i></a>

    </div>
    <br>
    <p>
        <?php
            if(isset($_SESSION['senha'])){
                echo $_SESSION['senha'];
                $_SESSION['senha'] = " ";
            } 
            if(isset($_SESSION['email'])){
                echo $_SESSION['email'];
                $_SESSION['email'] = " ";
            }
            if(isset($_SESSION['aviso'])){
                echo $_SESSION['aviso'];
                $_SESSION['aviso'] = " ";
            }
        ?>
    </p>

</body>
</html>