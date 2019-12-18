<?php

include_once 'users_functions.php';
include_once 'database_functions.php';

function login($username, $pw) {
    $stmt = db()->prepare("
        SELECT *
        FROM   users
        WHERE  username = '$username'
               AND password = '$pw'
    ");
    $stmt->execute();

    checkError($stmt);

    if ($stmt->rowCount() == 0) {
        return false;
    }
    $data = $stmt->fetch();

    $_SESSION['logged'] = true;
    $_SESSION['userId'] = $data['id'];
    $_SESSION['user'] = $data;
    return true;
}

function is_logged() {
    return $_SESSION['logged'] ?? false;
}

function is_admin() {
    return is_logged() && $_SESSION['user']['admin'] == 1;
}

function currentUser() {
    return $_SESSION['user'] ?? false;
}

function currentUserId() {
    return $_SESSION['userId'] ?? false;
}

function logout() {
    session_destroy();
}

?>