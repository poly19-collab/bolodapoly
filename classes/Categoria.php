<?php

class Categoria{

    private $categoria;
    private $idCategoria;

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($cat){
        $this->categoria = $cat;
    }

    public function getIdCategoria(){
        return $this->idCategoria;
    }

    public function setIdCategoria($id){
        $this->idCategoria = $id;
    }

    public function loadCategorias(){
        $arrayCat = [];

        $sql = new Sql();

        $resultSql = $sql->select("SELECT * FROM categoria");

       for ($i=0; $i < count($resultSql); $i++) { 
            array_push($arrayCat, $resultSql[$i]['nomeCategoria']);
        }

        return $arrayCat;
    }

    public function loadCategoriasEdit($nomeCat){
        $sql = new Sql();

        $resultSql = $sql->select("SELECT * FROM categoria WHERE nomeCategoria = :NOME", [
            ":NOME"=>$nomeCat
        ]);

        $varDados = $resultSql;

        return $varDados;    
    }   

    public function loadByCategoria($nomeCat){
        $sql = new Sql();

        $resultSql = $sql->select("SELECT * FROM categoria WHERE nomeCategoria = :NOME", [
            ":NOME"=>$nomeCat
        ]);

        //Se o retorno do SELECT for maior que zero código dentro do if
        if(count($resultSql) > 0){
            $row = $resultSql[0];  

            $this->setIdCategoria($row['idCategoria']);
        }
    }

    public function loadByCategoriaid($idCategoria){
        $sql = new Sql();

        $resultSql = $sql->select("SELECT nomeCategoria FROM categoria WHERE idCategoria = :ID", [
            ":ID"=>$idCategoria
        ]);

        return $resultSql;
    }

    public function carregaCat($id){
        $sql = new Sql();

        $resultSql = $sql->select("SELECT nomeCategoria FROM categoria WHERE idCategoria = :ID", [
            ":ID"=>$id
        ]);

        return $resultSql[0]['nomeCategoria'];
    }

    public function loadById($nomeCat){
        $sql = new Sql();

        $resultSql = $sql->select("SELECT * FROM categoria WHERE nomeCategoria = :NOME", [
            ":NOME"=>$nomeCat
        ]);

        $varId = $resultSql[0]["idCategoria"];

        return $varId;
        //Se o retorno do SELECT for maior que zero código dentro do if
        /*if(count($resultSql) > 0){
            $row = $resultSql[0];  

            $this->setIdCategoria($row['idCategoria']);
        }*/
    }

    public function createCategoria($nomeCategoria){
        $sql = new Sql();

        $sql->execQuery("INSERT INTO categoria (nomeCategoria) VALUES(:NOME)", [
            ":NOME"=>$nomeCategoria
        ]);
    }

    public function deleteCategoriaById($id){
        $sql = new Sql();

        $sql->execQuery("DELETE FROM categoria WHERE idCategoria = :ID", [
            ":ID"=>$id
        ]);
    }

    public function atualizarCategoria($id, $categoria){
        $sql = new Sql();

        $sql->execQuery("UPDATE categoria SET nomeCategoria = :NOME WHERE idCategoria = :ID", [
            ":NOME"=>$categoria,
            ":ID"=>$id
        ]);
    }

}