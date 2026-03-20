<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une annonce - Campus Market</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; text-align: center; }
        form { background: white; padding: 20px; border-radius: 8px; display: inline-block; text-align: left; box-shadow: 0 2px 4px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        input, select, textarea { display: block; margin: 10px 0 20px 0; padding: 10px; width: 100%; box-sizing: border-box; }
        button { padding: 10px 20px; background-color: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        .error { color: red; margin-bottom: 15px; text-align: center; }
        a { display: block; text-align: center; margin-top: 15px; color: #2980b9; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Publier une nouvelle annonce</h1>
    
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    
    <form method="POST" action="index.php?action=store_ad">
        <label>Titre de l'annonce</label>
        <input type="text" name="title" required placeholder="Ex: Livre de PHP avancé">

        <label>Catégorie</label>
        <select name="category_id" required>
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Description</label>
        <textarea name="description" rows="5" required placeholder="Décrivez votre objet en détail..."></textarea>

        <label>Prix (€)</label>
        <input type="number" name="price" step="0.01" required placeholder="Ex: 15.50">

        <label>Lien d'une image (optionnel)</label>
        <input type="url" name="image_url" placeholder="https://lien-vers-image.com/photo.jpg">

        <button type="submit">Publier l'annonce</button>
    </form>
    
    <a href="index.php?action=ads">Retour aux annonces</a>
</body>
</html>