// Menu hamburger + accessibilité
document.addEventListener("DOMContentLoaded", () => {
  const burger = document.querySelector(".hamburger");
  const menu   = document.querySelector(".nav-links");
  //const hamburger = document.querySelector(".hamburger");
  const overlay = document.querySelector(".nav-overlay");
  const panel = document.querySelector(".nav-panel");

  if (burger && overlay && panel) {
  const toggleMenu = () => {
    overlay.classList.toggle("active");
    panel.classList.toggle("active");
  };
  burger.addEventListener("click", toggleMenu);
  overlay.addEventListener("click", toggleMenu);
  }
  /*if (burger && menu) {
    burger.addEventListener("click", () => {
      const opened = menu.classList.toggle("open");
      burger.setAttribute("aria-expanded", opened ? "true" : "false");
    });
  }*/
});
// Lightbox galerie
document.addEventListener("DOMContentLoaded", () => {
  const images = document.querySelectorAll(".gallery img");
  const lightbox = document.getElementById("lightbox");
  const lightboxImg = document.getElementById("lightbox-img");
  const closeBtn = document.querySelector(".lightbox .close");

  images.forEach(img => {
    img.addEventListener("click", () => {
      lightbox.style.display = "flex";
      lightboxImg.src = img.src;
      lightboxImg.alt = img.alt;
    });
  });

  closeBtn.addEventListener("click", () => lightbox.style.display = "none");
  lightbox.addEventListener("click", (e) => {
    if (e.target === lightbox) lightbox.style.display = "none";
  });
});
// Header solid on scroll
document.addEventListener("scroll", () => {
  const nav = document.querySelector(".navbar");
  if (!nav) return;
  if (window.scrollY > 8) nav.classList.add("scrolled");
  else nav.classList.remove("scrolled");
});

document.addEventListener("DOMContentLoaded", () => {
  if (window.GLightbox) GLightbox({ selector: ".glightbox" });
});

document.addEventListener('click', (e) => {
  const box = e.target.closest('.video-embed');
  if (!box) return;
  const platform = box.dataset.platform;
  const id = box.dataset.id;

  let src = '';
  if (platform === 'youtube') {
    src = 'https://www.youtube.com/embed/' + encodeURIComponent(id) + '?rel=0&autoplay=1';
  } else if (platform === 'vimeo') {
    src = 'https://player.vimeo.com/video/' + encodeURIComponent(id) + '?autoplay=1';
  }
  if (!src) return;

  // Remplace le contenu par l’iframe
  box.innerHTML = '<iframe src="'+src+'" allow="autoplay; fullscreen" allowfullscreen style="border:0;width:100%;height:100%"></iframe>';
}, { passive: true });

// Fondu d'apparition des vignettes (cartes + page film)
(function () {
  const imgs = document.querySelectorAll('img.js-thumb, .video-thumb img, .video-embed img');
  imgs.forEach((img) => {
    const setLoaded = () => img.classList.add('is-loaded');

    if (img.complete) {
      // déjà en cache
      if (img.naturalWidth > 0) setLoaded();
    } else {
      img.addEventListener('load', setLoaded, { once: true });
    }

    // Fallback en cas d'erreur : placeholder si dispo via data-placeholder
    img.addEventListener('error', () => {
      const ph = img.getAttribute('data-placeholder');
      if (ph && img.src !== ph) {
        img.src = ph;
      }
      setLoaded();
    }, { once: true });
  });
})();
