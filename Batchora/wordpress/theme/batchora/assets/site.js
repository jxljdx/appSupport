document.documentElement.classList.add("batchora-js");

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
