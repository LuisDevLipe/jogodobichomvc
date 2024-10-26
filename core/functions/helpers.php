<?php
function dd($dump): never
{
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
    die();
}
function redirect($url, $code)
{
    http_response_code($code);
    header("Location: $url");
    die();
}
function save_on_session($key, $value)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION[$key] = $value;
    session_commit();
}
function get_from_session($key)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $value = $_SESSION[$key] ?? null;
    session_commit();
    return $value;
}

?>