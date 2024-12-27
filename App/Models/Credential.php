<?php
namespace App\Models;
use Core\Model;
use App\Exceptions\UnableToPersistDataException;
use App\Exceptions\UsernameNotFoundException;

class Credential extends Model
{
    private string $username;
    private string $password;
    private bool $is_admin;

    private int $login_attempts;
    private bool $is_account_locked;
    private int $user_id;
    private $updated_at;

    public bool $usernameNotFound = false;

    public function __construct(
        array $constructor = [username, password, user_id]
    ) {
        if (!empty($constructor)) {
            $this->setUsername($constructor["username"]);
            $this->setPassword($constructor["password"]);
            $this->setUserId($constructor["user_id"]);
        }
        //  else {
        //     $this->usernameNotFound = true;
        // }
    }

    public function create(): Credential
    {
        if ($this->username_exists()) {
            return $this;
        }
        $db_con = self::connect();
        $stmt = $db_con->prepare(
            "INSERT INTO credenciais (nomeUsuario, senha, usuario_id) VALUES (:username, :password, :user_id)"
        );
        $result = $stmt->execute([
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
            "user_id" => $this->getUserId(),
        ]);
        $result = $stmt->fetch();
        if (!$result) {
            throw new UnableToPersistDataException('Something went wrong when getting your credentials stored');
        }
        $this->setUsername($result["nomeUsuario"]);
        $this->setPassword($result["senha"]);
        $this->setUserId($result["usuario_id"]);
        $this->setIsAdmin($result["administrador"]);
        $this->setLoginAttempts($result["tentativasLogin"]);
        $this->setIsAccountLocked($result["contaTravada"]);
        $this->setUpdatedAt(
            new \DateTime($result['updated_at'], new \DateTimeZone("America/Sao_Paulo"))
        );
        return $this;
    }
    public static function authenticate($username, $password)
    {
        $db_con = self::connect();
        $stmt = $db_con->prepare("SELECT nomeUsuario, senha FROM credenciais WHERE nomeUsuario = :username");
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch();

        if (!$result || empty($result)) {
            throw new UsernameNotFoundException('Usuário ou senha inválidos.');
        }
        if (!password_verify($password, $result['senha'])) {
            throw new UsernameNotFoundException('Usuário ou senha inválidos.');
        }

        if (!password_verify($password, $result['senha'])) {
            return false;
        }
        return true;

    }
    public function show($param): Credential
    {
        $db_con = self::connect();
        $stmt = $db_con->prepare(
            "SELECT * FROM credenciais WHERE nomeUsuario = :username"
        );
        $stmt->execute(["username" => $param]);
        $result = $stmt->fetch();
        if (!$result) {
            throw new UsernameNotFoundException();
        }
        // assign the result valuew to this instance
        $this->setUsername($result["nomeUsuario"]);
        $this->setPassword($result["senha"]);
        $this->setUserId($result["usuario_id"]);
        $this->setIsAdmin($result["administrador"]);
        $this->setLoginAttempts($result["tentativasLogin"]);
        $this->setIsAccountLocked($result["contaTravada"]);
        $this->setUpdatedAt(
            new \DateTime($result['updated_at'], new \DateTimeZone("America/Sao_Paulo"))
        );
        return $this;
    }
    public function username_exists()
    {
        try {
            $this->show($this->getUsername());
            return true;
        } catch (UsernameNotFoundException $e) {
            return false;
        }
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
    public function getUsernameNotFound(): bool
    {
        return $this->usernameNotFound;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
    public function setPassword(string $password): void
    {
        $this->password = password_hash(password: $password, algo: PASSWORD_BCRYPT);
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
    public function setUsernameNotFound(bool $userNotFound): void
    {
        $this->userNotFound = $userNotFound;
    }
}
