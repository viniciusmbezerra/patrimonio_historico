<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		//rotas da index
		$routes['lib'] = array(
			'route' => '/lib',
			'controller' => 'indexController',
			'action' => 'lib'
		);

		$routes['login'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'login'
		);

		$routes['cadastro'] = array(
			'route' => '/cadastro',
			'controller' => 'appController',
			'action' => 'cadastro'
		);

		$routes['sair'] = array(
            'route' => '/sair',
            'controller' => 'AuthController',
            'action' => 'sair'
        );

		$routes['autenticar'] = array(
            'route' => '/autenticar',
            'controller' => 'AuthController',
            'action' => 'autenticar'
        );

        $routes['cadastrar'] = array(
            'route' => '/cadastrar',
            'controller' => 'appController',
            'action' => 'cadastrar'
        );

		//rotas para patrimonio
		$routes['patrimonio'] = array(
			'route' => '/patrimonio',
			'controller' => 'AppController',
			'action' => 'patrimonio'
		);

		$routes['form_patrimonio'] = array(
			'route' => '/form_patrimonio',
			'controller' => 'AppController',
			'action' => 'form_patrimonio'
		);

		$routes['cadastrar_patrimonio'] = array(
			'route' => '/cadastrar_patrimonio',
			'controller' => 'AppController',
			'action' => 'cadastrar_patrimonio'
		);

		$routes['atualizar_patrimonio'] = array(
			'route' => '/atualizar_patrimonio',
			'controller' => 'AppController',
			'action' => 'atualizar_patrimonio'
		);

		$routes['deletar_patrimonio'] = array(
			'route' => '/deletar_patrimonio',
			'controller' => 'AppController',
			'action' => 'deletar_patrimonio'
		);

		$this->setRoutes($routes);
	}

}

?>