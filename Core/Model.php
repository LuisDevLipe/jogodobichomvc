<?php
namespace Core;
use Core\Connection;
use PDO;

interface ModelInterface
{
    public static function show($param): Model;
    public function create(): Model;
}

abstract class Model implements ModelInterface
{
    public function __construct()
    {
    }
    public static function connect(): PDO
    {
        return Connection::getInstance();
    }
}








list('a' => $a, 'b' => $b) = array('a' => 1, 'b' => 2);

// echo $a;
// echo $b;

function listar(array $arr = [fullname, email])
{
    echo $arr['fullname'];
    echo $arr['email'];
}

// listar(['fullname' => 'fulano', 'email' => 'beltrano@google.com']);

