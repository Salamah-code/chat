<?php
    session_start();
    require_once("basedonnees/db.php");

    if(isset($_SESSION['idMembre'])){
        $idMembre = $_SESSION['idMembre'];

        $getAllUser = $db->prepare("SELECT * FROM membre WHERE idMembre != '$idMembre'");
        $getAllUser->execute();

        $res = $getAllUser->fetchAll();

        //var_dump($res);

        foreach($res as $user){
            ?>

            <div class="container-fluid border rounded user-friend mt-2 align-items-center">
                <div class="row mt-2 p-1">
                    <div class="col">
                        <img src="<?php echo $user['profil'] ?>" class="rounded-circle profil">
                    </div>
                    <div class="col">
                        <h5 class="text-white"><?php echo $user['prenom']." ".$user['nom'] ?></h5>
                    </div>
                    <div class="col">
                        <a class=" bg-success rounded btn" href="ajouterAmi.php?idUser=<?php echo $user['idMembre']?>"><i class="fas fa-user-plus"></i></a>
                    </div>
                </div>
            </div>
            <?php
        }
    }else{
        echo "Il n'y pas d'autres utilisateur pour l'instant";
    }

?>