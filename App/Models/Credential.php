<?php
namespace App\Models;
use Core\Model;
class Credential extends Model
{
    private string $username;
    private string $password;
    private bool $is_admin;

    private int $login_attempts;
    private bool $is_account_locked;
    private int $user_id;
    private $updated_at;

    public bool $userNotFound = false;


    public function __construct(array $constructor = [username, password, user_id])
    {
        if (!empty($constructor)) {
            $this->setUsername($constructor['username']);
            $this->setPassword($constructor['password']);
            $this->setUserId($constructor['user_id']);
        } else {
            $this->userNotFound = true;
        }
    }

    public function create(): Credential
    {
        $db_con = self::connect();
        $stmt = $db_con->prepare('INSERT INTO credenciais (nomeUsuario, senha, usuario_id) VALUES (:username, :password, :user_id)');
        $result = $stmt->execute([
            'username' => $Credential->getUsername(),
            'password' => $Credential->getPassword(),
            'user_id' => $Credential->getUserId()
        ]);
        return $result;
    }
    public static function show($username): Credential
    {
        $db_con = self::connect();
        $stmt = $db_con->prepare('SELECT * FROM credenciais WHERE nomeUsuario = :username');
        $stmt->execute(['username' => 'admin']);
        $result = $stmt->fetch();
        if (!$result) {
            return new Credential([]);
        }
        return new Credential([
            'username' => $result['nomeUsuario'],
            'password' => $result['senha'],
            'is_admin' => $result['administrador'],
            'login_attempts' => $result['tentativasLogin'],
            'is_account_locked' => $result['contaTravada'],
            'user_id' => $result['usuario_id'],
            'updated_at' => $result['updated_at']
        ]);
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    // getters and setters
    public function getIsAdmin(): bool
    {
        return $this->is_admin;
    }
    public function getLoginAttempts(): int
    {
        return $this->login_attempts;
    }
    public function getIsAccountLocked(): bool
    {
        return $this->is_account_locked;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }
    public function getUserNotFound(): bool
    {
        return $this->userNotFound;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setIsAdmin(bool $is_admin): void
    {
        $this->is_admin = $is_admin;
    }
    public function setLoginAttempts(int $login_attempts): void
    {
        $this->login_attempts = $login_attempts;
    }
    public function setIsAccountLocked(bool $is_account_locked): void
    {
        $this->is_account_locked = $is_account_locked;
    }
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
    public function setUserNotFound(bool $userNotFound): void
    {
        $this->userNotFound = $userNotFound;
    }


}