<?php
$pageTitle       = 'Results - Post-Click Growth for DTC Brands';
$pageDescription = 'How Post-Click Growth engagements typically run for DTC ecommerce brands, from initial audit through landing page testing and lifecycle rebuilds.';
$pagePath        = '/results';
$activePage      = 'results';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require __DIR__ . '/../head.php'; ?>
</head>
<body>

<?php require __DIR__ . '/../header.php'; ?>

<main>

  <section class="hero hero-page">
    <div class="container">
      <p class="eyebrow center">Results</p>
      <h1 class="hero-title">What this actually looks like on a real brand.</h1>
      <p class="hero-lede">
        We're early in publishing named case studies with full metrics - the honest version below is what the
        engagements themselves typically look like, stage by stage.
      </p>
    </div>
  </section>

  <section class="section reveal" id="case-studies">
    <div class="container container-narrow">
      <div class="case-study-list">

        <article class="case-study">
          <p class="eyebrow">Situation</p>
          <h2 class="section-title">A DTC skincare brand with rising ad costs and a flat landing page</h2>
          <p class="case-study-detail"><strong>The setup:</strong> a growing skincare brand had a landing page that hadn't changed in over a year, built around an offer and message that no longer matched what their paid traffic actually responded to.</p>
          <p class="case-study-detail"><strong>The approach:</strong> an audit surfaced a message-match gap between the ad creative and the landing page headline, plus a checkout flow with more steps than it needed. We ran a prioritized sequence of tests starting with message-match, then checkout friction.</p>
          <p class="case-study-detail"><strong>What changed:</strong> conversion rate moved in the right direction within the first test cycle, and the roadmap kept finding smaller wins in the flows that followed - the kind of compounding curve, not a single dramatic spike.</p>
        </article>

        <article class="case-study">
          <p class="eyebrow">Situation</p>
          <h2 class="section-title">A supplements brand with email flows nobody had touched in two years</h2>
          <p class="case-study-detail"><strong>The setup:</strong> solid open and click rates on paper, but revenue per subscriber had been flat for several quarters - a classic sign of flows that were "fine" and quietly leaving money on the table.</p>
          <p class="case-study-detail"><strong>The approach:</strong> we rebuilt the welcome and post-purchase flows around current best-sellers and actual repurchase timing, instead of the original one-size-fits-all sequence.</p>
          <p class="case-study-detail"><strong>What changed:</strong> revenue per subscriber began climbing again, and the win-back flow - previously an afterthought - became one of the more reliable recovery channels.</p>
        </article>

        <article class="case-study">
          <p class="eyebrow">Situation</p>
          <h2 class="section-title">An apparel brand unsure if their offer or their page was the problem</h2>
          <p class="case-study-detail"><strong>The setup:</strong> the team suspected their bundle offer was underperforming but weren't sure if the real issue was the offer itself or how it was presented on the page.</p>
          <p class="case-study-detail"><strong>The approach:</strong> we isolated the two variables with a structured test sequence - offer held constant while testing page presentation, then presentation held constant while testing offer structure.</p>
          <p class="case-study-detail"><strong>What changed:</strong> the answer turned out to be both, in different amounts - which meant the fix was a combination neither the team nor we would have guessed correctly without testing it directly.</p>
        </article>

      </div>

      <p class="section-note">
        These reflect the kind of situations and approach we typically run, written to be honest about our
        current case-study library rather than overstate it. If you'd rather hear specifics on a call, ask -
        we're not shy about walking through how we work.
      </p>
    </div>
  </section>

  <section class="section section-alt reveal" id="contact">
    <div class="container container-narrow center">
      <p class="eyebrow center">Next step</p>
      <h2 class="section-title center">Want to see what the audit would find on your brand?</h2>
      <button type="button" class="btn btn-primary open-modal-btn">Apply Now</button>
    </div>
  </section>

</main>

<?php require __DIR__ . '/../footer.php'; ?>
</body>
</html>
