<?php

require_once __DIR__ . '/../Models/Announcement.php';

class AdController {
    private $adModel;

    public function __construct($pdo) {
        $this->adModel = new Announcement($pdo);
    }

    public function index() {
        $keyword = $_GET['search'] ?? '';
        $categoryId = $_GET['category_id'] ?? '';

        if (!empty($keyword) || !empty($categoryId)) {
            $ads = $this->adModel->search($keyword, $categoryId);
        } else {
            $ads = $this->adModel->getAll();
        }

        $categories = $this->adModel->getCategories();
        
        require_once __DIR__ . '/../../views/ads/index.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /campus-market-project/public/index.php?action=login");
            exit();
        }

        $categories = $this->adModel->getCategories();
        
        require_once __DIR__ . '/../../views/ads/create.php';
    }

    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /campus-market-project/public/index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            
            $categoryId = $_POST['category_id'] ?? '';
            $title = htmlspecialchars($_POST['title'] ?? '');
            $description = htmlspecialchars($_POST['description'] ?? '');
            $price = $_POST['price'] ?? 0;
            $imageUrl = $_POST['image_url'] ?? null; 
            if (empty($title) || empty($description) || empty($price) || empty($categoryId)) {
                $error = "Veuillez remplir tous les champs obligatoires.";
                $categories = $this->adModel->getCategories();
                require_once __DIR__ . '/../../views/ads/create.php';
                return;
            }

            if ($this->adModel->create($userId, $categoryId, $title, $description, $price, $imageUrl)) {
                header("Location: /campus-market-project/public/index.php?action=ads");
                exit();
            } else {
                $error = "Une erreur est survenue lors de la publication de l'annonce.";
                $categories = $this->adModel->getCategories();
                require_once __DIR__ . '/../../views/ads/create.php';
            }
        }
    }

    public function edit() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login"); exit();
        }

        $id = $_GET['id'] ?? null;
        $ad = $this->adModel->getById($id);

        if (!$ad || $ad['user_id'] != $_SESSION['user_id']) {
            echo "<h2>Accès refusé. Vous ne pouvez modifier que vos propres annonces.</h2>";
            echo "<a href='index.php?action=ads'>Retour</a>";
            exit();
        }

        $categories = $this->adModel->getCategories();
        require_once __DIR__ . '/../../views/ads/edit.php';
    }

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

    public function delete() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login"); exit();
        }

        $id = $_GET['id'] ?? null;
        $userId = $_SESSION['user_id'];

        if ($id) {
            $this->adModel->delete($id, $userId);
        }
        
        header("Location: index.php?action=ads");
        exit();
    }
}
?>