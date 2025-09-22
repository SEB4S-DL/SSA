<?php
    require_once "../functions/login.php";
    session_start();

    $errores = [
        "1" => "Credenciales incorrectas"
    ];

    if (isset($_SESSION["user"])){
        header("Location: ../index.php");
    }

    if (validarDatos()){
        $user = consultarUsuario();


        $_SESSION["user"] = $user["nombre"];
        $_SESSION["user_id"] = $user["nro_documento"];
        $_SESSION["user_rol"] = $user["rol"];
        $_SESSION["user_email"] = $user["correo_institucional"];

        header("Location: ../index.php");
        unset($errores["1"]);
    }
    else{
        if ($_SERVER["REQUEST_METHOD"] === "POST"){
            header("Location: ./login.php?status=1");
        }
    }

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
        <p class="theme-trigger" onclick="showThemeSelector()"><?= $traducciones['cambiar_tema']?></p>
        <i class="bi bi-moon-fill theme-trigger" onclick="showThemeSelector()"></i>

        <div class="theme-selector-container">
            <div class="selector" onclick="setTheme('light')"><?= $traducciones['claro']?><i class="bi bi-brightness-high-fill"></i></div>
            <div class="selector" onclick="setTheme('dark')"><?= $traducciones['oscuro']?><i class="bi bi-moon-fill"></i></div>
        </div>
    </div>

    <div class="login-form-container">
        <div class="form-logo-container">
            <img src="../assets/img/sena-logo.png" alt="">
            <span></span>
            <h2><?= $traducciones['SSA']?></h2>
        </div>

        <p><?= $traducciones['titulo_login']?></p>

        <form action="./login.php" class="login-form" method="POST">
            <?php if (isset($_GET["status"]) && $_GET["status"] == 1): ?>
            <div class="error-container"><?= $errores[$_GET["status"]]; ?></div>
            <?php endif; ?>

            <label for="emailInput"><?= $traducciones['correo']?></label>
            <input type="text" name="email" id="emailInput" placeholder="<?= $traducciones['input_correo']?>" required>

            <label for="passwordInput"><?= $traducciones['contraseña']?></label>
             <div class="password-input-container">
                <div class="view-password-container">
                    <i class="bi bi-eye" id="toggleIcon" onclick="togglePassword()"></i>
                </div>
                 <input type="password" name="password" id="passwordInput" placeholder="<?= $traducciones['input_contraseña']?>" required>
             </div>

            <input type="submit" value="<?= $traducciones['iniciar_sesion']?>">
            <a href="">Olvidaste tu contraseña?</a>
        </form>
    </div>

    <script src="../assets/js/modoOscuro.js"></script>
    <script src="../assets/js/toggleThemeLogin.js"></script>
    <script src="../assets/js/togglePassword.js"></script>
</body>
</html>