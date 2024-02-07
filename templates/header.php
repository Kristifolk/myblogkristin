<?php

?>
<!-- navbar -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">Myblogkristin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    if (!empty($_SESSION['auth'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/views/profile.php">Редактировать профиль</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/views/addArticle.php">Добавить статью</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/controllers/logout.php">Logout</a>
                        </li>
                    <?php
                    else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/views/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/views/registration.php">Registration</a>
                        </li>
                    <?php
                    endif; ?>
                </ul>
                <form class="d-flex" action="/views/search.php" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Поиск"
                           aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
            </div>
        </div>
    </nav>
</header>