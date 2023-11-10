<?php
    require_once('basedonnees/db.php');
    //$_POST['motCle'] = "T";
    if(isset($_POST['motCle'])){
        $motCle = $_POST['motCle'];
        $rech = $db->prepare("SELECT * FROM membre WHERE nom LIKE '%$motCle%' OR prenom LIKE '%$motCle%'");
        if($rech->execute()){
            $res = $rech->fetchAll();
            foreach($res as $user){
                ?>
                <div class="container-fluid border border-3 rounded user-friend mt-2 align-items-center">
                    <div class="row mt-2 p-1">
                        <div class="col">
                            <img src="<?php echo $user['profil']?>" class="rounded-circle profil">
                        </div>
                        <div class="col">
                            <h5 class="text-white"><?php echo $user['prenom']." ".$user['nom']?></h5>
                        </div>
                        <div class="col">
                            
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }else{
        ?>
        <p>Il n'y pas d'utilisateur</p>
        <?php
    }
?>