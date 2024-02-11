<?php

?>

<div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="/assets/images/cat_icon.jpeg" class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        </div>
    </div>
</div>

<footer>
    <div class="conteiner">
        <div class="footer-col">
            <nav>
                <ul>
                    <li><a href="/index.php">HOME</a></li>
                    <li><a href="/views/profile.php">EDIT PROFILE</a></li>
                    <li><a href="/views/addArticle.php">ADD ARTICLE</a></li>
                </ul>
            </nav>
        </div>
        <div class="footer-col">
            <nav>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contacs</a></li>
                    <li><a href="#">Privacy & cookies</a></li>
                </ul>
            </nav>
        </div>
        <div class="footer-col">
            <div class="logo">
                <a href="/index.php"><img class="graficlogo" src="/uploads/icons/favorites.png" alt="logo"></a>
            </div>
            <div class="social">
                <a href="#" class="fb-link"><img src="/uploads/icons/fb_gray.png" alt="Facebook"></a>
                <a href="#" class="insta-link"><img src="/uploads/icons/insta_gray.png" alt="Instagram"></a>
                <a href="#" class="youtube-link"><img src="/uploads/icons/youtube_gray.png" alt="YouTube"></a>
            </div>
        </div>
        <p>Myblogkristin. 2024</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script src="/assets/js/login.js"></script>
    <script src="/assets/js/registration.js"></script>
    <script src="/assets/js/addArticle.js"></script>
    <script src="/assets/js/profile.js"></script>
</footer>
