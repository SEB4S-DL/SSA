<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../auth/login.php");
  }
?>

<link rel="stylesheet" href="./assets/css/footer.css">
<footer>
  Desarrollado por grupo 1 - Todos los derechos reservados &copy;
</footer>