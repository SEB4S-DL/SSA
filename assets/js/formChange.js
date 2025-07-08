let input = document.getElementById("fileInput");
let fileState = document.querySelector(".selected-file");

input.addEventListener("change", () =>{
  let files = input.files;

  let file = files[0].name;

  fileState.innerText = `Archivo seleccionado: ${file}`;
});