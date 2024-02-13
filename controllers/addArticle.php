<?php

//TODO возможность редактировать статью отсутсвует..
global $connection, $query;
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
include '../models/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$categoryId = ($_POST['category']) ?? null;
$heading = ($_POST['heading']);
$author = ($_POST['author']);
$article = $_POST['article'];
$image = $_FILES['image'];

if (empty($heading) || empty($author) || empty($article) || empty($image)) { // поля, заполняемые пользователем не пустые
    echo json_encode(['status' => 'fail', 'message' => 'Все поля обязательны для заполнения']);
    exit();
}

$notValid = validation($categoryId, $heading, $author, $article, $image);
if ($notValid) {
    exit();
}

if (!$categoryId) {
    echo json_encode(['status' => 'fail', 'message' => 'Invalid category ID']);
    exit();
}

$imgName = $image['name'];
$imgtmp = $image['tmp_name'];

$fileinfo = pathinfo($imgName);
$path = '../assets/images/' . rand(
        1,
        1000
    ) . '.' . $fileinfo['extension'];//генерируется случайное имя файла для загруженного изображения путем объединения случайного числа от 1 до 1000 с расширением файла
$result = move_uploaded_file($imgtmp, $path);

//$query = "INSERT INTO articles (heading, author, article, image, category_id) VALUES ('$heading', '$author', '$article', '$path', $categoryId)";
//
//$result = mysqli_query($connection, $query);
//SQL-запрос с использованием подстановочных знаков (?) вместо конкретных значений
//подготовленное выражение mysqli_prepare, которая принимает соединение с базой данных и SQL-запрос
//значения переменных $heading, $author, $article, $path и $categoryId привязываются к подстановочным знакам в подготовленном выражении с помощью функции mysqli_stmt_bind_param. Второй аргумент этой функции - это строка формата, которая указывает типы данных для каждого значения
//подготовленное выражение выполняется с помощью функции mysqli_stmt_execute, которая возвращает true в случае успешного выполнения или false
$query = "INSERT INTO articles (heading, author, article, image, category_id) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "ssssi", $heading, $author, $article, $path, $categoryId);
$result = mysqli_stmt_execute($stmt);


$query = "SELECT * FROM users WHERE name = '$author' ";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) < 1) {
    echo json_encode(
        [
            'status' => 'fail',
            'message' => 'Нет такого пользователя. Введите имя зарегистрированного пользователя'
        ]
    );
    mysqli_close($connection);
    exit();
}

if ($result) {
    mysqli_close($connection);
    echo json_encode(['status' => 'successfully', 'message' => 'Статья успешно загружена']);
    exit();
}

//echo 'Ошибка сохранения данных: ' . mysqli_error($connection);
mysqli_close($connection);
echo json_encode(['status' => 'fail', 'message' => 'Ошибка сохранения данных: ' . mysqli_error($connection)]);
exit();

function validation(
    int $categoryId,
    string $heading,
    string $author,
    string $article,
    $image,//array
): bool //валидация введенных данных
{
    $allowedTypes = ['image/jpeg', 'image/png']; // разрешенные типы файлов
    $maxFileSize = 2 * 1024 * 1024; // максимальный размер файла (в данном случае 2 МБ)

    if (!preg_match("/^[a-zA-ZА-яёЁ\s]+$/u", $author)) {
        echo json_encode(['status' => 'fail', 'message' => 'Некорректный формат имени']);
        return true;
    }

    if (!is_numeric($categoryId)) {
        echo json_encode(['status' => 'fail', 'message' => 'Некорректный ввод категории']);
        return true;
    }

    if (!preg_match(
        "/^[a-zA-ZА-яёЁ\s\d.,!?]+$/u",
        $heading
    )) {// Регулярное выражение для проверки текста, выражение, которое позволяет использовать буквы латинского и кириллического алфавита, пробелы, цифры, а также знаки препинания (точка, запятая, вопросительный и восклицательный знаки)
        echo json_encode(['status' => 'fail', 'message' => 'Некорректный ввод заголовка']);
        return true;
    }
    if (!preg_match(
        '/^[a-zA-ZА-яёЁ\s\d.,!?\"]+$/u',
        $article
    //'/^[a-zA-ZА-яёЁ\s\d.,!?]+$/u',
    )) {// Регулярное выражение для проверки текста, выражение, которое позволяет использовать буквы латинского и кириллического алфавита, пробелы, цифры, а также знаки препинания (точка, запятая, вопросительный и восклицательный знаки) под вопросом "
        echo json_encode(['status' => 'fail', 'message' => 'Некорректный ввод текста статьи']);
        return true;
    }
    if (!in_array($image['type'], $allowedTypes)) {
        echo json_encode(['status' => 'fail', 'message' => 'Некорректный тип файла. Разрешены только JPEG и PNG']);
        return true;
    }

    if ($image['size'] > $maxFileSize) {
        echo json_encode(['status' => 'fail', 'message' => 'Размер файла превышает допустимый предел']);
        return true;
    }
    return false;
}
