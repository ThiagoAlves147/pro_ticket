<?php
    require "../config.php";
    require "../ver/verificarUsuario.php";
    date_default_timezone_set('America/Fortaleza');
    $id = $_SESSION['id'];
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_SPECIAL_CHARS);
    $prioridade = filter_input(INPUT_POST, 'prioridade');
    $mensagem = filter_input(INPUT_POST, 'mensagem');
    $data = date('Y/m/d H:i:s');

    if($id && $assunto && $prioridade && $data && $mensagem){
        $assunto = ucfirst($assunto);
        $sql = $pdo -> prepare('INSERT INTO ticket(idUsuario, assunto, idPri, data, id_situacao, idStatus) 
        VALUES(:id, :assunto, :prioridade, :data, 1, 1)');
        $sql -> bindValue(':id', $id);
        $sql -> bindValue(':assunto', $assunto);
        $sql -> bindValue(':prioridade', $prioridade);
        $sql -> bindValue(':data', $data);
        $sql -> execute(); 
        
        $idL = $pdo -> lastInsertId();

        $sql = $pdo -> prepare('INSERT INTO mensagem(idTicket, idUsuario, msg) 
        VALUES(:idL, :id, :mensagem)');
        $sql -> bindValue(':mensagem', $mensagem);
        $sql -> bindValue(':idL', $idL);
        $sql -> bindValue(':id', $id);
        $sql -> execute();

        $_SESSION['sucess'] = "Ticket aberto com sucesso!";

    }else{
        $_SESSION['fail'] = "Não foi possivel abrir o Ticket";;
    }

    if($_SESSION['cargo'] == 1){
        header("Location: ../telas/admin.php");
        exit;
    }
    elseif($_SESSION['cargo'] == 2){
        header("Location: ../telas/atendente.php");
        exit;
    }
    else{
        header("Location: ../telas/cliente.php");
        exit;
    }
    