<?php

include_once 'database_functions.php';

function add_equipment($equipment) {
    $stmt = db()->prepare("
        INSERT INTO equipments (equipment)
        VALUES ('$equipment')
    ");
    $exec = $stmt->execute();

    checkError($stmt);

    return $exec;
}

function get_equipment($id) {
    $equipments = get_equipments($id);
    return array_pop($equipments);
}

function get_equipments($id = null) {
    $where = '';
    if (!is_null($id)) {
        $where = "WHERE id = $id";
    }
    $stmt = db()->prepare("
        SELECT *
        FROM   equipments
        $where
        ORDER  BY equipment
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

?>