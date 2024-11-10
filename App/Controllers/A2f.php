<?php
namespace App\Controllers;
use Core\Controller;
class A2f extends Controller
{
    public function __construct()
    {
        $this->view = $this->getView('A2f/index');
    }
    public function index($params = [])
    {
        $this->view->render('A2f/index');
    }

    public function auth()
    {
        echo 'tryning to auth a2f';
        // header('Location: /Login/a2f');
    }
}