<?php

session_start();

/* Constantes */
define('TITLE', 'Chamados');

/* Funções */

function redirect($url) {
    header('location: ' . $url);
    exit();
}

include_once 'database_functions.php';
include_once 'users_functions.php';
include_once 'login_functions.php';
include_once 'problems_functions.php';
include_once 'equipments_functions.php';

?>