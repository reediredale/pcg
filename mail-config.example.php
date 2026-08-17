<?php
// Copy this file to mail-config.php (already gitignored) and fill in
// your real values. Never commit mail-config.php - it holds a secret.

return [
    // The Gmail / Google Workspace address that sends the notification.
    'smtp_username' => 'you@example.com',

    // An App Password, not your normal Google password.
    // Create one at https://myaccount.google.com/apppasswords
    // (requires 2-Step Verification to be turned on first).
    'smtp_password' => 'xxxx xxxx xxxx xxxx',

    // Where form submissions get delivered.
    'to' => 'reed@reediredale.com',
];
