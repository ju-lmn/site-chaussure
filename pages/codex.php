<?php
$select = $connexion-> query("select modele from chaussure");
$chaussures = $select->fetchAll(PDO::FETCH_OBJ);

foreach ($chaussures as $chaussure) {
    echo ("<img witdh= 150px src= '../assets/images/chaussures/" . $chaussure->modele . ".jpg' alt= '" . $chaussure->modele . "'>");
    echo "<h1>Modèle : " . $chaussure->modele . "</H1>";
}
