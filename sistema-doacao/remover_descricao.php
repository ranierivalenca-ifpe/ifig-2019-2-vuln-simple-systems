<?php

include 'conf/init.php';

$id = $_GET['id'] ?? false;
if ($id === false) {
    redirect('index.php');
}

$description = get_description($id);
if ($description['usr_id'] != currentUserId() && !is_admin()) {
    redirect('index.php');
}

del_description($id);
redirect('index.php');

?>