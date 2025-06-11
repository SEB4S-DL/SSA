<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }

  if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de programa no válido.";
    exit;
}

$idPrograma = $_GET['id']; // <- guardamos el ID
?>

<link rel="stylesheet" href="./assets/css/crear-competencia.css">

<title>Crear competencia</title>

<div class="container">
  <br>
    <div class="top-container">
      <h1>Crear competencia</h1>
      <button class="button-volver">
        Subir excel
        <i class="bi bi-file-earmark-spreadsheet"></i>
      </button>
    </div>
<br>  
  <form id="crearCompetencia" class="crear-ficha-form">
    <input type="hidden" name="id_programa" value="<?= $idPrograma  ?>">
    <label for="fichaNumber">Nombre de la competencia</label>
    <input type="text" name="nombreCompetencia" id="fichaNumber" placeholder="Ingrese el nombre de la competencia" required>

   

    <label for="day">Total horas de Crear RAEla competencia</label>
      <input type="text" name="horas" placeholder="Ingrese las horas" required>
    

    <div class="buttons-container">
      <a href=".?page=programas/listar_competencias&programa=<?= $idPrograma ?>">
        Cancelar
      </a>

      <input type="submit" value="Crear competencia">
    </div>
  </form>
</div>
<script src="/SSA/assets/js/crearCompetenciaForm.js"></script>
