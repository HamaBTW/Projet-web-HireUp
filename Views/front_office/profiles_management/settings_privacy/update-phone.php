<?php

require_once __DIR__ . '/../../../../Controls/profileController.php';

// Check if new phone number and verification code are posted
if (isset($_POST['profile_id']) && isset($_POST["verification_code_input"]) && isset($_POST["new_phone_number"]) && isset($_POST["verification_code"])) {
    // Get the new phone number and verification code from the POST data
    $id = $_POST["profile_id"];
    $newPhoneNumber = $_POST["new_phone_number"];
    $userInputCode = $_POST["verification_code_input"];
    $sentCode = $_GET["verification_code"];

    // Create an instance of the controller
    $profileController = new ProfileC();

    // Compare the sent code with the user input code
    if ($userInputCode === $sentCode) {
        // If codes match, update the phone number
        $result = $profileController->updateProfileAttribute($id, "phone_number", $newPhoneNumber);
        // Redirect back to the profile page
        if($result){
            header('Location: ./edit-profile.php?profile_id=' . $id . '?phone_updated_successfully');
            exit();
        } else {        
            header('Location: ./edit-profile.php?profile_id=' . $id . '?update_error');
            exit();
        }
        
    } else {
        // If codes don't match, display an error message
        header('Location: ./edit-profile.php?profile_id=' . $id . '?verification_code_incorrect');
        exit();
    }
}
