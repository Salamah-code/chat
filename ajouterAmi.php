<?php
    session_start();
    require_once('basedonnees/db.php');

    if(isset($_SESSION['idMembre']) AND isset($_GET['idUser'])){
        $idMembre = $_SESSION['idMembre'];
        $idOther = $_GET['idUser'];
        $dateDemande = date("Ymd");
// doit d'abord verifier si une demande a ete effectuee vers cet utilisateur

        $verif = $db->prepare("SELECT idDemande FROM demande WHERE idDemandeur = '$idMembre' AND idReceveur = '$idOther' 
        OR idDemandeur = '$idOther' AND idReceveur = '$idMembre'");
        $verif->execute();
        if($verif->fetch()> 0){
            echo "<p>demade encours</p>";
        }else{
            $insrtFriendAsk = $db->prepare("INSERT INTO demande (idDemandeur, idReceveur, dateDemande) VALUES 
            ('$idMembre', '$idOther', '$dateDemande')");
            
            if($insrtFriendAsk->execute()){
                header('Location:index.php');
            }else{
                echo "Echec de demande";
            }
        }
    }else{
        echo "parametre manquants";
    }
?>