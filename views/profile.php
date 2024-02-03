<?php

session_start();
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../templates/head.php"; ?>
    <title>Myblogkristin</title>
</head>
<body>
<?php
include "../templates/header.php";
if (!empty($_SESSION['auth'])):
    ?>
    <h1>Редактирование личного профиля</h1>
    <form id="profileForm" action="../controllers/profile.php" method="POST"> <!-- перезагрузка страницы -->
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" placeholder="Имя"><br><br>

        <label for="tel">Телефон:</label>
        <input type="tel" name="tel" id="tel" placeholder="+7(999) 99-99-999"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="test@test.ru"><br><br>

        <label for="new_password">Новый пароль:</label>
        <input type="password" name="new_password" id="new_password" placeholder="Новый пароль"><br><br>

        <label for="password">Текущий пароль:</label>
        <input type="password" name="password" id="password" required placeholder="Текущий пароль"><br><br>

        <input type="hidden" name="id">

        <input type="submit" value="Сохранить">
    </form>
<?php
else: ?>
    <h3>Для редактирования личного профиля войдите или зарегистрируйтесь</h3>
<?php
endif; ?>
</body>
</html>