<?php

session_start();

$connexionBDD = new PDO ('mysql:host=localhost;dbname=clicksmoviz;charset=utf8', 'root', 'BC08102003!');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $connexionBDD->prepare('SELECT * FROM utilisateur WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
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
<div class = "banniere" style = "cursor:default;">PlayFilms</div> 
<br/>
<body>
    <div class="pre-chargement">
        <span class ="chargement"></span>
    </div>
    <div align="center">
        <h2 style="font-size:xxx-large;font-weight:bold;">Profil de <?php echo $userinfo['pseudo']; ?></h2>
        <br />
        <h1>Pseudo : <?= $userinfo['pseudo']; ?></h1>
        <h1>Mail : <?= $userinfo['mail']; ?></h1>
        <?php
        if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
        {
        ?>
        <br />
        <div class="editer">
        <a href="editionprofil.php">Editer mon profil</a>
        </div>
        <br/>
        <div class ="deco">
        <a href="deconnexion.php">Se déconnecter</a>
        </div>
        <?php
        }
        ?>
</body>
</html>
<script src="./chargement.js"></script>

