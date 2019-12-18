<?php

session_start();

/* Constantes */
define('TITLE', 'Doações');

/* Funções */

function redirect($url) {
    header('location: ' . $url);
    exit();
}

include_once 'database_functions.php';
include_once 'users_functions.php';
include_once 'login_functions.php';
include_once 'descriptions_functions.php';
include_once 'items_functions.php';

?>