<?php

class Database {

    public static function connect() {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_error) {
            die("Error conexión: " . $conn->connect_error);
        }

        $conn->set_charset("utf8");

        return $conn;
    }
}