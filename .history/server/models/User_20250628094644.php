<?php
// Manages user authentication and registration
class User
{
    public string $FirstName;
    public string $LastName;
    public string $email;
    private string $password;
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
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
}
