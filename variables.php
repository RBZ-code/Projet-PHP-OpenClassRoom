<?php
include_once('dataBaseConnect.php');



$sqlQuery = 'SELECT * FROM recipes WHERE is_enabled = :is_enabled';

$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute([
    'is_enabled' => true,
]);
$recipes = $recipesStatement->fetchAll();



$sqlQuery = 'SELECT * FROM users';
$usersStatement = $mysqlClient->prepare($sqlQuery);
$usersStatement->execute();
$users = $usersStatement->fetchAll();

