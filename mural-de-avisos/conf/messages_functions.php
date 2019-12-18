<?php

include_once 'database_functions.php';
include_once 'users_functions.php';
include_once 'categories_functions.php';

function add_message($userId, $categoryId, $message) {
    $stmt = db()->prepare("
        INSERT INTO messages (user_id, category_id, message)
        VALUES ('$userId', '$categoryId', '$message')
    ");
    $exec = $stmt->execute();

    checkError($stmt);

    return $exec;

}

function del_message($id) {
    $stmt = db()->prepare("
        DELETE FROM messages
        WHERE id = $id
    ");

    $stmt->execute();

    checkError($stmt);
}

function get_messages_by_category($cat_id) {
    return get_messages(null, $cat_id);
}

function get_message($id) {
    $messages = get_messages($id);
    return array_pop($messages);
}

function get_messages($id = null, $cat_id = null) {
    $where = '';
    if (!is_null($id)) {
        $where = "WHERE m.id = $id";
    } else if (!is_null($cat_id)) {
        $where = "WHERE c.id = $cat_id";
    }
    $stmt = db()->prepare("
        SELECT m.id         AS mes_id,
               m.message    AS mes_message,
               m.created_at AS mes_created_at,
               u.id         AS usr_id,
               u.username   AS usr_username,
               u.email      AS usr_email,
               u.name       AS usr_name,
               c.id         AS cat_id,
               c.category   AS cat_category
        FROM   messages m
               JOIN users u
                 ON u.id = m.user_id
               JOIN categories c
                 ON c.id = m.category_id
        $where
        ORDER  BY m.created_at DESC
    ");
    $stmt->execute();
    checkError($stmt);

    return $stmt->fetchAll();
}

?>