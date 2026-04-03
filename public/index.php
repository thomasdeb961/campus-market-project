<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Controllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/AdController.php'; 
require_once __DIR__ . '/../src/Controllers/AdminController.php';
$adminController = new AdminController($pdo);

$authController = new AuthController($pdo);
$adController = new AdController($pdo); 

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;

    case 'ads':
        $adController->index(); 
        break;
    case 'create_ad':
        $adController->create(); 
        break;
    case 'store_ad':
        $adController->store(); 
        break;
    case 'edit_ad':
        $adController->edit();
        break;
    case 'update_ad':
        $adController->update();
        break;
    case 'delete_ad':
        $adController->delete();
        break;
    // --- ROUTES ADMIN ---
    case 'admin_dashboard':
        $adminController->dashboard();
        break;
    case 'admin_delete_ad':
        $adminController->forceDelete();
        break;    

    case 'home':
    default:
        require_once __DIR__ . '/../views/home.php';
        break;
}
?>