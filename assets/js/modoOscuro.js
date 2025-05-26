function activarModoOscuro(...excluded) {

  const userThemePreference = localStorage.getItem("userThemePreference") ?? "light";

  if (userThemePreference === "light") return;

  const links = document.querySelectorAll('link[rel="stylesheet"]');

  links.forEach(link => {
    const href = link.getAttribute("href");

    if (excluded.some(content => !href.includes(content))) {
      const newHref = href.replace(/\.css$/, '-dark.css');
      link.setAttribute("href", newHref);
    }
  });
}
