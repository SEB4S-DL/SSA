const respuesta = document.getElementById("respuesta");

document.getElementById("importarCompetencias").addEventListener("submit", function(e) {
  e.preventDefault();

  const BASE_URL = '/SSA/';
  const form = e.target;
  const formData = new FormData(form);

  fetch(BASE_URL + "functions/importar_competencias.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    console.log("Respuesta del servidor:", data);
    respuesta.textContent = data.mensaje;

    if (data.status === 'success') {
      setTimeout(() => {
        window.location.href = BASE_URL + "index.php?page=programas/listar_programas";
      }, 3000);
    }
  })
  .catch(error => {
    console.error("Error en el envío:", error);
    respuesta.textContent = "❌ Error al enviar el formulario.";
  });
});
