<?php

session_start();

/* Constantes */
define('TITLE', 'Mural');

/* Funções */

function redirect($url) {
    header('location: ' . $url);
    exit();
}

include_once 'database_functions.php';
include_once 'users_functions.php';
include_once 'login_functions.php';
include_once 'messages_functions.php';
include_once 'categories_functions.php';

?>