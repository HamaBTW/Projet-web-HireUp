<?php

include '../../../Controller/reponse_con.php';
include '../../../Model/reponse.php';

// Création d'une instance du contrôleur des événements
$repC = new repCon("reponses");

// Création d'une instance de la classe Event
$reponse = null;

$id=$_POST['id_reclamation'];
if (
    isset($_POST["contenu"]) &&
    isset($_POST["id_user"])&&
    isset($_POST["id_reclamation"])
) {
    if (
        !empty($_POST['contenu']) &&
        !empty($_POST["id_user"]) &&
        !empty($_POST["id_reclamation"]) 
        
    ) {
        
        $reponse = new Reponse(
            $repC->generateRepId(5),
            $_POST['contenu'],
            date("Y-m-d"),
            $_POST['id_user'],
            $_POST['id_reclamation']
            
        );        

        $repC->addRep($reponse);
        $repC->updateStatus($_POST['id_reclamation']);
        $success_message = "answer added successfully!";
        header("Location: ../../../View/back_office/reponse management/reps_management.php?id=$id");
        exit(); // Make sure to stop further execution after redirection
    } else {
        // returning an error
        $error_message = "Failed to add the answer. Please try again later.";
        header('Location: ../../../View/back_office/reponse management/reps_management.php?error_global=' . urlencode($error_message));
        exit(); // Make sure to stop further execution after redirection
    }
}


?>