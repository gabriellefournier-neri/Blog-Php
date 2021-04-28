<!-- ici session off : btn inscription + connecter 
session start : btn logOut -->

<?php if (la_conditions) { ?>
 <!-- //ici ton code html à interpréter si la condition est remplie -->
<?php } else { ?>
 <!-- //ici le code à exécuter si la condition n'est pas remplie -->
<?php } ?>

<!-- DONC :  -->
<?php if (empty($_SESSION)==true) { ?>
     <!-- //ici le code html à exécuter si la condition est remplie -->
    <a href="signIn.php">
        <i class="las la-user-plus"></i>
        <p>S'inscrire</p>
    </a>
    <a href="login.php" >
        <i class="las la-user-circle" ></i>
        <p>Mon espace</p>
    </a>
<?php } else { ?>
 <!-- //ici le code html à exécuter si la condition n'est pas remplie -->
    <a href="logout.php" alt="Se deconnecter">
        <i class="las la-sign-out-alt"></i>                    
        <p>Déconnecter</p>'
    </a>
<?php } ?>

UPDATE `articles` SET `body` = '6' WHERE `articles`.`id` = 3; pour mise à jour



ajouter un commentaire
INSERT INTO `comment` (`id`, `pseudo`, `body`, `date`, `id_article`) VALUES (NULL, 'Bran Stark', 'Hold the door! ', '2021-04-21', '2');  