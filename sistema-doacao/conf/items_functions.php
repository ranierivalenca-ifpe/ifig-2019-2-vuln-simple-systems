<?php

include_once 'database_functions.php';

function add_item($item) {
    $stmt = db()->prepare("
        INSERT INTO items (item)
        VALUES ('$item')
    ");
    $exec = $stmt->execute();

    checkError($stmt);

    return $exec;
}

function get_item($id) {
    $items = get_items($id);
    return array_pop($items);
}

function get_items($id = null) {
    $where = '';
    if (!is_null($id)) {
        $where = "WHERE id = $id";
    }
    $stmt = db()->prepare("
        SELECT *
        FROM   items
        $where
        ORDER  BY item
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

?>