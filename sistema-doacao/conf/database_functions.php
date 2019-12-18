<?php

$db = null;

function db() {
    global $db;
    if (!is_null($db)) return $db;
    $db = new PDO("mysql:host=localhost;dbname=web20192doacoes", "web20192doacoes", "web20192doacoes");
    return $db;
}

function checkError($stmt) {
    if ($stmt->errorCode() != 0) {
        echo "<pre class='error'>";
        print_r(debug_backtrace());
        print_r($stmt->errorInfo());
        echo "</pre>";
        exit();
    }
}

?>