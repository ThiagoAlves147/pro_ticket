<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../estilo.css" rel="stylesheet">
    <title>Ticket</title>
</head>
<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">TICKET</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <form action="../ver/verificarAdicionar.php" method="POST">
                        <div class="form-floating mb-3 mb-1">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Informe o assunto aqui..." name="assunto">
                            <label for="floatingInput">Assunto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="prioridade">
                                <option selected>Selecionar</option>
                                <option value="1">Baixa</option>
                                <option value="2">Normal</option>
                                <option value="3">Alta</option>
                            </select>
                            <label for="floatingSelect">Prioridade</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Descreva o ticket aqui..." id="floatingTextarea2" style="height: 100px" name="mensagem"></textarea>
                            <label for="floatingTextarea2">Descrição</label>
                        </div>
                </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>

                    </form>
            </div>
         </div>
    </div>
</body>
</html>