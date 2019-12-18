<?php

include 'conf/init.php';

$id = $_GET['id'] ?? false;
if ($id === false) {
    redirect('index.php');
}

$message = get_message($id);
if ($message['usr_id'] != currentUserId() && !is_admin()) {
    redirect('index.php');
}

del_message($id);
redirect('index.php');

?>