<?php
session_start();
// var_dump($_SESSION['user_logged']);
// die();

require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

$post_data = $_POST;

if (isset($post_data['email']) &&  isset($post_data['password'])) {

    if (!filter_var($post_data['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['$message_error'] = 'Email ou mot de passe incorrect';
        // return;
    }else{

        $email = $post_data['email'];
        $password = $post_data['password'];
    
        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                // $user_logged = $user;
                $_SESSION['user_logged'] = [
                    'email' => $user['email'], 
                    'full_name' => $user['full_name']];
                // $_SESSION['user_logged_name'] = $user['full_name'];
                
                $_SESSION['message_success'] = 'Vous êtes bien connecté';
                break;
            } else {
                
                $_SESSION['$message_error'] = 'Email ou mot de passe incorrect';
                // return;
            }
        }
        
        if (!$_SESSION['user_logged']) {
            $_SESSION['$message_error'] = 'Les information ne permmettent pas de vous connecter';
            // return;
        }
    }
    redirectToUrl('index.php');


}


?>