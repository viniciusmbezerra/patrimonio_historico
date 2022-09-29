<?php


namespace MF\Model;

abstract class Model {

	protected $transaction;

	public function __construct($transaction) {
		$this->transaction = $transaction;
	}
}


?>