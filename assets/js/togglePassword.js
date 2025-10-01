function togglePassword(){
  let PasswordInput = document.getElementById("passwordInput");
  let toggleIcon = document.getElementById("toggleIcon");

  let typeState = PasswordInput.getAttribute("type") === "password" ? "text" : "password";

  PasswordInput.setAttribute("type", typeState);
  
  if (toggleIcon.classList.contains("bi-eye")){
    toggleIcon.classList.remove("bi-eye");
    toggleIcon.classList.add("bi-eye-slash");
  }
  else{
    toggleIcon.classList.remove("bi-eye-slash");
    toggleIcon.classList.add("bi-eye");
  }
}