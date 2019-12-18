<?php

include 'conf/init.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= TITLE ?></title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <form action="add-user.php" method="POST">
        <input type="hidden" name="admin" value="1">
        <fieldset>
            <?php if ($_GET['mr'] ?? false !== false ): ?>
                <span class="msg"><?= $_GET['mr'] ?></span>
            <?php endif ?>
            <legend>Registro</legend>
            <input type="text" placeholder="Nome de usuário" name="username" value="<?= $_GET['username'] ?? '' ?>">
            <input type="email" placeholder="E-mail" name="email" value="<?= $_GET['email'] ?? '' ?>">
            <input type="text" placeholder="Nome" name="name" value="<?= $_GET['name'] ?? '' ?>">
            <input type="password" placeholder="Senha" name="pw">
            <input type="password" placeholder="Confirme a senha" name="pw2">
            <input type="submit" name="submit" value="ok">
        </fieldset>
    </form>
    <h3><a href="index.php">Voltar</a></h3>
</body>
</html>