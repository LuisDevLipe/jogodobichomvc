<?php
    namespace Core\Controllers;

    class LoginController
    {
        public function index() {
            require_once __DIR__ . '/../views/login.php';
        }
    }
?>