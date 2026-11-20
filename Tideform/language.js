function showLanguage(language) {
  const selected = language === "zh" ? "zh" : "en";
  document.documentElement.lang = selected === "zh" ? "zh-Hans" : "en";
  document.querySelectorAll("[data-language]").forEach((section) => {
    section.hidden = section.dataset.language !== selected;
  });
  document.querySelectorAll("[data-select-language]").forEach((button) => {
    button.setAttribute("aria-pressed", String(button.dataset.selectLanguage === selected));
  });
  try { localStorage.setItem("tideform-language", selected); }
  catch { /* The page remains usable without preference storage. */ }
}
document.querySelectorAll("[data-select-language]").forEach((button) => {
  button.addEventListener("click", () => showLanguage(button.dataset.selectLanguage));
});
let saved;
try { saved = localStorage.getItem("tideform-language"); }
catch { /* Storage is optional for the language preference. */ }
showLanguage(saved || (navigator.language.toLowerCase().startsWith("zh") ? "zh" : "en"));
