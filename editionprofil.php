<?php

session_start();

$connexionBDD = new PDO ('mysql:host=localhost;dbname=clicksmoviz;charset=utf8', 'root', 'BC08102003!');

if(isset($_SESSION['id']))
{
    $requser = $connexionBDD->prepare ("SELECT * FROM utilisateur WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    if (isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
    {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $pseudolength = strlen($newpseudo);
        if($pseudolength <= 255)
        {
            $insertpseudo = $connexionBDD->prepare("UPDATE utilisateur SET pseudo = ? WHERE id = ?");
            $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);
        }
        else
        {
            $msg = "Votre pseudo ne doit pas dépasser 255 caractères !";
        }
    }
    if (isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom'])
    {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $connexionBDD->prepare("UPDATE utilisateur SET nom = ? WHERE id = ?");
        $insertnom->execute(array($newnom, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if (isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom'])
    {
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertprenom = $connexionBDD->prepare("UPDATE utilisateur SET prenom = ? WHERE id = ?");
        $insertprenom->execute(array($newprenom, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if (isset($_POST['newtelephone']) AND !empty($_POST['newtelephone']) AND $_POST['newtelephone'] != $user['telephone'])
    {
        $newtelephone = htmlspecialchars($_POST['newtelephone']);
        $inserttelephone = $connexionBDD->prepare("UPDATE utilisateur SET telephone = ? WHERE id = ?");
        $inserttelephone->execute(array($newtelephone, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if (isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['adresse'])
    {
        $newadresse = htmlspecialchars($_POST['newadresse']);
        $insertadresse = $connexionBDD->prepare("UPDATE utilisateur SET adresse = ? WHERE id = ?");
        $insertadresse->execute(array($newadresse, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
        $newmail = htmlspecialchars($_POST['newmail']);
        if (filter_var($newmail, FILTER_VALIDATE_EMAIL)) 
        {
            $reqmail = $connexionBDD->prepare("SELECT mail FROM utilisateur WHERE mail = ?");
            $reqmail->execute(array($newmail));
            $mailexist = $reqmail->rowCount();
            if ($mailexist == 0) 
            {
                $insertmail = $connexionBDD->prepare("UPDATE utilisateur SET mail = ? WHERE id = ?");
                $insertmail->execute(array($newmail, $_SESSION['id']));
                header('Location: profil.php?id='.$_SESSION['id']);
            }
            else
            {
                $msg = "Email déjà utilisé ! ";
            }       
        }
        else
        {
            $msg = "Votre email n'est pas valide !";
        }
    }
    if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1'])AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
    {
        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);
        if($mdp1 == $mdp2)
        {
            $insertmdp = $connexionBDD->prepare("UPDATE utilisateur SET motdepasse = ? WHERE id = ?");
            $insertmdp -> execute(array($mdp1, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);
        }
        else 
        {
            $msg = "Vos deux mots de passe ne correspondent pas !";
        }
    }
    if (isset($_POST['newpseudo']) AND $_POST['newpseudo'] == $user['pseudo'])
    {
        header('Location: profil.php?id='.$_SESSION['id']);
    }
}
else 
{
    header("Location: connexion.php");
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
<div class = "banniere" style="cursor:default;">PlayFilms</div> 
<body>
    <div class="pre-chargement">
        <span class ="chargement"></span>
    </div>
    <div align="center">
        <h2 style="font-size:xxx-large;margin-top:1vh;">Modifier le profil</h2>
        <form method="POST" action="">
            <input type="text" id = "pseudoedit" name = "newpseudo" placeholder="Pseudo" value = "<?php echo $user['pseudo']; ?>" /><br /><br />
            <input type="text" id = "nomedit" name = "newnom" placeholder="Nom" value = "<?php echo $user['nom']; ?>"/><br /><br />
            <input type="text" id = "prenomedit" name = "newprenom" placeholder="Prenom" value = "<?php echo $user['prenom']; ?>" /><br /><br />
            <input type="tel" id = "telephonedit" name = "newtelephone" placeholder="Telephone" value = "<?php echo $user['telephone']; ?>"/><br /><br />
            <input type="text" id = "adresseedit" name = "newadresse" placeholder="Adresse" value = "<?php echo $user['adresse']; ?>" /><br /><br />
            <input type="text" id = "mailedit" name = "newmail" placeholder="Mail" value = "<?php echo $user['mail']; ?>" /><br /><br />
            <input type="password" id ="mdp1edit" name = "newmdp1" placeholder="Mot de passe" /><br /><br />
            <input type="password" id = "mdp2edit" name = "newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
            <input type="submit" id = "maj" value = "Mettre à jour mon profil "/><br /><br />
        </form>
        <?php if(isset($msg)) {echo '<font color ="red" style="font-size:x-large;margin-top: 31vh;margin-left: -45vh;font-weight: bold;">' .$msg. "</font>";}?>
    </div> 
</body>
</html>
<script src="./chargement.js"></script>

