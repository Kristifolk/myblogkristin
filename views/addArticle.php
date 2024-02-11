<?php

session_start();
include "../function.php";
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
$categories = categories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include "../templates/head.php"; ?>
    <title>Add article</title>
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
                <h1 class="mb-3">Добавить новую статью в myblogkristin</h1>
            </div>
        </div>
        <form id="addArticleForm" action="/controllers/addArticle.php" method="POST"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    <label for="category" class="form-label">Категория:</label>
                    <select name="category" id="category" class="form-control">
                        <?php
                        foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>">
                                <?= $category['title']; ?>
                            </option>
                        <?php
                        endforeach; ?>
                    </select>
                </div>
                <div class="col-12 mt-3">
                    <label for="heading" class="form-label">Заголовок:</label>
                    <input type="text" name="heading" id="heading" placeholder="Заголовок статьи" class="form-control">
                </div>
                <div class="col-12 mt-3">
                    <label for="image" class="form-label">Картинка:</label>
                    <input type="hidden" name="author" id="author" value="<?= $_SESSION['author'] ?>">
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="col-12 mt-3">
                    <label for="article" class="form-label">Статья:</label>
                    <textarea name="article" id="article" placeholder="Текст статьи" class="form-control"></textarea>
                </div>
                <div class="col-12 d-grid g-3 mt-3">
                    <input type="submit" value="Отправить" class="btn btn-success">
                </div>
            </div>
        </form>
        <?php
        else: ?>
            <h3>Войдите или зарегистрируйтесь, чтобы иметь возможность добавлять статьи</h3>
        <?php
        endif;
        ?>
    </div>
    <?php
    include "../templates/footer.php";
    ?>
</div>
</body>
</html>
