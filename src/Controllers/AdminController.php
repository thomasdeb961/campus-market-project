<?php

require_once __DIR__ . '/../Models/Announcement.php';

class AdminController {
    private $adModel;

    public function __construct($pdo) {
        $this->adModel = new Announcement($pdo);
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php");
            exit();
        }

        $ads = $this->adModel->getAll();
        
        require_once __DIR__ . '/../../views/admin/dashboard.php';
    }

    public function forceDelete() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php");
            exit();
        }

        $id = $_GET['id'] ?? null;
        if ($id) {
            global $pdo; 
            $stmt = $pdo->prepare("DELETE FROM announcements WHERE id = :id");
            $stmt->execute([':id' => $id]);
        }
        
        header("Location: index.php?action=admin_dashboard");
        exit();
    }
}
?>