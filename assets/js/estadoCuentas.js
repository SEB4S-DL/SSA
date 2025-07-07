const btn = document.getElementById("estadoBtn");

    btn.addEventListener("click", () => {
        // Obtener el estado actual
        let estado = btn.getAttribute("data-estado");

        // Cambiar el estado
        if (estado === "1") {
            btn.setAttribute("data-estado", "0");
            btn.textContent = "Deshabilitado";
        } else {
            btn.setAttribute("data-estado", "1");
            btn.textContent = "Habilitado";
        }
    });