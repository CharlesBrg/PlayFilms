<?php
session_start();
$connexionBDD = new PDO ('mysql:host=localhost;dbname=clicksmoviz;charset=utf8', 'root', 'BC08102003!');

if(isset($_POST['formconnexion']))
{
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if(!empty($mailconnect) AND !empty($mdpconnect))
    {
        $requser = $connexionBDD -> prepare("SELECT * FROM utilisateur WHERE mail = ? AND motdepasse = ?");
        $requser -> execute(array($mailconnect,$mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location:accueil.php?id=".$_SESSION['id']);
        }
        else
        {
            $erreur = "Identifiant ou mot de passe incorrect";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
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
<div class = "TitreFilm" style="cursor : default;">PlayFilms</div> 
</header>  
<body>
    <div class="pre-chargement">
        <span class ="chargement"></span>
    </div>
    <a href="./index.php" style="font-size : large;text-decoration:none;color : black;margin-left: 1vh;font-weight:bold;"><- Retour </a>
    <div class = "corpsco">
        <form method="POST" action ="connexion.php" style="margin-top:-5vh;">
            <h1 style="margin-left:9vh;">Connexion</h1>
            <div class="inputmail">
            <input name="mailconnect" id = "mail" type="email" placeholder="   E-mail" style ="cursor:pointer;">
            </div>
            <br />
            <div class="inputmdp">
            <input name="mdpconnect" id = "mdp" type="password" placeholder = "   Mot de passe"style="cursor:pointer;">
            </div>
            <br />
            <div class="envoyerco"> 
            <input name="formconnexion" type="submit" value = "Se connecter" style="cursor:pointer;">
            </div>
        </form>
        <div class="recup" style="margin-top:32vh;margin-left:-33vh;">
            <a href="recuperation.php"> Mot de passe oublié ? </a>
        </div>
        <?php
        if(isset($erreur))
        {
            echo '<font color ="red" style="font-size:x-large;margin-top: 31vh;margin-left: -45vh;font-weight: bold;">' .$erreur. "</font>";
        }
        ?>
    </div> 
</body>
<script src="./chargement.js"></script>
<script src="https://kit.fontawesome.com/edcc9f802a.js" crossorigin="anonymous"></script>