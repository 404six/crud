<?php

require_once "api/db.php";

//  instanciando a class do banco de dados
$db = new db();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAINEL - CRUD</title>

    <!------ css ---------->
    <link href="/crud/assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="/crud/assets/css/styles.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!------ js ---------->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>

<body>
    <fieldset>
        <div class="panel panel-primary">
            <div class="panel-heading">PAINEL - CRUD</div>
            <div class="panel-body">
                <section class="ftco-section">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center mb-5">
                                <h1 class="heading-section">Tabela de Usuários</h!>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-wrap">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr class="bg-dark">
                                                <th>Nome</th>
                                                <th>Telefone</th>
                                                <th>E-mail</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $qry = $db->do_query("SELECT * FROM dados ORDER BY primary_key DESC LIMIT 20")->execute();
                                            while ($result = $qry->get_result()) {
                                                echo '
                                                    <tr class="bg-primary" id="' . $result['primary_key'] . '">
                                                        <th>' . (empty($result['nome_apelido']) ? $result['nome'] : $result['nome_apelido']) . '<button id="edit-button-1" onclick="editar_valor(this)"><i class="fa fa-edit"></i></button></th>
                                                        <th>' . $result['telefone'] . '<button id="edit-button-2" onclick="editar_valor(this)"><i class="fa fa-edit"></i></button></th>
                                                        <th>' . $result['email'] . '<button id="edit-button-3" onclick="editar_valor(this)"><i class="fa fa-edit"></i></button></th>
                                                        <td><button onclick="deletar_fileira(this)"><i class="fa fa-remove"></i></button></td>
                                                    </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- modal de editar valores -->
                <div id="modal" class="modal">

                    <!-- conteúdo do modal -->
                    <div class="modal-content" id="modal-content">
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <script>
        function deletar_fileira(btn) {
            var fileira = btn.parentNode.parentNode;
            var id = fileira.id;

            $.ajax({
                url: "api/deletar.php",
                contentType: "text/html; charset=UTF-8",
                type: 'GET',
                data: {
                    "id": id
                },
                cache: false,
                async: true,
                contentType: false,
                success: function(response) {
                    // requisição feita com sucesso
                    switch (response) {
                        case "sucesso":
                            // remove fileira caso dê tudo certo
                            fileira.parentNode.removeChild(fileira);
                            alert('Usuário deletado com sucesso!');
                            break;
                        case "id_nao_informado":
                            alert('Id não informado!');
                            break;
                        case "falha_ao_deletar":
                            alert('Ocorreu uma falha ao deletar!');
                            break;
                    }
                },
                error: function() {
                    // error handling de algum desconhecido que ocorreu
                    alert(xhr.response);
                }
            });

        }

        // obtendo o modal
        var modal = document.getElementById("modal");

        function editar_valor(btn) {
            var fileira = btn.parentNode.parentNode;

            // abrir o modal quando o botão for clicado
            modal.style.display = "block";

            // valor padrão
            var coluna = 0;
            switch (btn.id) {
                case "edit-button-1":
                    $('#modal-content').text('Edite o nome');
                    break;
                case "edit-button-2":
                    coluna = 1;
                    $('#modal-content').text('Edite o telefone');
                    break;
                case "edit-button-3":
                    coluna = 2;
                    $('#modal-content').text('Edite o e-mail');
                    break;
                
            }

            $('#modal-content').append('<form id="editar-form" method="get"><br><input name="novo_valor" id="novo_valor" class="form-control" placeholder="Novo valor" type="text"><br><a id="enviar-btn" href="#" class="btn bg-primary" onClick="enviar_novo_valor(' + fileira.id +','+ coluna + ')";>Editar</a></form>');
        }
        
         $("#editar-form").keyup(function(event) {
            if (event.keyCode === 13) {
                $("#enviar-btn").click();
            }
        });

        function enviar_novo_valor(id, coluna_id) {
            $.ajax({
                url: "api/editar.php",
                contentType: "text/html; charset=UTF-8",
                type: 'GET',
                data: {
                    "id": id,
                    "novo_valor": $("#novo_valor").val(),
                    "coluna": coluna_id
                },
                cache: false,
                async: true,
                contentType: false,
                success: function(response) {
                    // requisição feita com sucesso
                    switch (response) {
                        case "sucesso":
                            alert('Valor editado com sucesso!');
                            location.reload();
                            break;
                        case "falha_ao_editar":
                            alert('Falha ao editar coluna!');
                            break;
                    }
                },
                error: function() {
                    // error handling de algum desconhecido que ocorreu
                    alert(xhr.response);
                }
            });
        };
        
        // fechar o modal quando clicar fora do modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>
