<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($ad['title']) ?> - Campus Market</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: var(--bg-color); padding: 40px 20px;">

    <div class="container" style="max-width: 900px; margin: 0 auto;">
        <a href="index.php?action=ads" class="btn" style="background-color: #64748b; margin-bottom: 20px;">← Retour aux annonces</a>

        <div style="background: var(--card-bg); border-radius: var(--radius); overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); display: flex; flex-wrap: wrap;">
            
            <div style="flex: 1; min-width: 350px; background: #f1f5f9;">
                <?php $imgUrl = !empty($ad['image_url']) ? htmlspecialchars($ad['image_url']) : 'https://placehold.co/600x400/e2e8f0/64748b?text=Pas+d\'image&font=Poppins'; ?>
                <img src="<?= $imgUrl ?>" style="width: 100%; height: 100%; object-fit: cover; max-height: 500px;">
            </div>

            <div style="flex: 1; min-width: 350px; padding: 40px; display: flex; flex-direction: column;">
                <span style="color: var(--primary-color); text-transform: uppercase; font-weight: bold; font-size: 0.8rem; letter-spacing: 1px;"><?= htmlspecialchars($ad['category_name']) ?></span>
                <h1 style="font-size: 2.2rem; margin: 10px 0;"><?= htmlspecialchars($ad['title']) ?></h1>
                
                <div style="font-size: 2rem; color: var(--accent-color); font-weight: bold; margin-bottom: 20px;">
                    <?= number_format($ad['price'], 2) ?> €
                </div>

                <div style="border-top: 1px solid #e2e8f0; padding-top: 20px; margin-bottom: 30px;">
                    <h3 style="font-size: 1rem; color: #64748b;">Description</h3>
                    <p style="color: var(--text-color); line-height: 1.8; font-size: 1.1rem;">
                        <?= nl2br(htmlspecialchars($ad['description'])) ?>
                    </p>
                </div>

                <div style="margin-top: auto; background: #f8fafc; padding: 20px; border-radius: 8px;">
                    <p style="margin-bottom: 10px; font-size: 0.9rem; color: #64748b;">Vendeur : <strong><?= htmlspecialchars($ad['seller_email']) ?></strong></p>
                    <a href="mailto:<?= $ad['seller_email'] ?>?subject=Interet pour votre annonce : <?= htmlspecialchars($ad['title']) ?>" class="btn btn-green" style="width: 100%; text-align: center; font-size: 1.1rem;">📧 Contacter le vendeur</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>