<?php include 'conf/init.php'; ?>

<?php $messages = get_messages(); ?>
<?php if (is_logged()): ?>
    <?php $categories = get_categories(); ?>
<?php endif ?>

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
    <h3>Mensagens</h3>

    <?php if (is_logged()): ?>
        <form action="addMessage.php" class="new-message" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= currentUserId() ?>">
            <fieldset>
                <legend>Nova mensagem</legend>
                <textarea name="message" cols="30" rows="10" placeholder="Mensagem"></textarea>
                <select name="category" required="" class="<?= is_admin() ? '' : 'full' ?>">
                    <option value="" readonly>Escolha a categoria</option>
                    <option value="" disabled>--</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['category'] ?></option>
                    <?php endforeach ?>
                </select>
                <?php if (is_admin()): ?>
                    <a href="newCategory.php">Nova categoria</a>
                <?php endif ?>
                <input type="file" name="image" accept=".jpg, .jpeg, .png">
                <input type="submit" value="enviar">
            </fieldset>
        </form>

    <?php endif ?>

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
</body>
</html>