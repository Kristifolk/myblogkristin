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
    <title>Article</title>
</head>
<body>
<?php
include "../templates/header.php"; ?>
<h2>Здесь название</h2>
<h3>Здесь категория</h3>
<h3>Автор</h3>
<h3>Дата публикации</h3>
<p>фото</p>
<p>текст</p>


<a href="/index.php">На главную</a>

</body>
</html>