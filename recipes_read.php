<?php
session_start();
require_once(__DIR__ . '/dataBaseConnect.php');
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/variables.php');

$getData = $_GET;


if (!isset($getData['id']) || !is_numeric($getData['id'])) {
   $_SESSION['message_error'] = 'La recette n\'existe pas';
   var_dump($getData);
   die();   
}

else {
    $recipe_id = $getData['id'];

    $sqlQuery = 'SELECT * FROM recipes WHERE is_enabled = :is_enabled AND recipe_id = :id';
    $recipesStatement = $mysqlClient->prepare($sqlQuery);
    $recipesStatement->execute([
        'id' => (int)$getData['id'],
        'is_enabled' => 1,
    ]);
    $recipe = $recipesStatement->fetch(PDO::FETCH_ASSOC);

    // var_dump($recipe);
    // die();
}
?>
<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/header.php'); ?>
    <div class="container">
        <?php if (isset($recipe)) : ?>
            <h1>Détails de la Recette</h1>

            <div class="card">

                <div class="card-body">
                    <h3 class="card-title"><?php echo $recipe['title']; ?></h3>
                    <p class="card-text"><b>Email</b> : <?php echo $recipe['author']; ?></p>
                    <p class="card-text"><b>Description de la recette</b> : <?php echo $recipe['recipe']; ?></p>
                    <p class="card-text"><b>Status</b> : <?php echo $recipe['is_enabled'] ? 'visible' : 'non visible'; ?></p>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
                <p><?php echo $_SESSION['message_error'] ?></p>
            </div>
        <?php endif; ?>
    </div>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>