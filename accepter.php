<?php
     session_start();
     require_once('basedonnees/db.php');
 
     if(isset($_SESSION['idMembre']) AND isset($_GET['idUser'])){
        $idOne = $_SESSION['idMembre'];
        $idOther = $_GET['idUser'];
        $dateDemande = date("Ymd");

        $verif = $db->prepare("SELECT idAmis FROM amis WHERE idOne = '$idOne' AND idOther = '$idOther' 
        OR idOne = '$idOther' AND idOther = '$idOne'");
        $verif->execute();
        if($verif->fetch() > 0){
            echo "<p>Vous deja amis</p>";
        }else{
            $insrtFriendAsk = $db->prepare("INSERT INTO amis (idOne, idOther, dateAmitie) VALUES 
            ('$idOne', '$idOther', '$dateDemande')");
            
            if($insrtFriendAsk->execute()){
                $supr = $db->prepare("DELETE FROM demande WHERE idReceveur = '$idOne' AND idDemandeur = '$idOther'");
                $supr->execute();
                header('Location:index.php');
            }else{
                echo "Echec de demande";
            }
        }

     }else{
         echo "parametre manquants";
     }

?>