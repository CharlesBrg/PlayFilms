<?php
session_start();
$connexionBDD = new PDO ('mysql:host=localhost;dbname=clicksmoviz;charset=utf8', 'root', 'BC08102003!');
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
    <a href="./connexion.php" style="font-size : large;text-decoration:none;color : black;margin-left: 1vh;font-weight:bold;"><- Retour </a>
    <div class = "corpsco">
        
            <?php 
            if ($section == 'code'){ ?>
                <br/>
                <form method="POST" style="margin-top:-2vh;" class="default-form">
                    <div class="inputmail">
                        <input name="verif_code" id = "mail" type="mail" placeholder="   Code de vérification" style ="cursor:pointer;">
                    </div>
                <br />
                    <div class="envoyerco"> 
                        <input name="verif_submit" type="submit" value = "Valider" style="cursor:pointer;">
                    </div>
                </form>
            <?php } elseif ($section== "changemdp") { ?> 
                <h1 style="margin-left:-5vh;">Nouveau mot de passe </h1>
                <form method="POST" style="margin-top:-2vh;" class="default-form">
                    <div class="inputmail">
                        <input name="change_mdp" id = "mail" type="password" placeholder="  Nouveau mot de passe" style ="cursor:pointer;">
                    </div>
                <br />
                    <div class="inputmail">
                        <input name="change_mdpc" id = "mail" type="password" placeholder="   Confirmation" style ="cursor:pointer;">
                    </div>
                <br />
                    <div class="envoyerco"> 
                        <input name="change_submit" type="submit" value = "Valider" style="cursor:pointer;">
                    </div>
                </form>
            <?php } else { ?>
            <form method="POST" style="margin-top:-2vh;" class="default-form">
            <h1 style="margin-left:-5vh;">Récupération de mot de passe</h1>
            <div class="inputmail">
            <input name="recup_mail" id = "mail" type="email" placeholder="   E-mail" style ="cursor:pointer;">
            </div>
            <br />
            <div class="envoyerco"> 
            <input name="recup_submit" type="submit" value = "Valider" style="cursor:pointer;">
            </div>
        </form>
        <?php } ?>
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