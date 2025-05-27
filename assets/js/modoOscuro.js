function activarModoOscuro(...excluded) {

  const userThemePreference = localStorage.getItem("userThemePreference") ?? "light";

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
