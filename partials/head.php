<?php
/**
 * Expects $pageTitle, $pageDescription, $pagePath (e.g. "/", "/the-system.php") to be set by the including page.
 */
$siteUrl = 'https://postclickgrowth.com';
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($pageTitle) ?></title>
<meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
<link rel="canonical" href="<?= htmlspecialchars($siteUrl . $pagePath) ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
<meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
<meta property="og:url" content="<?= htmlspecialchars($siteUrl . $pagePath) ?>">
<meta name="twitter:card" content="summary">
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌱</text></svg>">
<link rel="stylesheet" href="/style.css">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "Post-Click Growth",
  "url": "<?= htmlspecialchars($siteUrl) ?>",
  "description": "Conversion rate optimization and lifecycle growth partner for DTC ecommerce brands.",
  "areaServed": "Worldwide",
  "serviceType": ["Conversion rate optimization", "Landing page testing", "Email and SMS lifecycle marketing", "Ecommerce growth strategy"],
  "audience": {
    "@type": "Audience",
    "audienceType": "DTC ecommerce brands"
  }
}
</script>
