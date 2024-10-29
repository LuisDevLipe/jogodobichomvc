<?php
namespace App\Models;
use Core\Database\Connection;
class Credentials
{
    private string $username;
    private string $password;
    private int $user_id;
    private int $login_attempts;
    private int $lockAccount;
    private int $rootuser;
    private string $updated_at; // timestamp

    private static $connection;

    public function __construct(
        $username,
        $password,
        $user_id,
        $login_attempts,
        $lockAccount,
        $rootuser,
        $updated_at
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->user_id = $user_id;
        $this->login_attempts = $login_attempts;
        $this->lockAccount = $lockAccount;
        $this->rootuser = $rootuser;
        $this->updated_at = $updated_at;

    }

    public static function login($username, $password)
    {
        self::$connection = new Connection();

        $sql = "SELECT * FROM credentials WHERE username = ?";
        $stmt = self::$connection->execute_query(
            query: $sql,
            params: [$username]
        );
        if ($stmt->num_rows == 0) {
            return false;
        }
        $user = $stmt->fetch_assoc();
        if (!password_verify($password, $user["password"])) {
            return false;
        } else {
            return $user;
        }
    }
}
?>