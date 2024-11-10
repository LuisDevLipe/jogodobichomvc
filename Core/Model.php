<?php
namespace Core;
use Core\Connection;

interface ModelInterface
{
    public static function show(): Model;
}

abstract class Model implements ModelInterface
{
    protected $connection;
    public function __construct()
    {
        $this->connection = Connection::getInstance();
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

