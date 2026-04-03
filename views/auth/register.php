<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; width: 100vw; background-color: var(--bg-color);">    
<div style="background: var(--card-bg); padding: 40px; border-radius: var(--radius); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center;">        
        <h1 style="font-size: 1.8rem; margin-bottom: 20px; color: var(--accent-color);">✨ Rejoindre Campus Market</h1>
        
        <?php if (!empty($error)): ?>
            <div style="background-color: #fee2e2; color: var(--danger-color); padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; border: 1px solid #fca5a5; font-size: 0.9rem;">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div style="background-color: #d1fae5; color: var(--accent-color); padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; border: 1px solid #a7f3d0; font-size: 0.9rem; font-weight: 600;">
                <?= $success ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="index.php?action=register" style="box-shadow: none; padding: 0; margin: 0; background: transparent;">
            
            <div style="text-align: left; margin-bottom: 15px;">
                <label style="font-weight: 600; color: var(--text-color); font-size: 0.9rem; display: block; margin-bottom: 5px;">Adresse email étudiante</label>
                <input type="email" name="email" placeholder="etudiant@campus.fr" required style="margin-bottom: 0;">
            </div>

            <div style="text-align: left; margin-bottom: 25px;">
                <label style="font-weight: 600; color: var(--text-color); font-size: 0.9rem; display: block; margin-bottom: 5px;">Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" required style="margin-bottom: 0;">
            </div>

            <button type="submit" class="btn btn-green" style="width: 100%; font-size: 1.1rem;">S'inscrire</button>
        </form>
        
        <div style="margin-top: 25px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <p style="margin-bottom: 10px; font-size: 0.95rem;">Déjà un compte ? <a href="index.php?action=login" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Se connecter</a></p>
            <p><a href="index.php" style="color: #64748b; text-decoration: none; font-size: 0.9rem; font-weight: 600;">← Retour à l'accueil</a></p>
        </div>
    </div>

</body>
</html>