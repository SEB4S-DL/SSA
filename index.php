<?php require_once './db/conection.php'?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/img/sena-logo.png">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body onload="activarModoOscuro('global.css', 'bootstrap-icons')">
    <main>
        <?php include './includes/sidebar.php'?>
    
        <div class="main-container">
            <?php require_once './includes/header.php'?>

            <?php require_once './includes/main.php'; ?>

            <?php require_once './includes/footer.php'?>
        </div>
    </main>

    <script src="./assets/js/modoOscuro.js"></script>
    <script src="./assets/js/toggleMenu.js"></script>
    <script src="./assets/js/toggleTheme.js"></script>
    <script src="./assets/js/switchLanguage.js"></script>
</body>
</html>