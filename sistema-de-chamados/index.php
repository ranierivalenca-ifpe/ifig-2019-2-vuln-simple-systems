<?php include 'conf/init.php'; ?>

<?php $problems = get_problems(); ?>
<?php if (is_logged()): ?>
    <?php $equipments = get_equipments(); ?>
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
    <h3>Problemas</h3>

    <?php if (is_logged()): ?>
        <form action="add-problem.php" class="new-problem" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= currentUserId() ?>">
            <fieldset>
                <legend>Adicionar problema</legend>
                <textarea name="problem" cols="30" rows="10" placeholder="Mensagem"></textarea>
                <select name="equipment" required="" class="<?= is_admin() ? '' : 'full' ?>">
                    <option value="" readonly>Escolha o equipamento</option>
                    <option value="" disabled>--</option>
                    <?php foreach ($equipments as $eq): ?>
                        <option value="<?= $eq['id'] ?>"><?= $eq['equipment'] ?></option>
                    <?php endforeach ?>
                </select>
                <?php if (is_admin()): ?>
                    <a href="new-equipment.php">Novo equipamento</a>
                <?php endif ?>
                <input type="file" name="image" accept=".jpg, .jpeg, .png">
                <input type="submit" value="enviar">
            </fieldset>
        </form>

    <?php endif ?>

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
</body>
</html>