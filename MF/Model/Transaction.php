<?php

namespace MF\Model;

use MF\Model\Connection;

class Transaction {

    private static $conn;

    public function __construct() {}

    public function open($database) {
        self::$conn = Connection::open($database);
        self::$conn->beginTransaction();
    }

    public function close() {
        if (self::$conn) {
            self::$conn->commit();
            self::$conn = null;
        }
    }

    public function get() {
        return self::$conn;
    }

    public function rollback() {
        if (self::$conn) {
            self::$conn->rollback();
            self::$conn = null;
        }
    }
}