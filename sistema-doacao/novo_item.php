<?php
    include 'conf/init.php';
    if (!is_logged()) {
        redirect('index.php');
    }
    if (!is_admin()) {
        redirect('index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= TITLE ?></title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><?= currentUser()['name'] ?> <span>(<?= currentUser()['username'] ?>)</span></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>

    <h1><?= TITLE ?></h1>

    <form action="adicionar_item.php" method="POST" class="new-item">
        <fieldset>
            <legend>Novo tipo de item</legend>
            <input type="text" name="item" placeholder="tipo de item">
            <input type="submit" value="enviar">
        </fieldset>
    </form>
</body>
</html>