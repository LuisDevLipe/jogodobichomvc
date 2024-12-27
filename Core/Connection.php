<?php
namespace Core;
use \PDO;

class Connection
{
    private static $host = "mariadb";
    private static $port = "3306";
    private static $user = "root";
    private static $password = "";
    private static $database = "db_jogodobicho";

    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): PDO
    {
        $dsn =
            "mysql:host=" .
            self::$host .
            ";port=" .
            self::$port .
            ";dbname=" .
            self::$database;
        if (!self::$instance) {
            self::$instance = new PDO(
                dsn: $dsn,
                username: self::$user,
                password: self::$password
            );
        }
        return self::$instance;
    }
}
