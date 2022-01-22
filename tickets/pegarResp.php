<?php
    require "../config.php";
    session_start();
    $idUser = $_SESSION['id'];
    $cargo = $_SESSION['cargo'];
    $msg = filter_input(INPUT_POST, 'resposta');
    $id = filter_input(INPUT_POST, 'id');

    if($id && $msg){
        $sql = $pdo -> prepare('INSERT INTO mensagem(idTicket ,idUsuario, msg) 
                                VALUES(:id ,:idUser, :msg)');
        $sql -> bindValue(':id', $id);
        $sql -> bindValue(':msg', $msg);
        $sql -> bindValue(':idUser', $idUser);
        $sql -> execute();

        if($cargo == 1 || $cargo == 2){
            $sql = $pdo -> query("UPDATE ticket SET id_situacao=3 WHERE idTicket='$id'");
        }
        else{
            $sql = $pdo -> query("UPDATE ticket SET id_situacao=2 WHERE idTicket='$id'");
        }

        $_SESSION['ticket'] = $id;
    }
    else{
        $_SESSION['ticket'] = $id;
        header("Location: verMensagem.php");
        exit;
    }
                            