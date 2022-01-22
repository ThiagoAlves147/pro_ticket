<?php
    require "../config.php";
    require "../ver/verificarUsuario.php";
    $cargo = $_SESSION['cargo'];
    $id = filter_input(INPUT_GET, 'id');
    if($id){
        $sql = $pdo -> query("UPDATE ticket SET idStatus=2 WHERE idTicket='$id'");
    }
    if($cargo == 1){
        header("Location: ../telas/admin.php");
        exit;
    }
    elseif($cargo == 2){
        header("Location: ../telas/atendente.php");
        exit;
    }
    else {
        header("Location: ../telas/cliente.php");
        exit;
    }