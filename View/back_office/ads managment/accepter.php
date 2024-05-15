<?php

include '../../../Controller/dmd_con.php';
include '../../../Model/dmd.php';

// Création d'une instance du contrôleur des événements
$dmdd = new dmdCon();

// Création d'une instance de la classe Dmd
$dmd = null;

        $dmdd->updateStatus($_GET['id']);
        $success_message = "MRIGEL";
        header('Location: ../../../View/back_office/ads managment/dmd_management.php?error_global=' . urlencode($success_message));
        exit(); // Make sure to stop further execution after redirection

        // returning an error
        //$error_message = "Failed to add the answer. Please try again later.";
        //header('Location: ../../../View/back_office/reponse management/reps_management.php?error_global=' . urlencode($error_message));
        //exit(); // Make sure to stop further execution after redirection



?>