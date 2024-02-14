<?php

//TODO страница не по ТЗ
//TODO при редактировании профиля надо заполнять все поля, а если я хочу поменять только почту. Только смена пароля не обязательна
//TODO видеть свои статьи.. типа своей стр
//TODO возможность редактировать мою статью отсутсвует..
session_start();
global $connection;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);//показывать ошибки
include '../models/db.php';

// Проверяем, что запрос является POST-запросом
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $new_password = $_POST['new_password'] ?? null;
    $id = $_SESSION['id'];

    if (!empty($password)) {
        //принудительно число $id надо тут? тк $id все равно берется из сессии, а не от пользователя
        $id = (int)$id;
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);//извлекается первая строка результатов запроса
        $bd_name = $row['name'];
        $bd_tel = $row['tel'];
        $bd_email = $row['email'];
        $hashedPassword = $row['password'];// Хешированный пароль из базы данных

        $validation = validation(
            $id,
            $password,
            $hashedPassword,
            $name,
            $bd_name,
            $tel,
            $bd_tel,
            $email,
            $bd_email,
            $new_password,
            $connection
        );

        $_SESSION['author'] = $name;//если валидация прошла, то перезапись имени в сессии
        mysqli_close($connection);
    } else {
        echo json_encode(['status' => 'fail', 'message' => 'Пароль обязателен для заполнения']);
    }
}

function validation(
    $id,
    $password,
    $hashedPassword,
    $name,
    $bd_name,
    $tel,
    $bd_tel,
    $email,
    $bd_email,
    $new_password,
    $connection
)
{
    $is_update = false;
    if (password_verify($password, $hashedPassword)) {//Проверка текущего пароля
        if ($name !== $bd_name) {
            //экранирование имени
            $escapedName = mysqli_real_escape_string($connection, $name);
            $query = "SELECT * FROM users WHERE name = '$escapedName'";
            $result = mysqli_query($connection, $query);

            if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $name)) {
                echo json_encode(['status' => 'fail', 'message' => 'Некорректный формат имени']);
                return false;
            }
            if (mysqli_num_rows($result) > 0) {
                echo json_encode(['status' => 'fail', 'message' => 'Такое имя уже существует. Введите другие данные']);
                return false;
            } else {
//                $query = "UPDATE users SET name = '$name' WHERE id = '$id'";
//                mysqli_query($connection, $query);
//                $is_update = true;
                $query = "UPDATE users SET name = ? WHERE id = '$id'";
                $stmt = mysqli_prepare($connection, $query);//подготовленное выражение с указанием типа
                mysqli_stmt_bind_param($stmt, "s", $name);
                mysqli_stmt_execute($stmt);
                $is_update = true;
            }
        }
        if ($tel !== $bd_tel) {
            //принудительно число tel
            $tel = (int)$tel;
            $query = "SELECT * FROM users WHERE tel = '$tel'";

            $result = mysqli_query($connection, $query);

            if (!preg_match(
                "/^\d{11}$/",
                $tel
            )) {//такой формат телефона 89289999999. Можно регулярку "/^\+?\d{1,3}\(?\d{3}\)?\d{2}-?\d{2}-?\d{3}$/" то пример +7(928)99-99-999 и 89289999999 подходит и надо приводить к одному виду для уникальности в БД
                echo json_encode(['status' => 'fail', 'message' => 'Некорректный формат телефона']);
                return false;
            }
            if (mysqli_num_rows($result) > 0) {
                echo json_encode(
                    ['status' => 'fail', 'message' => 'Такой телефон уже существует. Введите другие данные']
                );
                return false;
            } else {
                $query = "UPDATE users SET tel = ? WHERE id = '$id'";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "i", $tel);
                mysqli_stmt_execute($stmt);
                $is_update = true;
            }
        }
        if ($email !== $bd_email) {
            //экранирование email
            $escapedEmail = mysqli_real_escape_string($connection, $email);
            $query = "SELECT * FROM users WHERE email = '$escapedEmail'";
            $result = mysqli_query($connection, $query);

            if (!filter_var($escapedEmail, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['status' => 'fail', 'message' => 'Некорректный формат email']);
                return false;
            }

            if (mysqli_num_rows($result) > 0) {
                echo json_encode(['status' => 'fail', 'message' => 'Такой email уже существует. Введите другие данные']
                );
                return false;
            } else {
//                $query = "UPDATE users SET email = '$email' WHERE id = '$id'";
//                mysqli_query($connection, $query);
//                $is_update = true;
                $query = "UPDATE users SET email = ? WHERE id = '$id'";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $is_update = true;
            }
        }
        if ($new_password) {
            // Хеширование пароля
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
//            $query = "UPDATE users SET password = '$hashedPassword' WHERE id = '$id'";
//            mysqli_query($connection, $query);
//            $is_update = true;
            $query = "UPDATE users SET password = ? WHERE id = '$id'";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "s", $hashedPassword);
            mysqli_stmt_execute($stmt);
            $is_update = true;
        }

        if ($is_update) {
            echo json_encode(['status' => 'successfully', 'message' => 'Данные успешно сохранены']);
            return true;
        } else {
            echo json_encode(['status' => 'fail', 'message' => 'Новые данные не введены']);
            return false;
        }
    } else {
        echo json_encode(['status' => 'fail', 'message' => 'Текущий пароль не совпадет с введенным паролем']);
        return false;
    }
}
