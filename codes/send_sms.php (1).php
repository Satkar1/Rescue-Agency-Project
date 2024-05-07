<?php
require_once 'vendor/autoload.php'; // Include Twilio PHP SDK

use Twilio\Rest\Client;

// Your Twilio API credentials
$twilioAccountSid = 'AC55a062aaa330df7276aaea8ad716e127';
$twilioAuthToken = '0e2a0457866e8aa4a9cb9b48c46421ce';

// Twilio phone number (from number)
$twilioPhoneNumber = '+14142191574';

// Hospital phone number (to number)
$hospitalPhoneNumber = '+919325148284'; // Replace with hospital's phone number

// Message to be sent
$message = "Emergency! Need help.";

try {
    // Initialize Twilio client
    $twilio = new Client($twilioAccountSid, $twilioAuthToken);

    // Send SMS message
    $twilio->messages->create(
        $hospitalPhoneNumber,
        [
            'from' => $twilioPhoneNumber,
            'body' => $message
        ]
    );

    echo "SMS message sent successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
