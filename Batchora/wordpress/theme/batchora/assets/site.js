document.documentElement.classList.add("batchora-js");

const revealTargets = document.querySelectorAll(
  [
    ".batchora-hero > *",
    ".batchora-home-hero__copy > *",
    ".batchora-home-hero__visual",
    ".batchora-product-media > *",
    ".batchora-section",
    ".batchora-workflow-card",
    ".batchora-feature-card",
    ".batchora-trust-fact",
    ".batchora-card",
    ".batchora-cta",
    ".batchora-faq details"
  ].join(",")
);

revealTargets.forEach((target, index) => {
  target.classList.add("batchora-reveal");
  target.style.setProperty(
    "--batchora-reveal-delay",
    `${Math.min(index % 4, 3) * 70}ms`
  );
});

if (
  "IntersectionObserver" in window &&
  !window.matchMedia("(prefers-reduced-motion: reduce)").matches
) {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }
        entry.target.classList.add("is-visible");
        observer.unobserve(entry.target);
      });
    },
    {
      rootMargin: "0px 0px -8% 0px",
      threshold: 0.08
    }
  );

  revealTargets.forEach((target) => observer.observe(target));
  requestAnimationFrame(() => {
    document.documentElement.classList.add("batchora-motion-ready");
  });
  window.setTimeout(() => {
    revealTargets.forEach((target) => {
      target.classList.add("is-visible");
      observer.unobserve(target);
    });
  }, 2200);
} else {
  revealTargets.forEach((target) => target.classList.add("is-visible"));
}

const menuToggle = document.querySelector(".batchora-menu-toggle");
const navigationShell = menuToggle?.closest(".primary-navigation-shell");

const closeNavigation = () => {
  if (!menuToggle || !navigationShell) {
    return;
  }
  menuToggle.setAttribute("aria-expanded", "false");
  navigationShell.classList.remove("is-open");
  document.body.classList.remove("batchora-menu-open");
};

menuToggle?.addEventListener("click", () => {
  const isOpen = menuToggle.getAttribute("aria-expanded") === "true";
  menuToggle.setAttribute("aria-expanded", String(!isOpen));
  navigationShell?.classList.toggle("is-open", !isOpen);
  document.body.classList.toggle("batchora-menu-open", !isOpen);
});

navigationShell?.addEventListener("click", (event) => {
  if (event.target.closest("a")) {
    closeNavigation();
  }
});

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    closeNavigation();
    menuToggle?.focus();
  }
});

document.addEventListener("click", (event) => {
  if (
    navigationShell?.classList.contains("is-open") &&
    !event.target.closest(".primary-navigation-shell")
  ) {
    closeNavigation();
  }
});

const mobileCta = document.querySelector(".batchora-mobile-cta");
const pageEndTargets = document.querySelectorAll(".batchora-cta, .site-footer");
let pageEndVisible = false;

const updateMobileCta = () => {
  if (!mobileCta) {
    return;
  }
  mobileCta.classList.toggle(
    "is-visible",
    window.scrollY > 420 && !pageEndVisible
  );
};

if (mobileCta) {
  const pageEndObserver = new IntersectionObserver(
    (entries) => {
      pageEndVisible = entries.some((entry) => entry.isIntersecting);
      updateMobileCta();
    },
    { rootMargin: "0px 0px 5% 0px", threshold: 0.02 }
  );
  pageEndTargets.forEach((target) => pageEndObserver.observe(target));
  window.addEventListener("scroll", updateMobileCta, { passive: true });
  updateMobileCta();
}

document.addEventListener("click", (event) => {
  const previewTrigger = event.target.closest(".batchora-preview-trigger");
  if (previewTrigger) {
    const container = previewTrigger.closest(".batchora-preview");
    const video = container?.querySelector(".batchora-preview-video");
    const status = container?.querySelector(".batchora-preview-status");
    if (video?.dataset.src) {
      container.classList.add("is-loading");
      if (status) {
        status.textContent = container.dataset.loadingLabel || "";
      }
      video.src = video.dataset.src;
      video.hidden = false;
      previewTrigger.replaceWith(video);
      video.addEventListener(
        "loadeddata",
        () => {
          container.classList.remove("is-loading");
          if (status && !container.classList.contains("has-manual-play")) {
            status.textContent = "";
          }
        },
        { once: true }
      );
      video.addEventListener(
        "error",
        () => {
          container.classList.remove("is-loading");
          container.classList.add("has-error");
          if (status) {
            status.textContent = container.dataset.errorLabel || "";
          }
        },
        { once: true }
      );
      video.load();
      video.play().catch(() => {
        container.classList.remove("is-loading");
        container.classList.add("has-manual-play");
        if (status) {
          status.textContent = container.dataset.manualLabel || "";
        }
      });
    }
    return;
  }

  const link = event.target.closest("a[href*='apps.apple.com']");
  if (!link) {
    return;
  }

  window.dispatchEvent(
    new CustomEvent("batchora:app-store-click", {
      detail: { href: link.href }
    })
  );
});
