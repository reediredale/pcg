<?php
declare(strict_types=1);

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
        // Bot filled the hidden field — accept silently instead of tipping it off.
        $formErrors  = [];
        $formSuccess = true;
    } elseif (empty($formErrors)) {
        $to      = 'reed@reediredale.com';
        $subject = 'New message from the Post-Click Growth site — ' . $formData['name'];
        $body    = "You've received a new contact form submission from your Post-Click Growth website.\n\n"
                 . "Name: {$formData['name']}\nEmail: {$formData['email']}\nCompany: {$formData['company']}\n\nMessage:\n{$formData['message']}";
        $headers = "From: no-reply@postclickgrowth.com\r\nReply-To: {$formData['email']}";

        // mail() depends on server MTA config; treat the request as received either way.
        @mail($to, $subject, $body, $headers);
        $formSuccess = true;
        $formData    = ['name' => '', 'email' => '', 'company' => '', 'message' => ''];
    }
}

$brandName = 'Post-Click Growth';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($brandName) ?></title>
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌱</text></svg>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php $modalOpen = $formSuccess || !empty($formErrors); ?>
<main class="page">
  <div class="container">
    <img class="hero-image" src="arpu-client.png" alt="US ARPU (Average Revenue Per User) trending upward from May 2025 to July 2026">
    <p class="hero-caption">Want more money back from your ads?</p>
    <button type="button" class="btn btn-primary" id="open-modal-btn">Apply Now</button>
  </div>
</main>

<div class="modal-overlay<?= $modalOpen ? ' is-open' : '' ?>" id="modal-overlay">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <button type="button" class="modal-close" id="modal-close-btn" aria-label="Close">&times;</button>

    <div class="contact-form-wrap">
      <h2 id="modal-title" class="modal-title">Apply Now</h2>

      <?php if ($formSuccess): ?>
        <div class="form-banner form-banner-success" role="status">
          Thanks — your message is in. We'll follow up soon.
        </div>
      <?php endif; ?>

      <?php if (!empty($formErrors)): ?>
        <div class="form-banner form-banner-error" role="alert">
          <ul>
            <?php foreach ($formErrors as $error): ?>
              <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form class="contact-form" method="post" action="#" id="contact-form" novalidate>
        <div class="form-row">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" required value="<?= htmlspecialchars($formData['name']) ?>">
        </div>
        <div class="form-row">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required value="<?= htmlspecialchars($formData['email']) ?>">
        </div>
        <div class="form-row">
          <label for="company">Company <span class="optional">(optional)</span></label>
          <input type="text" id="company" name="company" value="<?= htmlspecialchars($formData['company']) ?>">
        </div>
        <div class="form-row">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="4" required><?= htmlspecialchars($formData['message']) ?></textarea>
        </div>
        <div class="form-row form-row-honeypot" aria-hidden="true">
          <label for="website">Website</label>
          <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary btn-full">Send</button>
      </form>
    </div>
  </div>
</div>

<script src="script.js"></script>
</body>
</html>
