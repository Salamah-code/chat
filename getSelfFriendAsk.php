<?php
    session_start();
    require_once('basedonnees/db.php');

    if(isset($_SESSION['idMembre'])){
        $idMembre = $_SESSION['idMembre'];

        $recupFrndAsks = $db->prepare("SELECT idReceveur FROM demande WHERE idDemandeur = '$idMembre'");
        //$recupFrndAsks->execute();
        if($recupFrndAsks->execute()){
            //echo "good";

            //$recupFrndAsks->fetch();

            while($recupFrndAsk = $recupFrndAsks->fetch()){
                $idAsker = $recupFrndAsk['idReceveur'];
                $getAskers = $db->prepare("SELECT * FROM membre WHERE idMembre = '$idAsker'");
                $getAskers->execute();
                //var_dump($getAskers->fetch());
                while($getAsker = $getAskers->fetch()){
                    ?>
                    <div class="container-fluid border rounded user-friend mt-2 align-items-center">
                        <div class="row mt-2 p-1">
                            <div class="col">
                            <img src="<?php echo $getAsker['profil']?>" class="rounded-circle profil">
                            </div>
                            <div class="col">
                                <h5 class="text-white"><?php echo $getAsker['prenom']." ".$getAsker['nom']?></h5>
                            </div>
                            <div class="col">
                                <a class="bg-danger rounded btn text-white" href="annulerDemandeAmi.php?idUser=<?php echo $getAsker['idMembre']?>"><i class="far fa-window-close"></i>Annuler</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }

            }

        }else{
            echo "<p>Vous n'avez pas encore effectue de demande d'ami</p>";
        }

    }
?>