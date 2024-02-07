<?php

include __DIR__ . '/models/db.php';

//На главной странице выводится список статей
function allPosts()
{
    //все статьи из articles = heading, image
    global $connection;
    $query = "SELECT * FROM articles";
    return mysqli_query($connection, $query);
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
//        JOIN categories AS c ON c.id = a.category_id";
    return mysqli_query($connection, $query);
}

//Список категорий
function categories(): array
{
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);//MYSQLI_ASSOC - это константа, которая указывает функции mysqli_fetch_all() возвращать результат запроса в виде ассоциативного массива
}

// Все посты одной категории
function articlesByCategoryId($id): array
{
    global $connection;
    $query = "SELECT c.title AS category, a.id, a.heading, a.author, a.created_at, a.image, a.article 
        FROM articles AS a
        JOIN categories AS c ON c.id = a.category_id
        WHERE c.id=$id";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getSearch($search)
{
    global $connection;
    $query = "SELECT * FROM articles
    WHERE heading LIKE '%{$search}%'";//По ТЗ LIKE, поиск работает по заголовкам,но если в поиске введен текст запроса начиная с пробела, то не работает
//    $query = "SELECT * FROM articles WHERE MATCH (heading, article) AGAINST ('$search')";//поиск по заголовкам и телу статьи, пробелы в начале игноиуются
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
//Конструкция LIKE '%{$search}%' для поиска значений, которые содержат заданную подстроку $search.
// Здесь % - это символ подстановки, который соответствует любому количеству символов (включая ноль символов).