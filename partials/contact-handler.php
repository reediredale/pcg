<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

$formSuccess = false;
$formErrors  = [];
$formData    = ['name' => '', 'email' => '', 'company' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['name']    = trim((string)($_POST['name'] ?? ''));
    $formData['email']   = trim((string)($_POST['email'] ?? ''));
    $formData['company'] = trim((string)($_POST['company'] ?? ''));
    $formData['message'] = trim((string)($_POST['message'] ?? ''));
    $honeypot            = trim((string)($_POST['website'] ?? ''));

    if ($formData['name'] === '') {
        $formErrors[] = 'Please enter your name.';
    }
    if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $formErrors[] = 'Please enter a valid email address.';
    }
    if ($formData['message'] === '') {
        $formErrors[] = 'Tell us a little about what you need.';
    }

    if ($honeypot !== '') {
        // Bot filled the hidden field - accept silently instead of tipping it off.
        $formErrors  = [];
        $formSuccess = true;
    } elseif (empty($formErrors)) {
        $mailConfig = require __DIR__ . '/../mail-config.php';
        $subject    = 'New message from the Post-Click Growth site - ' . $formData['name'];
        $body       = "You've received a new contact form submission from your Post-Click Growth website.\n\n"
                    . "Name: {$formData['name']}\nEmail: {$formData['email']}\nCompany: {$formData['company']}\n\nMessage:\n{$formData['message']}";

        $mailer = new PHPMailer(true);
        try {
            $mailer->isSMTP();
            $mailer->Host       = 'smtp.gmail.com';
            $mailer->SMTPAuth   = true;
            $mailer->Username   = $mailConfig['smtp_username'];
            $mailer->Password   = $mailConfig['smtp_password'];
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->Port       = 587;

            $mailer->setFrom($mailConfig['smtp_username'], 'Post-Click Growth Website');
            $mailer->addAddress($mailConfig['to']);
            $mailer->addReplyTo($formData['email'], $formData['name']);
            $mailer->Subject = $subject;
            $mailer->Body    = $body;

            $mailer->send();
            $formSuccess = true;
            $formData    = ['name' => '', 'email' => '', 'company' => '', 'message' => ''];
        } catch (PHPMailerException $e) {
            $formErrors[] = 'Sorry, something went wrong sending your message. Please try again or email us directly.';
        }
    }
}

$modalOpen = $formSuccess || !empty($formErrors);
$brandName = 'Post-Click Growth';
