<?php
// src/Controllers/AuthController.php

// On a besoin du Modèle User pour travailler
require_once __DIR__ . '/../Models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // --- GESTION DE L'INSCRIPTION ---
    public function register() {
        $error = '';
        $success = '';

        // Si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Validation basique (on sécurise l'entrée)
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Tous les champs sont obligatoires.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Format d'email invalide.";
            } else {
                // 2. On demande au Modèle d'inscrire l'utilisateur
                if ($this->userModel->register($email, $password)) {
                    $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                    // Redirection vers la page de login possible ici
                } else {
                    $error = "Cet email est déjà utilisé ou une erreur est survenue.";
                }
            }
        }

        // 3. On affiche la vue (le formulaire HTML)
        require_once __DIR__ . '/../../views/auth/register.php';
    }

    // --- GESTION DE LA CONNEXION ---
    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } else {
                // 1. On cherche l'utilisateur dans la BDD
                $user = $this->userModel->findByEmail($email);

                // 2. Si l'utilisateur existe ET que le mot de passe correspond au hash
                if ($user && password_verify($password, $user['password_hash'])) {
                    
                    // 3. On vérifie si le compte est actif (L'astuce pro pour l'invalidation)
                    if (!$user['is_active']) {
                        $error = "Ce compte a été désactivé par un administrateur.";
                    } else {
                        // 4. On crée la session sécurisée
                        session_start();
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['role'] = $user['role']; // Gestion des rôles
                        
                        // 5. On redirige vers l'accueil (ou le dashboard admin selon le rôle)
                        header("Location: /campus-market-project/public/index.php");
                        exit();
                    }
                } else {
                    $error = "Identifiants incorrects.";
                }
            }
        }

        require_once __DIR__ . '/../../views/auth/login.php';
    }

    // --- GESTION DE LA DÉCONNEXION ---
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /campus-market-project/public/index.php?action=login");
        exit();
    }
}
?>