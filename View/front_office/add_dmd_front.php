
<?php

include '../../Controller/dmd_con_fron.php';
include '../../Model/dmd.php';



// Création d'une instance du contrôleur des événements
$dmdd = new dmdCon("dmd");

// Création d'une instance de la classe Event
$dmd = null;

if (
    isset($_POST["titre"]) &&
    isset($_POST["contenu"]) &&
    isset($_POST["objectif"]) &&
    isset($_POST["dure"]) &&
    isset($_POST["budget"])
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
        if ($dmdd->titreExists($dmd->get_titre())){
            $error_titre= "titre already exists";
            header('Location: about.php?error_titre=' . urlencode($error_titre) . '&titre=' . urlencode($dmd->get_titre()));
            exit(); // Make sure to stop further execution after redirection
        }

        $dmdd->adddmd($dmd);
        $success_message = "demande added successfully!";
        header('Location: about.php?success_global=' . urlencode($success_message) . '&titre=' . urlencode($dmd->get_titre()));
        echo "done";
        exit(); // Make sure to stop further execution after redirection
    } else {
        // returning an error
        $error_message = "Failed to add the demande. Please try again later.";
        header('Location: about.php?error_global=' . urlencode($error_message));
        echo "error 1";
        exit(); // Make sure to stop further execution after redirection
    }
} else {
    // returning an error if the file upload failed
    $error_message = "Failed to upload the file. Please try again.";
    header('Location: about.php?error_global=' . urlencode($error_message));
    echo "error";
    exit(); // Make sure to stop further execution after redirection
}

?>


