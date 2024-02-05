<?php

include '../models/db.php';
include "../function.php";
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
$categories = categories();
$result = post($_GET['post']);
$post = mysqli_fetch_assoc($result);
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

<!-- Статья START -->
<div class="container">
    <div class="content row">
        <div class="main-content col-12 col-md-9">
            <h2><?php echo $post['heading']; ?></h2>
            <div class="single-post row">
                <!-- картинка -->
                <div class="img col-12">
                    <img src="<?= $post['image']; ?>" class="img-thumbnail">
                </div>
                <div class="single-post-info">
                    <i class="far fa-user">Автор: <?= $post['author']; ?></i>
                    <i class="far fa-calendar">Дата создания: <?= $post['created_at']; ?></i>
                    <i class="far fa-topic">Категория: <?= $post['heading']; ?></i>
                </div>
                <div class="single-post-text col-12">
                    <p class="preview-text"><?= $post['article']; ?></p>
                </div>
            </div>
        </div>
        <!-- sidebar -->
        <div class="sidebar col-12 col-md-3">
            <!-- категории -->
            <div class="section-topic">
                <h4>Категории</h4>
                <ul>
                    <?php
                    foreach ($categories as $category) : ?>
                        <li><a href="<?= 'categories.php?post=' . $category['id']; ?>"><?= $category['title']; ?></a></li>
                    <?php
                    endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- sidebar END -->
        </div>
    </div>
</div>
<!-- Статья END -->

</body>
</html>
