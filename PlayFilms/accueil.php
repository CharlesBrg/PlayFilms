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
<div class = "banniere" style="cursor:default;">PlayFilms</div> 
<body>
    <div class="pre-chargement">
        <span class ="chargement"></span>
    </div>
</body>
</html>


<script src="./chargement.js"></script>