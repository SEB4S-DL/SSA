<link rel="stylesheet" href="./assets/css/styleHeader.css">

<div class="header">
    <span>
        <i class="bi bi-justify" id="toggle-menu-trigger"></i>
    </span>

    <a href=".">
        <img src="./assets/img/sena-logo.png" alt="Logo SENA">
    </a>
    <h1>Bienvenido/a, {{Nombre Usuario}}</h1>

    <div>
        <h1>Cambiar Tema: </h1>
        <i class="bi bi-moon-fill" id="toggle-menu-selector"></i>
        <a href="/SSA/auth/logout.php"><button>Salir</button></a>
        <div class="theme-selector">
            <div onclick="setTheme('system')">Auto <i class="bi bi-circle-half"></i></div>
        </div>
    </div>
</div>
