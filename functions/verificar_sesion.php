<?php
  // Validación para todo el sitio. Solo verifica que haya una sesión activa
  function validar_sesion(){
    if (!isset($_SESSION["user"])){
      return false;
    }
    
    return true;
  }

  // Validación de que el rol del usuario sea admin.
  function validar_admin(){
    if ($_SESSION["user_rol"] == "admin"){
      return true;
    }

    return false;
  }
?>