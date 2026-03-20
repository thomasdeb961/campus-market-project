<?php
// config/database.php

$host = 'localhost';
$dbname = 'campus_market';
$username = 'root';
$password = 'root'; // C'est le mot de passe par défaut de MAMP

try {
    // C'est ICI qu'on crée la fameuse variable $pdo qui te manquait !
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion à la BDD : " . $e->getMessage());
}
?>