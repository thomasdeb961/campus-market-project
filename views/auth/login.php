<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Campus Market</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; padding: 50px; }
        form { background: white; padding: 20px; border-radius: 8px; display: inline-block; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        input { display: block; margin: 10px auto; padding: 10px; width: 80%; }
        button { padding: 10px 20px; background-color: #2980b9; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Se connecter à Campus Market</h1>

    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST" action="index.php?action=login">
        <input type="email" name="email" placeholder="Adresse email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Connexion</button>
    </form>

    <p>Pas encore de compte ? <a href="index.php?action=register">Créer un compte</a></p>
</body>
</html>