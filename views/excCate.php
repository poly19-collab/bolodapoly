<?php

require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/sql.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}
    $catNome = htmlspecialchars($_POST["myDropdown"]);

    $categoria = new Categoria();

    $deleteCat = $categoria->loadById($catNome);

    $categoria->deleteCategoriaById($deleteCat);

    header("Location: http://localhost/bolodapoly/views/categoria.php");    

?>