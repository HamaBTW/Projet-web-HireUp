<?php

try {
    require '../../../config.php';
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

    public function pubExists($idpub, $db) {
        $sql = "SELECT COUNT(*) as count FROM publicite WHERE idpub = :idpub";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':idpub', $idpub);
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


    public function listpub()
    {
        $sql = "SELECT * FROM publicite";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addpub($pub)
    {
        $sql = "INSERT INTO publicite(idpub, titre, contenu, dat, id_demande) VALUES (:idpub, :titre, :contenu, :dat, :id_dmd)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(
               [
                'idpub' => $pub->get_idpub(), 
                'titre' => $pub->get_titre(), 
                'contenu' => $pub->get_contenu(), 
                'dat' => $pub->get_dat(),
                'id_dmd' => $pub->get_id_dmd()
                ]
            );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updatepub($pub, $idpub)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare("UPDATE publicite SET titre = :titre, contenu = :contenu, dat = :dat, id_demande = :id_dmd WHERE idpub = :idpub");
            $query->execute([
                'idpub' => $idpub, 
                'titre' => $pub->get_titre(),
                'contenu' => $pub->get_contenu(),
                'dat' => $pub->get_dat(),
                'id_dmd' => $pub->get_id_dmd()
        
                
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
            echo($e);
        }
    }
    

    public function deletepub($idpub)
    {
        $sql = "DELETE FROM publicite WHERE idpub = :idpub";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idpub', $idpub);

        try {
            $req->execute();
            return true;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
            return false;
        }
    }


    public function sortpub($by){

        
        $sql = "SELECT * publicite";
        
        if ($by == "everything"){
            $sql .= " ORDER BY id";
        }
        else{
            $sql .= " ORDER BY $by";
        }

        $db = config::getConnexion();
        try {
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
        
            $liste = $query->fetchAll(PDO::FETCH_ASSOC);
            //echo "SQL Query: " . $query->queryString;
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }        

    }

    public function searchpub($by, $keyword ){

        if ($by == "everything"){
            $sql = "SELECT * publicite WHERE titre LIKE '%$keyword%' OR contenu LIKE '%$keyword%' OR budget LIKE '%$keyword%' OR id LIKE '%$keyword%'";
        }
        else{
            $sql = "SELECT * publicite WHERE $by LIKE '%$keyword%'";
        }

        $db = config::getConnexion();
        try {
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
        
            $liste = $query->fetchAll(PDO::FETCH_ASSOC);
            //echo "SQL Query: " . $query->queryString;
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
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


    public function getpub($idpub)
    {
        $sql = "SELECT * FROM publicite WHERE idpub = $idpub";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute();
            $event = $query->fetch();
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function searchpubSorted($by, $keyword){

        if ($by == "everything"){
            $sql = "SELECT * publicite WHERE titre LIKE '%$keyword%' OR contenu LIKE '%$keyword%' OR budget LIKE '%$keyword%' OR id LIKE '%$keyword%'";
        }
        else{
            $sql = "SELECT * FROM publicite WHERE $by LIKE '%$keyword%'";
        }

       

        // add order by
        if ($by == "everything"){
            $sql .= " ORDER BY id";
        }
        else{
            $sql .= " ORDER BY $by";
        }

        $db = config::getConnexion();
        try {
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            $query->execute();
        
            $liste = $query->fetchAll(PDO::FETCH_ASSOC);
            //echo "SQL Query: " . $query->queryString;
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }        

    }


    public function generateDmdOptions()
    {
        // Fetching the blog IDs from the database
        $sql = "SELECT iddemande, titre FROM demande";

        $db = config::getConnexion();

        try {
            $stmt = $db->query($sql);

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $options .= '<option value="' . $row['iddemande'] . '">' . $row['titre'] . '</option>';
            }

            return $options;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function generateDmdOptionsSelected($id)
    {
        // Fetching the blog IDs from the database
        $sql = "SELECT iddemande, titre FROM demande";

        $db = config::getConnexion();

        try {
            $stmt = $db->query($sql);

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row['iddemande'] == $id){
                    $options .= '<option selected value="' . $row['iddemande'] . '">' . $row['titre'] . '</option>';
                }
                else{
                    $options .= '<option value="' . $row['iddemande'] . '">' . $row['titre'] . '</option>';
                }
            }

            return $options;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

}




   


?>