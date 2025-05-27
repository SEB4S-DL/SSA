<?php require_once './db/conection.php'?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/img/sena-logo.png">
    <link rel="stylesheet" href="./assets/css/global.css">
    <?php include_once "./includes/bootstrap.php"; ?>
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
</body>
</html>