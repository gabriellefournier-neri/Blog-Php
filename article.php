<?php
session_start();

$pdo = new PDO("mysql: host=localhost; dbname=blogwebforce", "root", "");
$pdo->exec('SET NAMES UTF8');

//AFFICHER MES ARTICLES SELON ID -----------------------------------------
$query = $pdo->prepare(
    'SELECT
        title,
        body,
        date,
        pseudo
    FROM users
    INNER JOIN articles ON users.id = articles.id_user
    WHERE articles.id = ?'
);
$query->execute(array($_GET['articleNumber']));
//  * La méthode fetch() renvoie un tableau à une dimension
$articleDt = $query->fetch(PDO::FETCH_ASSOC);
// var_dump($articleDt);


//AFFICHER COMMENTAIRES -----------------------------------------------
$query2 = $pdo->prepare(
    'SELECT
        comment.pseudo,
        comment.body,
        comment.date
    FROM comment
    INNER JOIN articles ON articles.id = comment.id_article
    WHERE articles.id = ?'
);
$query2->execute(array($_GET['articleNumber']));
//  * La méthode fetch() renvoie un tableau à une dimension
$comments = $query2->fetchAll(PDO::FETCH_ASSOC);


//AJOUTER COMMENTAIRE -------------------------------------------------
if (isset($_POST['comment'])) {
    $com = $pdo->prepare(
        "INSERT INTO comment (pseudo,body) 
        VALUES (:pseudo,:body)
        WHERE articles.id = ?'
        ");
    $com->bindParam(":pseudo", $_POST['pseudo']);
    $com->bindParam(":body", $_POST['body']);
    $com->execute();

}




include 'article.html';
