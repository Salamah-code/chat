<?php
    session_start();
    require_once('basedonnees/db.php');
    // $_POST['message'] = "Hello";
    // $_SESSION['idMembre'] = 1;
    // $idReceveur = $_SESSION['idReceveur'] = 2;
    if(isset($_FILES['file']) AND isset($_SESSION['idMembre']) AND isset($_SESSION['idReceveur'])){
        //$file = $_FILES['filename'];
        $idEmeteur = $_SESSION['idMembre'];
        $idReceveur = $_SESSION['idReceveur'];

        if($_FILES['file']['error'] == 0){
            $filename = $_FILES['file']['name'];
            $extension_ok = array('pdf', 'gif', 'jpeg', 'jpg', 'png', 'doc', 'docx', 'mp4', 'mp3');
            $file_extension = strtolower(substr(strrchr($filename, '.'), 1));
            if(in_array($file_extension, $extension_ok)){
                if($file_extension == 'jpeg' || $file_extension == 'png' || $file_extension == 'jpeg'){
                    $dosdest = "image";
                    $ajout = DATE('dmY_His',TIME());
                    $filename = $ajout."_".basename($filename);
                    $chemin  = "$dosdest/$filename";

                    if(move_uploaded_file($_FILES['file']['tmp_name'], $chemin)){
                        $insertMsg = $db->prepare("INSERT INTO message (idEmetteur, idDestine, msgText, fichier) 
                        VALUES ('$idEmeteur', '$idReceveur', null, '$chemin')");
                        if($insertMsg->execute()){
                            //echo "geniale";
                            header('Location:index.php');
                        }else{
                            echo "Echec d'envoi de message";
                        }
                    }

                }else if($file_extension == 'pdf' || $file_extension == 'doc' || $file_extension == 'docx'){
                    $dosdest = "documents";
                    $ajout = DATE('dmY_His',TIME());
                    $filename = $ajout."_".basename($filename);
                    $chemin  = "$dosdest/$filename";

                    if(move_uploaded_file($_FILES['file']['tmp_name'], $chemin)){
                        $insertMsg = $db->prepare("INSERT INTO message (idEmetteur, idDestine, msgText, fichier) 
                        VALUES ('$idEmeteur', '$idReceveur', null, '$chemin')");
                        if($insertMsg->execute()){
                            echo "geniale";
                            header('Location:index.php');
                        }else{
                            echo "Echec d'envoi de message";
                        }
                    }

                }else if($file_extension == 'mp3' || $file_extension == 'mp4'){
                    $dosdest = "video_songs";
                    $ajout = DATE('dmY_His',TIME());
                    $filename = $ajout."_".basename($filename);
                    $chemin  = "$dosdest/$filename";

                    if(move_uploaded_file($_FILES['file']['tmp_name'], $chemin)){
                        $insertMsg = $db->prepare("INSERT INTO message (idEmetteur, idDestine, msgText, fichier) 
                        VALUES ('$idEmeteur', '$idReceveur', null, '$chemin')");
                        if($insertMsg->execute()){
                            echo "geniale";
                            header('Location:index.php');
                        }else{
                            echo "Echec d'envoi de message";
                        }
                    }

                }
            }

        }else{
            echo "Votre fichier est incorrecte";
        }

        // $insertMsg = $db->prepare("INSERT INTO message (idEmetteur, idDestine, msgText, fichier) 
        // VALUES ('$idEmeteur', '$idReceveur', null, '$file')");
        // if($insertMsg->execute()){
        //     echo "geniale";
        // }else{
        //     echo "Echec d'envoi de message";
        // }
    }else{
        echo "Parametres manquants ";
    }
?>