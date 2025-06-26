<?php include_once __DIR__ . '/../../config.php'; ?>

<?php
  if (!isset($_SESSION["user"])){
      header("Location: ../../auth/login.php");
  }
?>

<?php
if (!isset($_GET["programa"]) || !is_numeric($_GET["programa"])) {
    die("ID de programa no válido.");
}
$idPrograma = intval($_GET["programa"]);
?>

<link rel="stylesheet" href="./assets/css/importar-aprendices.css">
<title>Importar competencias</title>

<div class="importar-aprendices-container">
  <h1 class="importar-title">
    Importar competencias
  </h1>

  <div class="warning-container">
    <div class="warning">
      <p>Para cargar los aprendices con un excel, este debe seguir un formato. El formato debe ser una tabla que contenga las siguientes columnas: {{Campos}}</p>

      <p>A continuación se muestra una imágen con un formato adecuado para subir los aprendices con un excel.</p>
    </div>

    <div class="img-container">
      <div class="img-clickable" onclick="toggleModal('imgModalBg', 'closeModal')">
        <span>Ver imágen</span>
      </div>
      <img src="./assets/img/hola.png" alt="Imágen con formato de excel" class="warning-image" onclick="toggleModal('imgModalBg', 'closeModal')">
    </div>
  </div>

  <form id="importarCompetencias" enctype="multipart/form-data" class="importar-form">
  <input type="hidden" name="programa" value="<?= $idPrograma ?>">

  <label for="fileInput">Seleccionar archivo</label>
  <input type="file" name="excel" id="fileInput" accept=".csv" required>

  <input type="submit" value="Importar competencias">
  <a href="<?php echo BASE_URL ?>index.php?page=programas/listar_programas" class="btn-cancelar">Cancelar</a>
</form>

</div>
<div id="respuesta"></div>

<div class="img-modal--bg" id="imgModalBg">
  <span id="closeModal">
    <i class="bi bi-x-lg"></i>
  </span>
  <img src="./assets/img/hola.png" alt="Imágen con formato de excel">
</div>

<script src="./assets/js/modalImage.js"></script>
<script src="./assets/js/importarCompetenciasForm.js"></script>