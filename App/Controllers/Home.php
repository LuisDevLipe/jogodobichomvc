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
        $user = $this->getModel('User', ['fullname' => 'Luis', 'email' => 'luis@google.com']);
        echo $user->getFullname();
        echo $user->getEmail();
        $this->view->render();
    }
    public function test()
    {
        echo 'Home/test';
    }
}
