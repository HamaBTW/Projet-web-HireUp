<?php

try {
    require '../../config.php';
} catch (Exception $e) {
    //die('Error:' . $e->getMessage());
}





class pubCon{


    public function generateId($id_length){
        $numbers = '0123456789';
        $numbers_length = strlen($numbers);
        $random_id = '';

        // Generate random ID
        for ($i = 0; $i < $id_length; $i++) {
            $random_id .= $numbers[rand(0, $numbers_length - 1)];
        }

        return (string) $random_id; // Ensure the return value is a string
    }

    public function pubExists($id, $db) {
        $sql = "SELECT COUNT(*) as count FROM publicite WHERE id = :id";
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

    public function generatepubId($id_length) {
        $db = config::getConnexion();
    
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->pubExists($current_id, $db));
    
        return $current_id;
    }


    public function addpub($pub)
    {
        $sql = "INSERT INTO publicite(id, titre, contenu, objectif ,dure ,budget) VALUES (:id, :titre, :contenu, :objectif, :dure, :budget)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(
               [
                'id' => $pub->get_id(), 
                'titre' => $pub->get_titre(), 
                'contenu' => $pub->get_contenu(), 
                'objectif' => $pub->get_objectif(), 
                'dure' => $pub->get_dure(),
                'budget' => $pub->get_budget()
                ]
            );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function titreExists($titre) {
        $db = config::getConnexion();

        $sql = "SELECT COUNT(*) as count FROM publicite WHERE titre = :titre";
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

    public function listAcceptedPubs()
    {
        $sql = "SELECT publicite.* 
                FROM publicite 
                INNER JOIN demande ON publicite.id_demande = demande.iddemande 
                WHERE demande.status = 'accepted'";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function get_pup_img_by_dmd_id($id){
        
        $db = config::getConnexion();

        $sql = "SELECT * FROM demande WHERE iddemande = :id";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['image'];
            } else {
                return "error";
            }

        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
        
    }

    public function generate_pub(){

        $array = $this->listAcceptedPubs();

        $pubs = $array->fetchAll(PDO::FETCH_ASSOC);

        //var_dump($pubs);

        $length = count($pubs);

        $randomNumber = rand(0, $length - 1);

        $current_pub = $pubs[$randomNumber];

        $its_id_dmd = $current_pub['id_demande'];

        //echo ''. $its_id_dmd .'';

        $current_dmd_img = $this->get_pup_img_by_dmd_id($its_id_dmd);


        echo '<img src="data:image/jpeg;base64,' . base64_encode($current_dmd_img) . '" alt="" class="img-fluid">';
    }

}




   


?>