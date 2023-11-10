<?php
    session_start();
    require_once("basedonnees/db.php");

    if(isset($_SESSION['idMembre'])){
        $idMembre = $_SESSION['idMembre'];

        $allFriends = $db->prepare("SELECT idOther FROM amis WHERE idOne = '$idMembre'");
        $allFriends->execute();

        while($allFriend = $allFriends->fetch()){
            $idFriend = $allFriend['idOther'];
            $recupFriends = $db->prepare("SELECT * FROM membre WHERE idMembre = '$idFriend'");
            //$recupFriends->execute();

            if($recupFriends->execute()){
                
                while($recupFriend = $recupFriends->fetch()){
                    ?>
                    <a href="index.php?prenom=<?php echo $recupFriend['prenom']?>&nom=<?php echo $recupFriend['nom']?>&idMbre=<?php echo $recupFriend['idMembre']?>&profil=<?php echo $recupFriend['profil'] ?>" class="text-white">
                        <div class="container-fluid border rounded shadow-lg user-friend mt-2 align-items-center">
                            <div class="row mt-2 p-1">
                                <div class="col">
                                    <img src="<?php echo $recupFriend['profil'] ?>" class="rounded-circle profil">
                                </div>
                                <div class="col">
                                    <h5 class="text-white"><?php echo $recupFriend['prenom']." ".$recupFriend['nom'] ?></h5>
                                </div>
                                <div class="col">
                                   <a class="mt-3 bg-danger rounded btn sup" href="suprimerAmi.php?idUser=<?php echo $recupFriend['idMembre']?>">
                                        <i class="fas fa-user-minus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }

            }else{
                echo "bad";
            }
        }


        $allOthersFriends = $db->prepare("SELECT idOne FROM amis WHERE idOther = '$idMembre'");
        $allOthersFriends->execute();
        $res = $allOthersFriends->fetchAll();
        //var_dump($res);

        // while($allOtherFriend = $allOthersFriends->fetch()){
        foreach($res as $allOtherFriend){
            $idOtherFriend = $allOtherFriend['idOne'];
            $recupOthersFriends = $db->prepare("SELECT * FROM membre WHERE idMembre = '$idOtherFriend'");
            //$recupFriends->execute();

            if($recupOthersFriends->execute()){
                
                while($recupOtherFriend = $recupOthersFriends->fetch()){
                    ?>
                    <a class="text-white d-flex flex-wrap" href="index.php?prenom=<?php echo $recupOtherFriend['prenom']?>&nom=<?php echo $recupOtherFriend['nom']?>&idMbre=<?php echo $recupOtherFriend['idMembre']?>&profil=<?php echo $recupOtherFriend['profil']?>">
                        <div class="container-fluid border border-3 rounded shadow-lg user-friend mt-2 align-items-center">
                            <div class="row mt-2 p-1">
                                <div class="col">
                                    <img src="<?php echo $recupOtherFriend['profil'] ?>" class="rounded-circle profil">
                                </div>
                                <div class="col">
                                    <h5 class="text-white"><?php echo $recupOtherFriend['prenom']." ".$recupOtherFriend['nom'] ?></h5>
                                </div>
                                <div class="col">
                                    <a class="mt-3 bg-danger rounded btn sup" href="suprimerAmiOther.php?idUser=<?php echo $recupOtherFriend['idMembre']?>">
                                        <i class="fas fa-user-minus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }

            }else{
                echo "bad";
            }
        }

    }else{
        echo "parametre manquant";
    }
?>