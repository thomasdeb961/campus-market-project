<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Les Annonces - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <h1 style="color: var(--primary-color); margin: 0;">🛍️ Toutes les annonces</h1>
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
            <a href="index.php" class="btn" style="background-color: #64748b;">Retour Accueil</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="index.php?action=create_ad" class="btn btn-green">➕ Déposer une annonce</a>
            <?php endif; ?>
        </div>
    </div>

    <form class="search-bar" method="GET" action="index.php">
        <input type="hidden" name="action" value="ads">
        
        <input type="text" name="search" placeholder="Que cherchez-vous (ex: ordinateur, livre...) ?" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" style="margin-bottom: 0;">
        
        <select name="category_id" style="margin-bottom: 0;">
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
            <div style="grid-column: 1 / -1; background: var(--card-bg); padding: 40px; text-align: center; border-radius: var(--radius); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <p style="font-size: 3rem; margin-bottom: 10px;">📭</p>
                <h3 style="color: var(--text-color);">Aucune annonce trouvée</h3>
                <p style="color: #64748b;">Essayez de modifier vos filtres de recherche ou soyez le premier à publier !</p>
            </div>
        <?php else: ?>
            <?php foreach ($ads as $ad): ?>
                <div class="ad-card" style="position: relative;">
    <a href="index.php?action=show_ad&id=<?= $ad['id'] ?>" style="display: block; text-decoration: none;">
        <?php 
            $imgUrl = !empty($ad['image_url']) ? htmlspecialchars($ad['image_url']) : 'https://placehold.co/600x400/e2e8f0/64748b?text=Pas+d\'image&font=Poppins';
        ?>
        <img src="<?= $imgUrl ?>" alt="Image de l'annonce" class="ad-img" style="display: block;">
    </a>
    
    <h3 style="margin-top: 15px; margin-bottom: 5px; font-size: 1.2rem;">
        <a href="index.php?action=show_ad&id=<?= $ad['id'] ?>" class="ad-link-title">
            <?= htmlspecialchars($ad['title']) ?>
        </a>
    </h3>

    <p class="category"><?= htmlspecialchars($ad['category_name']) ?></p>
    <p class="price"><?= htmlspecialchars($ad['price']) ?> €</p>
    <p style="color: #475569; font-size: 0.9rem;"><?= nl2br(htmlspecialchars(substr($ad['description'], 0, 80))) ?>...</p>

    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $ad['user_id']): ?>
        <div style="display: flex; gap: 10px; margin-top: 15px; border-top: 1px solid #e2e8f0; padding-top: 10px; position: relative; z-index: 10;">
            <a href="index.php?action=edit_ad&id=<?= $ad['id'] ?>" style="color: #d97706; text-decoration: none; font-size: 0.85rem; font-weight: 600;">✏️ Modifier</a>
            <a href="index.php?action=delete_ad&id=<?= $ad['id'] ?>" onclick="return confirm('Supprimer ?');" style="color: #dc2626; text-decoration: none; font-size: 0.85rem; font-weight: 600;">🗑️ Supprimer</a>
        </div>
    <?php endif; ?>
</div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>