<?php
// src/Controllers/AdminController.php

require_once __DIR__ . '/../Models/Announcement.php';
// On pourrait aussi inclure User.php plus tard si on veut gérer les utilisateurs

class AdminController {
    private $adModel;

    public function __construct($pdo) {
        $this->adModel = new Announcement($pdo);
    }

    // --- AFFICHER LE TABLEAU DE BORD ---
    public function dashboard() {
        // 🛑 SÉCURITÉ MAXIMALE : On vérifie que l'utilisateur est connecté ET qu'il est 'admin'
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            // Si ce n'est pas un admin, on le renvoie à l'accueil sans poser de questions !
            header("Location: index.php");
            exit();
        }

        // Si c'est un admin, on récupère toutes les annonces de tout le monde pour la modération
        $ads = $this->adModel->getAll();
        
        // On affichera la vue du tableau de bord (qu'on va créer juste après)
        require_once __DIR__ . '/../../views/admin/dashboard.php';
    }

    // --- SUPPRIMER N'IMPORTE QUELLE ANNONCE (MODÉRATION) ---
    public function forceDelete() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php");
            exit();
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            // Ici, on triche un peu : on fait une requête SQL directe pour supprimer sans vérifier le user_id
            // car l'admin a le droit de tout supprimer !
            global $pdo; // On récupère la connexion globale
            $stmt = $pdo->prepare("DELETE FROM announcements WHERE id = :id");
            $stmt->execute([':id' => $id]);
        }
        
        header("Location: index.php?action=admin_dashboard");
        exit();
    }
}
?>