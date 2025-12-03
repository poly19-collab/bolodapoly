<?php

class Usuario{

    private $idUsuario;
    private $usuario;
    private $senha;
    private $admin;

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function setIdUsuario($id){
        $this->idUsuario = $id;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function setUsuario($us){
        $this->usuario = $us;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($ps){

        $ns = password_hash($ps, PASSWORD_DEFAULT);

        $this->senha = $ns;        
    }

    public function getAdmin(){
        return $this->admin;
    }

    public function setAdmin($value){
        $this->admin = $value;
    }

    public function login($usuario, $senha){
        $sql = new Sql();

        $res = $sql->select("SELECT idUsuario, usuario, senha, admin FROM usuarios WHERE usuario = :LOGIN", [
            ":LOGIN"=>$usuario
        ]);       
        

        if(count($res) === 0){
            echo "Usuário ou senha inválidos!";            
        }else{
            //COMPARA SENHA INFORMADA COM O HASH NO BANCO DE DADOS
            if(password_verify($senha, $res[0]["senha"])){

                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['idUsuario'] = $res[0]["idUsuario"];                

                /*$administrador = $res[0]["admin"];

                if($administrador == 1){
                    header("Location: http://localhost/bolodapoly/views/sistema.php");
                }else if($administrador == 0){
                    header("Location: http://localhost/bolodapoly/views/loja.php");
                }*/
                header("Location: http://localhost/bolodapoly/views/sistema.php");
            }else{
                echo "Usuário ou senha inválidos!";
            }
        }
    }

    public function createUsuario($usuario, $senha, $admin){
        $sql = new Sql();

        $sql->execQuery("INSERT INTO usuarios (usuario, senha, admin) VALUES(:NOME, :SENHA, :ADMIN)", [
            ":NOME"=>$usuario,
            ":SENHA"=>$senha,
            ":ADMIN"=>$admin
        ]);
    }

    public function carregarUsuario($id){
        $sql = new Sql();

        $resultSql = $sql->select("SELECT usuario FROM usuarios WHERE idUsuario = :ID", [
            ":ID"=>$id
        ]);

        return $resultSql;
    }

    public function carregarIsAdmin($id){
        $sql = new Sql();

        $resultSql = $sql->select("SELECT admin FROM usuarios WHERE idUsuario = :ID", [
            ":ID"=>$id
        ]);

        return $resultSql;
    }
}