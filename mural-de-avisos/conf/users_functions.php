<?php

include_once 'database_functions.php';

function add_user($username, $email, $password, $name, $admin) {
    $stmt = db()->prepare("
        INSERT INTO users (username, email, password, name, admin)
        VALUES ('$username', '$email', '$password', '$name', '$admin')
    ");
    $exec = $stmt->execute();
    checkError($stmt);

    return $exec;
}

function user_info($id) {
    $stmt = db()->prepare("
        SELECT *
        FROM   users
        WHERE  id = $id
    ");
    $stmt->execute();
    checkError($stmt);

    return $stmt->fetchAll();
}

function email_exists($email) {
    $stmt = db()->prepare("
        SELECT *
        FROM   users
        WHERE  email = '$email'
    ");
    $stmt->execute();
    checkError($stmt);

    return $stmt->rowCount() > 0;
}

function username_exists($username) {
    $stmt = db()->prepare("
        SELECT *
        FROM   users
        WHERE  username = '$username'
    ");
    $stmt->execute();
    checkError($stmt);

    return $stmt->rowCount() > 0;
}

?>