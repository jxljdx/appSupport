function showLanguage(language) {
  const selected = language === "zh" ? "zh" : "en";
  document.documentElement.lang = selected === "zh" ? "zh-Hans" : "en";
  document.querySelectorAll("[data-language]").forEach((section) => {
    section.hidden = section.dataset.language !== selected;
  });
  document.querySelectorAll("[data-select-language]").forEach((button) => {
    button.setAttribute("aria-pressed", String(button.dataset.selectLanguage === selected));
  });
  try { localStorage.setItem("depthpop-language", selected); }
  catch { /* Language switching remains available when storage is disabled. */ }
}
document.querySelectorAll("[data-select-language]").forEach((button) => {
  button.addEventListener("click", () => showLanguage(button.dataset.selectLanguage));
});
let saved;
try { saved = localStorage.getItem("depthpop-language"); }
catch { /* Storage is optional for the language preference. */ }
showLanguage(saved || (navigator.language.toLowerCase().startsWith("zh") ? "zh" : "en"));
