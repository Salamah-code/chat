<?php
    session_start();
    require_once('basedonnees/db.php');

    if(isset($_SESSION['idMembre']) AND isset($_SESSION['idReceveur'])){
        $idMembre = $_SESSION['idMembre'];
        $idReceveur = $_SESSION['idReceveur'];

        $msgEnvs = $db->prepare("SELECT idEmetteur,idDestine, msgText, fichier FROM message WHERE idEmetteur = '$idMembre' AND idDestine = '$idReceveur' 
        OR idEmetteur = '$idReceveur' AND idDestine = '$idMembre' ORDER BY idMessage ASC");
        $msgEnvs->execute();

        while($msgEnv = $msgEnvs->fetch()){
            if($msgEnv['idEmetteur'] == $idMembre){
                $extFile = strtolower(substr(strrchr($msgEnv['fichier'], '.'), 1));
                if($extFile == 'png' || $extFile == 'jpg' || $extFile == 'jpeg' || $extFile == 'gif'){
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <img src='<?php echo $msgEnv['fichier']?>' height='100px' width='100px' class='text-white msgFileENv'>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }else if($extFile == 'pdf' || $extFile == 'doc' || $extFile == 'docx'){
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <a href='<?php echo $msgEnv['fichier']?>' download="document" height='100px' width='100px' class='text-white msgFileENvdoc'><button class="btn w-50 bg-success text-white"><i class="far fa-file-pdf"> Cliquer pour telecharger</button></i></i></a>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }else if($extFile == 'mp3'){
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <figure>
                        <audio  src='<?php echo $msgEnv['fichier']?>' controls="controls" class='text-white msgFileENv'></audio>
                    </figure>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }else if($extFile == 'mp4'){
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <figure>
                        <video  src='<?php echo $msgEnv['fichier']?>' controls="controls" height='100px' width='100px' class='text-white msgFileENv'></video>
                    </figure>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }else{
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p class='text-white msgENv'><?php echo $msgEnv['msgText']?></p>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }
                
            }else if($msgEnv['idEmetteur'] == $idReceveur){

                $extFile = strtolower(substr(strrchr($msgEnv['fichier'], '.'), 1));
                if($extFile == 'png' || $extFile == 'jpg' || $extFile == 'jpeg' || $extFile == 'gif'){
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <img src='<?php echo $msgEnv['fichier']?>' height='100px' width='100px' class='text-white msgFileRecu'>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }else if($extFile == 'pdf' || $extFile == 'doc' || $extFile == 'docx'){
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <a href='<?php echo $msgEnv['fichier']?>' download="document" height='100px' width='100px' class='text-white msgFileENvdoc'><button class="btn w-50 bg-success text-white"><i class="far fa-file-pdf"> Cliquer pour telecharger</button></i></i></a>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }else if($extFile == 'mp3'){
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <figure>
                        <audio  src='<?php echo $msgEnv['fichier']?>' controls="controls" class='text-white msgFileRecu'></audio>
                    </figure>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }else if($extFile == 'mp4'){
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <figure>
                        <video  src='<?php echo $msgEnv['fichier']?>' controls="controls" height='100px' width='100px' class='text-white msgFileRecu'></video>
                    </figure>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }else{
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p class='text-white msgRecu'><?php echo $msgEnv['msgText']?></p>
                    <!-- <br><p class='text-white msgRecu'></p> -->
                    <?php
                }
            }
        }
    }

?>