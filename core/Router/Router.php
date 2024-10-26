<?php
namespace Core\Router;

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
        $this->routes = [
            "/" => [
                "controller" => "HomeController",
                "method" => "index",
            ],
            "/login" => [
                "controller" => "LoginController",
                "method" => "index",
            ],
            "/login/auth" => [
                "controller" => "LoginController",
                "method" => "auth",
            ],
        ];
    }

    private function dispatch()
    {
        // dd("dispatching...");
        $uri = parse_url($_SERVER["REQUEST_URI"]);
        $path = $uri['path'] == '/' ? '/' : rtrim($uri["path"], "/");
        $route = $this->routes[$path];
        $controllerName = "Core\\Controllers\\" . $route["controller"];
        $controller = new $controllerName();
        $controller->{$route["method"]}();
    }
}
?>