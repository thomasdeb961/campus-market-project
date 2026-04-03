<?php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (email, password_hash, role) VALUES (:email, :password_hash, 'user')";
        $stmt = $this->pdo->prepare($sql);
        
        try {
            return $stmt->execute([
                ':email' => $email,
                ':password_hash' => $passwordHash
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        return $stmt->fetch(); 
    }
}
?>