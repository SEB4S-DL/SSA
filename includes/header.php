<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../auth/login.php");
  }
?>

<link rel="stylesheet" href="./assets/css/styleHeader.css">

<div class="header">
    <span>
        <i class="bi bi-justify" id="toggle-menu-trigger"></i>
    </span>

    <a href="/SSA/index.php">
        <img src="./assets/img/sena-logo.png" alt="Logo SENA">
    </a>
    <h1>Bienvenido/a, <?= $_SESSION["user"]; ?></h1>

    <div>
        <h1>Cambiar Tema: </h1>
        <i class="bi bi-moon-fill" id="toggle-menu-selector"></i>
        <a href="/SSA/auth/logout.php"><button>Salir</button></a>
        <div class="theme-selector">
            <div onclick="setTheme('system')">Auto <i class="bi bi-circle-half"></i></div>
        </div>
    </div>
</div>
