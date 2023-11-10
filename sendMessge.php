<?php
    session_start();
    require_once('basedonnees/db.php');
    // $_POST['message'] = "Hello";
    // $_SESSION['idMembre'] = 1;
    // $idReceveur = $_SESSION['idReceveur'] = 2;
    if(isset($_POST['message']) AND isset($_SESSION['idMembre']) AND isset($_SESSION['idReceveur'])){
        $message = $_POST['message'];
        $idEmeteur = $_SESSION['idMembre'];
        $idReceveur = $_SESSION['idReceveur'];

        $insertMsg = $db->prepare("INSERT INTO message (idEmetteur, idDestine, msgText, fichier) 
        VALUES ('$idEmeteur', '$idReceveur', '$message', null)");
        if($insertMsg->execute()){
            echo "geniale";
        }else{
            echo "Echec d'envoi de message";
        }
    }else{
        echo "Parametres manquants ";
    }
?>