<?php

include_once 'database_functions.php';
include_once 'users_functions.php';

function add_description($userId, $itemId, $description) {
    $stmt = db()->prepare("
        INSERT INTO descriptions (user_id, item_id, description)
        VALUES ('$userId', '$itemId', '$description')
    ");
    $exec = $stmt->execute();

    checkError($stmt);

    return $exec;

}

function del_description($id) {
    $stmt = db()->prepare("
        DELETE FROM descriptions
        WHERE id = $id
    ");

    $stmt->execute();

    checkError($stmt);
}

function get_descriptions_by_item($itm_id) {
    return get_descriptions(null, $itm_id);
}

function get_description($id) {
    $descriptions = get_descriptions($id);
    return array_pop($descriptions);
}

function get_descriptions($id = null, $itm_id = null) {
    $where = '';
    if (!is_null($id)) {
        $where = "WHERE d.id = $id";
    } else if (!is_null($itm_id)) {
        $where = "WHERE i.id = $itm_id";
    }
    $stmt = db()->prepare("
        SELECT d.id          AS dsc_id,
               d.description AS dsc_description,
               d.created_at  AS dsc_created_at,
               u.id          AS usr_id,
               u.username    AS usr_username,
               u.email       AS usr_email,
               u.name        AS usr_name,
               i.id          AS itm_id,
               i.item        AS itm_item
        FROM   descriptions d
               JOIN users u
                 ON u.id = d.user_id
               JOIN items i
                 ON i.id = d.item_id
        $where
        ORDER  BY d.created_at DESC
    ");
    $stmt->execute();
    checkError($stmt);

    return $stmt->fetchAll();
}

?>