<?php
namespace App\Controllers;

use Core\Controller;
use App\Exceptions\UserAlreadyExistsException;
class Register extends Controller
{
    public function __construct()
    {
        $this->view = $this->getView("Register/index");
    }
    public function index()
    {
        $this->view->render();
    }
    public function new()
    {
        if (!$_SERVER["REQUEST_METHOD"] === "POST") {
            header("Location: /register");
            exit();
        }
        $this->validatePOST(payload: $_POST);

        try {

            $Endereco = $this->getModel("Address", [
                "street" => $_POST["logradouro"],
                "number" => $_POST["numero"],
                "complement" => $_POST["complemento"] ?? null,
                "neighborhood" => $_POST["bairro"],
                "city" => $_POST["cidade"],
                "state" => $_POST["estado"],
                "country" => $_POST["pais"],
                "cep" => $_POST["cep"],
            ]);
            $Endereco = $Endereco->create();
            $Usuario = $this->getModel("User", [
                "fullname" => $_POST["name"],
                "dob" => $_POST["dob"],
                "gender" => $_POST["gender"],
                "mothername" => $_POST["filiation-name"],
                "email" => $_POST["email"],
                "cpf" => $_POST["cpf"],
                "celular" => $_POST["celular"],
                "fixo" => $_POST["fixo"],
                "endereco_id" => $Endereco->getId(),
            ]);
            $Usuario = $Usuario->create();
            $Credenciais = $this->getModel("Credential", [
                "username" => $_POST["username"],
                "password" => $_POST["password"],
                "user_id" => $Usuario->getId(),
            ]);
            $Credenciais->create();

            $this->redirect("/Login");

        } catch (\Exception $e) {
            $this->view->render(["error" => $e->getMessage()]);
            exit();
        }
    }
    public function validatePOST($payload): void
    {
        $isValid = false;
        if (
            !empty($payload["fullname"]) ||
            !empty($payload["dob"]) ||
            !empty($payload["gender"]) ||
            !empty($payload["mothername"]) ||
            !empty($payload["email"]) ||
            !empty($payload["cpf"]) ||
            !empty($payload["celular"]) ||
            !empty($payload["fixo"]) ||
            !empty($payload["logradouro"]) ||
            !empty($payload["numero"]) ||
            !empty($payload["bairro"]) ||
            !empty($payload["cidade"]) ||
            !empty($payload["estado"]) ||
            !empty($payload["pais"]) ||
            !empty($payload["cep"]) ||
            !empty($payload["username"]) ||
            !empty($payload["password"]) ||
            !empty($payload["confirm_password"]) ||
            !empty($payload["termos"])
        ) {
            $isValid = true;
        }
        if ($isValid) {
            return;
        } else {

            $this->view->render(["error" => "Preencha todos os campos"]);
            exit();
        }
    }
}
