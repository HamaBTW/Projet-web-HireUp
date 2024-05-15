<?php

try {
    require '../../config.php'; // Inclure le fichier de configuration de la base de données
} catch (Exception $e) {
    die('Error:' . $e->getMessage());
}

class dmdCon {
    public function generateId($id_length) {
        $numbers = '0123456789';
        $numbers_length = strlen($numbers);
        $random_id = '';

        // Générer un ID aléatoire
        for ($i = 0; $i < $id_length; $i++) {
            $random_id .= $numbers[rand(0, $numbers_length - 1)];
        }

        return (string) $random_id; // Assurez-vous que la valeur retournée est une chaîne de caractères
    }

    public function dmdExists($iddemande, $db) {
        $sql = "SELECT COUNT(*) as count FROM demande WHERE iddemande = :iddemande";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':iddemande', $iddemande);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function generatedmdId($id_length) {
        $db = config::getConnexion();
    
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->dmdExists($current_id, $db));
    
        return $current_id;
    }

    public function adddmd($dmd) {
        $sql = "INSERT INTO demande(iddemande, titre, contenu, objectif, dure, budget, image) VALUES (:iddemande, :titre, :contenu, :objectif, :dure, :budget, :image)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'iddemande' => $dmd->get_iddemande(), 
                'titre' => $dmd->get_titre(), 
                'contenu' => $dmd->get_contenu(), 
                'objectif' => $dmd->get_objectif(), 
                'dure' => $dmd->get_dure(),
                'budget' => $dmd->get_budget(),
                'image' => $dmd->get_image()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function titreExists($titre) {
        $db = config::getConnexion();

        $sql = "SELECT COUNT(*) as count FROM demande WHERE titre = :titre";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':titre', $titre);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
?>
