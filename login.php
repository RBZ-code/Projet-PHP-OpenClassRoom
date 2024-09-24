<?php
$post_data = $_POST;

if (isset($post_data['email']) &&  isset($post_data['password'])) {

    if (!filter_var($post_data['email'], FILTER_VALIDATE_EMAIL)) {
        $message_error = 'Email ou mot de passe incorrect';
        // return;
    }

    $email = $post_data['email'];
    $password = $post_data['password'];

    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $user_logged = $user;
            $message_success = 'Vous êtes bien connecté';
            break;
        } else {

            $message_error = 'Email ou mot de passe incorrect';
            // return;
        }
    }

    if (!isset($user_logged)) {
        $message_error = 'Les information ne permmettent pas de vous connecter';
        // return;
    }
}

?>


<?php if (!isset($user_logged)) : ?>

    <?php if (isset($message_error)) : ?>
        <div class="alert alert-danger" role="alert">
            <p><?php echo $message_error ?></p>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name='email' aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name='password' placeholder="Password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

<?php elseif ($user_logged) : ?>
    <h1 style='text-align:center;'>Bienvenue <?php echo htmlspecialchars($user_logged['full_name']) ?></h1>
<?php endif; ?>