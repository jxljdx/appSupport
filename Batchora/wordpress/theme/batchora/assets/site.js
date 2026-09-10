document.documentElement.classList.add("batchora-js");

document.addEventListener("click", (event) => {
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

