<?php

if (!isset($_SESSION['user_logged'])) {
    echo('Il faut être authentifié pour cette action.');
    exit;
}