<?php

require_once __DIR__ . '/../../config.php';

class ProfileController{

    private $conn;

    public function __construct() {
        $this->conn = config::getConnexion(); // Get PDO connection
    }
    public function fetchProfileData($profileId) {
        try {
            // Prepare and execute SQL query to fetch profile data based on profile ID
            $stmt = $this->conn->prepare("SELECT * FROM profile WHERE profile_id = ?");
            $stmt->execute([$profileId]);
            $profileData = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $profileData; // Return fetched profile data
        } catch (PDOException $e) {
            // Handle database error
            return false;
        }
    }

    public function getProfileEducation($profileId) {
        try {
            // Prepare SQL query to fetch profile education based on profile ID
            $stmt = $this->conn->prepare("SELECT profile_education FROM profile WHERE profile_id = ?");
            $stmt->execute([$profileId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result) {
                // Return profile education if found
                return $result['profile_education'];
            } else {
                // Return null or handle the case where profile is not found
                return null;
            }
        } catch (PDOException $e) {
            // Handle database error
            return null;
        }
    }

}


?>