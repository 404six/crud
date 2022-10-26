<?php

require_once "db.php";

if (empty($_GET['id']) || !isset($_GET['coluna'])) die('Id não informado!');

if (empty($_GET['novo_valor'])) die('Valor não informado!');


$id = $_GET['id'];
$coluna = $_GET['coluna'];
$valor = $_GET['novo_valor'];

//  instanciando a class do banco de dados
$db = new db();

switch ($coluna) {
    case 0: // nome
        $qry_apelido = $db->do_query("SELECT * FROM dados WHERE primary_key=:id AND nome_apelido!=''")->bind_param(array(
            ":id" => $id
        ))->execute();
    
        // checa se a conta tem um apelido e caso tenha, o apelido será alterado ao inves do nome
        if($qry_apelido->get_row_count() > 0)
            $qry = $db->do_query("UPDATE dados SET nome_apelido=:valor WHERE primary_key = :id")->bind_param(array(":valor" => $valor, ":id" => $id))->execute();
        else
            $qry = $db->do_query("UPDATE dados SET nome=:valor WHERE primary_key = :id")->bind_param(array(":valor" => $valor, ":id" => $id))->execute();


        break;
    case 1: // telefone
        $qry = $db->do_query("UPDATE dados SET telefone=:valor WHERE primary_key = :id")->bind_param(array(":valor" => $valor, ":id" => $id))->execute();
        break;
    case 2: // email
        $qry = $db->do_query("UPDATE dados SET email=:valor WHERE primary_key = :id")->bind_param(array(":valor" => $valor, ":id" => $id))->execute();
        break;
}

if ($qry == NULL) die('falha_ao_editar');

die("sucesso");
