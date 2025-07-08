const res = document.getElementById("respuesta");

document.querySelectorAll(".estadosForm").forEach(form => {
  form.addEventListener("submit", function(e) {
    e.preventDefault();

    const BASE_URL = '/SSA/';
    const formData = new FormData(form);
    const estadoActual = form.dataset.estado.toLowerCase();
    formData.append("estado", estadoActual);

    fetch(BASE_URL + "functions/editarEstado.php", {
      method: "POST",
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      console.log("Respuesta del servidor:", data);
      if (data.success) {
        res.textContent = data.mensaje;
        setTimeout(() => location.reload(), 2000);
      } else {
        res.textContent = "Error: " + data.mensaje;
      }
    })
    .catch(error => {
      console.error("Error en el envío:", error);
      res.textContent = "Error al enviar";
    });
  });

  // ✋ Detener propagación del click del botón
  form.querySelector(".btn-estado").addEventListener("click", e => e.stopPropagation());
});
