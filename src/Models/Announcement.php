<?php
// src/Models/Announcement.php

class Announcement {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // --- 1. RÉCUPÉRER TOUTES LES ANNONCES (READ) ---
    public function getAll() {
        // On fait une jointure (JOIN) pour récupérer le nom de la catégorie au lieu de juste son ID
        $sql = "SELECT a.*, c.name as category_name 
                FROM announcements a 
                JOIN categories c ON a.category_id = c.id 
                ORDER BY a.created_at DESC";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // --- 2. CRÉER UNE ANNONCE (CREATE) ---
    public function create($userId, $categoryId, $title, $description, $price, $imageUrl = null) {
        $sql = "INSERT INTO announcements (user_id, category_id, title, description, price, image_url) 
                VALUES (:user_id, :category_id, :title, :description, :price, :image_url)";
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            ':user_id' => $userId,
            ':category_id' => $categoryId,
            ':title' => $title,
            ':description' => $description,
            ':price' => $price,
            ':image_url' => $imageUrl
        ]);
    }

    // --- 3. RÉCUPÉRER LES CATÉGORIES (Utile pour le formulaire de création) ---
    public function getCategories() {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // --- 4. RÉCUPÉRER UNE SEULE ANNONCE (Utile pour la modifier) ---
    public function getById($id) {
        $sql = "SELECT * FROM announcements WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // --- 5. MODIFIER UNE ANNONCE (UPDATE) ---
    // SÉCURITÉ : On vérifie le user_id dans le WHERE pour qu'il ne modifie que la sienne
    public function update($id, $userId, $categoryId, $title, $description, $price, $imageUrl) {
        $sql = "UPDATE announcements 
                SET category_id = :category_id, title = :title, description = :description, price = :price, image_url = :image_url 
                WHERE id = :id AND user_id = :user_id";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':user_id' => $userId,
            ':category_id' => $categoryId,
            ':title' => $title,
            ':description' => $description,
            ':price' => $price,
            ':image_url' => $imageUrl
        ]);
    }

    // --- 6. SUPPRIMER UNE ANNONCE (DELETE) ---
    // SÉCURITÉ : Pareil, on vérifie que l'annonce appartient bien à ce user_id
    public function delete($id, $userId) {
        $sql = "DELETE FROM announcements WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':user_id' => $userId
        ]);
    }

    // --- 7. RECHERCHE MULTICRITÈRES (Filtres et mots-clés) ---
    public function search($keyword = '', $categoryId = '') {
        // La requête de base (le 1=1 permet d'empiler les conditions AND facilement)
        $sql = "SELECT a.*, c.name as category_name 
                FROM announcements a 
                JOIN categories c ON a.category_id = c.id 
                WHERE 1=1"; 
        
        $params = []; // Ce tableau va stocker nos variables sécurisées

        // Si l'utilisateur a tapé un mot-clé
        if (!empty($keyword)) {
            $sql .= " AND (a.title LIKE :keyword OR a.description LIKE :keyword)";
            // Les % disent à MySQL : "le mot peut être entouré d'autres mots"
            $params[':keyword'] = '%' . $keyword . '%'; 
        }

        // Si l'utilisateur a choisi une catégorie dans le menu déroulant
        if (!empty($categoryId)) {
            $sql .= " AND a.category_id = :category_id";
            $params[':category_id'] = $categoryId;
        }

        // On trie toujours par les plus récentes
        $sql .= " ORDER BY a.created_at DESC";

        // On prépare et on exécute la requête sécurisée
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll();
    }
}
?>