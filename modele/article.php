<?php

require_once(__DIR__ . '/../config.php');

class Article {
    // Attributs
    private $id_article;    // identifiant de l'article
    private $titre;         // titre de l'article
    private $contenu;       // contenu de l'article
    private $auteur;        // auteur de l'article
    private $date_article;  // date de publication de l'article
    private $categorie;     // catégorie de l'article
    private $imageArticle;     // catégorie de l'article

    // Constructeur sans paramètres
    public function __construct() {}

    // Méthode pour définir les valeurs des attributs
    public function setValues($titre, $contenu, $auteur, $date_article, $categorie,$imageArticle="") {
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->auteur = $auteur;
        $this->date_article = $date_article;
        $this->categorie = $categorie;
        $this->imageArticle = $imageArticle;
    }

    // Getter et setter pour chaque attribut

    public function getIdArticle() {
        return $this->id_article;
    }

    public function getTitre() {
        return $this->titre;
    }
    public function getImageArticle() {
        return $this->imageArticle;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    public function getDateArticle() {
        return $this->date_article;
    }

    public function setDateArticle($date_article) {
        $this->date_article = $date_article;
    }

    public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    // Méthode pour sauvegarder les données dans la base de données
    public function save() {
        try {
            $db = $GLOBALS['db'];
            // Préparer la requête SQL
            $query = "INSERT INTO articles (titre, contenu, auteur, date_art, categorie) VALUES (?, ?, ?, ?, ?)";

            // Préparer la déclaration SQL
            $statement = $db->prepare($query);

            // Lier les valeurs
            $statement->bindParam(1, $this->titre);
            $statement->bindParam(2, $this->contenu);
            $statement->bindParam(3, $this->auteur);
            $statement->bindParam(4, $this->date_article);
            $statement->bindParam(5, $this->categorie);

            // Exécuter la requête
            $result = $statement->execute();

            // Fermer la connexion à la base de données
            $db = null;

            return $result;
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données
            echo "Erreur de base de données : " . $e->getMessage();
            return false;
        }
    }
}

?>
