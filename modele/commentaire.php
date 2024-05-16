<?php

require_once(__DIR__ . '/../config.php');

class Commentaire {
    // Attributs
    private $id_commentaire;    // identifiant du commentaire
    private $id_article;        // identifiant de l'article associé au commentaire
    private $auteur;            // auteur du commentaire
    private $contenu;           // contenu du commentaire
    private $date_commentaire;  // date du commentaire
    private $id_art;  // date du commentaire

    // Constructeur sans paramètres
    public function __construct() {}

    // Méthode pour définir les valeurs des attributs
    public function setValues($id_article, $auteur, $contenu, $date_commentaire) {
        $this->id_article = $id_article;
        $this->auteur = $auteur;
        $this->contenu = $contenu;
        $this->date_commentaire = $date_commentaire;
    }

    // Getter et setter pour chaque attribut

    public function getIdCommentaire() {
        return $this->id_commentaire;
    }

    public function getIdArticle() {
        return $this->id_article;
    }

    public function setIdArticle($id_article) {
        $this->id_article = $id_article;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function getDateCommentaire() {
        return $this->date_commentaire;
    }

    public function setDateCommentaire($date_commentaire) {
        $this->date_commentaire = $date_commentaire;
    }


    // Méthode pour sauvegarder les données dans la base de données
    public function save() {
        try {
            $db = $GLOBALS['db'];
            // Préparer la requête SQL
            $query = "INSERT INTO commentaires (id_article, auteur, contenu, date_commentaire) VALUES (?, ?, ?, ?)";

            // Préparer la déclaration SQL
            $statement = $db->prepare($query);

            // Lier les valeurs
            $statement->bindParam(1, $this->id_article);
            $statement->bindParam(2, $this->auteur);
            $statement->bindParam(3, $this->contenu);
            $statement->bindParam(4, $this->date_commentaire);

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