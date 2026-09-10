document.documentElement.classList.add("batchora-js");

const revealTargets = document.querySelectorAll(
  [
    ".batchora-hero > *",
    ".batchora-product-media > *",
    ".batchora-section",
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

document.addEventListener("click", (event) => {
  const previewTrigger = event.target.closest(".batchora-preview-trigger");
  if (previewTrigger) {
    const container = previewTrigger.closest(".batchora-preview");
    const video = container?.querySelector(".batchora-preview-video");
    if (video?.dataset.src) {
      video.src = video.dataset.src;
      video.hidden = false;
      previewTrigger.hidden = true;
      video.load();
      video.play().catch(() => {});
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
