<?php
namespace Core\Router;

class Routes
{
    public static function getRoutes()
    {
        $routes = [
            '/' => [
                'controller' => 'HomeController',
                'method' => 'index'
            ],
            '/login' => [
                'controller' => 'LoginController',
                'method' => 'index'
            ],
            '/login/new' => [
                'controller' => 'LoginController',
                'method' => 'auth'
            ],
            '/register' => [
                'controller' => 'RegisterController',
                'method' => 'index'
            ],
            '/register/new' => [
                'controller' => 'RegisterController',
                'method' => 'create'
            ]
        ];
        return $routes;
    }
}
