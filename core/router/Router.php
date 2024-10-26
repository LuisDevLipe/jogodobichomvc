<?php
    namespace Core\Router;

    class Router
    {
        private $routes;
        public function __construct() {
            $this->loadRoutes();
            $this->dispatch();
        }

        private function loadRoutes() {
            $this->routes = [
                '/' => [
                    'controller' => 'HomeController',
                    'method' => 'index'
                ],
                '/login' => [
                    'controller' => 'LoginController',
                    'method' => 'index'
                ]
            ];
        }

        private function dispatch() {
            $uri = $_SERVER['REQUEST_URI'];
            $route = $this->routes[$uri];
            $controllerName = 'Core\\Controllers\\' . $route['controller'];
            $controller = new $controllerName();
            $controller->{$route['method']}();
        }
    }
?>
