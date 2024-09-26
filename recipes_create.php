<?php
session_start();
?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'ajout de recettes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/header.php'); ?>
    <div class="container">
        <?php if (isset($_SESSION['user_logged'])) : ?>
            <h1>Ajoutez une recette</h1>
            <form action="recipes/submit_recipes.php" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de la recette</label>
                    <input class="form-control" placeholder="titre" id="title" name="title"></input>
                </div>
                <div class="mb-3">
                    <label for="recipe" class="form-label">Description de la recette</label>
                    <textarea class="form-control" placeholder="Ecrivez votre recette" id="recipe" name="recipe"></textarea>
                </div>
                <div class="form-check form-switch mb-3">
                    <label class="form-check-label" for="is_enabled">Visible</label>
                    <input class="form-check-input" type="checkbox" role="switch" id="is_enabled" name="is_enabled" value="true">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <br />
        <?php endif ?>
    </div>
    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>

