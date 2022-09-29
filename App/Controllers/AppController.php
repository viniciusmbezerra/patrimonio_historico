<?php

namespace App\Controllers;

//recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
    
    public static function validaAutenticacao() {
    
        session_start();
    
        if(!isset($_SESSION['idusuario']) || $_SESSION['idusuario'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == ''){
            header('Location: /?login=erro');
        }
    }

    public function cadastro() {

        $this->view->erroCadastro = false;
        
        $this->validaAutenticacao();

        $this->render('cadastro', 'layout_index');
    }
    public function cadastrar() {

        $usuario = Container::getModel('Usuario');

        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', $_POST['senha']);
        $usuario->__set('admin', $_POST['admin']);

        if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {
            $usuario->salvar();
            $usuario->transaction->close();

            header('Location: /cadastro');
        } else {

            $this->view->erroCadastro = true;

            $usuario->transaction->close();

            header('Location: /cadastro');
        }
    }

    public function patrimonio() {

        $this->validaAutenticacao();

        try {

            $patrimonio = Container::getModel('Patrimonio');
            if(isset($_GET['pesquisa'])){
                $patrimonio->__set('nome', $_GET['pesquisa']);
                $this->view->patrimonios = $patrimonio->pesquisarPatrimonio();
                $this->view->pesquisa = $_GET['pesquisa'];
            }else{
                $this->view->patrimonios = $patrimonio->getAll();
                $this->view->pesquisa = '';
            }
            $patrimonio->transaction->close();
            
            $usuario = Container::getModel('Usuario');
            $i=0;
            foreach($this->view->patrimonios as $patrimonio){
                $usuario->__set('idusuario', $patrimonio['fk_idusuario']);
                $info = $usuario->getInfoUsuario();
                $this->view->patrimonios[$i]['fk_idusuario'] = $info['nome'];
                $i++;
            }
            $usuario->transaction->close();

            $this->render('patrimonio', 'layout_app');
        }
        catch(\Exception $e) {

            $patrimonio->transaction->rollback();
            print $e->getMessage();
        }

    }

    public function form_patrimonio() {

        $this->validaAutenticacao();

        if($_GET['acao']=='criar') {

            $this->view->infoPatrimonio = array(
                'idpatrimonio' => '',
                'nome' => '',
                'descricao' => '',
                'localizacao' => '',
                'imagem' => ''
            );
            $this->view->acao = "cadastrar";

        } elseif($_GET['acao']=='editar') {

            try {
                
                $patrimonio = Container::getModel('Patrimonio');

                $patrimonio->__set('idpatrimonio', $_GET['idpatrimonio']);

                $result = $patrimonio->getInfoPatrimonio();
                $patrimonio->transaction->close();

                $this->view->infoPatrimonio = array(
                    'idpatrimonio' => $result['idpatrimonio'],
                    'nome' => $result['nome'],
                    'descricao' => $result['descricao'],
                    'localizacao' => $result['localizacao'],
                    'imagem' => $result['imagem']
                );
                $this->view->acao = "atualizar";
                $this->view->erroCadastro = false;
            }
            catch(\Exception $e) {
                $patrimonio->transaction->rollback();
                print $e->getMessage();
            }
        }

        $this->render('form_patrimonio', 'layout_app');
    }

    public function cadastrar_patrimonio() {

        $this->validaAutenticacao();
        try {
                
            $patrimonio = Container::getModel('Patrimonio');

            $patrimonio->__set('nome', $_POST['nome']);
            $patrimonio->__set('descricao', $_POST['descricao']);
            $patrimonio->__set('localizacao', $_POST['localizacao']);
    
            //recebe a imagem e guarda na pasta indicada
            move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/patrimonio/imagem/'.$_FILES['imagem']['name']);
            //pega o nome da imagem e preenche o atributo da classe
            $patrimonio->__set('imagem', 'uploads/patrimonio/imagem/'.$_FILES['imagem']['name']);

            if($patrimonio->validarCadastro() && count($patrimonio->getPatrimonioPorNome()) == 0) {

                $patrimonio->salvar();
                $patrimonio->transaction->close();

                header('Location: /patrimonio');
            } else {
    
                $this->view->patrimonio = array(
                    'nome' => $_POST['nome'],
                    'descricao' => $_POST['descricao'],
                    'localizacao' => $_POST['localizacao']
                );
    
                $this->view->erroCadastro = true;
                $patrimonio->transaction->close();

                header('Location: /patrimonio');
            }
        }
        catch(\Exception $e) {
            $patrimonio->transaction->rollback();
            print $e->getMessage();
        }
    }

    public function atualizar_patrimonio() {

        $this->validaAutenticacao();
        try {
            $patrimonio = Container::getModel('patrimonio');

            $patrimonio->__set('idpatrimonio', $_POST['idpatrimonio']);
            $patrimonio->__set('nome', $_POST['nome']);
            $patrimonio->__set('descricao', $_POST['descricao']);
            $patrimonio->__set('localizacao', $_POST['localizacao']);

            $patrimonio_imagem = $patrimonio->getInfoPatrimonio();

            if($_FILES['imagem']['tmp_name'] != '') {

                unlink($patrimonio_imagem['imagem']);

                move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/patrimonio/imagem/'.$_FILES['imagem']['name']);

                $patrimonio->__set('imagem', 'uploads/patrimonio/imagem/'.$_FILES['imagem']['name']);
            } else {
                $patrimonio->__set('imagem', $patrimonio_imagem['imagem']);
            }

            $patrimonio->atualizar();
            $patrimonio->transaction->close();

            header('Location: /patrimonio');
        }
        catch(\Exception $e) {
            $patrimonio->transaction->rollback();
            print $e->getMessage();
        }
    }

    public function deletar_patrimonio() {

        $this->validaAutenticacao();

        try {
    
            $patrimonio = Container::getModel('Patrimonio');

            $patrimonio->__set('idpatrimonio', $_GET['idpatrimonio']);
            
            $patrimonio_imagem = $patrimonio->getInfoPatrimonio();
            unlink($patrimonio_imagem['imagem']);

            $patrimonio->deletar();
            $patrimonio->transaction->close();
    
            header('Location: /patrimonio');
        }
        catch(\Exception $e) {
            $patrimonio->transaction->rollback();
            print $e->getMessage();
        }
    }
}

?>