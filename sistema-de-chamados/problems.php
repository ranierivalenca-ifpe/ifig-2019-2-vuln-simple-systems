<?php

include 'conf/init.php';
$eq_id = $_GET['eq'];

$problems = get_problems_by_equipment($eq_id);
$equipment = get_equipment($eq_id);

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
            <?php if (!is_logged()): ?>
                <li><a href="login.php">Registro / Login</a></li>
            <?php else: ?>
                <li><?= currentUser()['name'] ?> <span>(<?= currentUser()['username'] ?>)</span></li>
                <li><a href="logout.php">Sair</a></li>
            <?php endif ?>
        </ul>
    </nav>

    <h1><?= TITLE ?></h1>
    <h3>Problemas com o equipamento
        <span class="eq-text eq-<?= $equipment['id'] ?>"><?= $equipment['equipment'] ?></span>
    </h3>
    <br>
    <?php foreach ($problems as $problem): ?>
        <?php
            $fromUser = (is_logged() && $problem['usr_id'] == currentUserId()) || is_admin();
        ?>
        <div class="problem <?= $fromUser ? 'from-user' : '' ?>">
            <a href="problems.php?eq=<?= $problem['eq_id'] ?>" class="eq">
                <div class="equipment equipment-<?= $problem['eq_id'] ?>">
                    <?= $problem['eq_equipment'] ?>
                    <?php if ($fromUser): ?>
                         <a href="del-problem.php?id=<?= $problem['prb_id']; ?>" class="del" title="Remover mensagem">&times;</a>
                    <?php endif ?>
                </div>
            </a>
            <div class="problem-text"><?= $problem['prb_problem'] ?></div>
            <?php if (is_dir("attachments/" . $problem['prb_id'])): ?>
                <div class="problem-image">
                    <img src="attachments/<?= $problem['prb_id'] ?>/image.<?= file_get_contents('attachments/' . $problem['prb_id'] . '/extension') ?>" alt="">
                </div>
            <?php endif ?>
            <div class="author_date">
                <div class="author">
                    <?= $problem['usr_name'] ?>
                    <?php if (is_logged()): ?>
                        <span>
                            (<?= $problem['usr_username'] ?>)
                        </span>
                    <?php endif ?>
                </div>
                <div class="date">
                    <?= $problem['prb_created_at'] ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <a class="back" href="index.php">Voltar</a>
</body>
</html>