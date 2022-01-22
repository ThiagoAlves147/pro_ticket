<?php
    require_once "../config.php";
    session_start();
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');
    $senhaC = filter_input(INPUT_POST, 'senhaC');

    if($senha != $senhaC){
        $_SESSION['senha'] = "Senhas Diferentes";
        header("Location: ../cadastro.php");
        exit;
    }

    $sql = $pdo -> query("SELECT * FROM usuarios WHERE email='$email'");
    if($sql -> rowCount() > 0){
        $_SESSION['email'] = "Este Email já existe";
        header("Location: ../cadastro.php");
        exit;
    }

    if($nome && $email && $senha){
        $nome = ucwords(strtolower($nome));
        $senha = password_hash($senha, PASSWORD_DEFAULT);

        $sql = $pdo -> prepare('INSERT INTO usuarios(nome, email, senha, idCargo, status) VALUES(:nome, :email, :senha, 3, 1)');
        $sql -> bindValue(":nome", $nome);
        $sql -> bindValue(":email", $email);
        $sql -> bindValue(":senha", $senha);
        $sql -> execute();
        $_SESSION['sucess'] = "Cadastrado com sucesso!";
        header("Location: ../index.php");
        exit;
    }else{
        $_SESSION['aviso'] = "Preencha os campos corretamente!";
        header("Location: ../cadastro.php");
        exit;
    } 