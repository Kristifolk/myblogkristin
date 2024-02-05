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
