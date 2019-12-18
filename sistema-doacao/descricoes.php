<?php

include 'conf/init.php';
$eq_id = $_GET['eq'];

$descriptions = get_descriptions_by_item($eq_id);
$item = get_item($eq_id);

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
    <h3>Items a serem doados do tipo
        <span class="eq-text eq-<?= $item['id'] ?>"><?= $item['item'] ?></span>
    </h3>
    <br>
    <?php foreach ($descriptions as $description): ?>
        <?php
            $fromUser = (is_logged() && $description['usr_id'] == currentUserId()) || is_admin();
        ?>
        <div class="description <?= $fromUser ? 'from-user' : '' ?>">
            <a href="descricoes.php?eq=<?= $description['itm_id'] ?>" class="itm">
                <div class="item item-<?= $description['itm_id'] ?>">
                    <?= $description['itm_item'] ?>
                    <?php if ($fromUser): ?>
                         <a href="remover_descricao.php?id=<?= $description['dsc_id']; ?>" class="del" title="Remover mensagem">&times;</a>
                    <?php endif ?>
                </div>
            </a>
            <div class="description-text"><?= $description['dsc_description'] ?></div>
            <?php if (is_dir("attachments/" . $description['dsc_id'])): ?>
                <div class="description-image">
                    <img src="attachments/<?= $description['dsc_id'] ?>/image.<?= file_get_contents('attachments/' . $description['dsc_id'] . '/extension') ?>" alt="">
                </div>
            <?php endif ?>
            <div class="author_date">
                <div class="author">
                    <?= $description['usr_name'] ?>
                    <?php if (is_logged()): ?>
                        <span>
                            (<?= $description['usr_username'] ?>)
                        </span>
                    <?php endif ?>
                </div>
                <div class="date">
                    <?= $description['dsc_created_at'] ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <a class="back" href="index.php">Voltar</a>
</body>
</html>