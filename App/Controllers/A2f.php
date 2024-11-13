<?php
namespace App\Controllers;
use Core\Controller;
class A2f extends Controller
{
    public function __construct()
    {
        if (!isset($_SERVER['HTTP_REFERER'])) {
            $this->redirect('/Login', 0);
        }

        $this->view = $this->getView('A2f/index');
    }
    public function index($params = [])
    {
        $this->view->render('A2f/index');
    }

    public function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/A2f');
        }

        $token = $_POST['token'] ?? '';
        $tokenType = $_POST['tokenType'] ?? '';
        if (empty($token) || empty($tokenType)) {
            $this->sendError('Token inválido');
        }

        echo 'Token: ' . $token . ' Tipo: ' . $tokenType;

        // get username from cookie and unset it
        $user_id = $_COOKIE['user_id'] ?? '';
        echo 'User id: ' . $user_id;
        if (empty($user_id)) {
            $this->sendError('Usuário não encontrado');
        }
        setcookie('user_id', '', time() - 3600, path: '/', secure: true, httponly: true);
        $user_id = $this->ssl_decrypt($user_id);

        // get user from db

        $user = $this->getModel('User')::findById($user_id);

        dd($user);


    }



}