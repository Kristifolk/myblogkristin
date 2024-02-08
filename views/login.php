<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../templates/head.php"; ?>
    <title>Login</title>
</head>
<body>
<div class="page">
    <?php
    include "../templates/header.php"; ?>
    <h1>Вход</h1>
    <form id="loginForm" action="../controllers/login.php" method="POST"> <!-- перезагрузка страницы -->
        <label for="login">Введите логин:</label>
        <input type="text" id="login" name="login" required
               pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}|[0-9]{10,12}"
               placeholder="89289999999 или test@test.ru"><br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required placeholder="Пароль"><br><br>

        <input type="submit" value="Войти">
    </form>
    <?php
    include "../templates/footer.php";
    ?>
</div>
</body>
</html>
