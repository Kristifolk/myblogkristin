<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../templates/head.php"; ?>
    <title>Registration</title>
</head>
<body>
<div class="page">
    <?php
    include "../templates/header.php"; ?>
    <h1>Введите данные</h1>
    <form id="registrationForm" action="../controllers/registration.php" method="POST"> <!-- перезагрузка страницы -->
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" placeholder="Имя"><br><br>

        <label for="tel">Телефон:</label>
        <input type="tel" name="tel" id="tel" required placeholder="89289999999"><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required placeholder="test@test.ru"><br><br>

        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required placeholder="Пароль"><br><br>

        <label for="confirm_password">Повторите пароль:</label>
        <input type="password" name="confirm_password" id="confirm_password" required placeholder="Пароль"><br><br>

        <input type="submit" value="Зарегистрироваться">
    </form>

    <div class="error"></div>
    <?php
    include "../templates/footer.php";
    ?>
</div>
</body>
</html>
