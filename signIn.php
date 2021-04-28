<?php

session_start();

try {
    $pdo=new PDO("mysql: host=localhost; dbname=blogwebforce","root","");
}
catch( PDOException $Exception ) {
    
    echo 'Échec lors de la connexion : '.$Exception->getMessage( );
}

if(isset($_POST['submit'])==false){
	/* TESTER ET VALIDER UN CHAMP */
	/* strlen — Calcule la taille d'une chaîne */
	$error = false;
	if (!isset($_POST['firstName']) || strlen($_POST['firstName']) < 1) {
        $_SESSION['messages'][] = "le champ n'est pas valide.";
        $error = true;
    }

    if (!isset($_POST['lastName']) || strlen($_POST['lastName']) < 1) {
        $_SESSION['messages'][] = "le champ n'est pas valide.";
        $error = true;
    }
      
    if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 1) {
        $_SESSION['messages'][] = "le champ n'est pas valide.";
        $error = true;
    }

    /* la fonction filter_var() avec l'argument | filter_var($_POST['pseudo'],FILTER_VALIDATE_EMAIL permet de valider une adresse mail */
     if (!isset($_POST['email']) || filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) == false) {
        $_SESSION['messages'][] = "le champ n'est pas valide.";
        $error = true;
    }

      /* ctype_alnum — Vérifie qu'une chaîne est alphanumérique */
      if (!isset($_POST['psw']) || !ctype_alnum($_POST['psw']) || strlen($_POST['psw']) < 1) {
        $_SESSION['messages'][] = "le champ n'est pas valide.";
        $error = true;
    }

    /* SI IL N'Y A PAS D'ERREUR => ENVOIE DES DONNES DANS LA BASE DE DONNÉES => REQUETE INSERT INTO */
    if(!$error){

    	$password = $_POST['psw'];
    	$hashPassword = password_hash($password, PASSWORD_DEFAULT);

    	$rep = $pdo->prepare(
            "INSERT INTO users (email,psw,firstName,lastName,pseudo) 
            VALUES (:email,:psw,:firstName,:lastName ,:pseudo)" );

		$rep->bindParam(":email", $_POST['email']);
		$rep->bindParam(":psw", $hashPassword );
		$rep->bindParam(":firstName", $_POST['firstName']);
		$rep->bindParam(":lastName", $_POST['lastName']);
		$rep->bindParam(":pseudo", $_POST['pseudo']);
		$rep->execute();
        var_dump($_POST);  //voir que ramene la variable POST globale variable des données recupérées
		header('Location:index.php');

    }

}





include "signin.html";

?>