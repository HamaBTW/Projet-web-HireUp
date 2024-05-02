<?php

require_once __DIR__ . '/../../config.php';

class categoryController {
    private $conn;

    public function __construct() {
        $this->conn = config::getConnexion(); // Get PDO connection
    }
    // Create a new category
    public function createCategory($category_id, $name_category, $description) {
        try {
            // Check if the category name already exists
            $stmt = $this->conn->prepare("SELECT id_category FROM category WHERE name_category = ?");
            $stmt->execute([$name_category]);
            $existingCategory = $stmt->fetch();
    
            if ($existingCategory) {
                return "Category name already exists."; // Return a message indicating the category name already exists
            }
    
            // Insert the new category
            $stmt = $this->conn->prepare("INSERT INTO category (id_category, name_category, description_category) VALUES (?, ?, ?)");
            $stmt->execute([$category_id, $name_category, $description]);
            return "New category created successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Read all jobs
    public function getAllJobs() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM category ORDER BY name_category");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

 


    public function updateCategory($category_id, $name_category, $description) {
        try {
            // Check if the category name already exists (excluding the current category being updated)
            $stmt = $this->conn->prepare("SELECT id_category FROM category WHERE name_category = ? AND id_category != ?");
            $stmt->execute([$name_category, $category_id]);
            $existingCategory = $stmt->fetch();
    
            if ($existingCategory) {
               
                return "Category name already exists."; // Return a message indicating the category name already exists
            }
    
            // Update the category
            $stmt = $this->conn->prepare("UPDATE category SET name_category = ?, description_category = ? WHERE id_category = ?");
            $stmt->execute([$name_category, $description, $category_id]);
            return "Category updated successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Delete a job
    public function deletecategory($id) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM category WHERE id_category=?");
            $stmt->execute([$id]);
            return "Job deleted successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Get all jobs
    public function getCategory() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM category");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
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


    public function categoryExists($id)
    {
        $tableName = "jobs";

        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE id = :id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function generateCategoryId($id_length)
    {
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->categoryExists($current_id));

        return $current_id;
    }
/*
    // Read a job by ID
    public function readJob($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM category WHERE id_category=?");
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result ? $result : "category not found";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
*/
}


?>
