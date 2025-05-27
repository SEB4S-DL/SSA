<?php
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
                    <span>Inicio</span>
                </a>
            </div>
            <div>
                <?php if (str_contains($actualPage, "cuentas") ): ?>
                    <span class="sidebar-indicator"></span>
                <?php endif; ?>

                <a href="./index.php?page=cuentas/listar_cuentas">
                    <span>Cuentas</span>
                </a>
            </div>
            <div>
                <?php if (str_contains($actualPage, "programas") ): ?>
                    <span class="sidebar-indicator"></span>
                <?php endif; ?>

                <a href="./index.php?page=programas/listar_programas">
                    <span>Programas</span>
                </a>
            </div>
        </div>
    </div>