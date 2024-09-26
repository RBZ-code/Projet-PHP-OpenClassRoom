

<?php if (!isset($_SESSION['user_logged'])) : ?>

    <?php if (isset($_SESSION['$message_error'])) : ?>
        <div class="alert alert-danger" role="alert">
            <p><?php echo $_SESSION['$message_error'] ?></p>
    <?php endif; ?>

    <form action="submit_login.php" method="POST">
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

<?php elseif ($_SESSION['user_logged']) : ?>
   
    <h1 style='text-align:center;'>Bienvenue <?php echo $_SESSION['user_logged']['full_name'] ?></h1>
<?php endif; ?>