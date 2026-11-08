<?php
try {
    $dns = "mysql:host=gateway01.eu-central-1.prod.aws.tidbcloud.com;
            port=4000;
            dbname=gestion_chaussures;";
    $utilisateur = "3fA3VaFNw2q7T3k.root";
    $mdpasse = "pKZklrrhAQMr1qud";
    $options = [
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        PDO::MYSQL_ATTR_SSL_CA => true,
    ];

    $connexion = new PDO($dns, $utilisateur, $mdpasse,);  
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}
