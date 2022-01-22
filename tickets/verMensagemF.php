<?php
    require "../config.php";
    require "../ver/verificarUsuario.php";
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if($_SESSION['cargo'] == 3){
        $idUser = $_SESSION['id'];
        $sql = $pdo -> query("SELECT * FROM ticket WHERE idUsuario='$idUser' AND idTicket='$id'");
        if($sql -> rowCount() == 0){
            header("Location: ../notFound.php");
            exit;
        }
    }

    if(!$id){
        $id = $_SESSION['ticket'];
    }

    $sql = $pdo -> query(
                        "SELECT ticket.idTicket, ticket.assunto, usuarios.nome, mensagem.msg, cargo.funcao
                        FROM ticket, usuarios, mensagem, cargo 
                        WHERE ticket.idTicket=mensagem.idTicket 
                        AND usuarios.idCargo=cargo.idCargo
                        AND usuarios.idUsuario=mensagem.idUsuario
                        AND ticket.idTicket='$id'"
                        );
    if($sql -> rowCount() > 0){
        $lista = [];
        $lista = $sql -> fetchAll(PDO::FETCH_ASSOC);
    }

    $sql = $pdo -> query(
                        "SELECT ticket.idTicket, ticket.assunto, usuarios.nome, usuarios.email
                        FROM ticket, usuarios 
                        WHERE usuarios.idUsuario=ticket.idUsuario
                        AND ticket.idTicket='$id'"
                        );
    if($sql -> rowCount() > 0){
    $info = [];
    $info = $sql -> fetch(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="../estilo.css" rel="stylesheet">
    <link href="../estiloBoots.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f5c5b70e3a.js" crossorigin="anonymous"></script>
    <title>Tickets</title>
</head>
<body class="body3">
    <div class="container3">
        <div class="menu">
            <img src="../imagens/LOGO1.png" width="100%" height="140px" class="logo" onclick="voltar()"/>
            <br/><br/>
            <a href="reabrir.php?id=<?php echo $id?>"><button class="btn btn-success" type="button" id="finalizar">
                    Reabrir Ticket 
            </button></a>
            <br/><br/><br/>
            <p id="infoP" >Cliente</p>
            <p class="infoP">
                Nome:<br/>
                <?= $info['nome'] ?>
                <br/><br/>
                E-mail:<br/>
                <?= $info['email'] ?>
            </p>

            <a type="button" onclick="voltar()"><i id="arrowMsg" class="fas fa-arrow-left fa-2x"></i></a>
        </div>    

        <div class="header3">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid" id="procurar">
                    <i class="fas fa-search fa-lg"></i>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search" id="pesquisar">
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                                echo $_SESSION['nome'];
                            ?>
                        </a>
                        <ul class="dropdown-menu bg-white" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Meus Dados</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../telas/sair.php">Sair</a></li>
                        </ul>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="tabela3"> 
            <h2><?php echo "Detalhes do Ticket #".$info['idTicket']." - ".$info['assunto']; ?></h2>
            <?php foreach($lista as $dados): ?>
                <div class="msg">
                    <div class="dMsg">
                        <p class="pMsg" ><?php echo $dados['nome']?></p> 
                        <small class="sMsg"><?php echo $dados['funcao'] ?> </small>
                    </div>
                    
                    <?php echo $dados['msg'] ?>
                    <br/><br/>
                    
                    <div id="dvConteudo" style="display: none;">
                        <br/>
                        <form action="pegarResp.php" method="POST" for="#rEnviar">
                            <input type="hidden" name="id" value="<?php echo $info['idTicket'] ?>"/>
                            <textarea name="resposta" placeholder="Insira a resposta aqui..." id="resposta"></textarea>
                            <br/>
                        </form>
                    </div>
                    

                </div>
            <?php endforeach ?>
        </div>
        
    </div>

    <script>
        function voltar() {
            window.history.back()
        }
    </script>

    <script type="text/javascript" src="../jquery.js"></script>    
    <script type="text/javascript" src="../bootstrap.js"></script>
</body>
</html>