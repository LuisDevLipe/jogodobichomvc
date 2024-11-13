<?php
namespace App\Controllers;

use Core\Controller;

class Register extends Controller
{
    public function __construct()
    {
        $this->view = $this->getView('Register/index');
    }
    public function index()
    {
        $this->view->render();
    }
    public function new()
    {
        if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Location: /register');
            exit();
        }
        $this->validatePOST(payload: $_POST);

        $Endereco = $this->getModel('Address', ['logradouro' => $_POST['logradouro'], 'numero' => $_POST['numero'], 'complemento' => $_POST['complemento']?? null, 'bairro' => $_POST['bairro'], 'cidade' => $_POST['cidade'], 'estado' => $_POST['estado'], $_POST['pais'], 'cep' => $_POST['cep']]);
        $Endereco = $Endereco->create();
        $Usuario = $this->getModel('User', ['fullname' => $_POST['fullname'],'dob' => $_POST['dob'], 'gender' => $_POST['gender'],'mothername' => $_POST['mothername'], 'email' => $_POST['email'], 'cpf' => $_POST['cpf'],'celular' => $_POST['celular'],'fixo' => $_POST['fixo'], 'endereco_id' => $Endereco->getId()]);
        $Usuario = $Usuario->create();
        $Credenciais = $this->getModel('Credential', ['username' => $_POST['username'], 'password' => $_POST['password'], 'user_id' => $Usuario->getId()]);
        $Credenciais->create($Credenciais);
    }
    public function validatePOST($payload): void
    {
        $isValid = false;
        if (
            !empty($payload['fullname']) ||
            !empty($payload['dob']) ||
            !empty($payload['gender']) ||
            !empty($payload['mothername']) ||
            !empty($payload['email']) ||
            !empty($payload['cpf']) ||
            !empty($payload['celular']) ||
            !empty($payload['fixo']) ||
            !empty($payload['logradouro']) ||
            !empty($payload['numero']) ||
            !empty($payload['bairro']) ||
            !empty($payload['cidade']) ||
            !empty($payload['estado']) ||
            !empty($payload['pais']) ||
            !empty($payload['cep']) ||
            !empty($payload['username']) ||
            !empty($payload['password']) ||
            !empty($payload['confirm_password']) ||
            !empty($payload['termos'])
        ) {
            $isValid = true;
        }
        $this->view->render(['error' => 'Preencha todos os campos']);
        exit();
    }
}