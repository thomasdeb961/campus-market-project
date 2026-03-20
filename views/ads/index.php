<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Les Annonces - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <h1>Toutes les annonces</h1>
        <div>
            <a href="index.php" class="btn" style="background-color: #7f8c8d;">Retour Accueil</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="index.php?action=create_ad" class="btn btn-green">+ Déposer une annonce</a>
            <?php endif; ?>
        </div>
    </div>

    <form class="search-bar" method="GET" action="index.php">
        <input type="hidden" name="action" value="ads">
        
        <input type="text" name="search" placeholder="Que cherchez-vous ?" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        
        <select name="category_id">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= (isset($_GET['category_id']) && $_GET['category_id'] == $category['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit" class="btn">🔍 Rechercher</button>
    </form>

    <div class="ad-grid">
        <?php if (empty($ads)): ?>
            <p style="font-size: 1.2em; color: #7f8c8d;">Aucune annonce ne correspond à votre recherche... 😢</p>
        <?php else: ?>
            <?php foreach ($ads as $ad): ?>
                <div class="ad-card">
                    <?php if (!empty($ad['image_url'])): ?>
                        <img src="<?= htmlspecialchars($ad['image_url']) ?>" alt="Image de l'annonce" class="ad-img">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($ad['title']) ?></h3>
                    <p class="category"><?= htmlspecialchars($ad['category_name']) ?></p>
                    <p class="price"><?= htmlspecialchars($ad['price']) ?> €</p>
                    <p><?= nl2br(htmlspecialchars(substr($ad['description'], 0, 100))) ?>...</p>

                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $ad['user_id']): ?>
                        <div style="margin-top: 15px; border-top: 1px solid #eee; padding-top: 10px;">
                            <a href="index.php?action=edit_ad&id=<?= $ad['id'] ?>" style="color: #f39c12; text-decoration: none; margin-right: 10px;">✏️ Modifier</a>
                            <a href="index.php?action=delete_ad&id=<?= $ad['id'] ?>" onclick="return confirm('Êtes-vous sûr ?');" style="color: #e74c3c; text-decoration: none;">🗑️ Supprimer</a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>