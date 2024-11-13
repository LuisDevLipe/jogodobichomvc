<?php
namespace App\Controllers;
use Core\Controller;

class Home extends Controller
{
    public function __construct()
    {
        $this->view = $this->getView('Home/index');
    }
    public function index($params = [])
    {
        $this->view->render();
    }
    public function test()
    {
        echo 'Home/test';
    }
}
