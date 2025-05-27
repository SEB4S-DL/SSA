<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <?php include "../includes/bootstrap.php" ?>
    <link rel="icon" href="../assets/img/sena-logo.png">
    <title>Login</title>
</head>
<body onload="activarModoOscuro('global.css')">
    <div class="diagonal-div"></div>
    <div class="diagonal-div-2"></div>

    <div class="toggle-theme-login">
        <p>Cambiar tema:</p>
        <i class="bi bi-moon-fill"></i>
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
            <input type="text" name="password" id="passwordInput" placeholder="Ingrese su contraseña">

            <input type="submit" value="Iniciar sesión">
        </form>
    </div>

    <script src="../assets/js/modoOscuro.js"></script>
</body>
</html>