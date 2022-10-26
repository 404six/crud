<?php

require_once "db.php";

if(empty($_GET['id'])) die('id_nao_informado');

// id, também conhecido com primary_key
$id = $_GET['id'];

//  instanciando a class do banco de dados
$db = new db();

$qry = $db->do_query("DELETE FROM contatos WHERE id = :id")->bind_param(array(
    ":id" => $id
))->execute();

if($qry == NULL) die('falha_ao_deletar');

$qry = $db->do_query("DELETE FROM dados WHERE primary_key = :id")->bind_param(array(
    ":id" => $id
))->execute();

if($qry == NULL) die('falha_ao_deletar');

die("sucesso");