<?php
    require_once "../config.php";
    require "../function.php";
    require "../ver/verificarUsuario.php";
    $open = aberto($_SESSION['id'], $_SESSION['cargo']);
    $pendentes = pendentes($_SESSION['id'], $_SESSION['cargo']);
    $todos = todos($_SESSION['id'], $_SESSION['cargo']);
    admin($_SESSION['cargo']);
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
            <img src="../imagens/LOGO1.png" width="100%" height="140px" class="logo"/>
            <br/>
            <a type="button" class="abrir" data-bs-toggle="modal" data-bs-target="#exampleModal">Abrir Ticket</a>
            <!-- Modal -->
            <?php require "../tickets/adicionarTicket.php"; ?>
            <br/>
            <i class="fas fa-plus-circle fa-lg"></i>
            <i class="fas fa-users"></i>
            <i class="fas fa-user-lock"></i>
            <i class="fas fa-envelope-open"></i>
            <i class="fas fa-phone"></i>
            
            <br/>
            <a class="menuF" href="../users/verUsuarios.php">Usuários</a>
            <a class="menuF" href="../users/verInativos.php">Usuários Inativos</a>
            <div class="dropdown ml-5">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Tickets <span class="badge bg-danger"><?= $todos ?></span>
                </button>
                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item text-white" href="admin.php"><i class="fas fa-angle-right"></i>Abertos<span class="badge bg-danger"><?= $open ?></span></a></li>
                    <li><a class="dropdown-item text-white" href="pendentes.php"><i class="fas fa-angle-right"></i>Pendentes<span class="badge bg-danger"><?= $pendentes ?></span></a></li>
                    <li><a class="dropdown-item text-white" href="#"><i class="fas fa-angle-right"></i>Fechados</a></li>
                </ul>
            </div>
            <a class="menuF" href="">Contatar Suporte</a>
            <a class="menuF" href=""><i class="fas fa-question-circle"></i>Ajuda</a>
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
                            <li><a class="dropdown-item" href="sair.php">Meus Dados</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="sair.php">Sair</a></li>
                        </ul>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="tabela3">

            <?php require "../tickets/verFechados.php"; ?>

        </div>
        
    </div>
    

    <script type="text/javascript" src="../jquery.js"></script>    
    <script type="text/javascript" src="../bootstrap.js"></script>
</body>
</html>