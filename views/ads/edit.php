<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'annonce</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; text-align: center; }
        form { background: white; padding: 20px; border-radius: 8px; display: inline-block; text-align: left; width: 100%; max-width: 500px; }
        input, select, textarea { display: block; margin: 10px 0; padding: 10px; width: 100%; box-sizing: border-box; }
        button { padding: 10px; background-color: #f39c12; color: white; border: none; width: 100%; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Modifier mon annonce</h1>
    
    <form method="POST" action="index.php?action=update_ad">
        <input type="hidden" name="id" value="<?= $ad['id'] ?>">

        <label>Titre de l'annonce</label>
        <input type="text" name="title" value="<?= htmlspecialchars($ad['title']) ?>" required>

        <label>Catégorie</label>
        <select name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" <?= ($category['id'] == $ad['category_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Description</label>
        <textarea name="description" rows="5" required><?= htmlspecialchars($ad['description']) ?></textarea>

        <label>Prix (€)</label>
        <input type="number" name="price" step="0.01" value="<?= $ad['price'] ?>" required>

        <label>Lien de l'image</label>
        <input type="url" name="image_url" value="<?= htmlspecialchars($ad['image_url'] ?? '') ?>">

        <button type="submit">Enregistrer les modifications</button>
    </form>
    
    <a href="index.php?action=ads">Annuler</a>
</body>
</html>