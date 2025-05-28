// Función para obtener el tema del usuario (en caso de que haya seleccionado una preferencia anteriormente)
export function getTheme(){
  let theme = localStorage.getItem("userThemePreference") ?? "light";
  
  switch (theme){
    case "light":
      return "light";

    case "dark":
      return "dark";

    case "system":
      const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");

      if (prefersDarkScheme.matches){
        return "dark";
      }
      else{
        return "light";
      }
  }
}