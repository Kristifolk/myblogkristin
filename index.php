<?php

session_start();
include 'models/db.php';
include "function.php";
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
$categories =  categories();
$posts = allPosts();
$post = post();//переменнная уйдет в стр 1 статьи

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
    <?php
    //TODO msg пропадает только после перезагрузки
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']); // Очистить значение ключа msg после его использования
    }
    ?>
    <!-- отформатировать вывод слева статьи и фото и категории справа-->
    <!--

    //при клике на название статьи редирект
    //header('Location: ../views/article.php');
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
<!-- Статьи START -->
<div class="container">
    <div class="content row">
        <div class="main-content col-12 col-md-9">
            <?php foreach ($posts as $post) :?>
                <div class="post row">
                    <!-- картинка -->
                    <div class="img col-12 col-md-4">
                        <img src="<?=  $post['image']; ?>" class="img-thumbnail">
                    </div>
                    <!-- заголовок статьи -->
                    <div class="post-text col-12 col-md-8">
                        <h5>
                            <a href="<?= 'single.php?post=' . $post['id']; ?>"><?= $post['heading']; ?></a>
                        </h5>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <!-- sidebar -->
        <div class="sidebar col-12 col-md-3">
            <!-- поиск -->
            <div class="section-search">
                <h4>Поиск</h4>
                <form action="search.php" method="get">
                    <input class="text-input" type="text" name="search">
                </form>
            </div>
            <!-- категории -->
            <div class="section-topic">
                <h4>Категории</h4>
                <ul>
                    <?php foreach ($categories as $category) : ?>
                        <li><a href="<?= $category['title']; ?>"</a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Статьи END -->

</body>
</html>