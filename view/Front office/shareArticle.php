<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';

require '../../vendor/autoload.php';



    $mail = new PHPMailer(true);
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'careshare697@gmail.com';                 //SMTP username
    $mail->Password   = 'rjutzbysmcmxufzy';                    //SMTP password
    $mail->SMTPSecure = "ssl";
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

    //Recipients
    $mail->setFrom('careshare697@gmail.com');

    $email = strtolower($_POST['email']);
    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email address.");
    }


    $mail->addAddress($email);
    // $mail->addAddress($_POST["email"]);     //Add a recipient

    $mail->addAttachment($_POST['imageArticle'], 'article.png');         // Add attachments, optionally rename

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "LETS READ ARTICLES";
    $mail->Body = 'Discover Our Article: ' . $_POST['titre'];
    $mail->Body .= "<br></br>";
    $mail->Body .= 'This is the Article\'s content :' . $_POST['contenu'];
    $mail->Body .= "<br></br>";
    $mail->Body .= 'This is the Article\'s Author :' . $_POST['auteur'];
    $mail->Body .= "<br></br>";
    $mail->Body .= 'this is the Article\'s Author date :' . $_POST['date_art'];
    $mail->Body .= "<br></br>";
    $mail->Body .= 'this is the Article\'s category' . $_POST['categories'];
    $mail->Body .= "<br></br>";

    try {
    $mail->send();
    header("Location: liste_article.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


