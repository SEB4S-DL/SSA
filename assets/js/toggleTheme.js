// Función para obtener el tema que haya seleccionado el usuario (En caso de haberlo hecho previamente)
function getTheme(){
  let storedTheme = localStorage.getItem("userThemePreference") ?? "light";

  switch (storedTheme) {
    case "light":
      return "light";
  
    case "dark":
      return "dark";

    case "system":
      const preference_isDark = window.matchMedia("(prefers-color-scheme: dark)");

      if (preference_isDark.matches){
        return "dark";
      }
      else{
        return "light";
      }
  }
}

let toggleThemeSelector = document.getElementById("toggle-menu-selector");
let themeSelector = document.querySelector(".theme-selector");
let sidebarThemeSelector = document.querySelector(".toggle-theme-select__sidebar");

const selectorElements = {
  "light": `<div class="light-theme-selector theme-selector-element" onclick="setTheme('light')" ><i class="bi bi-brightness-high-fill"></i></div>`,
  "dark": `<div class="dark-theme-selector theme-selector-element" onclick="setTheme('dark')" ><i class="bi bi-moon-fill"></i></div>`
};

const actualTheme = getTheme();

if (actualTheme === "light"){
  themeSelector.innerHTML += selectorElements.dark;
  sidebarThemeSelector.innerHTML += selectorElements.dark;
}
else{
  themeSelector.innerHTML += selectorElements.light;
  sidebarThemeSelector.innerHTML += selectorElements.light;
}

toggleThemeSelector.addEventListener("click", (e) =>{
  e.stopPropagation();
  themeSelector.classList.toggle("visible-theme-selector");

  document.addEventListener("click", (event) =>{
    if (event.target !== themeSelector){
      themeSelector.classList.toggle("visible-theme-selector");
    }
  }, {once: true});
});

// SIDEBAR

let toggleThemeSelectorSidebar = document.getElementById("sidebar-theme-toggle");
let sidebarSelectBg = document.querySelector(".toggle-theme-select-bg");

toggleThemeSelectorSidebar.addEventListener("click", (e) =>{
  e.stopPropagation();
  sidebarSelectBg.classList.toggle("visible-theme-select");

  document.addEventListener("click", (event) =>{
    if (event.target !== sidebarThemeSelector){
      sidebarSelectBg.classList.toggle("visible-theme-select");
    }
  }, {once: true});
});
