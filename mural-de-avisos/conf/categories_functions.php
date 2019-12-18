<?php

include_once 'database_functions.php';

function add_category($category) {
    $stmt = db()->prepare("
        INSERT INTO categories (category)
        VALUES ('$category')
    ");
    $exec = $stmt->execute();

    checkError($stmt);

    return $exec;
}

function get_category($id) {
    $categories = get_categories($id);
    return array_pop($categories);
}

function get_categories($id = null) {
    $where = '';
    if (!is_null($id)) {
        $where = "WHERE id = $id";
    }
    $stmt = db()->prepare("
        SELECT *
        FROM   categories
        $where
        ORDER  BY category
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

?>