<?php
namespace Core\Router;
use Core\Router\Routes;

class Router
{
    private $routes;
    public function __construct()
    {
        $this->loadRoutes();
        $this->dispatch();
    }

    private function loadRoutes()
    {
        $this->routes = Routes::getRoutes();
        
    }

    private function dispatch()
    {
        // dd("dispatching...");
        $uri = parse_url($_SERVER["REQUEST_URI"]);
        $path = $uri['path'] == '/' ? '/' : rtrim($uri["path"], "/");
        $route = $this->routes[$path];
        $controllerName = "App\\Controllers\\" . $route["controller"];
        $controller = new $controllerName();
        $controller->{$route["method"]}();
    }
}
?>