const languageTrigger = document.querySelector(".switch-language-container");
const languageSelect = document.querySelector(".switch-language-bg");
const languageOptions = document.querySelector(".language-select");

// Mostrar y ocultar el menú
languageTrigger.addEventListener("click", (e) => {
  e.stopPropagation();
  languageSelect.classList.toggle("visible-language-select");

  document.addEventListener("click", (event) => {
    if (!languageSelect.contains(event.target)) {
      languageSelect.classList.remove("visible-language-select");
    }
  }, { once: true });
});

// Cambiar idioma al hacer clic
document.querySelectorAll(".language-select div").forEach(option => {
  option.addEventListener("click", () => {
    const selectedLang = option.getAttribute("data-lang");

    // Redirigir con ?lang=es o ?lang=en
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set("lang", selectedLang);
    window.location.href = currentUrl.toString();
  });
});
  