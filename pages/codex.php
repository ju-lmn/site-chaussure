<?php
require_once __DIR__ . '/../config/database.php';


$select = $connection->query
("SELECT modele, idMarque, chemin 
FROM chaussure c
JOIN chaussure_img  i 
on i.idChaussure = c.idChaussure
 ");

$chaussures = $select->fetchAll(PDO::FETCH_ASSOC);


foreach ($chaussures as $chaussure) {
    echo ("<a href='details.php?'>");
    echo ("<img width='150' src='" . $chaussure['chemin'] . "'>");
    echo ("<h1>" . $chaussure['modele'] . "</h1>");
    echo ("</a>");
}