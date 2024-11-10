<?php
namespace App\Controllers;
use Core\Controller;
class Login extends Controller
{
    public function __construct()
    {
        $this->view = $this->getView('Login/index');
    }
    public function index($params = [])
    {
        $this->view->render();
    }

    public function auth()
    {
        echo 'tryning to auth';
        if ($_POST['username'] == 'luis')
            header('Location: /A2f/index');
    }
}
