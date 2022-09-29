<?php

namespace MF\Model;

use MF\Model\Transaction;

class Container {

	public static function getModel($model) {
		$class = "\\App\\Models\\".ucfirst($model);
		$transaction = new Transaction;
		$transaction->open('patrimonio_historico');

		return new $class($transaction);
	}
}


?>