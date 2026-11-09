<?php
require_once __DIR__ . '/../config/database.php';

$stmt = $connection->query("SELECT * FROM chaussure where idChaussure = 1");
$chaussures = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($chaussures);
 


?>