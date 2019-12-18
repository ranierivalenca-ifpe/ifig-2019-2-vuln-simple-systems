<?php

include 'conf/init.php';
$cat_id = $_GET['cat'];
// $cat_id = $_SERVER['REQUEST_URI'];
// $cat_id = explode('/', $cat_id);
// $cat_id = array_pop($cat_id);

$messages = get_messages_by_category($cat_id);
$category = get_category($cat_id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mural</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <nav>
        <ul>
            <?php if (!is_logged()): ?>
                <li><a href="reg_login.php">Registro / Login</a></li>
            <?php else: ?>
                <li><?= currentUser()['name'] ?> <span>(<?= currentUser()['username'] ?>)</span></li>
                <li><a href="logout.php">Sair</a></li>
            <?php endif ?>
        </ul>
    </nav>

    <h1>Mural</h1>
    <h3>Mensagens na categoria
        <span class="cat-text cat-<?= $category['id'] ?>"><?= $category['category'] ?></span>
    </h3>
    <br>
    <?php foreach ($messages as $message): ?>
        <?php
            $fromUser = (is_logged() && $message['usr_id'] == currentUserId()) || is_admin();
        ?>
        <div class="message <?= $fromUser ? 'from-user' : '' ?>">
            <a href="messages.php?cat=<?= $message['cat_id'] ?>" class="cat">
                <div class="category category-<?= $message['cat_id'] ?>">
                    <?= $message['cat_category'] ?>
                    <?php if ($fromUser): ?>
                         <a href="removeMessage.php?id=<?= $message['mes_id']; ?>" class="del" title="Remover mensagem">&times;</a>
                    <?php endif ?>
                </div>
            </a>
            <div class="message-text"><?= $message['mes_message'] ?></div>
            <?php if (is_dir("attachments/" . $message['mes_id'])): ?>
                <div class="message-image">
                    <img src="attachments/<?= $message['mes_id'] ?>/image.<?= file_get_contents('attachments/' . $message['mes_id'] . '/extension') ?>" alt="">
                </div>
            <?php endif ?>
            <div class="author_date">
                <div class="author">
                    <?= $message['usr_name'] ?>
                    <?php if (is_logged()): ?>
                        <span>
                            (<?= $message['usr_username'] ?>)
                        </span>
                    <?php endif ?>
                </div>
                <div class="date">
                    <?= $message['mes_created_at'] ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <a class="back" href="index.php">Voltar</a>
</body>
</html>