<?php

session_start();
global $connection, $query;
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
include '../models/db.php';//


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];////защита от sql иньекций в select value id
    $heading = $_POST['heading'];
    $author = $_POST['author'];
    $article = $_POST['article'];
    $image = $_FILES['image'];

    if (!empty($heading) && !empty($author) && !empty($article) && !empty($image)) { // поля, заполняемые пользователем не пустые

        $validation = validation($category, $heading, $author, $article, $image, $connection);
        if ($validation) {
            return;
        }
        $query = "SELECT id FROM categories WHERE title = '$category'";// идентификатор категории на основе выбранной категории
        $result = mysqli_query($connection, $query);
        if ($row = mysqli_fetch_assoc($result)) {

            $categoryId = $row['id'];
            // Код для сохранения файла на сервере
            $uploadDir = '/uploads/img/'; // путь к директории для сохранения файлов
            $uploadFile = $uploadDir . basename($image['name']);

            $imgName = $image['name'];
            $imgtmp = $image['tmp_name'];

            $fileinfo = pathinfo($imgName);
            $path ='../uploads/img/' . rand(1,1000).'.'.$fileinfo['extension'];
            $result = move_uploaded_file($imgtmp, $path);

            $query = "INSERT INTO articles (heading, author, article, image, category_id) VALUES ('$heading', '$author', '$article', '$uploadFile', $categoryId)";

            $result = mysqli_query($connection, $query);
        }

        //TODO имя любого зарегистрированного пользователя, или можно сделать именно авторизованного пользователя и вообще вставлять имя автоматически сразу из сессии
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
    string $category,
    string $heading,
    string $author,
    string $article,
    $image,//array
    $connection
) //валидация введенных данных
{
    $allowedTypes = ['image/jpeg', 'image/png']; // разрешенные типы файлов
    $maxFileSize = 2 * 1024 * 1024; // максимальный размер файла (в данном случае 2 МБ)

    if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $author)) {
        echo "Некорректный формат имени";
        return true;
    }

    if (!preg_match(
        "/^[a-zA-Zа-яА-ЯёЁ\s\d.,!?]*$/u",
        $category
    )) {// Регулярное выражение для проверки текста, выражение, которое позволяет использовать буквы латинского и кириллического алфавита, пробелы, цифры, а также знаки препинания (точка, запятая, вопросительный и восклицательный знаки).Рег. выражение, позволяет полю $category быть пустым
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
}


//TODO возможность редактировать статью отсутсвует..