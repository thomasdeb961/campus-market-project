<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Campus Market</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; padding: 50px; }
        form { background: white; padding: 20px; border-radius: 8px; display: inline-block; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        input { display: block; margin: 10px auto; padding: 10px; width: 80%; }
        button { padding: 10px 20px; background-color: #27ae60; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; margin-bottom: 15px; }
        .success { color: green; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Créer un compte</h1>

    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

    <form method="POST" action="index.php?action=register">
        <input type="email" name="email" placeholder="Adresse email étudiante" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
    
    <p>Déjà un compte ? <a href="index.php?action=login">Se connecter</a></p>
</body>
</html>