<?php

require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/sql.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$valueId = htmlspecialchars($_POST["idCategoriaEdit"]);
$valueName = htmlspecialchars($_POST['nomeCategoria']);

$upCategoria = new Categoria();
$upCategoria->atualizarCategoria($valueId, $valueName);

header("Location: http://localhost/bolodapoly/views/categoria.php");    

?>