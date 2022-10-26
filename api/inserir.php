<?php

require_once "db.php";

/* 
    *teste de sanidade*
    creio que não seja a melhor forma de fazer isso
    usei empty() para dados que são obrigatórios (ou seja, não pode ser vazio)
    e usei !isset() para dados que são opcionais (ou, seja pode ser vazio, porém deve estar definido)
*/
if (
    empty($_POST["nome"]) || !isset($_POST["nome_fantasia"]) ||
    empty($_POST["cpf"]) || empty($_POST["data_nsc"]) ||
    empty($_POST["telefone"]) || empty($_POST["email"]) ||
    empty($_POST["cep"]) || empty($_POST["rua"]) ||
    empty($_POST["numero"]) || empty($_POST["bairro"]) ||
    empty($_POST["cidade"]) || empty($_POST["estado"]) ||
    !isset($_POST["complemento"]) || !isset($_POST["contatos_adicionais"])
) {
    die("preencha_tudo");
}

// definindo todas as variaveis que serão necessárias
$nome = $_POST["nome"];
$nome_fantasia = $_POST["nome_fantasia"];
$cpf = $_POST["cpf"];
$data_nsc = $_POST["data_nsc"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];

/*
    transformando o endereço completo para array e depois formatando para json
    obs: optei por json por ser mais compacto no banco de dados e por ser bem facil de manipulação
*/
$cep = $_POST["cep"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$complemento = $_POST["complemento"];

$endereco = json_encode(array(
    "cep" => $cep,
    "rua" => $rua,
    "numero" => $numero,
    "bairro" => $bairro,
    "cidade" => $cidade,
    "estado" => $estado,
    "complemento" => $complemento
));

//  instanciando a class do banco de dados
$db = new db();

// executa uma requisição em busca de uma conta já existente com os dados informados
$dados_qry = $db->do_query("SELECT * FROM dados WHERE cpf=:cpf or email=:email;")->bind_param(array(
    ":cpf" => $cpf,
    ":email" => $email
))->execute();

$row_count = $dados_qry->get_row_count();

// checa se já há uma ocorrência daqueles dados no banco de dados
if ($row_count > 0) {
    $db->destroy();
    die("cpf_email_existente");
}

// inserindo os dados de cadastro ao banco de dados
$db->do_query("INSERT INTO dados(nome, nome_apelido, cpf, data_nascimento, telefone, email, endereco) VALUES(:nome, :nome_apelido, :cpf, :data_nascimento, :telefone, :email, :endereco)")->bind_param(array(
    ":nome" => $nome,
    ":nome_apelido" => $nome_fantasia,
    ":cpf" => $cpf,
    ":data_nascimento" => $data_nsc,
    ":telefone" => $telefone,
    ":email" => $email,
    ":endereco" => $endereco
))->execute();


$contatos_adicionais = $_POST["contatos_adicionais"];

// apenas checando se algum contato adicional foi informado
if (!empty($contatos_adicionais)) {
    // organiza a array recebida pelo form
    $array = array_chunk($contatos_adicionais, 3);

    $qry = $db->do_query("SELECT * FROM dados WHERE cpf=:cpf;")->bind_param(array(
        ":cpf" => $cpf,
    ))->execute();

    $id = "";
    while ($result = $qry->get_result()) $id = $result['primary_key'];

    // loopando entre todos os contatos informados
    foreach ($array as $arr) {

        $nome_contato = $arr[0];
        $telefone_contato = $arr[1];
        $email_contato = $arr[2];
        
        if( // pular inserção ao banco de dados caso algum dos campos estiver vazio
            empty($nome_contato) || 
            empty($telefone_contato) || 
            empty($email_contato) 
        ) continue;

        /* 
            inserindo os dados a tabela de contatos
            optei por esse método por ser mais simples, mas seria possível também utilizar em formato de json sem nem criar outra tabela só para os contatos
            porém seria uma dor de cabeça para formatar tudo isso caso diversos contatos fossem adicionados, mas tudo é possível sempre
        */
        $db->do_query("INSERT INTO contatos(id, nome, telefone, email) VALUES(:id, :nome, :telefone, :email)")->bind_param(array(
            ":id" => $id,
            ":nome" => $nome_contato,
            ":telefone" => $telefone_contato,
            ":email" => $email_contato
        ))->execute();
    }
}

die("sucesso");
