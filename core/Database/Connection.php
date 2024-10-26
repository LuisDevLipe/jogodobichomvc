<?php

namespace Core\Database;
use mysqli;

class Connection extends mysqli
{
    private $host = "localhost";
    private $username = "root"; // Change this to your username if there is any
    private $password = ""; // Change this to your password if there is any
    private $database = "db_jogodobicho";
    public function __construct()
    {
        parent::__construct(
            hostname: $this->host,
            username: $this->username,
            password: $this->password,
            database: $this->database
        );
        if ($this->connect_error) {
            die("Connection failed: " . $this->connect_error);
        }
    }
}
