<?php
require_once __DIR__ . '/../vendor/database.php';


$select = $connection->query("SELECT modele, idMarque, chaussure_img.chemin FROM chaussure
JOIN chaussure_img on chaussure.idChaussure = chaussure_img.idChaussure
WHERE chaussure.idChaussure=30001");

$chaussures = $select->fetchAll(PDO::FETCH_ASSOC);

foreach ($chaussures as $chaussure) {
    echo ("<a href= 'details.php?>");
    echo ("<img width= 150px src'" . $chaussure->chemin . "' alt='Chaussure'>");
    echo ("<h1>" . $chaussure->modele . "</h1>");
    echo ("</a>");
}
