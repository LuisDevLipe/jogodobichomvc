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
        if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Location: /login');
            exit();
        }
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $credentials = $this->getModel('Credential', []);

        try {
            $isAuthenticated = $credentials::authenticate($username, $password);
            if ($isAuthenticated) {
                $this->saveSession('username', $username);
                $this->redirect('/A2f');
            }
        } catch (\Exception $e) {
            $this->sendError($e->getMessage());
        }

    }

    protected function validate(object $credentials, object $credentialsFromDB): bool
    {
        if (empty($credentials->getUsername()) && empty($credentials->getPassword())) {
            return false;
        }


        if (!$credentialsFromDB) { // username wasnt found
            return false;
        }

        return true;

    }

    public function authenticate(object $credentials, object $credentialsFromDB): bool
    {
        if (!password_verify(password: $credentials->getPassword(), hash: $credentialsFromDB->getPassword())) {
            return false;
        }
        return true;

    }
}
