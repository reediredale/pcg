(function () {
  "use strict";

  var header = document.getElementById("site-header");
  var backToTop = document.getElementById("back-to-top");
  var openBtns = document.querySelectorAll(".open-modal-btn");
  var closeBtn = document.getElementById("modal-close-btn");
  var overlay = document.getElementById("modal-overlay");
  var form = document.getElementById("contact-form");

  function onScroll() {
    header.classList.toggle("is-scrolled", window.scrollY > 12);
    backToTop.classList.toggle("is-visible", window.scrollY > 480);
  }

  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  backToTop.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  var revealTargets = document.querySelectorAll(".reveal");
  if ("IntersectionObserver" in window) {
    var revealObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 }
    );
    revealTargets.forEach(function (el) {
      revealObserver.observe(el);
    });
  } else {
    revealTargets.forEach(function (el) {
      el.classList.add("is-visible");
    });
  }

  function openModal() {
    overlay.classList.add("is-open");
  }

  function closeModal() {
    overlay.classList.remove("is-open");
  }

  if (openBtns.length && overlay) {
    openBtns.forEach(function (btn) {
      btn.addEventListener("click", openModal);
    });
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

  var chartCanvas = document.getElementById("growth-chart");
  if (chartCanvas && window.Chart) {
    var labels = [
      "May 2025", "Jun 2025", "Jul 2025", "Aug 2025", "Sep 2025",
      "Oct 2025", "Nov 2025", "Dec 2025", "Jan 2026", "Feb 2026",
      "Mar 2026", "Apr 2026", "May 2026", "Jun 2026", "Jul 2026"
    ];
    var revenueData = [1.2, 1.1, 3.0, 5.8, 5.3, 4.9, 6.8, 5.7, 5.5, 5.3, 7.5, 7.2, 11.2, 8.5, 10.9];
    var trendData = labels.map(function (_, i) {
      return 2.0 + i * ((10.2 - 2.0) / (labels.length - 1));
    });

    var ctx = chartCanvas.getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, chartCanvas.height);
    gradient.addColorStop(0, "rgba(79, 70, 229, 0.35)");
    gradient.addColorStop(1, "rgba(79, 70, 229, 0.02)");

    new Chart(ctx, {
      type: "line",
      data: {
        labels: labels,
        datasets: [
          {
            label: "Indexed revenue per customer",
            data: revenueData,
            borderColor: "#4f46e5",
            backgroundColor: gradient,
            fill: true,
            tension: 0.4,
            pointRadius: 0,
            pointHoverRadius: 4,
            borderWidth: 2.5
          },
          {
            label: "Trend",
            data: trendData,
            borderColor: "#a5b4fc",
            borderDash: [6, 6],
            borderWidth: 1.5,
            pointRadius: 0,
            fill: false,
            tension: 0
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: { mode: "index", intersect: false },
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: "#1e1b4b",
            padding: 10,
            titleFont: { family: "Plus Jakarta Sans" },
            bodyFont: { family: "Plus Jakarta Sans" },
            callbacks: {
              label: function (item) {
                return item.dataset.label + ": " + item.parsed.y.toFixed(1);
              }
            }
          }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: { font: { family: "Plus Jakarta Sans", size: 10 }, color: "#5c5a72", maxRotation: 0, autoSkip: true, maxTicksLimit: 6 }
          },
          y: {
            grid: { color: "#e6e2f0" },
            ticks: { font: { family: "Plus Jakarta Sans", size: 10 }, color: "#5c5a72" }
          }
        }
      }
    });
  }
})();
