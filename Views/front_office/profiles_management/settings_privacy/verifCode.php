<?php

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "/../../../../vendor/autoload.php";

// Part One: Send the verification code to the phone number and display the popup form
if (isset($_POST["update_profile_phone_number"]) && isset($_POST["profile_id"])) {
    // Get the profile phone number from the POST data
    $profilePhoneNumber = $_POST["update_profile_phone_number"];

    // Generate a 4-digit verification code
    $verificationCode = $_POST["verification_code"];

    // Create the message containing the verification code
    $message = "Your verification code for HireUp: $verificationCode";

    // Infobip API configuration
    $base_url = "https://k2lmje.api.infobip.com";
    $api_key = "ede2c85f709b3d0a7c9c6e4a231129e5-6ffa59b7-3969-4f89-bf20-c2db157b45b9";

    $configuration = new Configuration(host: $base_url, apiKey: $api_key);
    $api = new SmsApi(config: $configuration);

    // Set the destination phone number to the profile phone number
    $destination = new SmsDestination(to: $profilePhoneNumber);

    // Create the SMS message
    $message = new SmsTextualMessage(
        destinations: [$destination],
        text: $message,
        from: "HireUp"
    );

    // Create the request to send the SMS
    $request = new SmsAdvancedTextualRequest(messages: [$message]);

    // Send the SMS message
    $response = $api->sendSmsMessage($request);

}

?>