<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Sesuaikan path ke autoload.php

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];

$mail = new PHPMailer(true);

try {
    // Konfigurasi SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP host Anda
    $mail->SMTPAuth = true;
    $mail->Username = 'emailanda@gmail.com'; // Ganti dengan email Gmail Anda
    $mail->Password = 'passwordemailanda'; // Ganti dengan password Gmail Anda
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Pengirim dan penerima
    $mail->setFrom('emailanda@gmail.com', 'Nama Anda'); // Ganti dengan email dan nama Anda
    $mail->addAddress('fiberpermatakasih@gmail.com', 'Fiber Permata Kasih');

    // Konten email
    $mail->isHTML(false);
    $mail->Subject = 'Email dari Form';
    $mail->Body = "Email dari: $email";

    $mail->send();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $mail->ErrorInfo]);
}
?>