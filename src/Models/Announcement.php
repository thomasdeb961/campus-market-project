<?php

class Announcement {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $sql = "SELECT a.*, c.name as category_name 
                FROM announcements a 
                JOIN categories c ON a.category_id = c.id 
                ORDER BY a.created_at DESC";
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

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

    public function getCategories() {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT * FROM announcements WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

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

    public function delete($id, $userId) {
        $sql = "DELETE FROM announcements WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':user_id' => $userId
        ]);
    }

    public function search($keyword = '', $categoryId = '') {
        $sql = "SELECT a.*, c.name as category_name 
                FROM announcements a 
                JOIN categories c ON a.category_id = c.id 
                WHERE 1=1"; 
        
        $params = []; 
        if (!empty($keyword)) {
            $sql .= " AND (a.title LIKE :keyword OR a.description LIKE :keyword)";
            $params[':keyword'] = '%' . $keyword . '%'; 
        }

        if (!empty($categoryId)) {
            $sql .= " AND a.category_id = :category_id";
            $params[':category_id'] = $categoryId;
        }

        $sql .= " ORDER BY a.created_at DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll();
    }
}
?>