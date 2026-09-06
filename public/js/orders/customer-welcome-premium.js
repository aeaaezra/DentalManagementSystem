(function () {
  'use strict';

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------------- Sticky / glass header ---------------- */
  var header = document.getElementById('mainHeader');
  if (header) {
    var updateHeaderState = function () {
      if (window.scrollY > 24) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    };
    document.addEventListener('scroll', updateHeaderState, { passive: true });
    updateHeaderState();
  }

  /* ---------------- Scroll reveal ---------------- */
  var revealSelectors = [
    '.trust-container',
    '.cat-card-premium',
    '.promo-cta-inner',
    '.why-card',
    '.how-step',
    '.experience-copy',
    '.experience-mockup',
    '.final-cta-inner'
  ];
  var revealEls = document.querySelectorAll(revealSelectors.join(','));

  if (reduceMotion || !('IntersectionObserver' in window)) {
    revealEls.forEach(function (el) { el.classList.add('ss-reveal', 'ss-in'); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('ss-reveal'); });
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('ss-in');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    revealEls.forEach(function (el) { io.observe(el); });
  }

  /* ---------------- Animated counters ---------------- */
  var counters = document.querySelectorAll('.counter[data-count]');
  var animateCounter = function (el) {
    var target = parseInt(el.getAttribute('data-count'), 10) || 0;
    var duration = 1400;
    var start = null;
    var step = function (ts) {
      if (!start) start = ts;
      var progress = Math.min((ts - start) / duration, 1);
      el.textContent = Math.floor(progress * target);
      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target;
      }
    };
    requestAnimationFrame(step);
  };

  if (counters.length) {
    var trustSection = document.getElementById('trust');
    if (trustSection && !reduceMotion && 'IntersectionObserver' in window) {
      var cio = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            counters.forEach(animateCounter);
            cio.unobserve(entry.target);
          }
        });
      }, { threshold: 0.4 });
      cio.observe(trustSection);
    } else {
      counters.forEach(function (el) {
        el.textContent = el.getAttribute('data-count');
      });
    }
  }

  /* ---------------- Hero glow parallax (subtle, non-essential) ---------------- */
  var glow = document.querySelector('.hero-cinematic-glow');
  if (glow && !reduceMotion) {
    document.addEventListener('scroll', function () {
      var y = window.scrollY;
      if (y < window.innerHeight) {
        glow.style.transform = 'translate(-50%,-50%) translateY(' + (y * 0.15) + 'px)';
      }
    }, { passive: true });
  }
})();
