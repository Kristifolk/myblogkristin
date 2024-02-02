<?php

// Удалить все переменные сессии
//$_SESSION = array();
// Удалить сессионные cookie, если они существуют
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}


// Уничтожить сессию
//session_destroy();
session_unset();
// Перенаправить пользователя на страницу выхода
header("Location: ../views/main.php");
exit;
