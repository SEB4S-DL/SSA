<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../auth/login.php");
  }

  $idioma = 'es';

if (isset($_GET['lang'])) {
    $idioma = $_GET['lang'];
} elseif (isset($_COOKIE['lang'])) {
    $idioma = $_COOKIE['lang'];
}

// Cargar archivo de idioma
$traducciones = require __DIR__ . "/../lang/$idioma.php";
?>

<link rel="stylesheet" href="./assets/css/footer.css">
<footer>
  <?= $traducciones['footer_text']; ?>
</footer>
