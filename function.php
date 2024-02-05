<?php

include __DIR__ . '/models/db.php';

//На главной странице выводится список статей
function allPosts()
{
    //все статьи из articles = heading, image
    global $connection;
    $query = "SELECT id, heading, image FROM articles";
    $result = mysqli_query($connection, $query);
    return $result;

}

// Страница одной статьи все данные кроме id
function post()
{   //статья из articles = heading,  category_id (чтобы получить название категории), author , article, image, created_at
    //из табл categories надо title
    global $connection;
    $query = "SELECT c.title AS category, a.id, a.heading, a.author, a.created_at, a.image, a.article
        FROM articles AS a
        LEFT JOIN categories AS c ON c.title = a.category_id"  ;
    $result = mysqli_query($connection, $query);
    return $result;
}

//На главной странице выводится список категорий
function categories()
{
    //все категории из categories
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);
    return $result;
}
