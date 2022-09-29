<?php

namespace App\Models;

//recursos do miniframework
use MF\Model\Container;

use MF\Model\Model;

class Usuario extends Model {
    private $idusuario;
    private $nome;
    private $email;
    private $senha;
    private $admin;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function salvar() {
        $query = "insert into usuario(nome, email, senha, admin) values(:nome, :email, :senha, :admin)";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', md5($this->__get('senha')));
        $stmt->bindValue(':admin', $this->__get('admin'));
        $stmt->execute();

        return $this;
    }

    //validar se um cadastro pode ser feito
    public function validarCadastro() {
        $valido = true;
        if(strlen($this->__get('nome'))<3) {
            $valido = false;
        }

        if(strlen($this->__get('email'))<3) {
            $valido = false;
        }

        if(strlen($this->__get('senha'))<3) {
            $valido = false;
        }

        return $valido;
    }

    public function getUsuarioPorEmail() {
        $query = "select * from usuario where email = :email";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function autenticar() {
        $query = "select * from usuario where email = :email and senha = :senha";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($usuario['idusuario'] != '' && $usuario['nome'] != ''){
            $this->__set('idusuario', $usuario['idusuario']);
            $this->__set('nome', $usuario['nome']);
            $this->__set('admin', $usuario['admin']);
        }

        return $this;
    }

    public function getInfoUsuario() {
        $query = "select * from usuario where idusuario = :id_usuario";
        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('idusuario'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $query = "
            select 
                u.id,
                u.nome,
                u.email,
                (
                    select
                        count(*)
                    from
                        usuarios_seguidores as us
                    where
                        us.id_usuario = :id_usuario and us.id_usuario_seguindo = u.id
                ) as seguindo_sn
            from 
                usuarios as u
            where 
                u.nome like :nome and u.id != :id_usuario";

        $stmt = $this->transaction->get()->prepare($query);
        $stmt->bindValue(':nome', '%'.$this->__get('nome').'%');
        $stmt->bindValue(':id_usuario', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}

?>