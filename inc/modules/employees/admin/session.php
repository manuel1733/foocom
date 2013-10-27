<?php

session_start();

if (empty($_SESSION['auth'])) {
    $request->rest('employees-login');
}

class Change extends Database{
    private static $instance = null;
    private static $id = null;

    public static function initialize() {
        if (self::$instance == null) {
            self::$instance = new Change();
        }
        if (empty($_SESSION['auth']['id'])) {
            self::$id = 1;
        } else {
            self::$id = $_SESSION['auth']['id'];
        }
    }

    public static function log($message) {
        self::$instance->run("INSERT INTO changes VALUES (now(), ?, ?)", array(self::$id, $message));
    }
}

Change::initialize();
