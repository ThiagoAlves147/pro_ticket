<?php
    require_once "../config.php";
    require "../function.php";
    require "../ver/verificarUsuario.php";
    $open = aberto($_SESSION['id'], $_SESSION['cargo']);
    $pendentes = pendentes($_SESSION['id'], $_SESSION['cargo']);
    $todos = todos($_SESSION['id'], $_SESSION['cargo']);
    admin($_SESSION['cargo']);
    $sql = $pdo -> query(
                        'SELECT usuarios.idUsuario, usuarios.nome, usuarios.email, cargo.funcao
                        FROM usuarios, cargo, status_usuarios
                        WHERE usuarios.idCargo=cargo.idCargo
                        AND usuarios.status=status_usuarios.id_status_usuarios
                        AND usuarios.status=2
                        ORDER BY cargo.idCargo,
                        usuarios.nome'
                    );

    $lista = [];
    if($sql -> rowCount() > 0){
        $lista = $sql -> fetchAll(PDO::FETCH_ASSOC);
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
            <i class="fas fa-question-circle"></i>
            <br/>
            <a class="menuF" href="verUsuarios.php">Usuários</a>
            <a class="menuF" href="verInativos.php">Usuários Inativos</a>
            <div class="dropdown ml-5">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Tickets <span class="badge bg-danger"><?= $todos ?></span>
                </button>
                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item text-white" href="../telas/admin.php"><i class="fas fa-angle-right"></i>Abertos<span class="badge bg-danger"><?= $open ?></span></a></li>
                    <li><a class="dropdown-item text-white" href="../telas/pendentes.php"><i class="fas fa-angle-right"></i>Pendentes<span class="badge bg-danger"><?= $pendentes ?></span></a></li>
                    <li><a class="dropdown-item text-white" href="../telas/fechados.php"><i class="fas fa-angle-right"></i>Fechados</a></li>
                </ul>
            </div>
            <a class="menuF" href="">Contatar Suporte</a>
            <a class="menuF" href="">Ajuda</a>
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
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" id="cod">#id</th>
                        <th scope="col">Usuarios</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        alerta();
                    ?>
                    <?php foreach($lista as $dados):?>
                        <tr>
                            <th scope="row"><?php echo "#".$dados['idUsuario']; $dado = $dados['idUsuario']?></th>
                            <td><?php echo $dados['nome'] ?></td>
                            <td><?php echo $dados['email'] ?></td>
                            <td><?php echo $dados['funcao'] ?></td>
                            <td>
                                <a type="button"><i class="far fa-edit" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $dados['idUsuario'] ?>"></i></a>
                            </td>
                        </tr>
                        
                        <div class="modal fade" id="modalEdit<?php echo $dados['idUsuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">EDITAR</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <form action="editarUser.php" method="POST">
                                            <div class="form-floating mb-2 mb-1">
                                                <input type="number" class="form-control" id="floatingInput" name="editId" value="<?= $dados['idUsuario'] ?>" readonly>
                                                <label for="floatingInput">#ID: </label>
                                            </div>
                                            <div class="form-floating mb-2 mb-1">
                                                <input type="text" class="form-control" id="floatingInput" value="<?= $dados['nome'] ?>" name="editNome">
                                                <label for="floatingInput">Nome</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input type="email" class="form-control" id="floatingInputValue" value="<?= $dados['email'] ?>" name="editEmail" readonly>
                                                <label for="floatingInputValue">E-mail</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="editCargo">
                                                    <option selected disabled><?= $dados['funcao'] ?></option>
                                                    <option value="1">Administrador</option>
                                                    <option value="2">Atendente</option>
                                                    <option value="3">Cliente</option>
                                                </select>
                                                <label for="floatingSelect">Prioridade</label>
                                            </div>
                                    </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </div>

                                        </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
            
        </div>
    </div>

    <script type="text/javascript" src="../jquery.js"></script>    
    <script type="text/javascript" src="../bootstrap.js"></script>

    
</body>
</html>