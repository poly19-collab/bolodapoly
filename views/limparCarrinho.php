<?php

require_once("../config.php");
include_once("../classes/Produto.php");
include_once("../classes/Sql.php");
include_once("../classes/Carrinho.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

var_dump($_POST);exit;

$id = htmlspecialchars($_POST['idCliente']);

echo $id; exit;

$car = new Carrinho();
$car->deletarCarrinho($id);

header("Location: http://localhost/bolodapoly/views/sistema.php");

?>