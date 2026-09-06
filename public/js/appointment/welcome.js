// ==========================================================================
// Shine & Smile — Cinematic Welcome Page
// Self-contained script for resources/views/welcome.blade.php only.
// Does not touch js/appointment.js (shared dashboard script).
// ==========================================================================

(function () {
  "use strict";

  var prefersReducedMotion =
    window.matchMedia &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // ---------------- Nav scroll state ----------------

  var nav = document.getElementById("ssNav");

  function updateNavState() {
    if (!nav) return;
    if (window.scrollY > 40) {
      nav.classList.add("is-scrolled");
    } else {
      nav.classList.remove("is-scrolled");
    }
  }

  updateNavState();
  window.addEventListener("scroll", updateNavState, { passive: true });

  // ---------------- Mobile menu ----------------

  var burger = document.getElementById("ssBurger");
  var mobilePanel = document.getElementById("ssMobilePanel");
  var mobileClose = document.getElementById("ssMobileClose");

  function openMobileMenu() {
    if (!mobilePanel) return;
    mobilePanel.classList.add("is-open");
    burger && burger.setAttribute("aria-expanded", "true");
    document.body.style.overflow = "hidden";
  }

  function closeMobileMenu() {
    if (!mobilePanel) return;
    mobilePanel.classList.remove("is-open");
    burger && burger.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";
  }

  burger &&
    burger.addEventListener("click", function () {
      var isOpen = mobilePanel && mobilePanel.classList.contains("is-open");
      isOpen ? closeMobileMenu() : openMobileMenu();
    });

  mobileClose && mobileClose.addEventListener("click", closeMobileMenu);

  mobilePanel &&
    mobilePanel.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", closeMobileMenu);
    });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeMobileMenu();
  });

  // ---------------- Scroll reveal ----------------

  var revealTargets = document.querySelectorAll(".ss-reveal");

  if (prefersReducedMotion || !("IntersectionObserver" in window)) {
    revealTargets.forEach(function (el) {
      el.classList.add("is-visible");
    });
  } else {
    var revealObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { root: null, rootMargin: "0px 0px -10% 0px", threshold: 0.15 }
    );

    revealTargets.forEach(function (el) {
      revealObserver.observe(el);
    });
  }

  // ---------------- Hero load-in ----------------

  var hero = document.querySelector(".ss-hero");
  if (hero) {
    window.requestAnimationFrame(function () {
      setTimeout(function () {
        hero.classList.add("is-loaded");
      }, 100);
    });
  }

  // ---------------- FAQ accordion ----------------

  document.querySelectorAll(".ss-faq-item").forEach(function (item) {
    var question = item.querySelector(".ss-faq-q");
    var answer = item.querySelector(".ss-faq-a");
    if (!question || !answer) return;

    question.addEventListener("click", function () {
      var isOpen = item.classList.contains("is-open");

      document.querySelectorAll(".ss-faq-item.is-open").forEach(function (openItem) {
        if (openItem !== item) {
          openItem.classList.remove("is-open");
          var openAnswer = openItem.querySelector(".ss-faq-a");
          if (openAnswer) openAnswer.style.maxHeight = null;
          var openQ = openItem.querySelector(".ss-faq-q");
          if (openQ) openQ.setAttribute("aria-expanded", "false");
        }
      });

      if (isOpen) {
        item.classList.remove("is-open");
        answer.style.maxHeight = null;
        question.setAttribute("aria-expanded", "false");
      } else {
        item.classList.add("is-open");
        answer.style.maxHeight = answer.scrollHeight + "px";
        question.setAttribute("aria-expanded", "true");
      }
    });
  });
})();
