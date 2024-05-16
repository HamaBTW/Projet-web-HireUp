<?php
// Inclure le contrôleur des commentaires
include "../../controlleur/commentaireC.php";
include "../../modele/commentaire.php";

// Initialiser le contrôleur des commentaires
$commentaireController = new CommentaireC();

// Vérifier si l'identifiant du commentaire à modifier est passé dans l'URL
if(isset($_GET['id'])) {
    // Récupérer les informations du commentaire à partir de son identifiant
    $commentaire = $commentaireController->showCommentaire($_GET['id']);
    $id_artc_options = $commentaireController->generateArticleOptionsSelectedId($commentaire['id_article']);

    // Vérifier si le commentaire existe
    if($commentaire) {
        // Vérifier si le formulaire de modification est soumis
        if(isset($_POST['submit'])) {
            // Récupérer les données du formulaire
            $contenu = $_POST['contenu'];
            $auteur = $_POST['auteur'];
            $date_commentaire = $_POST['date_commentaire'];
            $id_article = $_POST['id_article'];

            // Créer un nouvel objet Commentaire avec les données du formulaire
            $commentaireToUpdate = new Commentaire();
            $commentaireToUpdate->setContenu($contenu);
            $commentaireToUpdate->setAuteur($auteur);
            $commentaireToUpdate->setDateCommentaire($date_commentaire);
            $commentaireToUpdate->setIdArticle($id_article);

            // Mettre à jour le commentaire dans la base de données
            $commentaireController->updateCommentaire($commentaireToUpdate, $_GET['id']);

            // Rediriger vers la liste des commentaires après la mise à jour
            header('Location: liste_commentaire.php');
            exit();
        }
    } else {
        // Rediriger vers la liste des commentaires si le commentaire n'existe pas
        header('Location: liste_commentaire.php');
        exit();
    }
} else {
    // Rediriger vers la liste des commentaires si l'identifiant n'est pas passé dans l'URL
    header('Location: liste_commentaire.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un commentaire</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #678EC8; /* Couleur de fond */
        }
        .container {
            padding: 30px;
        }
        .form-container {
            border: 2px solid #000; /* Contour autour du formulaire */
            border-radius: 10px;
            padding: 20px;
            background-color: #fff; /* Couleur de fond du formulaire */
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-4">Modifier un commentaire</h1>
    <div class="row justify-content-center">
        <div class="col-md-6 form-container"> <!-- Ajout de la classe form-container -->
            <form action="" method="POST">
                <div class="form-group">
                    <label for="id_article"><i class="fas fa-file-alt mr-2"></i>ID de l'article :</label>
                    <select class="form-control" id="id_article" name="id_article" required>
			            <option value="" selected disabled>choisir le id article</option>
                        <?php echo $id_artc_options; ?>
                    </select>
                    <span id="id_article_error" class="error-message"></span>
                </div>
                <div class="form-group">
                    <label for="contenu">Contenu</label>
                    <textarea class="form-control" id="contenu" name="contenu"><?php echo $commentaire['contenu']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="auteur">Auteur</label>
                    <input type="text" class="form-control" id="auteur" name="auteur" value="<?php echo $commentaire['auteur']; ?>">
                </div>
                <div class="form-group">
                    <label for="date_commentaire">Date de commentaire</label>
                    <input type="date" class="form-control" id="date_commentaire" name="date_commentaire" value="<?php echo $commentaire['date_commentaire']; ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>