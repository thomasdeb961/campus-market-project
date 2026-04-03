<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'annonce - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div style="max-width: 600px; margin: 40px auto;">
        
        <div class="header" style="justify-content: center; flex-direction: column; text-align: center; border-bottom: none; margin-bottom: 10px;">
            <h1 style="color: var(--primary-color);">✏️ Modifier mon annonce</h1>
            <p style="color: #64748b;">Mettez à jour les informations de votre objet.</p>
        </div>
        
        <form method="POST" action="index.php?action=update_ad">
            <input type="hidden" name="id" value="<?= $ad['id'] ?>">

            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Titre de l'annonce</label>
            <input type="text" name="title" value="<?= htmlspecialchars($ad['title']) ?>" required>

            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Catégorie</label>
            <select name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == $ad['category_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Description</label>
            <textarea name="description" rows="5" required><?= htmlspecialchars($ad['description']) ?></textarea>

            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Prix (€)</label>
            <input type="number" name="price" step="0.01" value="<?= $ad['price'] ?>" required>

            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Lien de l'image</label>
            <input type="url" name="image_url" value="<?= htmlspecialchars($ad['image_url'] ?? '') ?>">

            <button type="submit" class="btn" style="width: 100%; background-color: #f59e0b; font-size: 1.1rem; margin-top: 10px;">💾 Enregistrer les modifications</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php?action=ads" style="color: #64748b; text-decoration: none; font-weight: 600;">← Annuler et retour</a>
        </div>
    </div>
</body>
</html>