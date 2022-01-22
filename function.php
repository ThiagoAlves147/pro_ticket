<?php
    function aberto($id, $cargo){
        require "config.php";
        if($cargo == 1 || $cargo == 2){
            $sql = $pdo -> query('SELECT * FROM ticket WHERE id_situacao=1 AND idStatus=1');
            return $sql -> rowCount();
        }
        else{
            $sql = $pdo -> query("SELECT * FROM ticket WHERE id_situacao=1 AND idUsuario='$id' AND idStatus=1");
            return $sql -> rowCount();
        }
    }

    function pendentes($id, $cargo){
        require "config.php";
        if($cargo == 1 || $cargo == 2){
            $sql = $pdo -> query('SELECT * FROM ticket WHERE id_situacao in(2,3) AND idStatus=1');
            return $sql -> rowCount();
        }
        else{
            $sql = $pdo -> query("SELECT * FROM ticket WHERE id_situacao in(2,3) AND idUsuario='$id' AND idStatus=1");
            return $sql -> rowCount();
        }
    }

    function todos($id, $cargo){
        require "config.php";
        if($cargo == 1 || $cargo == 2){
            $sql = $pdo -> query('SELECT * FROM ticket WHERE id_situacao in(1,2,3) AND idStatus=1');
            return $sql -> rowCount();
        }
        else{
            $sql = $pdo -> query("SELECT * FROM ticket WHERE id_situacao in(1,2,3) AND idUsuario='$id' AND idStatus=1");
            return $sql -> rowCount();
        }
    }

    function alerta(){
                if(isset($_SESSION['sucess']))
                    echo '<div class="alert alert-success" role="alert">'
                            .$_SESSION["sucess"].
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'.
                        '</div>';
                if(isset($_SESSION['fail'])){
                    echo '<div class="alert alert-danger" role="alert">'
                            .$_SESSION["fail"].
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'.
                        '</div>';
                }
                unset($_SESSION['sucess']);
                unset($_SESSION['fail']);
    }

    function admin($cargo){
        if($cargo != 1){
            header("Location: ../notFound.php");
            exit;
        }
    }

    function atendente($cargo){
        if($cargo != 1 || $cargo != 2){
            header("Location: ../notFound.php");
            exit;
        }
    }

    function cliente($cargo){
        if($cargo != 3){
            header("Location: ../notFound.php");
            exit;
        }
    }

    