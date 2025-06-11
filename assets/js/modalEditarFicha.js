let triggerButtons = document.querySelectorAll(".editarTrigger");
let editModal = document.querySelector(".modal-bg");
let exitModal = document.querySelector(".exitModal");

triggerButtons.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.stopPropagation();

    const tipo = btn.dataset.tipo;

    // Mostrar modal
    editModal.classList.add("visible");

    // Limpiar campos antes
    //editModal.querySelectorAll("input").forEach(input => input.value = "");

    // Rellenar según tipo
    if (tipo === "competencia") {
        editModal.querySelector("#idCompetencia").value = btn.dataset.id;
      editModal.querySelector("#nombreCompetencia").value = btn.dataset.nombre;
      editModal.querySelector("#cantidadHoras").value = btn.dataset.horas;
      editModal.querySelector("#idPrograma").value = btn.dataset.id;
      editModal.querySelector("#submitInput").value = "Editar";
    }

    if (tipo === "programa") {
      editModal.querySelector("#idPrograma").value = btn.dataset.id;
      editModal.querySelector("#nombrePrograma").value = btn.dataset.nombre;
      editModal.querySelector("#cantidadHoras").value = btn.dataset.horas;
      editModal.querySelector("#nivel").value = btn.dataset.nivel;
      editModal.querySelector("#submitInput").value = "Editar";
      // Agregá más si necesitás...
    }

    if (tipo === "ficha") {
      editModal.querySelector("#jefeGrupoSelect").value = btn.dataset.jefeid;
      editModal.querySelector("#jornadaSelect").value = btn.dataset.jornada;
      editModal.querySelector("#submitInput").value = "Editar";
      // Agregá más si necesitás...
    }

    // Escape para cerrar
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        editModal.classList.remove("visible");
      }
    }, { once: true });
  });
});

// Cierre por fondo o por X
document.addEventListener("click", (e) => {
  if (e.target === editModal) {
    editModal.classList.remove("visible");
  }
});

exitModal.addEventListener("click", () => {
  editModal.classList.remove("visible");
});
