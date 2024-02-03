<?php

session_start();
global $connection;
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
include '../models/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (!empty($login) && !empty($password)) { // поля, заполняемые пользователем не пустые

        $query = validation($login); // валидация введенных данных
        if (!$query) {
            return;
        }
        $result = mysqli_query($connection, $query);


        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);//извлекается первая строка результатов запроса
                $name = $row['name'];
                $tel = $row['tel'];
                $email = $row['email'];
                $id = $row['id'];
                $hashedPassword = $row['password'];// Хешированный пароль из базы данных

                //сравнение хешированного пароля с введенным пользователем паролем
                if (password_verify($password, $hashedPassword)) {
                    // Пароль совпадает, редирект
                    if (!empty($row)) {
                        $_SESSION['auth'] = true;
                        $_SESSION['id'] = $id;//TODO не видит Id из сессии для редактирования профиля, если убирать стр, то убрат это
                    }
                    header('Location: ../index.php');
                    exit;
                } else {
                    echo "Пароль не совпадает";
                }
            } else {
                echo "Неверный логин или пароль";
            }
        } else {
            echo 'Ошибка аутентификации';
        }
        mysqli_close($connection);
    } else {
        echo "Все поля обязательны для заполнения";
    }
}

function validation(string $login) //валидация введенных данных
{
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {//веденный логин является email-ом
        $query = "SELECT * FROM users WHERE email = '$login'";
        return $query;
    } elseif (ctype_digit($login)) { // Введенный логин является телефонным номером и состоит только из цифр
        $query = "SELECT * FROM users WHERE tel = '$login'";
        return $query;
    } else {
        echo "Авторизация возможна по телефону, например 89289999999, или email, например test@test.ru";
        return false;
    }
}


