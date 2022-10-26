<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO - CRUD</title>

    <!------ css ---------->
    <link href="/crud/assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="/crud/assets/css/styles.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"> </script>
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    
    <!------ js ---------->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="/crud/assets/js/datepicker.js"></script>
    <script src="/crud/assets/js/cep.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
</head>

<body>
    <!-- formulário de cadastro -->
    <form class="form-horizontal" id="cadastro-form" method="post">
        <fieldset>
            <div class="panel panel-primary">
                <div class="panel-heading">CADASTRO - CRUD</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-11 control-label">
                            <p class="help-block">
                                <h11>*</h11> Campo Obrigatório
                            </p>
                        </div>
                    </div>

                    <!-- field de nome -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>
                        <div class="col-md-8">
                            <input id="nome" name="nome" placeholder="" class="form-control input-md" required="" maxlength="256" type="text">
                        </div>
                    </div>

                    <!-- field de nome fantasia/apelido -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="Nome">Nome Fantasia/Apelido</label>
                        <div class="col-md-8">
                            <input id="nome_fantasia" name="nome_fantasia" placeholder="Campo Opcional" class="form-control input-md" maxlength="256" type="text">
                        </div>
                    </div>

                    <!-- field para CPF-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="Nome">CPF <h11>*</h11></label>
                        <div class="col-md-2">
                            <input id="cpf" name="cpf" placeholder="Apenas Números" class="form-control input-md" required="" type="text" maxlength="11" pattern="[0-9]+$">
                        </div>

                    </div>

                    <!-- field de data -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="Nome">Data de Nascimento<h11>*</h11></label>
                        <div class="col-md-2">
                            <div class="input-group">
                            <input class="form-control" type="text" name="data_nsc" id="datepicker" required="">
                            </div>
                        </div>
                    </div>

                    <!-- field de telefone -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Telefone <h11>*</h11></label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                <input id="telefone" name="telefone" class="form-control" placeholder="xx xxxxx-xxxx" required="" type="text" maxlength="16">
                            </div>
                        </div>
                    </div>

                    <!-- field de e-mail -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">E-mail <h11>*</h11></label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input id="email" name="email" class="form-control" placeholder="email@email.com" required="" maxlength="64" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                            </div>
                        </div>
                    </div>


                    <!-- field para CEP -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="CEP">CEP <h11>*</h11></label>
                        <div class="col-md-2">
                            <input id="cep" name="cep" placeholder="Apenas números" class="form-control input-md" required="" value="" type="search" maxlength="8" pattern="[0-9]+$">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" onclick="search(cep.value)">Pesquisar</button>
                        </div>
                    </div>

                    <!-- fields de endereço -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="prependedtext">Endereço</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">Rua</span>
                                <input id="rua" name="rua" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">Nº <h11>*</h11></span>
                                <input id="numero" name="numero" class="form-control" placeholder="" required="" type="text">
                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Bairro</span>
                                <input id="bairro" name="bairro" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="prependedtext"></label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">Cidade</span>
                                <input id="cidade" name="cidade" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                            </div>

                        </div>

                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-addon">Estado</span>
                                <input id="estado" name="estado" class="form-control" placeholder="" required="" readonly="readonly" type="text">
                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon">Complemento</span>
                                <input id="complemento" name="complemento" class="form-control" placeholder="Campo Opcional" type="text">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="prependedtext"></label>
                    </div>



                    <div class="form-group">
                        <label class="col-md-2 control-label" for="prependedtext">Contatos Adicionais</label>

                        <div id="field_dinamico">
                            <div class="col-md-4">

                                <div class="input-group">
                                    <span class="input-group-addon">Nome</span>
                                    <input type="text" ame="nome_contato" class="form-control" name="contatos_adicionais[]" id="input-22" placeholder="">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Telefone</span>
                                    <input name="contatos_adicionais[]" class="form-control" id="telefone" placeholder="xx xxxxx-xxxx" type="text">
                                </div>

                            </div>

                            <div class="col-md-2">
                                <div class="input-group">
                                    <span class="input-group-addon">E-mail</span>
                                    <input name="contatos_adicionais[]" class="form-control" placeholder="email@email.com" type="text">
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <button type="button" name="add_field" id="add_field" class="btn bg-primary">Adicionar</button>
                        </div>
                    </div>

                    <!-- button para submit -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="Cadastrar"></label>
                        <div class="col-md-8">
                            <button id="cadastrar" href="#" name="cadastrar" class="btn bg-primary" type="Submit">Concluir Cadastro</button>
                        </div>
                    </div>

                </div>
            </div>

        </fieldset>
    </form>

    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add_field').click(function() {
                i++;
                $('#field_dinamico').append('<label class="col-md-2 control-label" for="prependedtext"></label><div class="col-md-4" id="row' + i + '"><div class="input-group"><span class="input-group-addon">Nome</span><input type="text" name="contatos_adicionais[]" placeholder="" class="form-control"></div></div>');
                $('#field_dinamico').append('<div class="col-md-3" id="row' + i + '"><div class="input-group"><span class="input-group-addon">Telefone</span><input type="text" name="contatos_adicionais[]" name="telefone" placeholder="xx xxxxx-xxxx" class="form-control"></div></div>');
                $('#field_dinamico').append('<div class="col-md-2" id="row' + i + '"><div class="input-group"><span class="input-group-addon">E-mail</span><input type="text" name="contatos_adicionais[]" placeholder="email@email.com" class="form-control"></div><br></div>');
            });
        });

        $('#cadastro-form').submit(function(e) {
            e.preventDefault();
            var data = new FormData($('#cadastro-form')[0]);
            $.ajax({
                url: "api/inserir.php",
                contentType: "text/html; charset=UTF-8",
                type: 'POST',
                data: data,
                cache: false,
                async: true,
                processData: false,
                contentType: false,
                success: function(response) {
                    // requisição feita com sucesso
                    switch (response) {
                        case "sucesso":
                            alert('Usuário criado com sucesso!');
                            // redirecionando para painel
                            $(location).attr('href', 'painel.php');
                            break;
                        case "preencha_tudo":
                            alert('Preencha todos os campos!');
                            break;
                        case "cpf_email_existente":
                            alert('CPF ou E-mail já cadastrado!');
                            break;
                    }
                },
                error: function() {
                    // error handling de algum desconhecido que ocorreu
                    alert(xhr.response);
                }
            });
        });


        /* máscaras ER */
        function mascara(o,f){
            v_obj=o
            v_fun=f
            setTimeout("execmascara()",1)
        }
        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }
        function mtel(v){
            v=v.replace(/\D/g,""); // remove tudo o que não é dígito
            v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); // coloca parênteses em volta dos dois primeiros dígitos
            v=v.replace(/(\d)(\d{4})$/,"$1-$2"); // coloca hífen entre o quarto e o quinto dígitos
            return v;
        }
        function id( el ){
            return document.getElementById( el );
        }
        window.onload = function(){
            id('telefone').onkeyup = function(){
                mascara( this, mtel );
            }
        }
    </script>
</body>

</html>