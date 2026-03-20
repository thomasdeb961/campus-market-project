<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration - Campus Market</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #2c3e50; color: white; padding: 20px; }
        .container { background: white; color: #333; padding: 20px; border-radius: 8px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px;}
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
        .btn-danger { background-color: #e74c3c; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; font-weight: bold; }
        .btn-back { background-color: #7f8c8d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛡️ Espace Modération (Admin)</h1>
            <a href="index.php" class="btn-back">Retour au site normal</a>
        </div>

        <h2>Toutes les annonces de la plateforme</h2>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Prix</th>
                    <th>Date de création</th>
                    <th>Action Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($ads)): ?>
                    <tr><td colspan="5">Aucune annonce sur le site.</td></tr>
                <?php else: ?>
                    <?php foreach ($ads as $ad): ?>
                        <tr>
                            <td>#<?= $ad['id'] ?></td>
                            <td><?= htmlspecialchars($ad['title']) ?></td>
                            <td><?= $ad['price'] ?> €</td>
                            <td><?= $ad['created_at'] ?></td>
                            <td>
                                <a href="index.php?action=admin_delete_ad&id=<?= $ad['id'] ?>" class="btn-danger" onclick="return confirm('ADMIN : Supprimer définitivement cette annonce ?');">Supprimer (Modération)</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>