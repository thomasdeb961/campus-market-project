<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <h1>🛡️ Espace Modération</h1>
        <a href="index.php" class="btn" style="background-color: #64748b;">Retour au site normal</a>
    </div>

    <div style="background: var(--card-bg); padding: 25px; border-radius: var(--radius); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <h2 style="margin-top: 0; color: var(--primary-color);">Toutes les annonces de la plateforme</h2>
        
        <div class="table-responsive">
            <table class="admin-table">
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
                        <tr><td colspan="5" style="text-align: center; padding: 20px; color: #64748b;">Aucune annonce sur le site.</td></tr>
                    <?php else: ?>
                        <?php foreach ($ads as $ad): ?>
                            <tr>
                                <td><span style="background: #e2e8f0; padding: 4px 8px; border-radius: 4px; font-weight: 600; font-size: 0.85rem; color: #475569;">#<?= $ad['id'] ?></span></td>
                                <td style="font-weight: 600;"><?= htmlspecialchars($ad['title']) ?></td>
                                <td style="color: var(--accent-color); font-weight: bold;"><?= $ad['price'] ?> €</td>
                                <td style="color: #64748b; font-size: 0.9rem;"><?= date('d/m/Y à H:i', strtotime($ad['created_at'])) ?></td>
                                <td>
                                    <a href="index.php?action=admin_delete_ad&id=<?= $ad['id'] ?>" class="btn btn-danger" style="padding: 6px 12px; font-size: 0.85rem;" onclick="return confirm('ADMIN : Supprimer définitivement cette annonce ?');">🗑️ Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>