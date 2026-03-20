<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .hero { text-align: center; padding: 80px 20px; background: white; border-radius: var(--radius); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-top: 40px; }
        .hero h1 { font-size: 2.5rem; color: var(--primary-color); margin-bottom: 20px; }
        .hero p { font-size: 1.2rem; color: #64748b; margin-bottom: 30px; }
        .action-buttons { display: flex; justify-content: center; gap: 15px; flex-wrap: wrap; }
    </style>
</head>
<body>
    <div class="hero">
        <h1>🎓 Bienvenue sur Campus Market</h1>
        <p>La plateforme 100% étudiante pour acheter, vendre et échanger votre matériel !</p>
        
        <div class="action-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="index.php?action=ads" class="btn">🛍️ Parcourir les annonces</a>
                <a href="index.php?action=create_ad" class="btn btn-green">➕ Déposer une annonce</a>
                
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="index.php?action=admin_dashboard" class="btn btn-danger">🛡️ Espace Admin</a>
                <?php endif; ?>
                
                <a href="index.php?action=logout" class="btn" style="background-color: #64748b;">Déconnexion</a>
                
            <?php else: ?>
                <a href="index.php?action=ads" class="btn">🛍️ Voir les annonces</a>
                <a href="index.php?action=login" class="btn btn-green">👋 Se connecter</a>
                <a href="index.php?action=register" class="btn" style="background-color: #64748b;">Créer un compte</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>