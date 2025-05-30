function showThemeSelector() {
  const selectorContainer = document.querySelector(".theme-selector-container");
  const themeTriggers = document.querySelectorAll(".theme-trigger");

  selectorContainer.classList.toggle("visible-theme-selector-container");

  document.addEventListener("click", (e) => {
    if (e.target !== selectorContainer && e.target !== themeTriggers[0] && e.target !== themeTriggers[1] && selectorContainer.classList.contains("visible-theme-selector-container")){
      selectorContainer.classList.remove("visible-theme-selector-container");
    }
  });
}