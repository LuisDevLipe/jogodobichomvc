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

        $credentials::authenticate($username, $password);
        die();

        $validation = $this->validate($credentials, $credentialsFromDB);
        $authentication = $this->authenticate($credentials, $credentialsFromDB);

        if (!$validation || !$authentication) {
            $this->view->render(['error' => 'Usuário ou senha inválidos']);
        } else {
            // set username in a cookie using sha256 encryption
            setcookie('user_id', $this->ssl_encrypt($credentialsFromDB->getUserId()), time() + 1200, path: '/', secure: true, httponly: true);
            $this->redirect('/A2f');
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
