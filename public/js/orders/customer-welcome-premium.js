const header = document.getElementById("siteHeader");
const menuButton = document.getElementById("menuButton");
const mobileMenu = document.getElementById("mobileMenu");

window.addEventListener("scroll", () => {
  header.classList.toggle("scrolled", window.scrollY > 8);
}, { passive: true });

menuButton.addEventListener("click", () => {
  const open = mobileMenu.classList.toggle("open");
  menuButton.setAttribute("aria-expanded", open);
  menuButton.textContent = open ? "✕" : "☰";
});

mobileMenu.querySelectorAll("a").forEach(link => {
  link.addEventListener("click", () => {
    mobileMenu.classList.remove("open");
    menuButton.setAttribute("aria-expanded", "false");
    menuButton.textContent = "☰";
  });
});

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("visible");
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });

document.querySelectorAll(".reveal").forEach(el => observer.observe(el));

const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (!entry.isIntersecting) return;
    const counter = entry.target;
    const target = Number(counter.dataset.target);
    const duration = 1300;
    const start = performance.now();

    const tick = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);
      counter.textContent = Math.floor(target * eased);
      if (progress < 1) requestAnimationFrame(tick);
      else counter.textContent = target;
    };
    requestAnimationFrame(tick);
    counterObserver.unobserve(counter);
  });
}, { threshold: 0.7 });

document.querySelectorAll(".counter").forEach(el => counterObserver.observe(el));

document.querySelectorAll(".favorite").forEach(button => {
  button.addEventListener("click", () => {
    button.classList.toggle("active");
    button.textContent = button.classList.contains("active") ? "♥" : "♡";
  });
});

document.querySelectorAll(".add-cart").forEach(button => {
  button.addEventListener("click", () => {
    const original = button.innerHTML;
    button.innerHTML = "Added to Cart ✓";
    button.style.background = "#E91E63";
    button.style.color = "#fff";
    setTimeout(() => {
      button.innerHTML = original;
      button.style.background = "";
      button.style.color = "";
    }, 1100);
  });
});

document.querySelectorAll(".category-card").forEach(card => {
  card.addEventListener("click", () => {
    document.querySelectorAll(".category-card").forEach(c => c.classList.remove("active"));
    card.classList.add("active");
  });
});

// Gentle pointer movement on the hero product composition.
const heroVisual = document.querySelector(".hero-visual");
if (heroVisual && window.matchMedia("(pointer:fine)").matches) {
  heroVisual.addEventListener("pointermove", (event) => {
    const rect = heroVisual.getBoundingClientRect();
    const x = (event.clientX - rect.left) / rect.width - 0.5;
    const y = (event.clientY - rect.top) / rect.height - 0.5;
    heroVisual.style.setProperty("--mx", `${x * 12}px`);
    heroVisual.style.setProperty("--my", `${y * 10}px`);
  });
  heroVisual.addEventListener("pointerleave", () => {
    heroVisual.style.setProperty("--mx", "0px");
    heroVisual.style.setProperty("--my", "0px");
  });
}
