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

    // --- ACCUEIL ---
    case 'home':
    default:
        echo "<h1>Bienvenue sur Campus Market !</h1>";
        if (isset($_SESSION['user_id'])) {
            echo "<p style='color:green;'>Tu es connecté !</p>";
            echo "<a href='index.php?action=ads' style='margin-right: 15px;'>👉 Voir les annonces</a>";
            echo "<a href='index.php?action=logout'>Se déconnecter</a>";
        } else {
            echo "<p><a href='index.php?action=login'>Se connecter</a> | <a href='index.php?action=register'>S'inscrire</a></p>";
            echo "<br><a href='index.php?action=ads'>Voir les annonces sans se connecter</a>";
        }
        break;
}
?>