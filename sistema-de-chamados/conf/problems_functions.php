<?php

include_once 'database_functions.php';
include_once 'users_functions.php';

function add_problem($userId, $equipmentId, $problem) {
    $stmt = db()->prepare("
        INSERT INTO problems (user_id, equipment_id, problem)
        VALUES ('$userId', '$equipmentId', '$problem')
    ");
    $exec = $stmt->execute();

    checkError($stmt);

    return $exec;

}

function del_problem($id) {
    $stmt = db()->prepare("
        DELETE FROM problems
        WHERE id = $id
    ");

    $stmt->execute();

    checkError($stmt);
}

function get_problems_by_equipment($eq_id) {
    return get_problems(null, $eq_id);
}

function get_problem($id) {
    $problems = get_problems($id);
    return array_pop($problems);
}

function get_problems($id = null, $eq_id = null) {
    $where = '';
    if (!is_null($id)) {
        $where = "WHERE p.id = $id";
    } else if (!is_null($eq_id)) {
        $where = "WHERE e.id = $eq_id";
    }
    $stmt = db()->prepare("
        SELECT p.id         AS prb_id,
               p.problem    AS prb_problem,
               p.created_at AS prb_created_at,
               u.id         AS usr_id,
               u.username   AS usr_username,
               u.email      AS usr_email,
               u.name       AS usr_name,
               e.id         AS eq_id,
               e.equipment   AS eq_equipment
        FROM   problems p
               JOIN users u
                 ON u.id = p.user_id
               JOIN equipments e
                 ON e.id = p.equipment_id
        $where
        ORDER  BY p.created_at DESC
    ");
    $stmt->execute();
    checkError($stmt);

    return $stmt->fetchAll();
}

?>