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
}
