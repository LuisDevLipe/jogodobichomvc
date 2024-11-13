<?php
namespace App\Models;
use Core\Model;
class User extends Model
{
    private int $id;
    private string $fullname;
    private $dob;
    private string|null $gender;
    private string $mothername;
    private string $cpf;

    private string $email;
    private string|null $celular;
    private string|null $fixo;
    private $created_at = null;
    private $updated_at = null;
    private int $endereco_id;

    public bool $userNotFound = false;
    public function __construct(array $constructor = [fullname, dob, gender, mothername, cpf, email, celular, fixo, endereco_id])
    {
        if (!empty($constructor)) {
            $this->setFullname($constructor['fullname']);
            $this->setDob($constructor['dob']);
            $this->setGender($constructor['gender']);
            $this->setMothername($constructor['mothername']);
            $this->setCpf($constructor['cpf']);
            $this->setEmail($constructor['email']);
            $this->setCelular($constructor['celular']);
            $this->setFixo($constructor['fixo']);
            $this->setEnderecoId($constructor['endereco_id']);
        } else {
            $this->userNotFound = true;
        }

    }
    public static function show($cpf): User
    {
        return new User();
    }

    public static function findById($user_id): User
    {
        $stmt = self::connect()->prepare('SELECT * FROM usuarios WHERE id = :id');
        $stmt->execute(['id' => $user_id]);
        $result = $stmt->fetch();
        if (!$result) {
            return new User([]);
        }
        $newUser =  new User(
            [
                'fullname' => $result['nomeCompleto'],
                'dob' => $result['dataNasc'],
                'gender' => $result['genero'],
                'mothername' => $result['nomeMae'],
                'cpf' => $result['cpf'],
                'email' => $result['email'],
                'celular' => $result['celular'],
                'fixo' => $result['fixo'],
                'endereco_id' => $result['endereco_id']
            ]
        );
        $newUser->setId($result['id']);
        $newUser->setCreatedAt($result['created_at']);
        $newUser->setUpdatedAt($result['updated_at']);
        return $newUser;
    }

    public function create(): User
    {
        $db_con = self::connect();
        if($this->user_exists()){
            return $this;
        }
        $stmt = $db_con->prepare('INSERT INTO usuarios (nomeCompleto, dataNasc, genero, nomeMae, cpf, email, celular, fixo, endereco_id) VALUES (:fullname, :dob, :gender, :mothername, :cpf, :email, :celular, :fixo, :endereco_id)');
        $result = $stmt->execute([
            'fullname' => $this->getFullname(),
            'dob' => $this->getDob(),
            'gender' => $this->getGender(),
            'mothername' => $this->getMothername(),
            'cpf' => $this->getCpf(),
            'email' => $this->getEmail(),
            'celular' => $this->getCelular(),
            'fixo' => $this->getFixo(),
            'endereco_id' => $this->getEnderecoId()
        ]);
        if (!$result) {
            return new User([]);
        }
        $this->setId($db_con->lastInsertId());
        $this->setCreatedAt($result['created_at']);
        $this->setUpdatedAt($result['updated_at']);
        return $this;
        
    }
    public static function find(string $cpf):User
    {
        $db_con = self::connect();
        $stmt = $db_con->prepare('SELECT * FROM usuarios WHERE cpf = :cpf');
        $result = $stmt->execute(['cpf' => $cpf]);
        if (!$result) {
            return new User([]);
        }
        $newUser = new User(
            [
                'fullname' => $result['nomeCompleto'],
                'dob' => $result['dataNasc'],
                'gender' => $result['genero'],
                'mothername' => $result['nomeMae'],
                'cpf' => $result['cpf'],
                'email' => $result['email'],
                'celular' => $result['celular'],
                'fixo' => $result['fixo'],
                'endereco_id' => $result['endereco_id']
            ]
            );
        $newUser->setId($result['id']);
        $newUser->setCreatedAt($result['created_at']);
        $newUser->setUpdatedAt($result['updated_at']);
        return $newUser;
    }

    public function user_exists(){
        $user = $this->find($this->getCpf());
        if($user->userNotFound){
            return false;
        }
        return true;
    }
    // getters and setters
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getFullname(): string
    {
        return $this->fullname;
    }
    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
    }
    public function getDob()
    {
        return $this->dob;
    }
    public function setDob($dob): void
    {
        $this->dob = $dob;
    }
    public function getGender(): string
    {
        return $this->gender;
    }
    public function setGender(string|null $gender): void
    {
        $this->gender = $gender;
    }
    public function getMothername(): string
    {
        return $this->mothername;
    }
    public function setMothername(string $mothername): void
    {
        $this->mothername = $mothername;
    }
    public function getCpf(): string
    {
        return $this->cpf;
    }
    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function getCelular(): string
    {
        return $this->celular;
    }
    public function setCelular(string|null $celular): void
    {
        $this->celular = $celular;
    }
    public function getFixo(): string
    {
        return $this->fixo;
    }
    public function setFixo(string|null $fixo): void
    {
        $this->fixo = $fixo;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }
    public function getEnderecoId(): int
    {
        return $this->endereco_id;
    }
    public function setEnderecoId(int $endereco_id): void
    {
        $this->endereco_id = $endereco_id;
    }


}
