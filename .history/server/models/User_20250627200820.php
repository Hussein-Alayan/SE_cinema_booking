<?php
require_once("Model.php");

class User extends Model
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $mobile;
    private string $password_hash;
    private string $date_of_birth;
    private string $created_at;

    protected static string $table = "users";

    public function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->first_name = $data["first_name"];
        $this->last_name = $data["last_name"];
        $this->email = $data["email"];
        $this->mobile = $data["mobile"];
        $this->password_hash = $data["password_hash"];
        $this->date_of_birth = $data["date_of_birth"];
        $this->created_at = $data["created_at"];
    }

    public function register($firstName, $lastName, $email, $mobile, $passwordHash, $dob)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO users (first_name, last_name, email, mobile, password_hash, date_of_birth) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstName, $lastName, $email, $mobile, $passwordHash, $dob);
        return $stmt->execute();
    }

    public function findByEmailOrMobile($identifier)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM users WHERE email = ? OR mobile = ?");
        $stmt->bind_param("ss", $identifier, $identifier);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function verifyPassword($identifier, $password)
    {
        $user = $this->findByEmailOrMobile($identifier);
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return false;
    }

    // Getters and setters...
}
