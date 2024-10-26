<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/core/functions/helpers.php";
use Core\Router\Router;
// Ensure the Core\Router class is correctly autoloaded
session_set_cookie_params(lifetime_or_options: 0, secure: true, httponly: true);
if (!class_exists("Core\Router\Router")) {
    die(
        "Class Core\Router not found. Please check your autoload configuration."
    );
}
$router = new Router();

?>
