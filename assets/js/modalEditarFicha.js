let triggerButtons = document.querySelectorAll(".editarFichaTrigger");
let editModal = document.querySelector(".modal-bg");
let exitModal = document.querySelector(".exitModal");

triggerButtons.forEach((item) =>{
  item.addEventListener("click", () =>{
    editModal.classList.add("visible");

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape"){
        editModal.classList.remove("visible");
      }
    }, {once: true});
  })
});

document.addEventListener("click", (e) => {
  if (e.target === editModal){
    editModal.classList.remove("visible");
  }
})

exitModal.addEventListener("click", () =>{
  editModal.classList.remove("visible");
});
