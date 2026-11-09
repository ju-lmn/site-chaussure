<?php
require_once __DIR__ . '/../config/database.php'; // garde ta ligne actuelle

// Récupération et vérification de l'id
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: codex.php');
    exit();
}

// Infos de la chaussure
$stmt = $connection->prepare("
    SELECT c.idChaussure, c.modele, c.prix, c.couleur,
           m.nom AS marque, m.pays,
           t.nom AS type
    FROM chaussure c
    JOIN marque m ON m.idMarque = c.idMarque
    JOIN `type` t ON t.idType = c.idType
    WHERE c.idChaussure = :id
");
$stmt->execute(['id' => $id]);
$chaussure = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$chaussure) {
    header('Location: codex.php');
    exit();
}

// Toutes les photos
$stmt = $connection->prepare("SELECT chemin FROM chaussure_img WHERE idChaussure = :id");
$stmt->execute(['id' => $id]);
$images = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Tailles et stocks
$stmt = $connection->prepare("
    SELECT t.valeur, ct.stock
    FROM chaussure_taille ct
    JOIN taille t ON t.idTaille = ct.idTaille
    WHERE ct.idChaussure = :id
    ORDER BY t.valeur
");
$stmt->execute(['id' => $id]);
$tailles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">  
<link rel="stylesheet" href="../css/styles.css">>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($chaussure['modele']) ?> | Codex</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header class="bandeau bandeau-haut">
        <div class="bandeau-contenu">
            <a href="codex.php" class="logo">Détails<span>.</span></a>
        </div>
    </header>

    <main class="details">
        <a href="codex.php" class="retour">← Retour au catalogue</a>

        <div class="details-grille">

            <!-- Galerie photos -->
            <section class="galerie">
                <div class="galerie-principale">
                    <?php if ($images): ?>
                        <img id="photo-principale"
                             src="<?= htmlspecialchars($images[0]) ?>"
                             alt="<?= htmlspecialchars($chaussure['modele']) ?>">
                    <?php else: ?>
                        <p class="pas-photo">Aucune photo disponible</p>
                    <?php endif; ?>
                </div>

                <?php if (count($images) > 1): ?>
                    <div class="miniatures">
                        <?php foreach ($images as $i => $img): ?>
                            <button type="button"
                                    class="miniature <?= $i === 0 ? 'active' : '' ?>"
                                    data-src="<?= htmlspecialchars($img) ?>">
                                <img src="<?= htmlspecialchars($img) ?>" alt="Vue <?= $i + 1 ?>">
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>

            <!-- Informations -->
            <section class="infos">
                <span class="infos-marque"><?= htmlspecialchars($chaussure['marque']) ?></span>
                <h1 class="infos-modele"><?= htmlspecialchars($chaussure['modele']) ?></h1>
                <p class="infos-prix"><?= number_format($chaussure['prix'], 2, ',', ' ') ?> €</p>

                <ul class="caracteristiques">
                    <li><span>Type</span><?= htmlspecialchars($chaussure['type']) ?></li>
                    <li><span>Couleur</span><?= htmlspecialchars($chaussure['couleur'] ?? '-') ?></li>
                    <li><span>Marque d'origine</span><?= htmlspecialchars($chaussure['pays'] ?? '-') ?></li>
                </ul>

                <h2 class="titre-section">Tailles disponibles</h2>
                <?php if ($tailles): ?>
                    <div class="tailles">
                        <?php foreach ($tailles as $t): ?>
                            <?php $dispo = (int) $t['stock'] > 0; ?>
                            <div class="taille <?= $dispo ? '' : 'epuise' ?>">
                                <strong><?= (float) $t['valeur'] ?></strong>
                                <small><?= $dispo ? $t['stock'] . ' en stock' : 'Épuisé' ?></small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="pas-photo">Aucune taille renseignée.</p>
                <?php endif; ?>
            </section>

        </div>
    </main>

    <footer class="bandeau bandeau-bas">
        <div class="bandeau-contenu">
            <p>&copy; <?= date('Y') ?>Tous droits réservés.</p>
            <p>Marques, modèles, tailles et stocks.</p>
        </div>
    </footer>

    <script>
        // Clic sur une miniature : change la photo principale
        const principale = document.getElementById('photo-principale');
        document.querySelectorAll('.miniature').forEach(btn => {
            btn.addEventListener('click', () => {
                principale.src = btn.dataset.src;
                document.querySelectorAll('.miniature').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            });
        });
    </script>

</body>
</html>