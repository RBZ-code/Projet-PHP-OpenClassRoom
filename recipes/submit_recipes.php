<?php
session_start();
include_once('../dataBaseConnect.php');


$postData = $_POST;


if (isset($_SESSION['user_logged'])) {

    if (!isset($postData['title']) || !isset($postData['recipe'])) {

        $_SESSION['message_error'] = 'Les information envoyé ne sont pas completes.';
        // return;

    } elseif (empty($postData['recipe']) || empty($postData['title'])) {

        $_SESSION['message_error'] = 'Le titre ou la recette ne peuvent pas être vide';
    } else {
        // Sécurisation des entrées utilisateur
        $title = htmlspecialchars(trim($postData['title']));
        $recipe = htmlspecialchars(trim($postData['recipe']));

        // Vérification de la visibilité de la recette
        $is_enabled = isset($postData['is_enabled']) ? 1 : 0;
        // Récupération de l'e-mail de l'utilisateur connecté
        $author = htmlspecialchars($_SESSION['user_logged']['email']);

        $insertRecipe = $mysqlClient->prepare('INSERT INTO recipes (title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)');
        $insertRecipe->execute([
            'title' => $title,
            'recipe' => $recipe,
            'author' => $author,
            'is_enabled' => $is_enabled,
        ]);
        $_SESSION['message_sucess'] = 'Recette bien ajoutée';
    }
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
    <?php require_once(__DIR__ . '/../header.php'); ?>
    <div class="container">
        <?php if (isset($_SESSION['message_sucess'])) : ?>
            <h1><?php echo $_SESSION['message_sucess'] ?></h1>

            <div class="card">

                <div class="card-body">
                    <h3 class="card-title"><?php echo htmlspecialchars($postData['title']); ?></h3>
                    <p class="card-text"><b>Email</b> : <?php echo htmlspecialchars($_SESSION['user_logged']['email']); ?></p>
                    <p class="card-text"><b>Description de la recette</b> : <?php echo htmlspecialchars($postData['recipe']); ?></p>
                    <p class="card-text"><b>Status</b> : <?php echo $postData['is_enabled'] ? 'visible' : 'non visible'; ?></p>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-danger" role="alert">
            <p><?php echo $_SESSION['$message_error'] ?></p>
            </div>
        <?php endif; ?>
    </div>
    <?php require_once(__DIR__ . '/../footer.php'); ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>