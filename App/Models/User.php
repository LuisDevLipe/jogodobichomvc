<?php
namespace App\Models;
use Core\Model;
class User extends Model
{
    private string $fullname;
    private string $email;
    public function __construct(array $constructor = [fullname, email])
    {
        if (!empty($constructor)) {
            $this->fullname = $constructor['fullname'];
            $this->email = $constructor['email'];
        }

    }
    public static function show(): User
    {
        return new User();
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

}
