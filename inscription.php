<?php

$connexionBDD = new PDO ('mysql:host=localhost;dbname=clicksmoviz;charset=utf8', 'root', 'BC08102003!');

if(isset($_POST['forminscription']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = sha1($_POST['motdepasse']);
    $pseudolength = strlen($pseudo);
    if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['motdepasse'])){
        if($pseudolength <= 255)
        {
            if (filter_var($mail, FILTER_VALIDATE_EMAIL)) 
            {
                $reqmail = $connexionBDD->prepare("SELECT mail FROM utilisateur WHERE mail = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                    if ($mailexist == 0) {
                    $insertmembre = $connexionBDD->prepare("INSERT INTO utilisateur(pseudo, mail, motdepasse) VALUES(?,?,?)");
                    $insertmembre -> execute(array ($pseudo, $mail, $mdp));
                    $_SESSION['comptecree'] = "Inscription effectuée ";
                    $erreur = "Votre compte a bien été crée ! <a href=\"connexion.php\"> Me connecter</a>";
                    header('Location: connexion.php');
                    } else {
                        $erreur = " Adresse déjà utilisée ! ";
                    }
            } else {
                $erreur = " Votre adresse mail n'est pas valide ! ";
            }
        } else {
            $erreur = " Votre pseudo ne doit pas dépasser 255 caractères ! ";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>PlayFilms</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" 
    href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ81WUE00s/"
    crossorigin="anonymous">

</head>
<header>   
<div class = "TitreFilm" style="cursor:default;">PlayFilms</div> 
</header>  
<body>
    <div class="pre-chargement">
                    <span class ="chargement"></span>
    </div>
    <a href="./index.php" style="font-size : large;text-decoration:none;color : black;margin-left: 1vh; font-weight:bold;"><- Retour </a>
    <div class = "corps">
        <form method="POST" action ="inscription.php">
        <div class="field-name active">
            <i class ="fas fa-user" style="cursor:default;"></i>
            <input name="pseudo" id ="pseudoi" type="text" placeholder="Pseudonyme" style="cursor:pointer;" required>
            <i class = "fas fa-arrow-down"></i>
        </div> 
        <div class="field-email innactive">
            <i class = "fas fa-arrow-down"></i>
            <input name="mail" id="maili"type="email" placeholder="Email" style="cursor:pointer;" required>
            <i class = "fas fa-arrow-down"></i>
        </div>
        <div class="field-password innactive">
            <i class = "fas fa-key"style="cursor:default;"></i>
            <input name="motdepasse" id = "mdpi" type="password" placeholder = "Mot de passe" style="cursor:pointer;" required>
            <i class = "fas fa-arrow-down"></i>
        </div>
        <div class="field-submit innactive">
            <button type ="submit" name="forminscription" class ="btn" style ="cursor:pointer;">Envoyer</button>
        </div>
        </form>
        <?php
        if(isset($erreur))
        {
            echo '<font color ="red" style="font-size:x-large;margin-top: 31vh;margin-left: -45vh;font-weight: bold;">' .$erreur. "</font>";
        }
        ?>
    </div>
</body>

<script src="./slide.js"></script>
<script src="./chargement.js"></script>
<script src="https://kit.fontawesome.com/edcc9f802a.js" crossorigin="anonymous"></script>
