<?php
$connexionBDD = new PDO ('mysql:host=localhost;dbname=clicksmoviz;charset=utf8', 'root', 'BC08102003!');

if(isset($_GET['section'])){
    $section = htmlspecialchars($_GET['section']);
} else {
    $section = "";
}

if(isset($_POST['recup_submit'],$_POST['recup_mail'])){
        if(!empty($_POST['recup_mail'])){
            $recup_mail = htmlspecialchars($_POST['recup_mail']);
            if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)){
                $mailexist=$connexionBDD->prepare('SELECT id,pseudo from utilisateur where mail= ?');
                $mailexist->execute(array($recup_mail));
                $mailexist_count=$mailexist->rowCount();
                if($mailexist_count==1){
                    $pseudo = $mailexist->fetch();
                    $pseudo = $pseudo['pseudo'];
                    $_SESSION['recup_mail'] = $recup_mail;
                    $recup_code = "";
                    for($i=0; $i < 8; $i++){
                        $recup_code .= mt_rand(0,9);
                    }

                    $mail_recup_exist = $connexionBDD ->prepare('SELECT id FROM recuperation WHERE mail = ?');
                    $mail_recup_exist->execute(array($recup_mail));
                    $mail_recup_exist = $mail_recup_exist->rowCount();

                    if($mail_recup_exist==1){
                        $recup_insert = $connexionBDD ->prepare ('UPDATE recuperation SET code = ? WHERE mail = ?');
                        $recup_insert ->execute(array($recup_code,$recup_mail));
                    }else{
                        $recup_insert = $connexionBDD ->prepare ('INSERT INTO recuperation(mail,code) VALUES (?,?)');
                        $recup_insert ->execute(array($recup_mail,$recup_code));
                    }
                    $header="MIME-Version: 1.0\r\n";
                    $header.='From: PlayFilms.com""<support@playfilms.com>'."\n";
                    $header.='Content-Type:text/html; charset="uft-8"'."\n";
                    $header.='Content-Transfer-Encoding: 8bit';

                    $message='
                    <html>
                        <title>Récupération de mot de passe - PlayFilms.com</title>
                        <body>
                            <div align="center"> Bonjour <b>'.$pseudo.'<b>, <div
                                <br />
                                Voici votre code de récupération :<b> '.$recup_code.'</b><br />
                                <br />
                            </div>
                        </body>
                    </html>
                    ';
                    mail($recup_mail, "Récupération de mot de passe - PlayFilms.com", $message, $header);
                    header("Location:http://localhost/PROJET%20BTS%20(STREAMING%20WEBSITE)/recuperation.php?section=code");
                    }
                }else{
                    $erreur = "Cette adresse mail n'est pas enregistrée";
                }
            }else{
                $erreur = "Adresse mail invalide";
            }
        }else{
            $erreur = "Veuillez entrer votre adresse mail";
        }   

    
if(isset($_POST['verif_submit'],$_POST['verif_code'])){
    if(!empty($_POST['verif_code'])){
        $verif_code = htmlspecialchars($_POST['verif_code']);
        $verif_req = $connexionBDD->prepare('SELECT id FROM recuperation WHERE mail = ? AND code = ?');
        $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
        $verif_req = $verif_req->rowCount();
        if($verif_req==1){
            $del_req = $connexionBDD->prepare('DELETE FROM recuperation WHERE mail = ?');
            $del_req->execute(array($_SESSION['recup_mail']));
            header('Location:http://localhost/PROJET%20BTS%20(STREAMING%20WEBSITE)/recuperation.php?section=changemdp');
        }else{
            $erreur = "Code invalide !";
        }
    }else{
        $erreur = "Veuillez entrer votre code de confirmation !";
    }
}
    
    require_once('recuperation.view.php');
?>