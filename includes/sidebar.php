<?php
    if (!isset($_SESSION["user"])){
        header("Location: ../auth/login.php");
    }

    $actualPage = $_GET["page"] ?? "fichas";
?>

<link rel="stylesheet" href="./assets/css/styleSideBar.css">
    <div class="sidebar"> 

        <div class="logo-container">
            <a href=".">
                <img src="./assets/img/sena-logo.png">
            </a>

            <h1>SSA</h1>
        </div>

        <div class="sidebar-links-container">
            <div>
                <!-- Verificar en qué apartado se encuentra, para colocar el indicar del sidebar -->
                <?php if (str_contains($actualPage, "fichas") ): ?>
                    <span class="sidebar-indicator"></span>
                <?php endif; ?>

                <a href=".">
                    <span><i class="bi bi-house-fill"></i> Inicio</span>
                </a>
            </div>
            <div>
                <?php if (str_contains($actualPage, "cuentas") ): ?>
                    <span class="sidebar-indicator"></span>
                <?php endif; ?>

                <a href="./index.php?page=cuentas/listar_cuentas">
                    <span><i class="bi bi-person-fill"></i> Cuentas</span>
                </a>
            </div>
            <div>
                <?php if (str_contains($actualPage, "programas") ): ?>
                    <span class="sidebar-indicator"></span>
                <?php endif; ?>

                <a href="./index.php?page=programas/listar_programas">
                    <span><i class="bi bi-grid-fill"></i> Programas</span>
                </a>
            </div>
        </div>

        <div class="sidebar-bottom-container">
            <div class="sidebar-toggle-theme-container">
                <p>Cambiar tema:</p>
                <div id="sidebar-theme-toggle" class="sidebar-theme-toggle">
                    <i class="bi bi-moon-fill"></i>
                </div>
            </div>

            <div class="switch-language-container">
                <p>Cambiar idioma:</p>
                <div>
                    <i class="bi bi-globe"></i>
                </div>
            </div>

            <div class="logout-sidebar-container">
                <button onclick="window.location.href = './auth/logout.php'">
                    <span>Cerrar sesión</span>
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
            <div class="language-selector">
                Español
            </div>
            
            <div class="language-selector">
                Inglés
            </div>
        </div>
     </div>

    <div class="sidebar-background"></div>