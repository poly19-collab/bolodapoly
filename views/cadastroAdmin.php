<?php

require_once("../config.php");
include_once("../classes/Sql.php");
include_once("../classes/Usuario.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifique se o campo 'nome' foi enviado e não está vazio
        if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
            // Pegue os dados do formulário
            $nome = $_POST['usuario'];

        }else{
            echo "Por favor, preencha o campo nome.";
            exit;
        }

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verifique se o campo 'senha' foi enviado e não está vazio
            if (isset($_POST['senha']) && !empty($_POST['senha'])) {
            // Pegue os dados do formulário
            $senha = $_POST['senha'];
        }else {
            echo "Por favor, preencha o campo nome.";
            exit;
        }
    }
}

$admin = 1;

$usuario = new Usuario();
$usuario->setUsuario($nome);
$usuario->setSenha($senha);
$usuario->setAdmin($admin);

$usuCad = $usuario->getUsuario();
$novaSenha = $usuario->getSenha();
$novoAdmin = $usuario->getAdmin();

$usuario->createUsuario($usuCad, $novaSenha, $novoAdmin);

header("Location: http://localhost/bolodapoly/");