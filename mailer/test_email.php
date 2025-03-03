<?php
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Test data
$customerName = "Test Customer";

try {
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';     // REPLACE: Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'fleuguinersan@gmail.com'; // REPLACE: Your SMTP username
    $mail->Password   = 'vkqk ytaw mqll rtme';          // REPLACE: Your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('user@example.com', 'Triple Up Real Estate'); // REPLACE: Sender email
    $mail->addAddress('fleuguinersan@gmail.com', 'Fleu');      // Receiver email from your contact.form.php

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email - New Customer Contact';
    $mail->Body    = "Hello! A new customer <b>{$customerName}</b> has contacted us.";
    $mail->AltBody = "Hello! A new customer {$customerName} has contacted us.";

    $mail->send();
    echo "Test email sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
