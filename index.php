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
        $headers = "From: reed@reediredale.com\r\nReply-To: {$formData['email']}";

        // mail() depends on server MTA config; treat the request as received either way.
        @mail($to, $subject, $body, $headers);
        $formSuccess = true;
        $formData    = ['name' => '', 'email' => '', 'company' => '', 'message' => ''];
    }
}

$modalOpen = $formSuccess || !empty($formErrors);
$brandName = 'Post-Click Growth';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($brandName) ?> — For Shopify Brands Running Klaviyo Past $1M</title>
<meta name="description" content="A closer look at the gap between the click and the customer, for Shopify brands running Klaviyo past seven figures in revenue.">
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌱</text></svg>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="site-header" id="site-header">
  <div class="container header-inner">
    <span class="brand">
      <span class="brand-mark" aria-hidden="true"></span>
      <span class="brand-name"><?= htmlspecialchars($brandName) ?></span>
    </span>
    <button type="button" class="btn btn-primary btn-small open-modal-btn">Apply Now</button>
  </div>
</header>

<main>

  <section class="hero">
    <div class="container">
      <p class="eyebrow center">For Shopify brands running Klaviyo past $1M/yr</p>
      <h1 class="hero-title">You got past $1M. So why does the next dollar feel so much harder to find?</h1>
      <p class="hero-lede">
        Your ads still work. Your Klaviyo flows are still live. And growth still feels slower than it should.
        This is a look at the part of the funnel almost nobody is actually watching — and why it's usually
        where the next real gain is sitting.
      </p>
      <button type="button" class="btn btn-primary open-modal-btn">Apply Now</button>
    </div>
  </section>

  <section class="section reveal" id="chart-section">
    <div class="container">
      <p class="eyebrow center">What compounding looks like</p>
      <h2 class="section-title center">It's rarely one big win. It's this, month after month.</h2>
      <p class="section-lede center">
        Illustrative example of what compounding post-click revenue gains can look like over time — small,
        uneven, occasionally backwards, and trending up anyway. That's what a real testing program produces.
        Not a hack. A curve.
      </p>
      <div class="chart-card">
        <canvas id="growth-chart" height="320" aria-label="Line chart showing indexed revenue per customer trending upward over 15 months, with occasional dips" role="img"></canvas>
      </div>
      <p class="chart-caption">Indexed revenue per customer, 15 months — illustrative, not a specific client's audited results.</p>
    </div>
  </section>

  <section class="section section-alt reveal" id="problem">
    <div class="container container-narrow">
      <p class="eyebrow">The part nobody warns you about</p>
      <h2 class="section-title">Getting to $1M was the hard part. Nobody said what comes after is a different problem entirely.</h2>
      <div class="prose">
        <p>
          Somewhere past your first million on Shopify, the game changes and nobody sends a memo. The tactics
          that got you here — a sharp product, some scrappy ads, a Klaviyo welcome flow you set up in an
          afternoon — stop compounding the way they used to.
        </p>
        <p>You know the symptoms even if you haven't said them out loud:</p>
        <ul class="problem-list">
          <li>Cost per click keeps climbing, and your landing page conversion rate hasn't moved to match it.</li>
          <li>Your Klaviyo flows still "work" — decent open rates, fine click rates — but revenue per subscriber has been flat for a while.</li>
          <li>Nobody on the team actually owns what happens between the ad click and the sale. Paid media owns the click. Nobody owns the rest.</li>
          <li>You've talked about running tests on your landing pages for months. Somehow it never makes it to the top of the sprint.</li>
          <li>Every growth idea competes with fifty other priorities, so the page and the flows just... stay as they are.</li>
        </ul>
        <p>
          None of that means anything is broken. It means you've outgrown the version of growth that got you
          here — and nobody's been assigned to build the next one.
        </p>
      </div>
    </div>
  </section>

  <section class="section reveal" id="why">
    <div class="container container-narrow">
      <p class="eyebrow">Why this happens</p>
      <h2 class="section-title">Everyone is optimizing the click. Almost nobody is optimizing what happens after it.</h2>
      <div class="prose">
        <p>
          Your media buyer or agency is measured on getting the click cheaper. Your email platform is measured
          on sends going out. Neither one is measured on what your landing page actually does with the traffic,
          or whether that Klaviyo flow built two years ago still reflects how your best customers actually buy
          today.
        </p>
        <p>
          That gap — between the click and the customer — is exactly where Post-Click Growth lives. Not more
          traffic. Not a new platform. A structured way of finding and fixing the leaks in the page, the flow,
          and the offer that's already getting the traffic you're paying for.
        </p>
      </div>
    </div>
  </section>

  <section class="section section-alt reveal" id="approach">
    <div class="container">
      <p class="eyebrow center">How we actually work</p>
      <h2 class="section-title center">A repeatable process, not a grab-bag of tactics</h2>

      <ol class="process-list">
        <li class="process-step">
          <span class="process-number">01</span>
          <div>
            <h3>Audit</h3>
            <p>We map your full post-click journey — landing pages, Klaviyo flows, checkout — and find where the biggest opportunities actually are, before touching anything.</p>
          </div>
        </li>
        <li class="process-step">
          <span class="process-number">02</span>
          <div>
            <h3>Strategy</h3>
            <p>A prioritized roadmap of tests and lifecycle changes, ranked by expected impact against the effort to ship them.</p>
          </div>
        </li>
        <li class="process-step">
          <span class="process-number">03</span>
          <div>
            <h3>Build &amp; Test</h3>
            <p>We design, build, and ship experiments and flow changes on a consistent weekly cadence — with a clear hypothesis behind every one.</p>
          </div>
        </li>
        <li class="process-step">
          <span class="process-number">04</span>
          <div>
            <h3>Optimize &amp; Scale</h3>
            <p>Winners roll out permanently. Losers get documented, not repeated. The roadmap updates with what we actually learned.</p>
          </div>
        </li>
      </ol>
    </div>
  </section>

  <section class="section reveal" id="services">
    <div class="container">
      <p class="eyebrow center">What that looks like in practice</p>
      <h2 class="section-title center">Specifically, on your store</h2>

      <div class="services-grid">
        <article class="service-card">
          <h3>Landing Page &amp; CRO Testing</h3>
          <p>Structured experiments on the pages your ad and email traffic actually land on — not redesign for its own sake.</p>
        </article>
        <article class="service-card">
          <h3>Klaviyo Flow Rebuilds</h3>
          <p>A hard look at welcome, abandonment, post-purchase, and win-back flows — rebuilt around how your customers buy now, not when the flow was first set up.</p>
        </article>
        <article class="service-card">
          <h3>Checkout &amp; Offer Testing</h3>
          <p>Where offers, bundles, and checkout friction are quietly costing you conversions you're already paying to earn.</p>
        </article>
        <article class="service-card">
          <h3>Segmentation &amp; Retention</h3>
          <p>Getting more from customers you've already paid to acquire once, instead of only chasing the next new one.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="section section-alt reveal" id="qualify">
    <div class="container container-narrow">
      <p class="eyebrow center">Who this is actually for</p>
      <h2 class="section-title center">This isn't for every Shopify store. Here's how to tell.</h2>

      <div class="qualify-grid">
        <div class="qualify-col">
          <h3 class="qualify-heading qualify-yes">This is probably a fit if:</h3>
          <ul class="qualify-list">
            <li>You're running Shopify with Klaviyo as your core email/SMS platform.</li>
            <li>You're doing $1M+ in trailing revenue, with real paid or organic traffic hitting your pages daily.</li>
            <li>You already have flows and pages live — you just suspect they're leaving money on the table.</li>
            <li>Your team can actually ship a page or flow change weekly, not just talk about it.</li>
            <li>You want a testing partner who tells you what the data says, not what you want to hear.</li>
          </ul>
        </div>
        <div class="qualify-col">
          <h3 class="qualify-heading qualify-no">Probably not a fit if:</h3>
          <ul class="qualify-list">
            <li>You're pre-revenue, or still finding product-market fit.</li>
            <li>You want a set-and-forget vendor, not a partner who's going to ask questions about your funnel.</li>
            <li>Nobody on your team has the authority to approve a page or flow change.</li>
            <li>You're looking for a single overnight hack rather than a testing process.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section class="section reveal" id="faq">
    <div class="container container-narrow">
      <p class="eyebrow center">Before you apply</p>
      <h2 class="section-title center">Questions we get asked</h2>

      <div class="faq-list">
        <details class="faq-item">
          <summary>We already have an agency for paid media or email.</summary>
          <p>Good — keep them. Post-Click Growth isn't a replacement for your media buyer or your email platform. We work on the specific layer in between: the pages and flows that traffic actually lands on and moves through.</p>
        </details>
        <details class="faq-item">
          <summary>We tried CRO before and it didn't move the needle.</summary>
          <p>That's common, and usually it's not the concept that failed — it's the execution. Tests that aren't tied to a real hypothesis, sample sizes too small to mean anything, or programs that get called off after two weeks. A real testing process looks different from a one-off redesign.</p>
        </details>
        <details class="faq-item">
          <summary>Our Klaviyo flows already convert fine.</summary>
          <p>"Fine" is usually the sign worth investigating. Flows built once and left alone tend to plateau quietly — nothing breaks, revenue per subscriber just stops climbing. That's exactly the kind of gap an audit is built to find.</p>
        </details>
        <details class="faq-item">
          <summary>What does this cost, and how does an engagement start?</summary>
          <p>We're not going to quote a number before we've looked at your data — every account is different. Apply below, and if it looks like a fit, the next step is a conversation about your store, your traffic, and where we'd actually start.</p>
        </details>
      </div>
    </div>
  </section>

  <section class="section section-alt reveal" id="contact">
    <div class="container container-narrow center">
      <p class="eyebrow center">Next step</p>
      <h2 class="section-title center">If this sounds like your store, apply below.</h2>
      <p class="section-lede center">
        We only take on a handful of new accounts at a time so the work stays hands-on. Tell us a bit about
        your store and what you're trying to grow, and we'll tell you plainly whether we're a fit.
      </p>
      <button type="button" class="btn btn-primary open-modal-btn">Apply Now</button>
      <p class="ps-line">
        <strong>P.S.</strong> — If you're already running $1M+ through Shopify and Klaviyo, growth from here
        doesn't get easier. It gets more specific. Apply above and we'll tell you honestly whether post-click
        is where your next gain is hiding.
      </p>
    </div>
  </section>

</main>

<footer class="site-footer">
  <div class="container footer-inner">
    <span class="brand-mark" aria-hidden="true"></span>
    <span class="brand-name"><?= htmlspecialchars($brandName) ?></span>
  </div>
</footer>

<button id="back-to-top" class="back-to-top" aria-label="Back to top">↑</button>

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
          <label for="message">Tell us about your store and what you're trying to grow</label>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script src="script.js"></script>
</body>
</html>
