<?php

include 'conf/init.php';

if (!is_logged()) {
    redirect('index.php');
}

$item = $_POST['item'];
add_item($item);
redirect('index.php');

?>