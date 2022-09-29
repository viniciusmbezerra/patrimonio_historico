<?php

namespace App\Models;

use MF\Model\Model;

class Patrimonio extends Model {
    private $idpatrimonio;
    private $nome;
    private $descricao;
    private $localizacao;
    private $imagem;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function salvar() {
        $query = "
                insert into 
                    patrimonio(nome, descricao, localizacao, imagem, fk_idusuario) 
                values(:nome, :descricao, :localizacao, :imagem, :fk_idusuario)
                ";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':localizacao', $this->__get('localizacao'));
        $stmt->bindValue(':imagem', $this->__get('imagem'));
        $stmt->bindValue(':fk_idusuario', $_SESSION['idusuario']);
        $stmt->execute();

        return $this;
    }

    public function atualizar() {
        $query = "
                update 
                    patrimonio 
                set 
                    nome = :nome,
                    descricao = :descricao,
                    localizacao = :localizacao,
                    imagem = :imagem
                where 
                    idpatrimonio = :idpatrimonio
                ";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':idpatrimonio', $this->__get('idpatrimonio'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':localizacao', $this->__get('localizacao'));
        $stmt->bindValue(':imagem', $this->__get('imagem'));
        $stmt->execute();
    }

    public function deletar() {
        $query = "
                delete from 
                    patrimonio 
                where 
                    idpatrimonio = :idpatrimonio and 
                    fk_idusuario = :fk_idusuario
                    ";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':idpatrimonio', $this->__get('idpatrimonio'));
        $stmt->bindValue(':fk_idusuario', $_SESSION['idusuario']);
        $stmt->execute();
    }

    public function validarCadastro() {
        $valido = true;
        if(strlen($this->__get('nome'))<3) {
            $valido = false;
        }

        return $valido;
    }

    public function getPatrimonioPorNome() {
        $query = "
                select 
                    nome 
                from 
                    patrimonio 
                where 
                    nome = :nome
                ";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $query = "select * from patrimonio";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getInfoPatrimonio() {
        $query = "select * from patrimonio where idpatrimonio = :idpatrimonio";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':idpatrimonio', $this->__get('idpatrimonio'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function pesquisarPatrimonio() {
        $query = "
                select 
                    * 
                from 
                    patrimonio
                where
                    nome like :nome
                ";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':nome', '%'.$this->__get('nome').'%');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}

?>