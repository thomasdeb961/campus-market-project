<?php
// src/Controllers/AdController.php

// On inclut le Modèle qu'on vient de créer
require_once __DIR__ . '/../Models/Announcement.php';

class AdController {
    private $adModel;

    public function __construct($pdo) {
        $this->adModel = new Announcement($pdo);
    }

    // --- 1. AFFICHER LA LISTE DES ANNONCES (AVEC RECHERCHE) ---
    public function index() {
        // On récupère les filtres dans l'URL (méthode GET au lieu de POST pour la recherche)
        $keyword = $_GET['search'] ?? '';
        $categoryId = $_GET['category_id'] ?? '';

        // Si on a une recherche, on utilise notre nouvelle fonction search()
        if (!empty($keyword) || !empty($categoryId)) {
            $ads = $this->adModel->search($keyword, $categoryId);
        } else {
            // Sinon, on affiche tout par défaut
            $ads = $this->adModel->getAll();
        }

        // On a besoin des catégories pour afficher le menu déroulant des filtres sur la page
        $categories = $this->adModel->getCategories();
        
        require_once __DIR__ . '/../../views/ads/index.php';
    }

    // --- 2. AFFICHER LE FORMULAIRE DE CRÉATION ---
    public function create() {
        // SÉCURITÉ : On vérifie que l'utilisateur est connecté !
        if (!isset($_SESSION['user_id'])) {
            header("Location: /campus-market-project/public/index.php?action=login");
            exit();
        }

        // On a besoin des catégories pour remplir le menu déroulant du formulaire
        $categories = $this->adModel->getCategories();
        
        require_once __DIR__ . '/../../views/ads/create.php';
    }

    // --- 3. TRAITER L'ENVOI DU FORMULAIRE (CREATE) ---
    public function store() {
        // SÉCURITÉ : On revérifie la connexion
        if (!isset($_SESSION['user_id'])) {
            header("Location: /campus-market-project/public/index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // On récupère l'ID de l'utilisateur connecté depuis sa session
            $userId = $_SESSION['user_id'];
            
            // On récupère et on nettoie les données du formulaire (htmlspecialchars empêche le piratage XSS)
            $categoryId = $_POST['category_id'] ?? '';
            $title = htmlspecialchars($_POST['title'] ?? '');
            $description = htmlspecialchars($_POST['description'] ?? '');
            $price = $_POST['price'] ?? 0;
            $imageUrl = $_POST['image_url'] ?? null; // Pour faire simple aujourd'hui, on demandera juste un lien (URL) vers une image

            // Validation : est-ce que les champs obligatoires sont remplis ?
            if (empty($title) || empty($description) || empty($price) || empty($categoryId)) {
                $error = "Veuillez remplir tous les champs obligatoires.";
                $categories = $this->adModel->getCategories();
                require_once __DIR__ . '/../../views/ads/create.php';
                return;
            }

            // On demande au Modèle d'insérer tout ça dans la base de données
            if ($this->adModel->create($userId, $categoryId, $title, $description, $price, $imageUrl)) {
                // Succès ! On redirige vers la page de toutes les annonces
                header("Location: /campus-market-project/public/index.php?action=ads");
                exit();
            } else {
                $error = "Une erreur est survenue lors de la publication de l'annonce.";
                $categories = $this->adModel->getCategories();
                require_once __DIR__ . '/../../views/ads/create.php';
            }
        }
    }

    // --- 4. AFFICHER LE FORMULAIRE DE MODIFICATION ---
    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login"); exit();
        }

        $id = $_GET['id'] ?? null;
        $ad = $this->adModel->getById($id);

        // Si l'annonce n'existe pas ou n'appartient pas à l'utilisateur connecté -> Erreur
        if (!$ad || $ad['user_id'] != $_SESSION['user_id']) {
            echo "<h2>Accès refusé. Vous ne pouvez modifier que vos propres annonces.</h2>";
            echo "<a href='index.php?action=ads'>Retour</a>";
            exit();
        }

        $categories = $this->adModel->getCategories();
        require_once __DIR__ . '/../../views/ads/edit.php'; // On va créer cette vue après
    }

    // --- 5. TRAITER LA MODIFICATION (UPDATE) ---
    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login"); exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $userId = $_SESSION['user_id'];
            $categoryId = $_POST['category_id'] ?? '';
            $title = htmlspecialchars($_POST['title'] ?? '');
            $description = htmlspecialchars($_POST['description'] ?? '');
            $price = $_POST['price'] ?? 0;
            $imageUrl = $_POST['image_url'] ?? null;

            if ($this->adModel->update($id, $userId, $categoryId, $title, $description, $price, $imageUrl)) {
                header("Location: index.php?action=ads");
                exit();
            } else {
                echo "Erreur lors de la modification.";
            }
        }
    }

    // --- 6. SUPPRIMER L'ANNONCE (DELETE) ---
    public function delete() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login"); exit();
        }

        $id = $_GET['id'] ?? null;
        $userId = $_SESSION['user_id'];

        if ($id) {
            $this->adModel->delete($id, $userId);
        }
        
        // On redirige vers la liste des annonces après suppression
        header("Location: index.php?action=ads");
        exit();
    }
}
?>