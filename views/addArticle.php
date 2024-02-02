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
    <title>Add article</title>
</head>
<body>
<?php
include "../templates/header.php";
if (!empty($_SESSION['auth'])):
    ?>
    <h1>Добавить новую статью в myblogkristin</h1>

    <form id="addArticleForm" action="../controllers/addArticle.php" method="POST" enctype="multipart/form-data">
        <label for="category">Категория:</label> <!-- фильтр существующих или самим писать? или выпадающий список -->
        <input type="text" name="category" id="category" placeholder="Категория статьи"><br><br>

        <label for="heading">Заголовок:</label>
        <input type="text" name="heading" id="heading" placeholder="Заголовок статьи"><br><br>

        <label for="author">Автор:</label>
        <input type="text" name="author" id="author" placeholder="имя автора статьи"><br><br>

        <label for="image">Картинка:</label>
        <input type="file" name="image" id="image"><br><br>

        <label for="article">Статья:</label>
        <textarea name="article" id="article" placeholder="Текст статьи"></textarea><br><br>

        <input type="submit" value="Отправить">
    </form>
<?php
else: ?>
    <h3>Войдите или зарегистрируйтесь, чтобы иметь возможность добавлять статьи</h3>
<?php
endif; ?>
</body>
</html>