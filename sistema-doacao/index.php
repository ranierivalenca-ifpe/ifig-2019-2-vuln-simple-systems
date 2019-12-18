<?php include 'conf/init.php'; ?>

<?php $descriptions = get_descriptions(); ?>
<?php if (is_logged()): ?>
    <?php $items = get_items(); ?>
<?php endif ?>

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
    <h3>Descrições</h3>

    <?php if (is_logged()): ?>
        <form action="adicionar_descricao.php" class="new-description" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= currentUserId() ?>">
            <fieldset>
                <legend>Adicionar descrição</legend>
                <textarea name="description" cols="30" rows="10" placeholder="Mensagem"></textarea>
                <select name="item" required="" class="<?= is_admin() ? '' : 'full' ?>">
                    <option value="" readonly>Escolha o tipo de item</option>
                    <option value="" disabled>--</option>
                    <?php foreach ($items as $eq): ?>
                        <option value="<?= $eq['id'] ?>"><?= $eq['item'] ?></option>
                    <?php endforeach ?>
                </select>
                <?php if (is_admin()): ?>
                    <a href="novo_item.php">Novo tipo de item</a>
                <?php endif ?>
                <input type="file" name="image" accept=".jpg, .jpeg, .png">
                <input type="submit" value="enviar">
            </fieldset>
        </form>

    <?php endif ?>

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
</body>
</html>