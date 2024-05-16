<?php

require_once(__DIR__ . '/../config.php');

class ArticleC {


    public function listArticles() {
        $sql = "SELECT * FROM articles"; // Modify this query as needed
        $db = Config::getConnexion();
        try {
            $stmt = $db->query($sql);
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $articles;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    
    public function articleExists($id)
    {
        $tableName = "articles";

        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE id = :id";
        $db = Config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function generateId($id_length)
    {
        $numbers = '0123456789';
        $numbers_length = strlen($numbers);
        $random_id = '';

        // Generate random ID
        for ($i = 0; $i < $id_length; $i++) {
            $random_id .= $numbers[rand(0, $numbers_length - 1)];
        }

        return (string) $random_id; // Ensure the return value is a string
    }

    public function generateJobId($id_length)
    {
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->articleExists($current_id));

        return $current_id;
    }

    public function deleteArticle($id) {
        $sql = "DELETE FROM articles WHERE id = :id";
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
    
        try {
            $req->execute();
            // Check if any rows were affected by the deletion
            $deleted = $req->rowCount() > 0;
            return $deleted;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    


    public function addArticle($id, $title, $company, $location, $description,$category,$article_image="") {
    $sql = "INSERT INTO `articles` (`id`, `titre`, `contenu`, `auteur`, `date_art`, `categories`, `imageArticle`) VALUES (:id , :titre, :contenu, :auteur, :date_art, :categories, :imageArticle);";
        $db = new config();
        $conn = $db->getConnexion();
        try {
            $query = $conn->prepare($sql);
            $query->execute([
                'id' => $id,
                'titre' => $title,
                'contenu' => $company,
                'auteur' => $location,
                'date_art' => $description,
                'categories' => $category,
                'imageArticle' => $article_image
            ]);
            return "New article created successfully";
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function showArticle($id) {
        $sql = "SELECT * FROM articles WHERE id = $id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $article = $query->fetch();
            return $article;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function updateArticle($id, $title, $content, $author, $date_art, $category) {
        try {
            $db = Config::getConnexion();
            $query = $db->prepare(
                'UPDATE articles SET 
                    titre = :title, 
                    contenu = :content, 
                    auteur = :author, 
                    date_art = :date_art, 
                    categories = :category
                WHERE id = :id'
            );
    
            $query->execute([
                'id' => $id,
                'title' => $title,
                'content' => $content,
                'author' => $author,
                'date_art' => $date_art,
                'category' => $category
            ]);
    
            return $query->rowCount(); // Return the number of affected rows
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false; // Return false if an error occurs
        }
    }
}

?>