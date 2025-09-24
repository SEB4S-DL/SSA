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
<?php
// Verificar si ya se importaron competencias
require_once __DIR__ . '/../../db/conection.php';

function ya_tiene_competencias($idPrograma) {
    global $conn;
    $sql = "SELECT 1 FROM competencias WHERE id_programa_formacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPrograma);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

$yaImportado = ya_tiene_competencias($idPrograma);
?>

<link rel="stylesheet" href="./assets/css/importar-aprendices.css">
<title><?= $traducciones['titulo_importar_competencias']?></title>

<div class="importar-aprendices-container">
  <h1 class="importar-title">
    <?= $traducciones['titulo_importar_competencias']?>
  </h1>
  <button class="button-volver" onclick="window.location.href = '?page=programas/listar_competencias&programa=<?= $idPrograma ?>'">
      <i class="bi bi-arrow-left"></i> <?= $traducciones['volver']?>
  </button>
<br>
<br>

  <div class="warning-container">
    <div class="warning">
      <p><?= $traducciones['p1']?></p>


    <ul>
      <li><?= $traducciones['tipo_documento']?></li>
      <li><?= $traducciones['numero_de_documento']?></li>
      <li><?= $traducciones['nombre']?></li>
      <li><?= $traducciones['apellido']?></li>
      <li><?= $traducciones['estado']?></li>
      <li><?= $traducciones['competencia']?></li>
      <li><?= $traducciones['rae']?></li>
      <li><?= $traducciones['juicio_evaluacion']?></li>
      <li><?= $traducciones['fecha_hora']?></li>
      <li><?= $traducciones['funcionario']?></li>
    </ul>
    <br>
    <p><?= $traducciones['p2']?></p>
  <br>
    <p><?= $traducciones['p3']?></p>
    </div>

    <div class="img-container" onclick="window.open('./assets/img/juicios-excel.png')">
      <div class="img-clickable">
      </div>
      <img src="./assets/img/juicios-excel.png" alt="Imágen con formato de excel" class="warning-image">
    </div>
  </div>
<br>
 <?php if ($yaImportado): ?>
  <div class="warning" style="color: white; font-weight: bold;">
    <?= $traducciones['advertencia_importados']?>
  </div>
<?php else: ?>
  <form id="importarCompetencias" enctype="multipart/form-data" class="importar-form">
    <input type="hidden" name="idprograma" value="<?= $idPrograma ?>">

    <label for="fileInput"><?= $traducciones['seleccionar_archivo']?></label>
    <input type="file" name="excel" id="fileInput" accept=".csv" required>

    <input type="submit" value="<?= $traducciones['importar_competencias']?>">
    <a href="<?php echo BASE_URL ?>index.php?page=programas/listar_programas" class="btn-cancelar"><?= $traducciones['cancelar']?></a>
  </form>
  <?php endif; ?>


</div>
<div id="respuesta"></div>

<div class="img-modal--bg" id="imgModalBg">
  <span id="closeModal">
    <i class="bi bi-x-lg"></i>
  </span>
  <img src="./assets/img/formato-excel.png" alt="Imágen con formato de excel">
</div>

	<script src="<?php echo BASE_URL?>assets/js/modalImage.js"></script>
	<script src="<?php echo BASE_URL?>assets/js/importarCompetenciasForm.js"></script>
