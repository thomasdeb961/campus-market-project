<?php

require_once __DIR__ . '/../Models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Tous les champs sont obligatoires.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Format d'email invalide.";
            } else {
                if ($this->userModel->register($email, $password)) {
                    $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                } else {
                    $error = "Cet email est déjà utilisé ou une erreur est survenue.";
                }
            }
        }

        require_once __DIR__ . '/../../views/auth/register.php';
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } else {
                $user = $this->userModel->findByEmail($email);

                if ($user && password_verify($password, $user['password_hash'])) {
                    
                    if (!$user['is_active']) {
                        $error = "Ce compte a été désactivé par un administrateur.";
                    } else {
                        // 4. On crée la session sécurisée
                        session_start();
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['role'] = $user['role']; 
                        
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

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /campus-market-project/public/index.php?action=login");
        exit();
    }
}
?>