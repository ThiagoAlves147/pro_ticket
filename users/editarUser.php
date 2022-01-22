<?php
    require "../config.php";
    require "../ver/verificarUsuario.php";
    if($_SESSION['cargo'] != 1){
        header("Location: ../notFound.php");
        exit;
    }
    $id = filter_input(INPUT_POST, 'editId');
    $nome = filter_input(INPUT_POST, 'editNome', FILTER_SANITIZE_SPECIAL_CHARS);
    $cargo = filter_input(INPUT_POST, 'editCargo');
    if($id && $nome && $cargo){
        $nome = ucwords(strtolower($nome));
        $sql = $pdo -> prepare('UPDATE usuarios SET nome=:nome, idCargo=:cargo WHERE idUsuario=:id');
        $sql -> bindValue(':id', $id);
        $sql -> bindValue(':nome', $nome);
        $sql -> bindValue(':cargo', $cargo);
        $sql -> execute();
        $_SESSION['sucess'] = "Ação bem sucedida!";
    }else{
        $_SESSION['fail'] = "Falha ao relizar a ação!";
    }

    header("Location: verUsuarios.php");
    exit;