<?php
    require "../config.php";
    $lista = [];
    $cargo = $_SESSION['cargo'];
    $id = $_SESSION['id'];
    if($cargo == 1 || $cargo == 2){
        $sql = $pdo -> query(
                            'SELECT ticket.idTicket, usuarios.nome, ticket.assunto, prioridade.nivel, ticket.data, situacao.status_situacao, status.cond 
                            FROM ticket, usuarios, prioridade, situacao, status
                            WHERE ticket.idUsuario=usuarios.idUsuario 
                            AND ticket.idPri=prioridade.idPri 
                            AND ticket.id_situacao=situacao.id_situacao
                            AND ticket.idStatus=status.idStatus
                            AND ticket.id_situacao IN(1,2,3)
                            AND ticket.idStatus=2
                            ORDER BY ticket.idTicket DESC'
                        );
    }else{
        $sql = $pdo -> query(
                            "SELECT ticket.idTicket, usuarios.nome, ticket.assunto, prioridade.nivel, ticket.data, situacao.status_situacao, status.cond, usuarios.idUsuario
                            FROM ticket, usuarios, prioridade, situacao, status
                            WHERE ticket.idUsuario=usuarios.idUsuario 
                            AND ticket.idPri=prioridade.idPri 
                            AND ticket.id_situacao=situacao.id_situacao
                            AND ticket.idStatus=status.idStatus
                            AND ticket.id_situacao IN(1,2,3)
                            AND ticket.idStatus=2
                            AND usuarios.idUsuario='$id'
                            ORDER BY ticket.idTicket DESC"
        );
    }
    if($sql -> rowCount() > 0){
        $lista = $sql -> fetchAll(PDO::FETCH_ASSOC);
    }
?>

<table class="table table-striped table-hover"
     <thead>
        <tr>
            <th scope="col" id="cod">#id</th>
            <th scope="col">Cliente</th>
            <th scope="col">Assunto</th>
            <th scope="col">Prioridade</th>
            <th scope="col">Data/Hora</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lista as $dados):?>
            <a href="#">
                <tr>
                    <th scope="row"><a href="../tickets/verMensagem.php?id=<?php echo $dados['idTicket'] ?>" class="verTicket"><?php echo "#".$dados['idTicket']; ?></a></th>
                    <td><a href="../tickets/verMensagemF.php?id=<?php echo $dados['idTicket'] ?>" class="verTicket"><?php echo $dados['nome'] ?></a></td>
                    <td><a href="../tickets/verMensagemF.php?id=<?php echo $dados['idTicket'] ?>" class="verTicket"><?php echo $dados['assunto'] ?></a></td>
                    <td><a href="../tickets/verMensagemF.php?id=<?php echo $dados['idTicket'] ?>" class="verTicket"><?php echo $dados['nivel'] ?></a></td>
                    <td><a href="../tickets/verMensagemF.php?id=<?php echo $dados['idTicket'] ?>" class="verTicket"><?php echo $dados['data'] ?></a></td>
                    <td><a href="../tickets/verMensagemF.php?id=<?php echo $dados['idTicket'] ?>" class="verTicket"><?php echo $dados['cond'] ?></a></td>
                </tr>
            </a>
        <?php endforeach ?>
    </tbody>
</table>