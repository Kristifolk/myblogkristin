<?php

session_start();
global $connection, $query;
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
include '../models/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['category'] ?? null;
    $heading = $_POST['heading'];
    $author = $_POST['author'];
    $article = $_POST['article'];
    $image = $_FILES['image'];

    if (!empty($heading) && !empty($author) && !empty($article) && !empty($image)) { // поля, заполняемые пользователем не пустые

        $notValid = validation($categoryId, $heading, $author, $article, $image, $connection);
        if ($notValid) {
            return;
        }
        if ($categoryId) {
            $imgName = $image['name'];
            $imgtmp = $image['tmp_name'];

            $fileinfo = pathinfo($imgName);
            $path = '../uploads/img/' . rand(
                    1,
                    1000
                ) . '.' . $fileinfo['extension'];//генерируется случайное имя файла для загруженного изображения путем объединения случайного числа от 1 до 1000 с расширением файла
            $result = move_uploaded_file($imgtmp, $path);

            $query = "INSERT INTO articles (heading, author, article, image, category_id) VALUES ('$heading', '$author', '$article', '$path', $categoryId)";

            $result = mysqli_query($connection, $query);
        } else {
            echo " Invalid category ID!";
        }

        $query = "SELECT * FROM users WHERE name = '$author' ";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) < 1) {
            echo "Нет такого пользователя. Введите имя зарегистрированного пользователя";//нужн ли проверка, что выкладывает статью именно авторизованный пользователь, может автор = текущий пользователь. Или можно выкладывать чужие статьи и эта проверка лишняя
            return true;
        } elseif ($result) {
            $_SESSION['msg'] = "Статья успешно загружена";
            header('Location: ../index.php');
            return;
        } else {
            echo 'Ошибка сохранения данных: ' . mysqli_error($connection);
            return true;
        }
        mysqli_close($connection);
    } else {
        echo "Все поля обязательны для заполнения";
    }
}

function validation(
    int $categoryId,
    string $heading,
    string $author,
    string $article,
    $image,//array
    $connection
): bool //валидация введенных данных
{
    $allowedTypes = ['image/jpeg', 'image/png']; // разрешенные типы файлов
    $maxFileSize = 2 * 1024 * 1024; // максимальный размер файла (в данном случае 2 МБ)

    if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $author)) {
        echo "Некорректный формат имени";
        return true;
    }

    if (!is_numeric($categoryId))
    {
        echo "Некорректный ввод категории";
        return true;
    }

    if (!preg_match(
        "/^[a-zA-Zа-яА-ЯёЁ\s\d.,!?]+$/u",
        $heading
    )) {// Регулярное выражение для проверки текста, выражение, которое позволяет использовать буквы латинского и кириллического алфавита, пробелы, цифры, а также знаки препинания (точка, запятая, вопросительный и восклицательный знаки)
        echo "Некорректный ввод заголовка";
        return true;
    }
    if (!preg_match(
        "/^[a-zA-Zа-яА-ЯёЁ\s\d.,!?]+$/u",
        $article
    )) {// Регулярное выражение для проверки текста, выражение, которое позволяет использовать буквы латинского и кириллического алфавита, пробелы, цифры, а также знаки препинания (точка, запятая, вопросительный и восклицательный знаки)
        echo "Некорректный ввод текста статьи";
        return true;
    }
    if (!in_array($image['type'], $allowedTypes)) {
        echo "Некорректный тип файла. Разрешены только JPEG и PNG.";
        return true;
    }

    if ($image['size'] > $maxFileSize) {
        echo "Размер файла превышает допустимый предел.";
        return true;
    }
    return false;
}


//TODO возможность редактировать статью отсутсвует..