<?php

namespace App\Controllers;

//recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {

    public function autenticar() {

        try {
            
            $usuario = Container::getModel('Usuario');

            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', md5($_POST['senha']));

            $usuario = $usuario->autenticar();
            $usuario->transaction->close();
            
            if($usuario->__get('idusuario') != '' && $usuario->__get('nome') != ''){
                session_start();

                $_SESSION['idusuario'] = $usuario->__get('idusuario');
                $_SESSION['nome'] = $usuario->__get('nome');
                $_SESSION['admin'] = $usuario->__get('admin');

                header('Location: /patrimonio');
            } else {

                header('Location: /?login=erro');
            }
        }
        catch(\Exception $e) {
            $usuario->transaction->rollback();
            print $e->getMessage();
        }
    }

    public function sair() {
        session_start();
        session_destroy();
        header('Location: /login');
    }
}