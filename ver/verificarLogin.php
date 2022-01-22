<?php
    require "../config.php";
    session_start();
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');
    $lista = [];
    if($email && $senha){
        $sql = $pdo -> prepare('SELECT * FROM usuarios WHERE email=:email');
        $sql -> bindValue(":email", $email);
        $sql -> execute();
        if($sql -> rowCount() > 0){
            $lista = $sql -> fetch(PDO::FETCH_ASSOC);
            $emailC = $lista['email'];
            $senhaC = $lista['senha'];
            $status = $lista ['status'];
        }

        if($status != 1){
            $_SESSION['login'] = "Error ao efetuar o login!";
            header("Location: ../index.php");
            exit;
        }

        if($email == $emailC && password_verify($senha, $senhaC) && $status == 1){
            $_SESSION['id'] = $lista['idUsuario'];
            $_SESSION['nome'] = $lista['nome'];
            $_SESSION['cargo'] = $lista['idCargo'];
            if($_SESSION['cargo'] == 1){
                header("Location: ../telas/admin.php");
                exit;
            }
            elseif($_SESSION['cargo'] == 2){
                header("Location: ../telas/atendente.php");
                exit;
            }
            elseif($_SESSION['cargo'] == 3){
                header("Location: ../telas/cliente.php");
                exit;
            }
        } else{
            $_SESSION['login'] = "E-mail ou senha incorreto(s)!";
            header("Location: ../index.php");
            exit;
        }
    }else{
        $_SESSION['aviso'] = "Preencha os campos corretamente!";
        header("Location: ../index.php");
        exit;
    }
    
    
    