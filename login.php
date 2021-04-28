<?php
// si session existe => ira chercher $_SESSION sinon, va créer une pour stocker tout 
session_start();

$error = false;  //initialisation à faux 
$message = ''; // préparation variable 'Message'
       
if (!empty($_POST)) {
	// var_dump($_POST);

	$pdo = new PDO("mysql: host=localhost; dbname=blogwebforce","root","");
	$pdo->exec('SET NAMES UTF8');
    

    // requete : recupere les infos de l'utilisateurs et je filtre par l'email
    $query = $pdo->prepare(
        'SELECT * FROM users WHERE email= ?'
	);

	$query->execute([ $_POST['email']]); //change mon point d'intérogation par l'email saisi email:name de l'input

    $user = $query->fetch(PDO::FETCH_ASSOC); //récupère une ligne du tableau demandé
    
    // Action : 
    if($user == false) {
        $error = true;
        $message = "Cette adresse mail n'existe pas...";
    }
	else if( $user['email'] == $_POST['email'] && password_verify($_POST['psw'],$user['psw']) ) {
    
        //je stock le contenu de ma base de données dans des $_SESSION SUPER GLOBALE pouvant etre utilisé PARTOUT!! 
        $_SESSION['email'] = $user['email'];
        $_SESSION['psw'] = $user['psw'];
        $_SESSION['firstName'] = $user['firstname'];
        $_SESSION['lastName'] = $user['lastname'];
        $_SESSION['pseudo'] = $user['pseudo']; 
        // $_SESSION['LeNomQueJeVeux'] = $user['nomDeColones']

        // var_dump($_SESSION);
        header('Location:index.php'); // Si connexion réussi aller vers page accueil 
    } 
    else {
        $error = true;
        $message = "Mot de passe incorrect...";
    }
}

include "login.html";






?>