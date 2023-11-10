<?php
    session_start();

    require_once('basedonnees/db.php');
    if(isset($_POST['pseudo']) AND isset($_POST['mpass'])){
        $pseudo = $_POST['pseudo'];
        $mpass = $_POST['mpass'];
        $verif = $db->prepare("SELECT idMembre, mpass FROM membre WHERE pseudo='$pseudo' AND mpass='$mpass'");
        $verif->execute();
        if($verif->fetch() > 0){
            $_SESSION['pseudo'] = $pseudo;
            header('Location:index.php');
            exit;
        }else{
            header('Location:connexion.php');
        }
    }else{

    }
?>