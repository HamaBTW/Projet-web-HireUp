<?php
// Inclure le contrôleur des articles
include "../../controlleur/articleC.php";
include "../../modele/article.php";
// Initialiser le contrôleur des articles
$articleController = new ArticleC();

// Vérifier si l'identifiant de l'article à modifier est passé dans l'URL
if(isset($_GET['id'])) {
    // Récupérer les informations de l'article à partir de son identifiant
    $article = $articleController->showArticle($_GET['id']);

    // Vérifier si l'article existe
    if($article) {
        // Vérifier si le formulaire de modification est soumis
        if(isset($_POST['submit'])) {
            // Récupérer les données du formulaire
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $auteur = $_POST['auteur'];
            $date_art = $_POST['date_art'];
            $categorie = $_POST['categorie'];

            // Créer un nouvel objet Article avec les données du formulaire
            $articleToUpdate = new Article();
            $articleToUpdate->setTitre($titre);
            $articleToUpdate->setContenu($contenu);
            $articleToUpdate->setAuteur($auteur);
            $articleToUpdate->setDateArticle($date_art);
            $articleToUpdate->setCategorie($categorie);

            // Mettre à jour l'article dans la base de données
            $articleController->updateArticle($articleToUpdate, $_GET['id']);

            // Rediriger vers la liste des articles après la mise à jour
            header('Location: liste_article.php');
            exit();
        }
    } else {
        // Rediriger vers la liste des articles si l'article n'existe pas
        header('Location: liste_article.php');
        exit();
    }
} else {
    // Rediriger vers la liste des articles si l'identifiant n'est pas passé dans l'URL
    header('Location: liste_article.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un article</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="container">
    <h1 class="text-center mb-4">Modifier un article</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $article['titre']; ?>">
                </div>
                <div class="form-group">
                    <label for="contenu">Contenu</label>
                    <textarea class="form-control" id="contenu" name="contenu"><?php echo $article['contenu']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="auteur">Auteur</label>
                    <input type="text" class="form-control" id="auteur" name="auteur" value="<?php echo $article['auteur']; ?>">
                </div>
                <div class="form-group">
                    <label for="date_art">Date de publication</label>
                    <input type="date" class="form-control" id="date_art" name="date_art" value="<?php echo $article['date_art']; ?>">
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie</label>
                    <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo $article['categories']; ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Modifier</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>