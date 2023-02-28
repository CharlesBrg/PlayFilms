<?php

$connexionBDD = new PDO ('mysql:host=localhost;dbname=clicksmoviz;charset=utf8', 'root', 'BC08102003!');

try
{
	$db = new PDO('mysql:host=localhost;dbname=clicksmoviz;charset=utf8', 'root', 'BC08102003!');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
<title>PlayFilms</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
</head>
<header>   
<div class = "TitreFilm" style="cursor : default;">PlayFilms</div> 
</header>  
<body>

        <div class="pre-chargement">
                <span class ="chargement"></span>
        </div>
        <div class="boutons">
        <a href="./inscription.php" class="btn_i">
        S'inscrire
        </a>
        <a href ="./connexion.php" class="btn_co">
        Connexion
        </a>
        </div>
</body>
<script src="./chargement.js"></script>
</html>

        
