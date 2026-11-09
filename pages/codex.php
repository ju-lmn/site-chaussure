<?php
require_once __DIR__ . '/../config/database.php'; // garde ta ligne actuelle


$select = $connection->query("
    SELECT c.idChaussure, c.modele, c.prix, m.nom AS marque, i.chemin
    FROM chaussure c
    JOIN marque m ON m.idMarque = c.idMarque
    JOIN chaussure_img i ON i.idChaussure = c.idChaussure
");

$chaussures = $select->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Codex | Site Chaussure</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

    <header class="bandeau bandeau-haut">
        <div class="bandeau-contenu">
            <a href="codex.php" class="logo">Catalogue<span>.</span></a>
        </div>
    </header>

    <main class="catalogue">
        <?php foreach ($chaussures as $chaussure): ?>
            <a class="card" href="details.php?id=<?= (int) $chaussure['idChaussure'] ?>">
                <div class="card-img">
                    <img src="<?= htmlspecialchars($chaussure['chemin']) ?>"
                         alt="<?= htmlspecialchars($chaussure['modele']) ?>">
                </div>
                <div class="card-body">
                    <span class="card-marque"><?= htmlspecialchars($chaussure['marque']) ?></span>
                    <h2 class="card-modele"><?= htmlspecialchars($chaussure['modele']) ?></h2>
                    <span class="card-prix"><?= number_format($chaussure['prix'], 2, ',', ' ') ?> €</span>
                </div>
            </a>
        <?php endforeach; ?>
    </main>

    <footer class="bandeau bandeau-bas">
        <div class="bandeau-contenu">
            <p>&copy; <?= date('Y') ?>Tous droits réservés.</p>
            <p>Marques, modèles, tailles et stocks.</p>
        </div>
    </footer>

</body>
</html>
