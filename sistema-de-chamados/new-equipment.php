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

    <form action="add-equipment.php" method="POST" class="new-problem">
        <fieldset>
            <legend>Novo equipamento</legend>
            <input type="text" name="equipment" placeholder="equipamento">
            <input type="submit" value="enviar">
        </fieldset>
    </form>
</body>
</html>