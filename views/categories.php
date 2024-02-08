<?php

session_start();
include '../models/db.php';
include "../function.php";
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
$categories = categories();
//var_dump($categories);
$postId = $_GET['post'] ?? null;
$title = '';
if ($postId) {
    $articles = articlesByCategoryId($postId);
    $title = $categories[array_search(
        $postId,
        array_column($categories, 'id')
    )]['title'];//array_search — Осуществляет поиск данного значения в массиве и возвращает ключ первого найденного элемента в случае успешного выполнения
} else {
    $articles = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../templates/head.php"; ?>
    <title>Category</title>
</head>
<body>
<div class="page">
    <?php
    include "../templates/header.php"; ?>

    <!-- Статья START -->
    <div class="container">
        <div class="content row">
            <div class="main-content col-12 col-md-9">
                <h2 class="mb-3">Статьи категории: <?= $title ?></h2>
                <div class="row row-cols-1 g-4">
                    <?php
                    foreach ($articles as $article):
                        ?>
                        <!-- ARTICLE-->
                        <div class="single-post col">
                            <div class="card p-3">
                                <!-- картинка -->
                                <img src="<?= $article['image'] ?? '' ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $article['heading']; ?></h5>
                                    <i class="far fa-user">Автор: <?= $article['author']; ?></i>
                                    <i class="far fa-calendar">Дата создания: <?= $article['created_at']; ?></i>
                                </div>
                                <div class="single-post-text col-12">
                                    <p class="card-text"><?= $article['article']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;;
                    ?>
                </div>
            </div>
            <!-- sidebar -->
            <?php
            include __DIR__ . "/../templates/sidebar.php";
            ?>
        </div>
    </div>
    <!-- Статья END -->
    <?php
    include "../templates/footer.php";
    ?>
</body>
</html>
