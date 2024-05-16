<?php

include '../../../Controller/dmd_con.php';
include '../../../Model/dmd.php';

// Création d'une instance du contrôleur des événements
$dmdd = new dmdCon();

// Création d'une instance de la classe Dmd
$dmd = null;

if (
    isset($_POST["titre"]) &&
    isset($_POST["contenu"]) &&
    isset($_POST["objectif"]) &&
    isset($_POST["dure"]) &&
    isset($_POST["budget"]) &&
    isset($_FILES['image_publication']) && // Vérifie si le champ de fichier est présent
    $_FILES['image_publication']['error'] === UPLOAD_ERR_OK // Vérifie si le téléchargement du fichier s'est bien déroulé
) {
    if (
        !empty($_POST['titre']) &&
        !empty($_POST["contenu"]) &&
        !empty($_POST["objectif"]) &&
        !empty($_POST["dure"]) &&
        !empty($_POST["budget"])
    ) {   
        
        // Get profile photo and cover data
        $image_publication_tmp_name = $_FILES['image_publication']['tmp_name'];
        $image_publication_data = file_get_contents($image_publication_tmp_name);
        
        $dmd = new Dmd(
            $dmdd->generatedmdId(5),
            $_POST['titre'],
            $_POST['contenu'],
            $_POST['objectif'],
            $_POST['dure'],
            $_POST['budget'],
            $image_publication_data
        );

        # do some checks first
        # check titre existence
        if ($dmdd->dmdExists($dmd->get_iddemande(), config::getConnexion())){
            $error_titre= "titre already exists";
            header('Location: ../../../View/back_office/add managment/dmd_management.php?error_titre=' . urlencode($error_titre) . '&titre=' . urlencode($dmd->get_titre()));
            exit(); // Make sure to stop further execution after redirection
        }

        $dmdd->adddmd($dmd);
        $success_message = "demande added successfully!";
        header('Location: ../../../View/back_office/ads managment/dmd_management.php?success_global=' . urlencode($success_message) . '&titre=' . urlencode($dmd->get_titre()));
        exit(); // Make sure to stop further execution after redirection
    } else {
        // returning an error
        $error_message = "Failed to add the demande. Please try again later.";
        header('Location: ../../../View/back_office/ads managment/dmd_management.php?error_global=' . urlencode($error_message));
        exit(); // Make sure to stop further execution after redirection
    }
} else {
    // returning an error if the file upload failed
    $error_message = "Failed to upload the file. Please try again.";
    header('Location: ../../../View/back_office/ads managment/dmd_management.php?error_global=' . urlencode($error_message));
    exit(); // Make sure to stop further execution after redirection
}

?>
