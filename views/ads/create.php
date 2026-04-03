<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une annonce - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div style="max-width: 600px; margin: 40px auto;">
        
        <div class="header" style="justify-content: center; flex-direction: column; text-align: center; border-bottom: none; margin-bottom: 10px;">
            <h1 style="color: var(--primary-color);">➕ Publier une annonce</h1>
            <p style="color: #64748b;">Vendez ou échangez votre matériel avec les autres étudiants.</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div style="background-color: #fee2e2; color: var(--danger-color); padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; border: 1px solid #fca5a5;">
                <?= $error ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="index.php?action=store_ad">
            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Titre de l'annonce</label>
            <input type="text" name="title" required placeholder="Ex: Livre de PHP avancé">

            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Catégorie</label>
            <select name="category_id" required>
                <option value="">-- Choisir une catégorie --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Description</label>
            <textarea name="description" rows="5" required placeholder="Décrivez votre objet en détail..."></textarea>

            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Prix (€)</label>
            <input type="number" name="price" step="0.01" required placeholder="Ex: 15.50">

            <label style="font-weight: 600; color: var(--text-color); margin-bottom: 5px; display: block;">Lien d'une image (optionnel)</label>
            <input type="url" name="image_url" placeholder="https://lien-vers-image.com/photo.jpg">

            <button type="submit" class="btn btn-green" style="width: 100%; font-size: 1.1rem; margin-top: 10px;">🚀 Publier l'annonce</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php?action=ads" style="color: #64748b; text-decoration: none; font-weight: 600;">← Retour aux annonces</a>
        </div>
    </div>
</body>
</html>