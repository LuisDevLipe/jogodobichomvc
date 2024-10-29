<?php
namespace App\Controllers;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . "/../components/navbar.php";
        require_once __DIR__ . "/../Views/home.php";
        var_dump(get_from_session(key: "username"));
    }
}
