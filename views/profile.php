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
<div class="page">
    <?php
    include "../templates/header.php";
    if (!empty($_SESSION['auth'])):
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="mb-3">Редактирование личного профиля</h1>
            </div>
        </div>
        <form id="profileForm" action="/controllers/profile.php" method="POST" enctype="multipart/form-data">
            <!-- перезагрузка страницы -->
            <div class="row">
                <div class="col-12">
                    <label for="name" class="form-label">Имя:</label>
                    <input type="text" name="name" id="name" placeholder="Имя" class="form-control"><br><br>
                </div>
                <div class="col-12 mt-3">
                    <label for="tel" class="form-label">Телефон:</label>
                    <input type="tel" name="tel" id="tel" placeholder="+7(999) 99-99-999" class="form-control"><br><br>
                </div>
                <div class="col-12 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" placeholder="test@test.ru" class="form-control"><br><br>
                </div>
                <div class="col-12 mt-3">
                    <label for="new_password" class="form-label">Новый пароль:</label>
                    <input type="password" name="new_password" id="new_password" placeholder="Новый пароль"
                           class="form-control"><br><br>
                </div>
                <div class="col-12 mt-3">
                    <label for="password" class="form-label">Текущий пароль:</label>
                    <input type="password" name="password" id="password" placeholder="Текущий пароль"
                           class="form-control"><br><br>
                </div>
                <div class="col-12 d-grid g-3 mt-3">
                    <input type="submit" value="Сохранить" class="btn btn-success">
                </div>
            </div>
    </div>
    </form>
</div>
</div>
<?php
else: ?>
    <h3>Для редактирования личного профиля войдите или зарегистрируйтесь</h3>
    </div>
    </div>
<?php
endif;
include "../templates/footer.php";
?>
</body>
</html>
