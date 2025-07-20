<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once dirname(__DIR__, 2) . '/config.php';

if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
    exit;
}

if (!isset($_GET["programa"]) || !is_numeric($_GET["programa"])) {
    echo "<p style='color:red;'>ID de competencia no válido o no enviado.</p>";
    exit;
}

$programa_id = intval($_GET["programa"]);
$idPrograma = $programa_id;

$sql = "SELECT 
            c.id, 
            c.nombre_competencia, 
            COUNT(r.id) AS cant_rae  
        FROM competencias c 
        LEFT JOIN resultados_aprendizaje r 
            ON r.id_competencia = c.id 
        WHERE c.id_programa_formacion = $programa_id 
        GROUP BY c.id";

$resultado = $conn->query($sql);

if (!$resultado) {
    echo "<p style='color:red;'>Error en la consulta: " . $conn->error . "</p>";
    exit;
}

$idiomasPermitidos = ['es', 'en'];
$idioma = 'es';

if (isset($_GET['lang']) && in_array($_GET['lang'], $idiomasPermitidos)) {
    $idioma = $_GET['lang'];
    setcookie('lang', $idioma, time() + (86400 * 30), "/");
} elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $idiomasPermitidos)) {
    $idioma = $_COOKIE['lang'];
}

$traducciones = require __DIR__ . "/../../lang/$idioma.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listar competencias</title>
    <link rel="stylesheet" href="./assets/css/listar-competencias.css">
</head>
<body>

<div class="listar-fichas-container">
    <div class="listar-fichas-top-container">
        <h1><?= $traducciones['titulo_listar_competencias']?></h1>
        <button class="button-volver" onclick="window.location.href = '.?page=programas/listar_programas'">
            <i class="bi bi-arrow-left"></i> <?= $traducciones['volver']?>
        </button>
        <button class="crear-button" onclick="window.location.href = '.?page=programas/importar_competencias&programa=<?= $idPrograma ?>'">
            <?= $traducciones['importar_competencias']?>
        </button>
    </div>

    <div class="contenedor">
        <?php if ($resultado->num_rows > 0): ?>
            <?php while($dato = $resultado->fetch_assoc()): ?>
                <div class="card" onclick="window.location.href = '.?page=programas/listar_rae&competencia=<?= $dato['id']; ?>'">
                   

                    <p class="card-first-p"><?= htmlspecialchars($dato["nombre_competencia"]) ?></p>
                    <p><strong>RAE:</strong> <?= $dato["cant_rae"] ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p><?= $traducciones['advertencia_competencias']?></p>
        <?php endif; ?>
    </div>
</div>


</body>
</html>
