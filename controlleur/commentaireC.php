<?php

require_once(__DIR__ . '/../config.php');

class CommentaireC {
    public function listCommentaires() {
        $sql = "SELECT * FROM commentaires";
        $db = Config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deleteCommentaire($id) {
        $sql = "DELETE FROM commentaires WHERE id_commentaire = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function incrementLikes($commentId) {
        $db = Config::getConnexion();
        $stmt = $db->prepare("UPDATE commentaires SET likes = likes + 1 WHERE id_commentaire = :commentId");
        $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function incrementDislikes($commentId) {
        $db = Config::getConnexion();
        $stmt = $db->prepare("UPDATE commentaires SET dislikes = dislikes + 1 WHERE id_commentaire = :commentId");
        $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function getCommentLikesDislikes($commentId) {
        $db = Config::getConnexion();
        $stmt = $db->prepare("SELECT likes, dislikes FROM commentaires WHERE id_commentaire = :commentId");
        $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCommentaire(Commentaire $commentaire) {
        $sql =  "INSERT INTO `commentaires` (`id_commentaire`, `id_article`, `auteur`, `contenu`, `date_commentaire`, `likes`, `dislikes`) VALUES (NULL, :id_article, :auteur, :contenu, :date_commentaire, '0', '0');";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_article' => $commentaire->getIdArticle(),
                'auteur' => $commentaire->getAuteur(),
                'contenu' => $commentaire->getContenu(),
                'date_commentaire' => $commentaire->getDateCommentaire()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showCommentaire($id) {
        $sql = "SELECT * FROM commentaires WHERE id_commentaire = $id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $commentaire = $query->fetch();
            return $commentaire;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateCommentaire(Commentaire $commentaire, $id) {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE commentaires SET 
                    id_article = :id_article, 
                    auteur = :auteur, 
                    contenu = :contenu, 
                    date_commentaire = :date_commentaire 
                WHERE id_commentaire = :id'
            );

            $query->execute([
                'id' => $id,
                'id_article' => $commentaire->getIdArticle(),
                'auteur' => $commentaire->getAuteur(),
                'contenu' => $commentaire->getContenu(),
                'date_commentaire' => $commentaire->getDateCommentaire()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function generateArticleOptions()
    {
        // Fetching the blog IDs from the database
        $sql = "SELECT id, titre FROM articles";

        $db = config::getConnexion();

        try {
            $stmt = $db->query($sql);

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $options .= '<option value="' . $row['id'] . '">' . $row['titre'] . '</option>';
            }

            return $options;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function generateArticleOptionsSelectedId($id)
    {
        // Fetching the blog IDs from the database
        $sql = "SELECT id, titre FROM articles";

        $db = config::getConnexion();

        try {
            $stmt = $db->query($sql);

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row['id'] == $id){
                    $options .= '<option selected value="' . $row['id'] . '">' . $row['titre'] . '</option>';
                }
                else{
                    $options .= '<option value="' . $row['id'] . '">' . $row['titre'] . '</option>';
                }
            }

            return $options;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }


}

?>