<?php
require_once("config.php");

$usuario = htmlspecialchars($_POST["usuario"]);
$senha = htmlspecialchars($_POST["senha"]);

$usu = new Usuario();

$usu->login($usuario, $senha);

?>