<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../auth/login.php");
  }


// Idiomas permitidos
$idiomasPermitidos = ['es', 'en'];

// Idioma por defecto
$idioma = 'es';

// Validar si viene por GET y es un idioma permitido
if (isset($_GET['lang']) && in_array($_GET['lang'], $idiomasPermitidos)) {
    $idioma = $_GET['lang'];
    setcookie('lang', $idioma, time() + (86400 * 30));
}
// Si no viene por GET pero hay cookie válida
elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $idiomasPermitidos)) {
    $idioma = $_COOKIE['lang'];
}

// Cargar archivo del idioma válido
$traducciones = require __DIR__ . "/../lang/$idioma.php";

?>



<link rel="stylesheet" href="./assets/css/styleHeader.css">

<div class="header">
    <span>
        <i class="bi bi-justify" id="toggle-menu-trigger"></i>
    </span>

    <a href="/SSA/index.php">
        <img src="./assets/img/sena-logo.png" alt="Logo SENA">
    </a>

    <h1><?= $traducciones['bienvenida'] ?>, <?= $_SESSION["user"]; ?></h1>

    <div>
        <h1><?= $traducciones['cambiar_tema'] ?></h1>
        <i class="bi bi-moon-fill" id="toggle-menu-selector"></i>
        <a href="/SSA/auth/logout.php">
            <button>
                <?= $traducciones['salir'] ?>
                <i class="bi bi-door-closed"></i>
            </button>
        </a>
        <div class="theme-selector">
            <div onclick="setTheme('system')">
                <?= $traducciones['auto'] ?> <i class="bi bi-circle-half"></i>
            </div>
        </div>
    </div>
</div>

