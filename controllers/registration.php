<?php

session_start();
global $connection;
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
include '../models/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (!empty($name) && !empty($tel) && !empty($email) && !empty($password) && !empty($confirmPassword)) { // поля, заполняемые пользователем не пустые

        $notValid = validation($password, $confirmPassword, $email, $tel, $name, $connection);
        if ($notValid) {
            return;
        }

        // Хеширование пароля
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, tel, email, password) VALUES ('$name', '$tel', '$email', '$hashedPassword')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $_SESSION['auth'] = true;
            $_SESSION['author'] = $name;
            echo json_encode(['status' => 'successfully']);//редирект на главную
        } else {
            //echo 'Ошибка сохранения данных: ' . mysqli_error($connection);
            echo json_encode(['status' => 'fail', 'message' => 'Ошибка сохранения данных: ' . mysqli_error($connection)]
            );
        }

        mysqli_close($connection);
    } else {
        echo json_encode(['status' => 'fail', 'message' => 'Все поля обязательны для заполнения']
        );     //выводится ошибка,есл отключить required в форме
    }
}

function validation(
    string $password,
    string $confirmPassword,
    string $email,
    int $tel,
    string $name,
    $connection
) {
    if ($password !== $confirmPassword) {
        echo json_encode(['status' => 'fail', 'message' => 'Пороли не совпадают']); //выводится ошибка
        return true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'fail', 'message' => 'Некорректный формат email']);//не выводится (
        return true;
    }

    if (!preg_match(
        "/^\d{11}$/",
        $tel
    )) {//такой формат телефона 89289999999. Можно регулярку "/^\+?\d{1,3}\(?\d{3}\)?\d{2}-?\d{2}-?\d{3}$/" то пример +7(928)99-99-999 и 89289999999 подходит и надо приводить к одному виду для уникальности в БД
        echo json_encode(['status' => 'fail', 'message' => 'Некорректный формат телефона']
        );//не выводится если "f" если меньше цифр то выводится сообщение
        return true;
    }

    if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $name)) {
        echo json_encode(['status' => 'fail', 'message' => 'Некорректный формат имени']);//выводится ошибка
        return true;
    }

    $query = "SELECT * FROM users WHERE email = '$email' OR name = '$name' OR tel = '$tel' ";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'fail', 'message' => 'Такой пользователь уже существует. Введите другие данные']
        );//не указывается что именно почта или имя или телефон
        //выводится ошибка
        return true;
    }
}
