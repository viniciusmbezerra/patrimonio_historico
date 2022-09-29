<?php

namespace MF\Controller;

abstract class Action {

	protected $view;

	public function __construct() {
		$this->view = new \stdClass();
	}

	protected function render($view, $layout = 'layout') {
		
		$this->view->page = $view;

		if(file_exists("../App/Views/".$layout.".phtml")) {
			require_once "../App/Views/".$layout.".phtml";
		} else {
			$this->content();
		}
	}

	protected function content() {

		$classAtual = get_class($this);

		$classAtual = str_replace('App\\Controllers\\', '', $classAtual);

		$classAtual = strtolower(str_replace('Controller', '', $classAtual));

		require_once "../App/Views/".$classAtual."/".$this->view->page.".phtml";
	}

	protected function css() {
		$links = array();
		switch ($this->view->page) {
			//casos para adicionar
			case 'cadastro':
				$links[] = "<link rel='stylesheet' href='css/login.css'>";
				break;

			//casos padrão
			default:
				$links[] = "<link rel='stylesheet' href='css/".$this->view->page.".css'>";
		}
		return $links;
	}
}

?>