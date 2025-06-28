<?php
require_once("Model.php");

// Manages user authentication and regisration
class User extends Model
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $mobile;
    private string $passwordHash;
    private string $dateOfBirth;
    private string $createdAt;

    protected static string $table = "users";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->firstName = $data["first_name"];
        $this->lastName = $data["last_name"];
        $this->email = $data["email"];
        $this->mobile = $data["mobile"];
        $this->passwordHash = $data["password_hash"];
        $this->dateOfBirth = $data["date_of_birth"];
        $this->createdAt = $data["created_at"];
    }

    public function getId()
    {
        return $this->id;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMobile()
    {
        return $this->mobile;
    }
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setFirstName(string $value)
    {
        $this->firstName = $value;
    }
    public function setLastName(string $value)
    {
        $this->lastName = $value;
    }
    public function setEmail(string $value)
    {
        $this->email = $value;
    }
    public function setMobile(string $value)
    {
        $this->mobile = $value;
    }
    public function setPasswordHash(string $value)
    {
        $this->passwordHash = $value;
    }
    public function setDateOfBirth(string $value)
    {
        $this->dateOfBirth = $value;
    }

    // Custom methods for authentication
    public static function findByEmailOrMobile(string $identifier)
    {
        $sql = "SELECT * FROM users WHERE email = ? OR mobile = ?";
        $query = self::$connection->prepare($sql);
        $query->bind_param("ss", $identifier, $identifier);
        $query->execute();

        $data = $query->get_result()->fetch_assoc();
        return $data ? new static($data) : null;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->passwordHash);
    }
}
