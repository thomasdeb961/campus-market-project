<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .auth-container { background: var(--card-bg); padding: 40px; border-radius: var(--radius); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; }
        .auth-container h1 { font-size: 1.8rem; margin-bottom: 20px; color: var(--accent-color); }
        form { box-shadow: none; padding: 0; margin: 0; }
    </style>
</head>
<body>
    <div class="auth-container">
        <h1>✨ Rejoindre Campus Market</h1>
        
        <?php if (!empty($error)) echo "<p style='color: var(--danger-color); margin-bottom: 15px;'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p style='color: var(--accent-color); margin-bottom: 15px;'>$success</p>"; ?>
        
        <form method="POST" action="index.php?action=register">
            <input type="email" name="email" placeholder="Adresse email étudiante" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" class="btn btn-green" style="width: 100%;">S'inscrire</button>
        </form>
        
        <p style="margin-top: 20px;">Déjà un compte ? <a href="index.php?action=login" style="color: var(--primary-color);">Se connecter</a></p>
        <p style="margin-top: 10px;"><a href="index.php" style="color: #64748b; text-decoration: none;">🏠 Retour à l'accueil</a></p>
    </div>
</body>
</html>