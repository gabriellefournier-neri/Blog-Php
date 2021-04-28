<?php

session_start();

try {
    $pdo=new PDO("mysql: host=localhost; dbname=blogwebforce","root","");
}
catch( PDOException $Exception ) {
    
    echo 'Échec lors de la connexion : '.$Exception->getMessage( );
}
//si mon formulaire est rempli : 
if(isset($_POST['body'])){
    //initialisation de valeur si besoin : 
    // $variable = $_POST['namedansHTML'];

    //péparation de la requete : 
    $ajout = $pdo->prepare(
        "INSERT INTO articles(title,extract,body,id_category) 
                VALUES(:title, :extract, :body, :category)" );

    $ajout->bindParam(":title", $_POST['title']);
    $ajout->bindParam(":extract", $_POST['extract']);
    $ajout->bindParam(":body", $_POST['body']);
    // $ajout->bindParam(":date", $_POST['date']);
    $ajout->bindParam(":category", $_POST['category']);
    $ajout->execute();
    // var_dump($_POST);  //voir que ramene la variable POST globale variable des données recupérées
    header('Location:index.php');
}

include "ajoutarticle.html";