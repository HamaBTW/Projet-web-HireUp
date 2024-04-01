<?php

include '../../Controller/user_con.php';


  
if (isset($_POST['user_con_password'])) {

    // Retrieve and sanitize the error message
    $user_new_password = htmlspecialchars($_POST['user_con_password']);
    
    session_start();
    if (isset($_SESSION['user id'])) {
        $user_id = htmlspecialchars($_SESSION['user id']);
        
        $userC = new userCon("user");
        $res = $userC->updateUserPassword($user_id, $user_new_password);

        echo($res);
        
        if ($res == true){
            $success_message = "Password changed successfully!";
            header('Location: ../../View/Sign In & Sign Up/authentication-login.php?success_global=' . urlencode($success_message));
            exit(); // Make sure to stop further execution after redirection
          }
    }
    
    // returning an error
    $error_message = "Failed to change password. Please try again later.";
    header('Location: ../../View/Sign In & Sign Up/authentication-login.php?error_global=' . urlencode($error_message));
    exit(); // Make sure to stop further execution after redirection
    
}


?>