(function () {
  "use strict";

  var openBtn = document.getElementById("open-modal-btn");
  var closeBtn = document.getElementById("modal-close-btn");
  var overlay = document.getElementById("modal-overlay");
  var form = document.getElementById("contact-form");

  function openModal() {
    overlay.classList.add("is-open");
  }

  function closeModal() {
    overlay.classList.remove("is-open");
  }

  if (openBtn && overlay) {
    openBtn.addEventListener("click", openModal);
    closeBtn.addEventListener("click", closeModal);

    overlay.addEventListener("click", function (event) {
      if (event.target === overlay) closeModal();
    });

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape" && overlay.classList.contains("is-open")) {
        closeModal();
      }
    });
  }

  if (form) {
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    form.addEventListener("submit", function (event) {
      var valid = true;

      form.querySelectorAll("[required]").forEach(function (field) {
        var value = field.value.trim();
        var fieldValid = value !== "";

        if (fieldValid && field.type === "email") {
          fieldValid = emailPattern.test(value);
        }

        field.classList.toggle("is-invalid", !fieldValid);
        if (!fieldValid) valid = false;
      });

      if (!valid) {
        event.preventDefault();
      }
    });

    form.querySelectorAll("input, textarea").forEach(function (field) {
      field.addEventListener("input", function () {
        field.classList.remove("is-invalid");
      });
    });
  }
})();
