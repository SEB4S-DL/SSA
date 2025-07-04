function activarModoOscuro(...excluded) {

  const userThemePreference = getTheme();

  if (userThemePreference === "light") return;

  const links = document.querySelectorAll('link[rel="stylesheet"]');

  links.forEach(link => {
    const href = link.getAttribute("href");

    let condition = excluded.some(content => href.includes(content));

    if (!condition) {
      const newHref = href.replace(/\.css$/, '-dark.css');
      link.setAttribute("href", newHref);
    }
  });
}

function setTheme(theme){
  let newTheme;

  switch (theme){
    case "light":
      newTheme = "light";
      break;
    
    case "dark":
      newTheme = "dark";
      break;

    case "system":
      newTheme = "system";
      break;

    default:
      newTheme = "light";
      break;
  }

  localStorage.setItem("userThemePreference", newTheme);

  location.reload();
}

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