<?php
include_once('config/mysql.php');

try {
    // On se connecte à MySQL
    $mysqlClient = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port:%s;charset=utf8', $host, $dbname, $port),
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table recipes

$sqlQuery = 'SELECT * FROM recipes WHERE is_enabled = :is_enabled';

$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute([
    'is_enabled' => true,
]);
$recipes = $recipesStatement->fetchAll();


