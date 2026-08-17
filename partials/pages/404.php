<?php
$pageTitle       = 'Page Not Found - Post-Click Growth';
$pageDescription = 'The page you were looking for could not be found.';
$pagePath        = $_SERVER['REQUEST_URI'] ?? '/';
$activePage      = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require __DIR__ . '/../head.php'; ?>
<meta name="robots" content="noindex">
</head>
<body>

<?php require __DIR__ . '/../header.php'; ?>

<main>
  <section class="hero hero-page">
    <div class="container">
      <p class="eyebrow center">404</p>
      <h1 class="hero-title">That page doesn't exist.</h1>
      <p class="hero-lede">
        The link might be old, or the page might have moved. Head back to the homepage below.
      </p>
      <a href="/" class="btn btn-primary">Back to Home</a>
    </div>
  </section>
</main>

<?php require __DIR__ . '/../footer.php'; ?>
</body>
</html>
