<?php
  session_start();

  // Eliminar todas las variables de sesión
  session_unset();

  // Eliminar la cookie de sesión
  setcookie(session_name(), "", time() - 3600);

  session_destroy();

  header("Location: ./login.php");
  exit();
;?>