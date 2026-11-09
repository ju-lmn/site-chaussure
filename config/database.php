<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

 $options = [
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        PDO::MYSQL_ATTR_SSL_CA => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,];

try {
    $dns = "mysql:host={$_ENV['DB_HOST']};
                  port={$_ENV['DB_PORT']};
                  dbname={$_ENV['DB_NAME']};";
    $utilisateur = $_ENV['DB_USER'];
    $mdpasse = $_ENV['DB_PASSWORD'];
    $connection = new PDO($dns, $utilisateur, $mdpasse, $options);  
} 
catch (PDOException $e)
{
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}
