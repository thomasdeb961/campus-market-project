<?php
// src/Models/User.php

class User {
    private $pdo;

    // Le constructeur récupère la connexion à la base de données
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fonction pour inscrire un nouvel utilisateur
    public function register($email, $password) {
        // 1. On hash le mot de passe pour la sécurité 
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        // 2. On prépare la requête SQL (protection contre les injections SQL) [cite: 92]
        $sql = "INSERT INTO users (email, password_hash, role) VALUES (:email, :password_hash, 'user')";
        $stmt = $this->pdo->prepare($sql);
        
        // 3. On exécute en liant les variables
        try {
            return $stmt->execute([
                ':email' => $email,
                ':password_hash' => $passwordHash
            ]);
        } catch (PDOException $e) {
            // Si l'email existe déjà, ça plantera ici car on a mis "UNIQUE" dans la BDD
            return false;
        }
    }

    // Fonction pour trouver un utilisateur par son email (utile pour la connexion)
    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        return $stmt->fetch(); // Retourne un tableau avec les infos de l'utilisateur, ou false
    }
}
?>