<?php
namespace Core;
// use Core;
// use Core\View;

use Core;

class Controller
{

    protected $view;
    public function getModel($model, $constructor = []): object
    {
        return ModelFactory::makeModel($model, $constructor);

    }
    public function getView($view)
    {
        return new View(viewPath: $view);
    }

    public function redirect($where, $replace = 0, $statusCode = 302): never
    {
        header('Location: ' . $where, $replace, $statusCode);
        exit();
    }


    public function sendError($error): never
    {
        $this->view->render(['error' => $error]);
        exit();
    }


    public function ssl_encrypt($data): string
    {
        $key = file_get_contents('../key.txt');
        $data = openssl_encrypt($data, "AES-128-ECB", $key);
        return base64_encode($data);

    }
    public function ssl_decrypt($data): string
    {
        $key = file_get_contents('../key.txt');
        $data = openssl_decrypt(base64_decode($data), "AES-128-ECB", $key);
        return $data;
    }
}
