<?php
namespace App\Controllers;

class RegisterController
{
    public function index()
    {
        require_once __DIR__ . "/../components/navbar.php";
        require_once __DIR__ . '/../views/register.php';
    }
    public function create()
    {
        echo "Creating user...";
    }
}