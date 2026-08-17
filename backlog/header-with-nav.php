<?php
/** Expects $activePage to be set: 'home' | 'system' | 'results' */
$activePage = $activePage ?? '';
function navClass(string $page, string $active): string
{
    return $page === $active ? 'is-active' : '';
}
?>
<header class="site-header" id="site-header">
  <div class="container header-inner">
    <a href="/" class="brand">
      <img src="/logo.svg" alt="Post-Click Growth" class="brand-logo">
    </a>

    <nav class="main-nav" id="main-nav">
      <a href="/" class="<?= navClass('home', $activePage) ?>">Home</a>
      <a href="/the-system" class="<?= navClass('system', $activePage) ?>">The System</a>
      <a href="/results" class="<?= navClass('results', $activePage) ?>">Results</a>
    </nav>

    <div class="header-actions">
      <button type="button" class="btn btn-primary btn-small open-modal-btn">Apply Now</button>
      <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="main-nav">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>
