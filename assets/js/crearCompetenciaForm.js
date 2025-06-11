document.getElementById("crearCompetencia").addEventListener("submit", function(e) {
  e.preventDefault(); // Evita que se recargue la página

  const BASE_URL = '/SSA/';
  const form = e.target;
  const formData = new FormData(form);

  fetch(BASE_URL + "functions/crearCompetencia.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text()) // o .json() si el backend devuelve JSON
  .then(data => {
    console.log("Respuesta del servidor:", data);
    // Aquí podés mostrar un mensaje, redirigir, etc.
  })
  .catch(error => {
    console.error("Error en el envío:", error);
  });
});
