<?php
    require "../config.php" ;
    require "../ver/verificarUsuario.php";
    if($_SESSION['cargo'] != 1){
        header("Location: ../notFound.php");
        exit;
    }
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if($id){
        $sql = $pdo -> prepare('UPDATE usuarios SET status=2 WHERE idUsuario=:id');
        $sql -> bindValue(':id', $id);
        $sql -> execute();
    }
    header("Location: verUsuarios.php");
    exit; 