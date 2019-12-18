<?php

include 'conf/init.php';

if (!is_logged()) {
    redirect('index.php');
}

$equipment = $_POST['equipment'];
add_equipment($equipment);
redirect('index.php');

?>