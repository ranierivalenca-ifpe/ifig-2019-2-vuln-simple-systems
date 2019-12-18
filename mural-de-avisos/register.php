<?php

include 'conf/init.php';

// foreach($_POST as $index => $data) {
//     $$index = $data;
// }
$username = $_POST['username'] ?? false;
$email = $_POST['email'] ?? false;
$name = $_POST['name'] ?? false;
$pw = $_POST['pw'] ?? false;
$pw2 = $_POST['pw2'] ?? false;
$admin = $_POST['admin'] ?? false;

$vars = '';
foreach(['username', 'email', 'name'] as $var) {
    $vars .= "&{$var}={$$var}";
}

$mr = false;

if ($pw != $pw2) {
    $mr = 'Senhas não conferem';
}
if ($pw == '') {
    $mr = 'Senha não pode estar em branco';
}
if (email_exists($email)) {
    $mr = 'E-mail já registrado';
}
if (username_exists($username)) {
    $mr = 'Nome de usuário já cadastrado';
}
if ($mr !== false) {
    redirect(sprintf('reg_login.php?mr=%s', $mr . $vars));
}

$added = add_user($username, $email, $pw, $name, $admin);

if ($added) {
    $mr = 'Usuário registrado';
} else {
    $mr = 'Ocorreu algum erro - entre em contato com o administrador';
}
redirect(sprintf('reg_login.php?mr=%s', $mr . $vars));

?>