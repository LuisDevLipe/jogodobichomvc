<?php
namespace App\Models;
use Core\Model;
use App\Exceptions\UnableToPersistDataException;

class Endereco extends Model
{
    private int $id;
    private string $cep;
    private string $street;
    private string $number;
    private string $city;
    private string $state;
    private string|null $complement = null;
    private string $neighborhood;
    private string $country;
    private $updated_at = null;

    private bool $enderecoNotFound = false;

    public function __construct(
        array $constructor = [
            cep,
            street,
            number,
            city,
            state,
            complement,
            neighborhood,
            country,
        ]
    ) {
        if (!empty($constructor)) {
            $this->setCep($constructor["cep"]);
            $this->setStreet($constructor["street"]);
            $this->setNumber($constructor["number"]);
            $this->setCity($constructor["city"]);
            $this->setState($constructor["state"]);
            $this->setComplement($constructor["complement"]);
            $this->setNeighborhood($constructor["neighborhood"]);
            $this->setCountry($constructor["country"]);
        } else {
            $this->enderecoNotFound = true;
        }
    }

    public function create(): Endereco
    {
        $db_con = self::connect();
        if ($this->adress_exists()) {
            return $this;
        }
        $stmt = $db_con->prepare(
            "INSERT INTO endereco (cep, rua, numero, cidade, estado, complemento, bairro, pais) VALUES (:cep, :street, :number, :city, :state, :complement, :neighborhood, :country)"
        );
        $result = $stmt->execute([
            "cep" => $this->getCep(),
            "street" => $this->getStreet(),
            "number" => $this->getNumber(),
            "city" => $this->getCity(),
            "state" => $this->getState(),
            "complement" => $this->getComplement(),
            "neighborhood" => $this->getNeighborhood(),
            "country" => $this->getCountry(),
        ]);
        if (!$result) {
            throw new UnableToPersistDataException(
                "Não foi possível persistir os dados do endereço"
            );
        }
        $this->setId($db_con->lastInsertId());
        $this->updated_at = new \DateTime(
            timezone: new \DateTimeZone("America/Sao_Paulo")
        );
        return $this;
    }
    public function show(Endereco $Endereco): Endereco
    {
    }

    public static function find(Endereco $Endereco): Endereco
    {
        $db_con = self::connect();
        $stmt = $db_con->prepare(
            "SELECT * FROM endereco WHERE cep = :cep AND rua = :street AND numero = :number AND cidade = :city AND estado = :state AND complemento = :complement AND bairro = :neighborhood AND pais = :country"
        );
        $stmt->execute([
            "cep" => $Endereco->getCep(),
            "street" => $Endereco->getStreet(),
            "number" => $Endereco->getNumber(),
            "city" => $Endereco->getCity(),
            "state" => $Endereco->getState(),
            "complement" => $Endereco->getComplement(),
            "neighborhood" => $Endereco->getNeighborhood(),
            "country" => $Endereco->getCountry(),
        ]);
        $result = $stmt->fetch();
        if (!$result) {
            return new Endereco([]);
        }
        $this->setId($result["id"]);
        $this->updated_at = $result["updated_at"];
        $this->userNotFound = false;
        return $this;
    }
    private function adress_exists(): bool
    {
        $address = $this->find($this);
        if ($address->getEnderecoNotFound()) {
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
    public function getCep(): string
    {
        return $this->cep;
    }
    public function setCep(string $cep): void
    {
        $this->cep = $cep;
    }
    public function getStreet(): string
    {
        return $this->street;
    }
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }
    public function getNumber(): string
    {
        return $this->number;
    }
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }
    public function getCity(): string
    {
        return $this->city;
    }
    public function setCity(string $city): void
    {
        $this->city = $city;
    }
    public function getState(): string
    {
        return $this->state;
    }
    public function setState(string $state): void
    {
        $this->state = $state;
    }
    public function getComplement(): string|null
    {
        return $this->complement;
    }
    public function setComplement(string|null $complement): void
    {
        $this->complement = $complement;
    }
    public function getNeighborhood(): string
    {
        return $this->neighborhood;
    }
    public function setNeighborhood(string $neighborhood): void
    {
        $this->neighborhood = $neighborhood;
    }
    public function getCountry(): string
    {
        return $this->country;
    }
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }
    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
    public function getEnderecoNotFound(): bool
    {
        return $this->enderecoNotFound;
    }
}
