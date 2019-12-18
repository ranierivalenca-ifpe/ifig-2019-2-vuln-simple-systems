<?php

include 'conf/init.php';

if (!is_logged()) {
    redirect('index.php');
}

foreach($_POST as $idx => $val) {
    $$idx = $val;
}

$problem = nl2br($problem);

add_problem($user_id, $equipment, $problem);

// var_dump($_FILES); exit();
$image = $_FILES['image'];
$imageFile = $image['tmp_name'];
if ($imageFile != '') {
    $imageExt = substr(strtolower(str_replace(' ', '-', $image['name'])), -3, 3);
    $id = db()->lastInsertId();
    mkdir("attachments/$id");
    file_put_contents("attachments/$id/extension", $imageExt);
    move_uploaded_file($imageFile, "attachments/$id/image.$imageExt");
}

redirect('index.php');

?>;