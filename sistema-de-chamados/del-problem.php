<?php

include 'conf/init.php';

$id = $_GET['id'] ?? false;
if ($id === false) {
    redirect('index.php');
}

$problem = get_problem($id);
if ($problem['usr_id'] != currentUserId() && !is_admin()) {
    redirect('index.php');
}

del_problem($id);
redirect('index.php');

?>