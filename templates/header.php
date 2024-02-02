<?php
//session_start();
?>
<!-- navbar -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Myblogkristin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/views/main.php">Главная</a>
                    </li>
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
                    <!--
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
-->
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>
            </div>
        </div>
    </nav>
</header>