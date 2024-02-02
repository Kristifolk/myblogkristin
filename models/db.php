<?php

// Сохранение данных в базу данных
$dbHost = 'db-myblogkristin';


$dbUser = 'root';
$dbPassword = 'root';
$dbName = 'myblogkristin';

$connection = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
if (!$connection) {
    die('Ошибка подключения к базе данных: ' . mysqli_connect_error());
}

$query = " SELECT 1 FROM information_schema.tables WHERE table_schema = 'myblogkristin' AND table_name = 'users' LIMIT 1";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) < 1) {//если таблица не существует, те первое обращение, то создать ее
    $query = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            tel VARCHAR(20) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            UNIQUE (name),
            UNIQUE (tel),
            UNIQUE (email)
        )";
    mysqli_query($connection, $query);
}

$query = " SELECT 1 FROM information_schema.tables WHERE table_schema = 'myblogkristin' AND table_name = 'categories' LIMIT 1";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) < 1) {//если таблица не существует, те первое обращение, то создать ее
    $query = "CREATE TABLE categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL
    )";
    mysqli_query($connection, $query);

$query = "INSERT INTO `categories` (`id`, `title`) VALUES
        (1, 'Рассказы'),
        (2, 'Походы'),
        (3, 'Города'),
        (4, 'Здоровье'),
        (5, 'Прочее')";
         mysqli_query($connection, $query);
}

$query = " SELECT 1 FROM information_schema.tables WHERE table_schema = 'myblogkristin' AND table_name = 'articles' LIMIT 1";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) < 1) {//если таблица не существует, те первое обращение, то создать ее
    $query = "CREATE TABLE articles (
            id INT AUTO_INCREMENT PRIMARY KEY,
            heading VARCHAR(255) NOT NULL,
            category_id INT DEFAULT NULL,
            author VARCHAR(255) NOT NULL,
            article TEXT NOT NULL,
            image VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            UNIQUE (heading),
            FOREIGN KEY (category_id) REFERENCES categories(id)
        )";
    mysqli_query($connection, $query);
}



//$query = "INSERT INTO articles (category_id) SELECT id FROM categories";
//mysqli_query($connection, $query);

//TODO При запуске докер - должна устанавливаться база, в которой будет 5-6 статей примеров