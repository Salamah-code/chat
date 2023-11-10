<?php
    session_start();
    session_unset();
    session_destroy();
    session_commit();

    // $idMembre = $_SESSION['idMembre'];
    // unset($_SESSION['idMembre'], $idMembre);

    header('Location:connexion.php');
    exit;
?>