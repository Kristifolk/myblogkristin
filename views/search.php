<?php

session_start();
include '../models/db.php';
include "../function.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../templates/head.php"; ?>
    <title>Search</title>
</head>
<body>
<div class="page">
    <?php
    include "../templates/header.php";
    ?>

    <!-- Статья START -->
    <div class="container">
        <div class="content row">
            <div class="main-content col-12 col-md-9">
                <h2>Результаты поиска</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $search = $_GET['search'];//значение от пользователя из поля поиска
                    $articles = getSearch($search);
                }
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
                endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    include "../templates/footer.php";
    ?>
</div>
</body>
</html>
