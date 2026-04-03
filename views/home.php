<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; width: 100vw; margin: 0; padding: 0; background-color: var(--bg-color);">
    <div style="background: var(--card-bg); padding: 60px 30px; border-radius: var(--radius); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); text-align: center; max-width: 800px; width: 90%;">        
        <div style="font-size: 4rem; margin-bottom: 10px;">🎓</div>
        <h1 style="font-size: 2.8rem; color: var(--primary-color); margin-bottom: 15px; line-height: 1.2;">Bienvenue sur<br>Campus Market</h1>
        
        <p style="font-size: 1.2rem; color: #64748b; margin-bottom: 40px; max-width: 100%; margin-left: auto; margin-right: auto;">
            La plateforme 100% étudiante pour acheter, vendre et échanger votre matériel en toute sécurité !
        </p>
        
        <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="index.php?action=ads" class="btn" style="font-size: 1.1rem; padding: 12px 24px;">🛍️ Parcourir les annonces</a>
                <a href="index.php?action=create_ad" class="btn btn-green" style="font-size: 1.1rem; padding: 12px 24px;">➕ Déposer une annonce</a>
                
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <div style="flex-basis: 100%; height: 5px;"></div> <a href="index.php?action=admin_dashboard" class="btn btn-danger" style="font-size: 1rem;">🛡️ Espace Admin</a>
                <?php endif; ?>
                
                <a href="index.php?action=logout" class="btn" style="background-color: #e2e8f0; color: #475569; font-size: 1rem;">Déconnexion</a>
                
            <?php else: ?>
                <a href="index.php?action=ads" class="btn" style="font-size: 1.1rem; padding: 12px 24px;">🛍️ Voir les annonces</a>
                <a href="index.php?action=login" class="btn btn-green" style="font-size: 1.1rem; padding: 12px 24px;">👋 Se connecter</a>
                <a href="index.php?action=register" class="btn" style="background-color: #e2e8f0; color: #475569; font-size: 1.1rem; padding: 12px 24px;">Créer un compte</a>
            <?php endif; ?>
            
        </div>
    </div>
    
    <p style="margin-top: 40px; color: #94a3b8; font-size: 0.9rem;">© <?= date('Y') ?> Campus Market. Projet étudiant.</p>

</body>
</html>