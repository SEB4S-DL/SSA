<?php
if (!isset($_SESSION["user"])) {
    header("Location: ../../auth/login.php");
}

if (!isset($_GET['competencia']) || !is_numeric($_GET['competencia'])) {
    echo "ID de competencia no válido.";
    exit;
}

$idCompetencia = $_GET['competencia'];
?>

<link rel="stylesheet" href="./assets/css/crear-rae.css">
<title>Crear RAE</title>

<div class="container">
  <br>
  <div class="top-container">
    <h1>Crear RAE</h1>
  
  </div>

  <form id="crearRae" class="crear-ficha-form">
    <label for="fichaNumber">Nombre del RAE</label>
    <input type="text" name="nombreRae" id="fichaNumber" placeholder="Ingrese el nombre del RAE" required>

    <label for="day">Total horas del RAE</label>
    <input type="text" name="horas" placeholder="Ingrese las horas" required>

    <div class="buttons-container">
      <a href=".?page=programas/listar_rae&competencia=<?= $idCompetencia ?>">
        Cancelar
      </a>

      <input type="submit" value="Crear RAE">
    </div>
  </form>
</div>
