<?php

require_once("config.php");

/*$sql = new Sql();
$usuario = $sql->select("select * from usuarios");
echo json_encode($usuario);*/

//Carrega apenas um usuário
//$user = new Usuario();
//$user->loadById(1);
//echo $user;

//Carrega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carrega uma lista de usuários buscando por login
//$search = Usuario::search("ia");
//echo json_encode($search);

//Carrega um usuário usando o login e a senha
$usuario = new Usuario();
$usuario->login("Alexander","12345678901");
echo $usuario;
?>