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

    public function sendSuccess($success): never
    {
        exit();
    }

    public function saveSession($key, $value): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$key] = $value;

        session_commit();
    }
    public function getFromSession($key)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $value = $_SESSION[$key] ?? null;
        session_commit();
        return $value;
    }
}
