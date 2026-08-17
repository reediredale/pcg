<div class="modal-overlay<?= $modalOpen ? ' is-open' : '' ?>" id="modal-overlay">
  <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <button type="button" class="modal-close" id="modal-close-btn" aria-label="Close">&times;</button>

    <div class="contact-form-wrap">
      <h2 id="modal-title" class="modal-title">Apply Now</h2>

      <?php if ($formSuccess): ?>
        <div class="form-banner form-banner-success" role="status">
          Thanks - your message is in. We'll follow up soon.
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
          <label for="message">Tell us about your brand and what you're trying to grow</label>
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
