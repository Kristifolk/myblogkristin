<?php

session_start();
include 'models/db.php';
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "templates/head.php"; ?>
    <title>Myblogkristin</title>
</head>
<body>
<?php
include "templates/header.php";
if (!empty($_SESSION['auth'])):
    ?>
    <h1>myblogkristin</h1>

    <!-- отформатировать вывод слева статьи и фото и категории справа-->
    <p>статьи</p>
    <p>фото</p>
    <p>категории</p>
    <!--
    // На главной странице выводится список статей
    if () {//вывести слева, как область видимости задать
    $query = "SELECT heading FROM articles";
    return $query;
    //при клике на название статьи редирект
    //header('Location: ../views/article.php');
    }
    //При клике на название статьи открывается список всех статей
    if () {//вывести справа, как область видимости задать
    $query = "SELECT category FROM articles";//////// articles или categories
    return $query;
    }
    //при клике на название категории редирект?
    //header('Location: ');
    -->


    <!-- добавить поиск -->
<?php
else: ?>
    <h1>Приветствуем в myblogkristin</h1>
    <h3>Войдите или зарегистрируйтесь, чтобы иметь возможность добавлять статьи</h3>
    <!-- показывать статьи и категории -->
    <!-- добавить поиск -->
<?php
endif; ?>

</body>
</html>