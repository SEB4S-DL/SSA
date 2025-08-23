function toggleModal(modalBackground, closeModal){
  let modalBg = document.getElementById(modalBackground);
  let modalClose = document.getElementById(closeModal);

  modalBg.style.display = "block";

  modalClose.addEventListener("click", () =>{
    modalBg.style.display = "none";
  }, {once: true});

  modalBg.addEventListener("click", (e) =>{
    if (e.target === modalBg){
      modalBg.style.display = "none";
    }
  });
}