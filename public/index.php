<?php
// public/index.php

// 1. On affiche les erreurs (utile pour le dev)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. On démarre la session
session_start();

// 3. On inclut la base de données et les Contrôleurs
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Controllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/AdController.php'; // <-- NOUVEAU !
require_once __DIR__ . '/../src/Controllers/AdminController.php';
$adminController = new AdminController($pdo);

// 4. On initialise les contrôleurs en leur passant la connexion PDO
$authController = new AuthController($pdo);
$adController = new AdController($pdo); // <-- NOUVEAU !

// 5. LE ROUTEUR
$action = $_GET['action'] ?? 'home';

switch ($action) {
    // --- ROUTES AUTHENTIFICATION ---
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;

    // --- ROUTES ANNONCES (NOUVEAU !) ---
    case 'ads':
        $adController->index(); // Affiche la liste
        break;
    case 'create_ad':
        $adController->create(); // Affiche le formulaire
        break;
    case 'store_ad':
        $adController->store(); // Traite le formulaire
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

    // --- ACCUEIL ---
    case 'home':
    default:
        // On appelle la nouvelle vue qu'on vient de créer !
        require_once __DIR__ . '/../views/home.php';
        break;
}
?>