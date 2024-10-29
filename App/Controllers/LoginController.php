<?php
namespace App\Controllers;
use App\Models\Credentials;
class LoginController
{
    public function index()
    {
        require_once __DIR__ . "/../components/navbar.php";
        require_once __DIR__ . "/../Views/login.php";
    }

    public function auth(): never
    {
        if (
            $_SERVER["REQUEST_METHOD"] !== "POST" ||
            !isset($_POST["username"]) ||
            !isset($_POST["password"])
        ) {
            redirect(url: "/login?", code: 401);
        }
        $username = $_POST["username"];
        $password = $_POST["password"];
        if ($username == "" || $password == "") {
            redirect(url: "/login?error", code: 401);
        }
        $credentials = Credentials::login(username: $username, password: $password);
        if ($credentials) {
            save_on_session(key: "username", value: $credentials["username"]);
            session_regenerate_id(delete_old_session: true);
            redirect(url: "/", code: 200);
        }
        redirect(url: "/login?error", code: 401);
    }
}
?>