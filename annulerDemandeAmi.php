<?php
    session_start();
    require_once('basedonnees/db.php');

    if(isset($_SESSION['idMembre']) AND isset($_GET['idUser'])){
        $idMembre = $_SESSION['idMembre'];
        $idOther = $_GET['idUser'];

        $supFrd = $db->prepare("DELETE FROM demande WHERE idDemandeur = '$idMembre' AND idReceveur = '$idOther'");
        if($supFrd->execute()){
            header('Location:index.php');
        }else{
            echo "Impossible de supprimer";
        }

    }else{
        echo "Parametres manquents";
    }
?>