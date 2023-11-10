<?php
    session_start();

    require_once("basedonnees/db.php");

    if(isset($_POST['pseudo']) AND isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['mpass'])){
        $pseudo = $_POST['pseudo'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mpass = $_POST['mpass'];

        if(isset($_FILES['profile'])){
            if($_FILES['profile']['error']==0){
                $fileName = $_FILES['profile']['name'];
                $extension_ok = array('jpeg', 'jpg', 'png');
                $fileExt = strtolower(substr(strrchr($fileName, "."), 1));
                if(in_array($fileExt, $extension_ok)){
                    $destDoss = "image";
                    $ajout = DATE('dmY_His',TIME());
                    $fileName = $ajout."_".basename($fileName);
                    $chemin  = "$destDoss/$fileName";
    
                    if(move_uploaded_file($_FILES['profile']['tmp_name'], $chemin)){
                        $verifPseudo = $db->prepare("SELECT idMembre FROM membre WHERE pseudo='$pseudo'");
                        $verifPseudo->execute();
                        
                        if($verifPseudo->fetch() > 0){
                            echo "Cet utilisateur existe deja avec ce pseudo";
                        }else{
                            $insertUser = $db->prepare("INSERT INTO membre(pseudo,nom,prenom, profil, mpass) 
                            VALUES ('$pseudo', '$nom', '$prenom', '$chemin', '$mpass')");
                            if($insertUser->execute()){

                                $insertUserSec = $db->prepare("INSERT INTO membresecondaire(pseudo,nom,prenom, profil, mpass) 
                                VALUES ('$pseudo', '$nom', '$prenom', '$chemin', '$mpass')");
                                if($insertUserSec->execute()){
                                    $_SESSION['pseudo'] = $pseudo;
                                    header('Location:index.php');
                                }else{
                                    echo "probleme";
                                }
                            }else{
                                echo "Echec d'insertion ";
                            }
                        }                
                    }else{
                        echo "Bad extention";
                    }
                }
            }
        }else{
            echo "tas pas choisi photo";
            $profile = "image/imagesprofil.png";
            $verifPseudo = $db->prepare("SELECT idMembre FROM membre WHERE pseudo='$pseudo'");
            $verifPseudo->execute();

            if($verifPseudo->fetch() > 0){
                echo "Cet utilisateur existe deja avec ce pseudo";
            }else{
                $insertUser = $db->prepare("INSERT INTO membre(pseudo,nom,prenom, profil, mpass) 
                VALUES ('$pseudo', '$nom', '$prenom', '$profile', '$mpass')");
                if($insertUser->execute()){
                    
                    $insertUserSec = $db->prepare("INSERT INTO membresecondaire(pseudo,nom,prenom, profil, mpass) 
                        VALUES ('$pseudo', '$nom', '$prenom', '$profile', '$mpass')");

                    if($insertUserSec->execute()){
                        $_SESSION['pseudo'] = $pseudo;
                        header('Location:index.php');
                    }else{
                        echo "probleme";
                    }
                }else{
                    echo "Echec d'insertion ";
                }
            }
        }
    }else{
        header('Location:inscription.php');
        echo "Remplissez tous les champ requis";
    }
?>