<?php

require_once("config.php");

/*$sql = new Sql();
$usuario = $sql->select("select * from usuarios");

echo json_encode($usuario);*/

$user = new Usuario();
$user->loadById(1);
echo $user;
?>