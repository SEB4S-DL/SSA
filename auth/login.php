<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" href="../assets/img/sena-logo.png">
    <title>Login</title>
</head>
<body onload="activarModoOscuro('global.css', 'bootstrap-icons')">
    <div class="diagonal-div"></div>
    <div class="diagonal-div-2"></div>

    <div class="toggle-theme-login">
        <p class="theme-trigger" onclick="showThemeSelector()">Cambiar tema:</p>
        <i class="bi bi-moon-fill theme-trigger" onclick="showThemeSelector()"></i>

        <div class="theme-selector-container">
            <div class="selector" onclick="setTheme('light')">Claro <i class="bi bi-brightness-high-fill"></i></div>
            <div class="selector" onclick="setTheme('dark')">Oscuro <i class="bi bi-moon-fill"></i></div>
        </div>
    </div>

    <div class="login-form-container">
        <div class="form-logo-container">
            <img src="../assets/img/sena-logo.png" alt="">
            <span></span>
            <h2>SSA</h2>
        </div>

        <p>Sistema de seguimiento de aprendices</p>

        <form action="" class="login-form">
            <label for="emailInput">Correo</label>
            <input type="text" name="email" id="emailInput" placeholder="Ingrese su correo">

            <label for="passwordInput">Contraseña</label>
             <div class="password-input-container">
                <div class="view-password-container">
                    <i class="bi bi-eye" id="toggleIcon" onclick="togglePassword()"></i>
                </div>
                 <input type="password" name="password" id="passwordInput" placeholder="Ingrese su contraseña">
             </div>

            <input type="submit" value="Iniciar sesión">
        </form>
    </div>

    <script src="../assets/js/modoOscuro.js"></script>
    <script src="../assets/js/toggleThemeLogin.js"></script>
    <script src="../assets/js/togglePassword.js"></script>
</body>
</html>