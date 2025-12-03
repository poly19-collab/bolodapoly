<?php

require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/sql.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

if(isset($_POST["categoria"]) && $_POST["categoria"] == ""){
    echo "É preciso informar a categoria <br/>";
    echo "<a href='http://localhost/bolodapoly/views/categoria.php'>VOLTAR</a>";
    exit;
}

$categoriaCadastro = htmlspecialchars($_POST["categoria"]);    

$categoria = new Categoria();

$categoria->createCategoria($categoriaCadastro);

header("Location: http://localhost/bolodapoly/views/categoria.php");
    

?>