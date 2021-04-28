<?php
session_start();

$pdo = new PDO("mysql: host=localhost; dbname=blogwebforce","root","");
$pdo->exec('SET NAMES UTF8');

$query =$pdo->prepare(
    'SELECT 
        id,
        title,
        extract,
        body,
        id_user
    FROM articles
    ORDER BY RAND()
    LIMIT 5'
    );

$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

// IF SESSION START AFFICHER TOUT
$query2 =$pdo->prepare(
    'SELECT 
        id,
        title,
        extract,
        body,
        id_user
    FROM articles
    ORDER BY id DESC'
    );

$query2->execute();
$articlesFULL = $query2->fetchAll(PDO::FETCH_ASSOC);




include "index.html";

?>