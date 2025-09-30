<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../auth/login.php");
    }

    $actualPage = $_GET["page"] ?? "fichas";

    $idiomasPermitidos = ['es', 'en'];
$idioma = 'es';

if (isset($_GET['lang']) && in_array($_GET['lang'], $idiomasPermitidos)) {
    $idioma = $_GET['lang'];
    setcookie('lang', $idioma, time() + (86400 * 30), "/");
} elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $idiomasPermitidos)) {
    $idioma = $_COOKIE['lang'];
}

$traducciones = require __DIR__ . "/../lang/$idioma.php";
?>

<link rel="stylesheet" href="./assets/css/styleSideBar.css">
    <div class="sidebar"> 

        <div class="logo-container">
            <a href=".">
                <img src="./assets/img/sena-logo.png">
            </a>

            <h1><?= $traducciones['SSA']?></h1>
        </div>

        <div class="sidebar-links-container">
            <div>
                <!-- Verificar en qué apartado se encuentra, para colocar el indicar del sidebar -->
                <?php if (str_contains($actualPage, "fichas") ): ?>
                    <span class="sidebar-indicator"></span>
                <?php endif; ?>

                <a href=".">
                    <span><i class="bi bi-house-fill"></i><?=$traducciones['inicio']?></span>
                </a>
            </div>
            <div>
                <?php if (str_contains($actualPage, "cuentas") ): ?>
                    <span class="sidebar-indicator"></span>
                <?php endif; ?>

                <a href="./index.php?page=cuentas/listar_cuentas">
                    <span><i class="bi bi-person-fill"></i><?=$traducciones['cuentas']?></span>
                </a>
            </div>
            <?php if ($_SESSION["user_rol"] == "admin"): ?>
            <div>
                <?php if (str_contains($actualPage, "programas") ): ?>
                    <span class="sidebar-indicator"></span>
                <?php endif; ?>

                <a href="./index.php?page=programas/listar_programas">
                    <span><i class="bi bi-grid-fill"></i><?= $traducciones['programas']?></span>
                </a>
            </div>
            <?php endif; ?>

            <div>
                <?php if (str_contains($actualPage, "manuales") ): ?>
                    <span class="sidebar-indicator"></span>
                <?php endif; ?>

                <a href="./index.php?page=manuales/manuales">
                    <span></i>Manuales</span>
                </a>
            </div>
        </div>

        <div class="sidebar-bottom-container">
            <div class="sidebar-toggle-theme-container">
                <p><?= $traducciones['cambiar_tema']?></p>
                <div id="sidebar-theme-toggle" class="sidebar-theme-toggle">
                    <i class="bi bi-moon-fill"></i>
                </div>
            </div>

            <div class="switch-language-container">
                <p><?= $traducciones['cambiar_idioma']?></p>
                <div>
                    <i class="bi bi-globe"></i>
                </div>
            </div>

            <div class="logout-sidebar-container">
                <button onclick="window.location.href = './auth/logout.php'">
                    <span><?= $traducciones['cerrar_sesion']?></span>
                    <i class="bi bi-door-open"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Selector de el tema -->
    <div class="toggle-theme-select-bg">
        <div class="toggle-theme-select__sidebar">
            <div class="theme-selector-element" onclick="setTheme('system')">
                Auto <i class="bi bi-circle-half"></i>
            </div>
        </div>
    </div>

    <!-- Selector del lenguaje -->
     <div class="switch-language-bg">
        <div class="language-select">
            <div class="language-selector" data-lang="es">Español</div>
            <div class="language-selector" data-lang="en">Inglés</div>
        </div>

     </div>

    <div class="sidebar-background"></div>