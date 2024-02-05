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

// Страница одной статьи
function post($id)
{   //статья из articles = heading,  category_id (чтобы получить название категории), author , article, image, created_at
    //из табл categories надо title
    global $connection;
    $id = mysqli_real_escape_string($connection, $id); // Экранирование значения $id. иначе может привести к уязвимости SQL-инъекции.
    $query = "SELECT c.title AS category, a.id, a.heading, a.author, a.created_at, a.image, a.article 
        FROM articles AS a
        JOIN categories AS c ON c.id = a.category_id
        WHERE a.id=$id";
//    $query = "SELECT c.title AS category, a.id, a.heading, a.author, a.created_at, a.image, a.article
//        FROM articles AS a
//        JOIN categories AS c ON c.id = a.category_id"  ;
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

// Страница одной категории
function postsCategory()
{
    //все посты одной из категории
    global $connection;
    $query = "SELECT c.title AS category, a.id, a.heading, a.author, a.created_at, a.image, a.article 
        FROM articles AS a
        JOIN categories AS c ON c.id = a.category_id
        WHERE c.id=category_id";
    $result = mysqli_query($connection, $query);
    return $result;
}
